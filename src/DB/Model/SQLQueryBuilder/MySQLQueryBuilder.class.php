<?php
namespace DB\Model\SQLQueryBuilder;

use Exception;

class MySQLQueryBuilder implements SQLQueryBuilder
{
    private static ?MySQLQueryBuilder $instance = null;
    private SQLQuery $query;

    private function __construct()
    {
    }

    public static function getInstance(SQLQuery $query) : MySQLQueryBuilder
    {
        if (self::$instance == null)
            self::$instance = new self;
        self::$instance->query = $query;
        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    public function select(string $table, array $fields = ['*']) : SQLQueryBuilder
    {
        if ($this->query->getField('type') !== null) 
            throw new Exception('SELECT, UPDATE or INSERT can only be used once in a query');
        
        $sql = "SELECT " . implode(", ", $fields) . " FROM " . $table;

        $this->query->appendStatement($sql);
        $this->query->setType('select');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function insert(string $table, array $values) : SQLQueryBuilder
    {
        if ($this->query->getField('type') !== null) 
            throw new Exception('SELECT, UPDATE or INSERT can only be used once in a query');

        $fields = array_keys($values);
        $sql = "INSERT INTO " . $table . " (" . implode(", ",$fields) . ") VALUES (". 
                substr(str_repeat("?,",sizeof($fields)),0,-1) . ")";
        
        $this->query->appendStatement($sql);
        $this->query->appendValues(array_values($values));
        $this->query->setType('insert');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function update(string $table, array $values) : SQLQueryBuilder
    {
        if ($this->query->getField('type') !== null) 
            throw new Exception('SELECT, UPDATE or INSERT can only be used once in a query');

        $fields = array_keys($values);
        $fields = array_map(function($val) { return $val . "=?"; }, $fields);
        $sql = "UPDATE " . $table . " SET " . implode(", ", $fields);

        $this->query->appendStatement($sql);
        $this->query->appendValues(array_values($values));
        $this->query->setType('insert');
        return $this;
    }

    public function where(): WhereBuilder
    {
        if ($this->query->getField('type') === null)
            throw new Exception('SQL Query must start with SELECT, INSERT or UPDATE');
            
        return WhereBuilder::getInstance($this->query);
    }

    /**
     * @inheritDoc
     */
    public function limit(int $count, int $offset = 0) : SQLQueryBuilder
    {
        if ($this->query->getField('type') === null)
            throw new Exception('SQL Query must start with SELECT, INSERT or UPDATE');

        if ($this->query->getField('type') !== 'select')
            throw new Exception('LIMIT can only be added to SELECT');

        $sql = " LIMIT " . $offset . ", " . $count;

        $this->query->appendStatement($sql);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function orderBy(array $fields) : SQLQueryBuilder
    {
        if ($this->query->getField('type') === null)
            throw new Exception('SQL Query must start with SELECT, INSERT or UPDATE');

        if ($this->query->getField('type') !== 'select')
            throw new Exception('ORDER BY can only be added to SELECT');

        $values = [];
        foreach($fields as $field => $type) array_push($values, "$field $type");
        $sql = " ORDER BY " . implode(", ", $values);

        $this->query->appendStatement($sql);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function join(string $table, array $conditions) : SQLQueryBuilder
    {
        if ($this->query->getField('type') === null)
            throw new Exception('SQL Query must start with SELECT, INSERT or UPDATE');
            
        if ($this->query->getField('type') === 'insert')
            throw new Exception('JOIN can only be added to SELECT or UPDATE');

        $tables = [];
        $values = [];

        //creating ON conditions
        foreach($conditions as $condition)
        {
            $onConditions = [];
            foreach ($condition as $onTable => $field)
            {
                array_push($onConditions,"$onTable.$field");
                array_push($tables,$onTable);
            }
            array_push($values,implode(" = ", $onConditions));
        }

        //Removing the initial table to avoid duplication
        $tables = array_unique($tables);
        foreach (array_keys($tables, $table) as $key) {
            unset($tables[$key]);
        }
         
        $tables = array_map(function($val) { return " INNER JOIN $val "; }, $tables);
        $sql = implode($tables) . "ON " . implode(" AND ", $values);

        $this->query->appendStatement($sql);
        return $this;
    }

    public function getSQLQuery() : SQLQuery
    {
        $this->query->appendStatement(';');
        return $this->query;
    }
}