<?php
namespace DB\Model\SQLQueryBuilder;

use FFI\Exception;

class SQLQuery
{
    private string $sqlStatement;
    private array $placeholderVals;
    private string $type;

    public function __construct()
    {
        $this->sqlStatement = '';
        $this->placeholderVals = [];
    }

    public function getField(string $field){ 
        if(property_exists($this,$field)){
            return $this->$field;
        }
        throw new Exception('Field does not exist');
    }

    /**
     * Appends the statement to the current sql statement
     * 
     * @param string $statement
     * 
     */
    public function appendStatement(string $statement) : void
    {
        $this->sqlStatement .= $statement;
    }

    /**
     * Appends placeholder values to the current values
     * 
     * @param array $values
     */
    public function appendValues(array $values)
    {
        $this->placeholderVals = array_merge($this->placeholderVals,$values);
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * Resets all the current values
     */
    public function reset() : void
    {
        $this->sqlStatement = '';
        $this->placeholderVals = [];
        $this->type = '';
    }
}