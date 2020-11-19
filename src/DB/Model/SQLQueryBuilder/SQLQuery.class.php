<?php
namespace DB\Model\SQLQueryBuilder;

class SQLQuery
{
    private string $statement;
    private array $values;
    private ?string $type;

    public function __construct()
    {
        $this->statement = '';
        $this->values = [];
        $this->type = null;
    }

    /**
     * @param string $field
     * 
     * @return string|array
     * @throws SQLException
     */
    public function getField(string $field){ 
        if(property_exists($this,$field)){
            return $this->$field;
        }
        throw new SQLException($field, 2);
    }

    /**
     * Appends the statement to the current sql statement
     * 
     * @param string $statement
     * 
     */
    public function appendStatement(string $statement) : void
    {
        $this->statement .= $statement;
    }

    /**
     * Appends placeholder values to the current values
     * 
     * @param array $values
     */
    public function appendValues(array $values) : void
    {
        $this->values = array_merge($this->values,$values);
    }

    public function setType(string $type) : void
    {
        $this->type = $type;
    }

    /**
     * Resets all the current values
     */
    public function reset() : void
    {
        $this->statement = '';
        $this->values = [];
        $this->type = null;
    }
}