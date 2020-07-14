<?php

namespace DB\Model;

use PDO;
use DB\Model\SQLQueryBuilder\SQLQuery;

class DatabaseHandler
{
    private static ?DatabaseHandler $instance = null;
    private string $host = 'remotemysql.com';
    private string $user = 'Kvs8AuC78e';
    private string $pass = 'bmMrp4oj2h';
    private string $dbname = 'Kvs8AuC78e';
    private string $port = '3306'; //Config::$port
    private PDO $pdo;

    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';
        dbname=' . $this->dbname, $this->user, $this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Returns the DatabaseHandler object
     */
    public static function getInstance(): DatabaseHandler
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Read records from the database by running a sql query
     * 
     * @param SQLQuery $query
     * 
     * @return array
     */
    public function read(SQLQuery $query): array
    {
        $stmt = $this->pdo->prepare($query->getField('statement'));
        $stmt->execute($query->getField('values'));
        $results = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($results, $row);
        }
        $query->reset();
        return $results;
    }

    /**
     * Write records to the database by running a sql query
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
