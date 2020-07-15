<?php

namespace DB\Model\SQLQueryBuilder;

use Exception;

class SQLException extends Exception
{
    private function getErrorMessage() : string
    {
        switch ($this->getCode())
        {
            case 0: return $this->getMessage();
            case 1: return $this->getMessage() . ' can only be used once in a query';
            case 2: return "'" . $this->getMessage() . "' attribute does not exist in SQLQuery";
            case 3: return 'Cannot begin a SQL statement with ' . $this->getMessage() .
                            '. Only SELECT, INSERT or UPDATE are applicable';
        }
    }

    public function __toString()
    {
        return 'SQLException: ' . $this->getErrorMessage() . ' ' . $this->getTraceAsString();
    }
}