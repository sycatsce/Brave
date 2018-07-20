<?php

namespace App\Characters\Repository;

class CharactersRepository
{

    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCharacter(int $id) : \stdClass
    {
        $query = $this->pdo->prepare("SELECT * from characters WHERE id = ?");
        $query->execute([$id]);
        $character = $query->fetch(\PDO::FETCH_OBJ);
        return $character;
    }

    public function getCharacters(): array
    {
        $characters = $this->pdo->query("SELECT * FROM characters")->fetchAll();
        return $characters;
    }
}
