<?php

namespace DB\Model;

use DB\Model\SQLQueryBuilder\MySQLQueryBuilder;
use DB\Model\SQLQueryBuilder\SQLQuery;
use DB\Model\SQLQueryBuilder\SQLQueryBuilder;

abstract class Model
{
    protected $tableName;
    protected DatabaseHandler $dbh;
    protected SQLQueryBuilder $queryBuilder;

    public function __construct(String $tableName)
    {
        $query = new SQLQuery();
        $this->tableName = $tableName;
        $this->dbh = DatabaseHandler::getInstance();
        $this->queryBuilder = MySQLQueryBuilder::getInstance($query);
    }

    protected function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * A general code to generate a SQL statement to add records to database.
     * 
     * @param array $values ['Field' => 'Value']
     */
    protected function addRecord(array $values): void
    {
        $query = $this->queryBuilder->insert($this->tableName,$values)
                                    ->getSQLQuery();
        
        $this->dbh->write($query);
    }

    /**
     * A general code to generate SQL statement to get records from the database.
     * 
     * @param array $conditions ['Field' => 'Value'] or ['Field' => [Values]]
     * @param array $wantedFields ['Field'] @default = all
     * 
     * @return array
     */
    protected function getRecords(array $conditions = [], array $wantedFields = ['*']): array
    {
        $query = $this->queryBuilder->select($this->tableName,$wantedFields)
                                    ->where()
                                        ->conditions($conditions)
                                        ->getWhere()
                                    ->getSQLQuery();
        $result = $this->dbh->read($query);

        return $result ? $result : [];
    }

    /**
     * A general code to generate SQL statement to update a record in the database.
     * 
     * @param array $values ['Field' => 'Value']
     * @param array $conditions ['Field' => 'Value'] or ['Field' => [Values]]
     */
    protected function updateRecord(array $values, array $conditions): void 
    {
        $query = $this->queryBuilder->update($this->tableName,$values)
                                    ->where()
                                        ->conditions($conditions)
                                        ->getWhere()
                                    ->getSQLQuery();

        $this->dbh->write($query);
    }

    /**
     * A general code to generate SQL statement to get records from multiple tables in the database.
     * 
     * @param array $joinConditions [['Table1' => 'Field1', 'Table2' => 'Field2']]
     * @param array $conditions ['Field' => 'Value'] or ['Field' => [Values]]
     * @param array $wantedFields ['Field'] @default = all
     * 
     * @return array
     */
    public function getRecordsFromTwo(array $joinConditions, array $conditions = [], array $wantedFields = ['*']): array 
    {
        $query = $this->queryBuilder->select($this->tableName,$wantedFields)
                                    ->join($this->tableName,$joinConditions)
                                    ->where()
                                        ->conditions($conditions)
                                        ->getWhere()
                                    ->getSQLQuery();

        $result = $this->dbh->read($query);

        return $result ? $result : [];
    }

    /**
     * Generates SQL statement to get records for multiple states
     * 
     * @param array $conditions ['Field' => 'Value'] or ['Field' => [Values]] - primary conditions
     * @param array $stateConditions ['Field' => 'Value'] or ['Field' => [Values]] - state conditions
     * @param array $wantedFields ['Field'] @default = all
     * 
     * @return array
     */
    public function getRecordsFromMultipleStates(array $conditions, array $stateConditions, array $wantedFields = ['*']) : array
    {
        $query = $this->queryBuilder->select($this->tableName,$wantedFields)
                                    ->where()
                                        ->conditions($conditions)
                                        ->open()
                                        ->conditions($stateConditions,"OR")
                                        ->close()
                                        ->getWhere()
                                    ->orderBy(['DateOfTrip' => 'ASC'])
                                    ->getSQLQuery();

        $result = $this->dbh->read($query);

        return $result ? $result : [];
    }
}
