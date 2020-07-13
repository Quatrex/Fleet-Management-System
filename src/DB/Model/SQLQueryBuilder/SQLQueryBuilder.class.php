<?php
namespace DB\Model\SQLQueryBuilder;

interface SQLQueryBuilder
{
    /**
     * Builds SELECT statement
     * 
     * @param string $table
     * @param array $fields
     * 
     * @return SQLQueryBuilder
     */
    public function select(string $table, array $fields = ['*']) : SQLQueryBuilder;

    /**
     * Builds INSERT statement
     * 
     * @param string $table
     * @param array $values ['Field' => 'Value']
     * 
     * @return SQLQueryBuilder
     */
    public function insert(string $table, array $values) : SQLQueryBuilder;

    /**
     * Builds UPDATE statement
     * 
     * @param string $table
     * @param array $values ['Field' => 'Value']
     * 
     * @return SQLQueryBuilder
     */
    public function update(string $table, array $values) : SQLQueryBuilder;

    /**
     * Builds WHERE statement
     * 
     * @param array $conditions ['Field' => 'Value']
     * @param string $operator @default AND | OR
     * 
     * @return SQLQueryBuilder
     */
    public function where(array $conditions = [], string $operator = "AND") : SQLQueryBuilder;

    /**
     * Builds LIMIT statement
     * 
     * @param int $count
     * @param int $offset @default = 0
     * 
     * @return SQLQueryBuilder
     */
    public function limit(int $count, int $offset = 0) : SQLQueryBuilder;

    /**
     * Builds ORDER BY statement
     * 
     * @param array $fields ['Field' => ASC | DESC]
     * 
     * @return SQLQueryBuilder
     */
    public function orderBy(array $fields) : SQLQueryBuilder;

    /**
     * Builds INNER JOIN statement
     * 
     * @param array $tables
     * @param array $conditions [['Table1' => 'Field1', 'Table2' => 'Field2']]
     * 
     * @return SQLQueryBuilder
     */
    public function join(string $table, array $conditions) : SQLQueryBuilder;

    public function getSQLQuery() : SQLQuery;
}