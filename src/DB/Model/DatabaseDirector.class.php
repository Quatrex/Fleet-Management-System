<?php

namespace DB\Model;

use DB\Model\SQLQueryBuilder\SQLQuery;

interface DatabaseDirector {
    
    /**
     * Initialize the connection to the database
     */
    public function initializeConnection();

    /**
     * Read data from the data base
     * 
     * @param SQLQuery $query
     * 
     * @return array
     */
    public function read(SQLQuery $query) : array;

    /**
     * Write to the database
     * 
     * @param SQLQuery $query
     */
    public function write(SQLQuery $query);
}