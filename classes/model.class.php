<?php
abstract class Model
{
    protected $tableName;
    protected DatabaseHandler $dbh;

    public function __construct(String $tableName) {
        $this->tableName = $tableName;
        $this->dbh = DatabaseHandler::getInstance();
    }
    //write a general code for addRecord. use a key(column name)-value(data value) pair array to get values
    protected function addRecord($tableName,$columnNames,$columnVals,$columnDataTypes)//$date, $time, $pickup, $dropoff, $purpose, $requesterID) // rework the function
    {
    }

    protected function getRecords($columnNames,$columnVals){
        $condition = '';
        $count = 0;

        foreach ($columnNames as $key => $value) {
            $condition=$condition."`".$value."`"."=?";
            if(sizeof($columnNames)>($count+1)){
                $condition=$condition." AND ";
            }
            $count+=1;
        }

        $preStatement="SELECT * FROM `".$this->tableName."` WHERE ";
        //"SELECT * FROM `request` WHERE `RequesterID`=? AND `Status`=?"
        $sql = $preStatement.$condition; //"SELECT * FROM $table WHERE 'RequesterID'=? AND 'Status'=?";
        //$sql="SELECT * FROM `employee` WHERE `EmpID`=?";
        $result = $this->dbh->execute($sql,$columnVals);

        if ($result == false ) {
            //there is no data for those values
            echo "Error: No Data for given ID";
            return false;
        } else {
            return $result;
        }
    }

    protected function getRecordsEmp($position)
    {
        
    }
}