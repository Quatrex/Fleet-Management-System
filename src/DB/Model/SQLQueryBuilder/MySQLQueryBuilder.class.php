<?php
namespace DB\Model\SQLQueryBuilder;

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
     * @throws SQLException
     */
    public function select(string $table, array $fields = ['*']) : SQLQueryBuilder
    {
        if ($this->query->getField('type') !== null) 
            throw new SQLException('SELECT', 1);
        
        $sql = "SELECT " . implode(", ", $fields) . " FROM " . $table;

        $this->query->appendStatement($sql);
        $this->query->setType('select');
        return $this;
    }

    /**
     * @inheritDoc
     * @throws SQLException
     */
    public function insert(string $table, array $values) : SQLQueryBuilder
    {
        if ($this->query->getField('type') !== null) 
            throw new SQLException('INSERT', 1);

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
     * @throws SQLException
     */
    public function update(string $table, array $values) : SQLQueryBuilder
    {
        if ($this->query->getField('type') !== null) 
            throw new SQLException('UPDATE', 1);

        $fields = array_keys($values);
        $fields = array_map(function($val) { return $val . "=?"; }, $fields);
        $sql = "UPDATE " . $table . " SET " . implode(", ", $fields);

        $this->query->appendStatement($sql);
        $this->query->appendValues(array_values($values));
        $this->query->setType('insert');
        return $this;
    }

    /**
     * @inheritDoc
     * @throws SQLException
     */
    public function where(): WhereBuilder
    {
        if ($this->query->getField('type') === null)
            throw new SQLException('WHERE', 3);
            
        return WhereBuilder::getInstance($this->query);
    }

    /**
     * @inheritDoc
     * @throws SQLException
     */
    public function limit(int $count, int $offset = 0) : SQLQueryBuilder
    {
        if ($this->query->getField('type') === null)
            throw new SQLException('LIMIT', 3);

        if ($this->query->getField('type') !== 'select')
            throw new SQLException('LIMIT can only be added to SELECT');

        $sql = " LIMIT " . $offset . ", " . $count;

        $this->query->appendStatement($sql);
        return $this;
    }

    /**
     * @inheritDoc
     * @throws SQLException
     */
    public function orderBy(array $fields) : SQLQueryBuilder
    {
        if ($this->query->getField('type') === null)
            throw new SQLException('ORDER BY', 3);

        if ($this->query->getField('type') !== 'select')
            throw new SQLException('ORDER BY can only be added to SELECT');

        $values = [];
        foreach($fields as $field => $type) array_push($values, "$field $type");
        $sql = " ORDER BY " . implode(", ", $values);

        $this->query->appendStatement($sql);
        return $this;
    }

    /**
     * @inheritDoc
     * @throws SQLException
     */
    public function join(string $table, array $conditions) : SQLQueryBuilder
    {
        if ($this->query->getField('type') === null)
            throw new SQLException('INNER JOIN');
            
        if ($this->query->getField('type') === 'insert')
            throw new SQLException('JOIN can only be added to SELECT or UPDATE');

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