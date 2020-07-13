<?php

namespace DB\Model;

use DB\Model\SQLQueryBuilder\MySQLQueryBuilder;
use DB\Model\SQLQueryBuilder\SQLQueryBuilder;

abstract class Model
{
    protected $tableName;
    protected DatabaseHandler $dbh;
    private SQLQueryBuilder $queryBuilder;

    public function __construct(String $tableName)
    {
        $this->tableName = $tableName;
        $this->dbh = DatabaseHandler::getInstance();
        $this->queryBuilder = MySQLQueryBuilder::getInstance();
    }

    protected function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * A general code to generate a SQL statement to add records to database.
     */
    protected function addRecord(array $values): void
    {
        $query = $this->queryBuilder->insert($this->tableName,$values)
                                    ->getSQLQuery();
        
        $this->dbh->write($query);
    }

    /**
     * A general code to generate SQL statement to get records from the database.
     */
    protected function getRecords(array $conditions = [], array $wantedFields = ['*']): array
    {
        $query = $this->queryBuilder->select($this->tableName,$wantedFields)
                                    ->where($conditions)
                                    ->getSQLQuery();

        $result = $this->dbh->read($query);

        return $result ? $result : [];
    }

    /**
     * A general code to generate SQL statement to update a record in the database.
     */
    protected function updateRecord(array $values, array $conditions): void {
        $query = $this->queryBuilder->update($this->tableName,$values)
                                    ->where($conditions)
                                    ->getSQLQuery();

        $this->dbh->write($query);
    }

    /**
     * A general code to generate SQL statement to get records from multiple tables in the database.
     */
    public function getRecordsFromTwo(array $joinConditions, array $conditions = [], array $wantedFields = ['*']): array {

        $query = $this->queryBuilder->select($this->tableName,$wantedFields)
                                    ->join($this->tableName,$joinConditions)
                                    ->where($conditions)
                                    ->getSQLQuery();

        $result = $this->dbh->read($query);

        return $result ? $result : [];
    }
}
