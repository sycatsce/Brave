<?php

namespace App\Characters\Repository;

use Framework\Helpers\CharactersRepositoryHelper;
use Framework\Helpers\RouterHelper;
use App\Characters\Entity\Character;
use Pagerfanta\Pagerfanta;
use Framework\Database\Paginate;

class CharactersRepository
{

    /**
     * @var \PDO
     */
    private $pdo;

    use CharactersRepositoryHelper;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCharacter(int $id) : Character
    {
        $query = $this->pdo->prepare("SELECT * FROM characters WHERE id = ?");
        $query->execute([$id]);
        $query->setFetchMode(\PDO::FETCH_CLASS, Character::class);
        $character = $query->fetch();
        return $character;
    }

    public function getCharacters(int $perPage, int $currentPage): Pagerfanta
    {
        $characters = $this->pdo->query("SELECT * FROM characters ORDER BY release_date DESC")->fetchAll(\PDO::FETCH_ASSOC);
        $adapter = new Paginate($this->pdo, $characters, 'SELECT count(id) FROM characters');
        return (new Pagerfanta($adapter))->setMaxPerPage($perPage)->setCurrentPage($currentPage);
    }

    public function getVersion(int $id): string
    {
        $query = $this->pdo->prepare("SELECT name FROM versions WHERE id = (SELECT id_version FROM characters WHERE id = ?)");
        $query->execute([$id]);
        $version = $query->fetch(\PDO::FETCH_OBJ);
        return $version->name;
    }

    public function getAffiliation(int $id, int $affiliationNb = 1)
    {
        if ($affiliationNb == 1) {
            $query = $this->pdo->prepare("SELECT name FROM affiliations WHERE id = (SELECT id_affiliation FROM characters WHERE id = ?)");
            $query->execute([$id]);
            $affiliation = $query->fetch(\PDO::FETCH_OBJ);
            return $affiliation->name;
        } elseif ($affiliationNb == 2) {
            $query = $this->pdo->prepare("SELECT name FROM affiliations WHERE id = (SELECT id_affiliation2 FROM characters WHERE id = ?)");
            $query->execute([$id]);
            $affiliation = $query->fetch(\PDO::FETCH_OBJ);
            return $affiliation->name;
        }
    }

    public function getSoulTrait(int $id): string
    {
        $query = $this->pdo->prepare("SELECT effet FROM soultraits WHERE id = (SELECT id_soultrait FROM characters WHERE id = ?)");
        $query->execute([$id]);
        $soultrait = $query->fetch(\PDO::FETCH_OBJ);
        return $soultrait->effet;
    }

    public function getAttribute(int $id): string
    {
        $query = $this->pdo->prepare("SELECT attribute FROM attributes WHERE id = (SELECT id_attribute FROM characters WHERE id = ?)");
        $query->execute([$id]);
        $attribute = $query->fetch(\PDO::FETCH_OBJ);
        return $attribute->attribute;
    }

    public function getKiller(int $id, int $killerNb = 1)
    {
        if ($killerNb == 1) {
            $query = $this->pdo->prepare("SELECT name, value FROM killers WHERE id = (SELECT id_killer FROM characters WHERE id = ?)");
            $query->execute([$id]);
            $killer = $query->fetch(\PDO::FETCH_OBJ);
            return array("name" => $killer->name, "value" => $killer->value);
        } elseif ($killerNb == 2) {
            $query = $this->pdo->prepare("SELECT name, value FROM killers WHERE id = (SELECT id_killer2 FROM characters WHERE id = ?)");
            $query->execute([$id]);
            $killer = $query->fetch(\PDO::FETCH_OBJ);
            return array("name" => $killer->name, "value" => $killer->value);
        }
    }

    public function getStats(int $id)
    {
        $query = $this->pdo->prepare("SELECT statsnames.id, name, value FROM statsnames, statsvalues WHERE statsvalues.id_charaStats = ? AND statsvalues.id_statsNames = statsnames.id");
        $query->execute([$id]);
        $stats = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $stats;
    }

    public function getVersions()
    {
        $versions = $this->pdo->query("SELECT * FROM versions")->fetchAll(\PDO::FETCH_ASSOC);
        return $versions;
    }

    public function getAffiliations()
    {
        return $this->pdo->query("SELECT * FROM affiliations")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getSoulTraits()
    {
        return $this->pdo->query("SELECT * FROM soultraits")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getKillers()
    {
        return $this->pdo->query("SELECT * FROM killers")->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAttributes()
    {
        return $this->pdo->query("SELECT * FROM attributes")->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Update the datas of a characters in database
     */
    public function update(int $id, array $params): bool
    {
        if ($params['id_killer2'] == '') {
            unset($params['id_killer2']);
            $s = $this->pdo->prepare("UPDATE characters SET id_killer2 = null WHERE id = :id");
            $s->execute(['id' => $id]);
        }

        if ($params['id_affiliation2'] == '') {
            unset($params['id_affiliation2']);
            $s = $this->pdo->prepare("UPDATE characters SET id_affiliation2 = null WHERE id = :id");
            $s->execute(['id' => $id]);
        }

        $fieldQuery = join(', ', array_map(function ($field) {
            return "$field = :$field";
        }, array_keys($params)));
        
        $params['id'] = $id;

        $statement = $this->pdo->prepare("UPDATE characters SET $fieldQuery WHERE id = :id");
        return $statement->execute($params);
    }


    public function updateStats(int $id, array $stats)
    {

        $statement = $this->pdo->prepare("UPDATE statsvalues SET value = :statVal WHERE id_statsNames = :statId and id_charaStats = :charaId");
        foreach ($stats as $key => $stat) {
            $statement->execute(['statVal' => $stat, 'statId' => substr($key, -1), 'charaId' => $id]);
        }
    }

    public function create(array $params, array $stats)
    {
        $fieldQuery = join(', ', array_map(function ($field) {
            return ":$field";
        }, array_keys($params)));

        $cols = join(', ', array_map(function ($field) {
            return '`'. $field . '`';
        }, array_keys($params)));

        $statement = $this->pdo->prepare("INSERT INTO `sycatsce`.`characters` ($cols) VALUES ($fieldQuery)");
        if (true == $statement->execute($params)) {
            $id = $this->pdo->lastInsertId();
            foreach ($stats as $stat => $val) {
                $statement = $this->pdo->prepare("INSERT INTO `sycatsce`.`statsvalues` (`id_charaStats`, `id_statsNames`, `value`) VALUES (:idChara, :idStat, :val)");
                $statement->execute([
                    'idChara' => $id,
                    'idStat' => substr($stat, -1),
                    'val' => $val
                ]);
            }
        }
    }

    public function delete(int $id)
    {
        $statement = $this->pdo->prepare("DELETE FROM `sycatsce`.`statsvalues` WHERE `id_charaStats` = ?");
        if ($statement->execute([$id])) {
            $statement = $this->pdo->prepare("DELETE FROM `sycatsce`.`characters` WHERE `id` = ?");
            return $statement->execute([$id]);
        }
    }
}
