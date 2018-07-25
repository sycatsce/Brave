<?php

namespace App\Characters\Repository;

use Framework\Helpers\CharactersRepositoryHelper;
use Framework\Helpers\RouterHelper;


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

    public function getCharacter(int $id) : array
    {
        $query = $this->pdo->prepare("SELECT * FROM characters WHERE id = ?");
        $query->execute([$id]);
        $character = $query->fetch(\PDO::FETCH_ASSOC);
        $attributes = $this->retrieveAttributes($character);
        $character['attributes'] = $attributes;
        return $character;
    }

    public function getCharacters(): array
    {
        $characters = $this->pdo->query("SELECT * FROM characters")->fetchAll(\PDO::FETCH_ASSOC);
        foreach($characters as $key=>$character){
            $attributes = $this->retrieveAttributes($character);
            $characters[$key]['attributes'] = $attributes;
        }
        return $characters;
    }

    public function getVersion(int $id): string
    {
        $query = $this->pdo->prepare("SELECT name FROM versions WHERE id = (SELECT id_version FROM characters WHERE id = ?)");
        $query->execute([$id]);
        $version = $query->fetch(\PDO::FETCH_OBJ);
        return $version->name;
    }

    public function getAffiliation(int $id, int $affiliationNb = 1): string
    {
        if ($affiliationNb == 1){
            $query = $this->pdo->prepare("SELECT name FROM affiliations WHERE id = (SELECT id_affiliation FROM characters WHERE id = ?)");
            $query->execute([$id]);
            $affiliation = $query->fetch(\PDO::FETCH_OBJ);
            return $affiliation->name;
        } else if ($affiliationNb == 2){
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

    public function getKiller(int $id, int $killerNb = 1): string
    {
        if ($killerNb == 1){
            $query = $this->pdo->prepare("SELECT name, value FROM killers WHERE id = (SELECT id_killer FROM characters WHERE id = ?)");
            $query->execute([$id]);
            $killer = $query->fetch(\PDO::FETCH_OBJ);
            return $killer->value . ' ' . $killer->name;
        } else if ($killerNb == 2){
            $query = $this->pdo->prepare("SELECT name, value FROM killers WHERE id = (SELECT id_killer2 FROM characters WHERE id = ?)");
            $query->execute([$id]);
            $killer = $query->fetch(\PDO::FETCH_OBJ);
            return $killer->value . ' ' . $killer->name;
        }
    }

    public function getStats(int $id)
    {
        $query = $this->pdo->prepare("SELECT name, value FROM statsnames, statsvalues WHERE statsvalues.id_charaStats = ? AND statsvalues.id_statsNames = statsnames.id");
        $query->execute([$id]);
        $stats = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $stats;
    }
}
