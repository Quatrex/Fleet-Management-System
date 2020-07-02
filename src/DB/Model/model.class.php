<?php

namespace DB\Model;

abstract class Model
{
    protected $tableName;
    protected DatabaseHandler $dbh;

    public function __construct(String $tableName)
    {
        $this->tableName = $tableName;
        $this->dbh = DatabaseHandler::getInstance();
    }

    protected function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * A general code to generate a SQL statement to add records to database.
     */
    protected function addRecord(array $columnNames, array $columnVals): void
    {
        $condition = '';
        $count = 0;
        $tail = '';

        foreach ($columnNames as $key => $value) {

            $condition .= "`" . $value . "`";
            $tail .= '?';
            if (sizeof($columnNames) > ($count + 1)) {
                $condition .= " , ";
                $tail .= ',';
            }
            $count += 1;
        }
        $condition .= ') VALUES (' . $tail . ');';
        $preStatement = "INSERT INTO `" . $this->tableName . "` (";
        $sql = $preStatement . $condition;

        $this->dbh->write($sql, $columnVals);
    }

    /**
     * A general code to generate SQL statement to get records from the database.
     */
    protected function getRecords(array $columnNames, array $columnVals, array $wantedCols = array('*')): array
    {
        $condition = '';
        $count = 0;

        foreach ($columnNames as $key => $value) {
            $condition .= "`" . $value . "`" . "=?";
            if (sizeof($columnNames) > ($count + 1)) {
                $condition .= " AND ";
            }
            $count += 1;
        }

        $wantedColumns = '';
        if (sizeof($wantedCols) > 1) {
            $wantedColumns = join(",", $wantedCols);
        } else {
            $wantedColumns = $wantedCols[0];
        }

        $preStatement = "SELECT $wantedColumns FROM `" . $this->tableName . "` WHERE ";
        //"SELECT * FROM `request` WHERE `RequesterID`=? AND `Status`=?"
        $sql = $preStatement . $condition; //"SELECT * FROM $table WHERE 'RequesterID'=? AND 'Status'=?";
        //$sql="SELECT * FROM `employee` WHERE `EmpID`=?";
        $result = $this->dbh->read($sql, $columnVals);

        if ($result == false) {
            //there is no data for those values
            echo "Error: No Data for given ID";
            echo "<br>" . $sql . "<br>";
            print_r($columnVals);
            return [];
        } else {
            return $result;
        }
    }

    /**
     * A general code to generate SQL statement to update a record in the database.
     */
    protected function updateRecord(
        array $columnNames,
        array $columnVals,
        array $conditionNames,
        array $conditionVals
    ): void {
        //Generates "'Name1=?' 'Name2=?' ... " for setting
        $preCondition = '';
        $count = 0;
        foreach ($columnNames as $key => $value) {
            $preCondition .= "`" . $value . "`" . "=?";
            if (sizeof($columnNames) > ($count + 1)) {
                $preCondition .= " , ";
            }
            $count += 1;
        }

        //Generates "'Name1=?' AND 'Name2=?' ... " for WHERE condition
        $postCondition = '';
        $count = 0;
        foreach ($conditionNames as $key => $value) {
            $postCondition .= "`" . $value . "`" . "=?";
            if (sizeof($conditionNames) > ($count + 1)) {
                $postCondition .= " AND ";
            }
            $count += 1;
        }

        $preStatement = "UPDATE $this->tableName SET ";
        $sql = $preStatement . $preCondition . " WHERE " . $postCondition;
        $this->dbh->write($sql, array_merge($columnVals, $conditionVals));
    }

    /**
     * A general code to generate SQL statement to get records from multiple tables in the database.
     */
    public function getRecordsFromTwo(
        string $secondTable,
        array $conditionCols,
        array $wantedCols = array('*')
    ): array {
        // SELECT table1.column_name1 , table2.column_name2
        // FROM table1 INNER JOIN table2 
        // ON table1.column_name = table2.column_name;

        $wantedColumns = '';
        $wantedArray = array();
        if (sizeof($wantedCols) > 1) {
            foreach ($wantedCols as $table => $cols) {
                foreach ($cols as $col) {
                    array_push($wantedArray, $table."." . $col);
                }
            }
            $wantedColumns = join(",", $wantedArray);
        } else {
            $wantedColumns = $wantedCols[0];
        }

        $joinTables = $this->tableName . ' NATURAL JOIN ' . $secondTable;
        // if (sizeof($tableNames) >= 1) {
        //     $joinTables .= join(" NATURAL JOIN ", $tableNames);
        // } else {
        //     $joinTables = $this->tableName;
        // }

        $preStatement = "SELECT $wantedColumns FROM `" . $joinTables . "` ON ";

        $condition = '';
        $count = 0;

        foreach ($conditionCols as $col) {
            $condition .= "`" . $this->tableName . $col . "`" . " = " . $secondTable . $col;
            if (sizeof($conditionCols) > ($count + 1)) {
                $condition .= " AND ";
            }
            $count += 1;
        }

        $sql = $preStatement . $condition;
        $result = $this->dbh->read($sql);

        if ($result == false) {
            //there is no data 
            return [];
        } else {
            return $result;
        }
    }
}
