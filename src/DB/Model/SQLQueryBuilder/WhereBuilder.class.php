<?php
namespace DB\Model\SQLQueryBuilder;

use Exception;

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
     * 
     * @param array $conditions ['Field' => 'Value'] or ['Field' => [Values]]
     * @param string $operator @default AND | OR
     * 
     * @return WhereBuilder
     */
    function conditions(array $conditions, string $operator = "AND") : WhereBuilder
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

        $fields = array_map(function($val) { return $val . "=?"; }, $fields);
        $sql = implode(" $operator ", $fields);
        
        $this->query->appendStatement($sql);
        $this->query->appendValues($flatValues);
        return $this;
    }

    /**
     * Opens a brackets for multiple conditions
     * 
     * @param string $operation - join with previous condition
     */
    function open(string $operation = "AND") : WhereBuilder
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
     * 
     */
    function close() : WhereBuilder
    {
        if ($this->activeParentheses < 1) 
            throw new Exception('There are no open parentheses to close');

        if (!$this->start) 
            throw new Exception('Cannot start WHERE condition with a closing parenthesis');

        $this->query->appendStatement(')');
        $this->activeParentheses--;

        return $this;
    }

    public function getWhere()
    {
        if ($this->activeParentheses !== 0)
            throw new Exception('Parentheses are not close');

        $this->query;
        return MySQLQueryBuilder::getInstance($this->query);
    }
}