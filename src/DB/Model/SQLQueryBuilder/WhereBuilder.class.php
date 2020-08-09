<?php
namespace DB\Model\SQLQueryBuilder;

use DB\Model\DatabaseHandler;

class WhereBuilder
{
    private static ?WhereBuilder $instance = null;
    private bool $start;
    private SQLQuery $query;
    private int $activeParentheses;

    private function __construct() {}

    public static function getInstance(SQLQuery $query) : WhereBuilder
    {
        if (self::$instance == null)
            self::$instance = new self($query);
        self::$instance->query = $query;
        self::$instance->start = false;
        self::$instance->activeParentheses = 0;
        return self::$instance;
    }

    /**
     * Builds the conditions for WHERE statement
     * Output is similar to "Field = Value AND|OR Field = Value"
     * 
     * @param array $conditions ['Field' => 'Value'] or ['Field' => [Values]]
     * @param string $operator @default AND | OR
     * 
     * @return WhereBuilder
     */
    public function conditions(array $conditions, string $operator = "AND", string $mathOp = "=") : WhereBuilder
    {
        if (empty($conditions)) return $this;

        if (!$this->start)
        {
            $this->query->appendStatement(" WHERE ");
            $this->start = true;
        }

        $values = array_values($conditions);
        $fields = array_keys($conditions);
        $flatValues = [];
        foreach($values as $key => $value)
        {
            if (is_array($value)) 
            {
                $numElements = sizeof($value);
                $numElements--;
                $elements = [];
                for($i = 0; $i < $numElements; $i++) array_push($elements,$fields[$key]);
                array_splice($fields,$key,0,$elements);
                $flatValues = array_merge($flatValues,$value);
            } else
            {
                array_push($flatValues,$value);
            }
        }

        foreach ($fields as $key=>$val)
            $fields[$key] = $val . "$mathOp?";
        $sql = implode(" $operator ", $fields);
        
        $this->query->appendStatement($sql);
        $this->query->appendValues($flatValues);
        return $this;
    }

    /**
     * Opens a brackets for multiple conditions
     * 
     * @param string $operation @default = AND | OR - with previous condition
     * 
     * @return WhereBuilder
     */
    public function open(string $operation = "AND") : WhereBuilder
    {
        if ($this->start)
            $this->query->appendStatement(" $operation (");
        else
        {
            $this->query->appendStatement(" WHERE (");
            $this->start = true;
        }
        $this->activeParentheses++;
        return $this;
    }

    /**
     * Closes the parenthesis
     * @return WhereBuilder
     * 
     * @throws SQLException
     */
    public function close() : WhereBuilder
    {
        if ($this->activeParentheses < 1) 
            throw new SQLException('There are no open parentheses to close');

        if (!$this->start) 
            throw new SQLException('Cannot start a WHERE condition with a closing parenthesis');

        $this->query->appendStatement(')');
        $this->activeParentheses--;

        return $this;
    }

    /**
     * BUILDS LIKE statements. 
     * Output is similar to "(Field LIKE '%keyword%')"
     * 
     * @param string $table
     * @param string $keyword
     * @param string $fields ['Field'] @default = all
     * 
     * @return WhereBuilder
     * @throws SQLException
     */
    public function like(string $table, string $keyword, array $fields = []) : WhereBuilder
    {
        if (!$this->start) 
            throw new SQLException('Cannot start a WHERE condition with LIKE');

        if (empty($fields))
        {
            // get the columns of the table
            $columnsSQL = "SELECT `COLUMN_NAME` FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'";
            $dbh = DatabaseHandler::getInstance();
            $columnQuery = new SQLQuery();
            $columnQuery->appendStatement($columnsSQL);
            $columnRecords = $dbh->read($columnQuery);
            array_walk_recursive($columnRecords, function($a) use (&$fields) { $fields[] = $a;});
        }
        
        
        //build the sql query for like
        $sql = " AND (";
        $values = array_fill(0, sizeof($fields), "%$keyword%");
        $conditions = array_map(function($column) { return "$column LIKE ?";}, $fields);
        $sql .= implode(" OR ", $conditions);
        $sql .= ")";

        $this->query->appendStatement($sql);
        $this->query->appendValues($values);
        return $this;
    }

    /**
     * Returns the WHERE statement
     * 
     * @return SQLQueryBuilder
     * @throws SQLException
     */
    public function getWhere() : SQLQueryBuilder
    {
        if ($this->activeParentheses !== 0)
            throw new SQLException('Parentheses are not close');

        $this->query;
        return MySQLQueryBuilder::getInstance($this->query);
    }
}