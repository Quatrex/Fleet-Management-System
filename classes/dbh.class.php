<?php
class DBH {
    //initialize in constructor
    private $servername = 'remotemysql.com';
    private $dBUsername = 'Kvs8AuC78e';
    private $dBPassword = 'bmMrp4oj2h';
    private $dBName = 'Kvs8AuC78e';

    protected function connect(){
        $conn = mysqli_connect($this->servername, $this->dBUsername, $this->dBPassword, $this->dBName);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        else{
            return $conn;
        }

    }

}