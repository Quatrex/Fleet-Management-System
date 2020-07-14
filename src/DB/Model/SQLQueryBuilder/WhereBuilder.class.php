<?php
namespace DB\Model\SQLQueryBuilder;

use Exception;

class WhereBuilder
{
    private static ?WhereBuilder $instance = null;
    private bool $start;
    private SQLQuery $query;
    private int $activeParenthesis;

    private function __construct() {}

    public static function getInstance(SQLQuery $query) : WhereBuilder
    {
        if (self::$instance == null)
            self::$instance = new self($query);
        self::$instance->query = $query;
        self::$instance->query->appendStatement(" WHERE ");
        self::$instance->start = false;
        self::$instance->activeParenthesis = 0;
        return self::$instance;
    }

    /**
     * Builds WHERE statement
     * 
     * @param array $conditions ['Field' => 'Value'] or ['Field' => [Values]]
     * @param string $operator @default AND | OR
     * 
     * @return WhereBuilder
     */
    function conditions(array $conditions, string $operator = "AND")
    {
        $this->start = true;

        if (empty($conditions)) return $this;

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

    function open(string $operation = "AND")
    {
        if ($this->start)
            $this->query->appendStatement(" $operation (");
        else
        {
            $this->query->appendStatement("(");
            $this->start = true;
        }
        $this->activeParenthesis++;
        return $this;
    }

    function close()
    {
        if ($this->activeParenthesis < 1) 
            throw new Exception('Cannot close as no parentheses are opened');

        $this->query->appendStatement(')');
        $this->activeParenthesis--;

        return $this;
    }

    public function getWhere()
    {
        if ($this->activeParenthesis !== 0)
            throw new Exception('Parentheses are not close');

        $this->query;
        return MySQLQueryBuilder::getInstance($this->query);
    }
}