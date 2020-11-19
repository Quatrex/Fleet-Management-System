<?php

namespace DB\Model;

use DB\Model\SQLQueryBuilder\SQLQuery;


class DatabaseHandler
{
    private static ?DatabaseHandler $instance = null;
    private DatabaseDirector $director;

    private function __construct()
    {
        $this->director = new PDOAdapter();
        $this->director->initializeConnection();
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
        return $this->director->read($query);
    }

    /**
     * Write records to the database by running a sql query
     * 
     * @param SQLQuery $query
     */
    public function write(SQLQuery $query)
    {
        return $this->director->write($query);
    }
}
