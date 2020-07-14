<?php
namespace DB\Model\SQLQueryBuilder;

class MySQLQueryBuilder implements SQLQueryBuilder
{
    private static ?MySQLQueryBuilder $instance = null;
    private SQLQuery $query;

    private function __construct()
    {
        $this->query = new SQLQuery();
    }

    public static function getInstance() : MySQLQueryBuilder
    {
        if (self::$instance == null)
            self::$instance = new MySQLQueryBuilder();
        return self::$instance;
    }

    /**
     * @inheritDoc
     */
    public function select(string $table, array $fields = ['*']) : SQLQueryBuilder
    {
        $this->query->reset();
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
        $this->query->reset();
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
        $this->query->reset();
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
     */
    public function where(array $conditions = [], string $operator = "AND") : SQLQueryBuilder
    {
        if (empty($conditions)) return $this;

        $fields = array_keys($conditions);
        $fields = array_map(function($val) { return $val . "=?"; }, $fields);
        $sql = " WHERE " . implode(" $operator ", $fields);

        $this->query->appendStatement($sql);
        $this->query->appendValues(array_values($conditions));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function limit(int $count, int $offset = 0) : SQLQueryBuilder
    {
        $sql = " LIMIT " . $offset . ", " . $count;

        $this->query->appendStatement($sql);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function orderBy(array $fields) : SQLQueryBuilder
    {
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