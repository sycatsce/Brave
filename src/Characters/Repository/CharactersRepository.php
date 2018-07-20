<?php

namespace App\Characters\Repository;

use Framework\Helpers\CharacterRepositoryHelper;
use Framework\Helpers\RouterHelper;


class CharactersRepository
{

    /**
     * @var \PDO
     */
    private $pdo;

    use CharacterRepositoryHelper;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCharacter(int $id) : \stdClass
    {
        $query = $this->pdo->prepare("SELECT * FROM characters WHERE id = ?");
        $query->execute([$id]);
        $character = $query->fetch(\PDO::FETCH_OBJ);
        return $character;
    }

    public function getCharacters(): array
    {
        $characters = $this->pdo->query("SELECT * FROM characters")->fetchAll(\PDO::FETCH_OBJ);
        $this->retrieveAttributes($characters);
        foreach ($characters as $key=>$character){
            $characters[$key]->version = $this->getVersion($character->id);
            $characters[$key]->affiliation = $this->getAffiliation($character->id);

        }
        //dump($characters);

        //die;
        return $characters;
    }

    public function getVersion(int $id): string
    {
        $query = $this->pdo->prepare("SELECT name FROM versions WHERE id = (SELECT id_version FROM characters WHERE id = ?)");
        $query->execute([$id]);
        $version = $query->fetch(\PDO::FETCH_OBJ);
        return $version->name;
    }

    public function getAffiliation(int $id): string
    {
        $query = $this->pdo->prepare("SELECT name FROM affiliations WHERE id = (SELECT id_affiliation FROM characters WHERE id = ?)");
        $query->execute([$id]);
        $affiliation = $query->fetch(\PDO::FETCH_OBJ);
        return $affiliation->name;
    }
}
