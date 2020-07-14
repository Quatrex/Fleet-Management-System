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
     * Returns the DataBaseHandler object
     */
    public static function getInstance(): DatabaseHandler
    {
        if (DatabaseHandler::$instance == null) {
            DatabaseHandler::$instance = new self();
        }
        return DatabaseHandler::$instance;
    }

    /**
     * Reads records from the database by running a sql query
     */
    public function read(SQLQuery $query): array
    {
        $stmt = $this->pdo->prepare($query->getField('sqlStatement'));
        $stmt->execute($query->getField('placeholderVals'));
        $results = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($results, $row);
        }
        return $results;
    }

    /**
     * Writes records to the database by running a sql query
     */
    public function write(SQLQuery $query)
    {
        $stmt = $this->pdo->prepare($query->getField('sqlStatement'));
        $stmt->execute($query->getField('placeholderVals'));
    }
}
