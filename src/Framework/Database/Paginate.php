<?php

namespace Framework\Database;

use Pagerfanta\Adapter\AdapterInterface;

/**
 * Paginates characters
 */
class Paginate implements AdapterInterface
{

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var array
     */
    private $characters;

    /**
     * @var string
     */
    private $countQuery;

    public function __construct(\PDO $pdo, array $characters, string $countQuery)
    {
        $this->pdo = $pdo;
        $this->characters = $characters;
        $this->countQuery = $countQuery;
    }

    public function getNbResults(): int
    {
        return $this->pdo->query($this->countQuery)->fetchColumn();
    }

    public function getSlice($offset, $length)
    {
        return array_slice($this->characters, $offset, $length);
    }
}
