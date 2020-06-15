<?php
class DatabaseHandler {
    private static ?DatabaseHandler $instance = null;
    //private $host = 'remotemysql.com';
    //private $user = 'Kvs8AuC78e';
    //private $pass = 'bmMrp4oj2h';
    //private $dbname = 'Kvs8AuC78e';
    //private $port = '3306';
    private $host = 'localhost';
    private $user = '';
    private $pass = '';
    private $dbname = 'misc';
    private $port = '3306';
    private PDO $pdo;

    private function __construct() {
        $this->pdo = new PDO('mysql:host=remotemysql.com;port=3306;dbname=Kvs8AuC78e','Kvs8AuC78e','bmMrp4oj2h');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public static function getInstance() {
        if (DatabaseHandler::$instance == null) {
            DatabaseHandler::$instance = new DatabaseHandler();
        }
        return DatabaseHandler::$instance;
    }

    public function execute($sql,$columnVals) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($columnVals);
        $results = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($results,$row);
        }
        return $results;
    }

}