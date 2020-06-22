<?php
class DatabaseHandler {
    private static ?DatabaseHandler $instance = null;
    private $host = 'remotemysql.com';
    private $user = 'Kvs8AuC78e';
    private $pass = 'bmMrp4oj2h';
    private $dbname = 'Kvs8AuC78e';
    private $port = '3306';//Config::$port
    private PDO $pdo;

    private function __construct() {
        $this->pdo = new PDO('mysql:host='.$this->host.';port='.$this->port.';
        dbname='.$this->dbname,$this->user,$this->pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public static function getInstance() {
        if (DatabaseHandler::$instance == null) {
            DatabaseHandler::$instance = new self();
        }
        return DatabaseHandler::$instance;
    }

    public function read($sql,$columnVals) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($columnVals);
        $results = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($results,$row);
        }
        return $results;
    }

    public function write($sql,$columnVals) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($columnVals);
    }

}