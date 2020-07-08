<?php
namespace DB\Model;

abstract class EmployeeModel extends Model{
    
    function __construct()
    {
        parent::__construct('employee');
    }

    protected function getRecordByID($empID){
        $columnNames= array('EmpID');
        $columnVals= array($empID);
        $wantedColumns=array('EmpID','FirstName','LastName','Position','Email','Username');
        $results = parent::getRecords($columnNames,$columnVals,$wantedColumns); //change getRecords() to not get password from database
        return $results[0];
    }

    protected function getRecordByUsername($username){
        $columnNames= array('Username');
        $columnVals= array($username);
        $wantedColumns=array('EmpID','FirstName','LastName','Position','Email','Username');
        return parent::getRecords($columnNames,$columnVals,$wantedColumns);
    }

    protected function saveRecord($empID, $firstName, $lastName, $position, $email, $username, $password) {
        $columnNames = array('EmpID','FirstName','LastName','Position','Email','Username','Password');
        $columnVals = array($empID, $firstName, $lastName, $position, $email, $username, $password);
        parent::addRecord($columnNames,$columnVals);
    }

    protected function checkPassword($username,$password){
        $columnNames= array('Username');
        $columnVals= array($username);
        $wantedColumns=array('Username','Password');
        return (parent::getRecords($columnNames,$columnVals,$wantedColumns)[0]['Password']==$password)? true:false;
    }

    public function getEmails(string $position)
    {
        $colmunNames = array('Position');
        $columnVals = array($position);
        $wantedCols = array('Email');
        $emailRecords = parent::getRecords($colmunNames,$columnVals,$wantedCols);

        $emails = array();
        foreach ($emailRecords as $email)
        {
             array_push($emails,$email['Email']);
        }
        return $emails;
    }

    public function getEmail(string $position)
    {
        switch ($position)
        {
            case 'requester':

            case 'jo':

            case 'cao';
        }
    }
}