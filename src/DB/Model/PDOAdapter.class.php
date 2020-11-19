<?php

namespace DB\Model;

use Core\Config;
use DB\Model\SQLQueryBuilder\SQLQuery;
use PDO;

class PDOAdapter implements DatabaseDirector
{
    private PDO $pdo;
    private string $host;
    private string $port;
    private string $dbname;
    private string $user;
    private string $pass;

    public function __construct() {
        $this->host = Config::$host;
        $this->port = Config::$port;
        $this->dbname = Config::$dbname;
        $this->user = Config::$user;
        $this->pass = Config::$pass;
    }

    /**
     * @inheritDoc
     */
    public function initializeConnection()
    {
        $this->pdo = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';
        dbname=' . $this->dbname, $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @inheritDoc
     *
     * @param SQLQuery $query
     * @return array
     */
    public function read(SQLQuery $query): array
    {
        $stmt = $this->pdo->prepare($query->getField('statement'));
        $stmt->execute($query->getField('values'));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $query->reset();
        return $results;
    }

    /**
     * @inheritDoc
     *
     * @param SQLQuery $query
     */
    public function write(SQLQuery $query)
    {
        $stmt = $this->pdo->prepare($query->getField('statement'));
        $stmt->execute($query->getField('values'));
        $query->reset();
    }
}