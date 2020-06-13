<?php
class EmployeeViewer extends EmployeeModel{

    public function __construct()
    {
        parent::__construct();
    }

    public function getRecordByID($empID){
        return parent::getRecordByID($empID);
    }

    public function getRecordByUsername($empID){
        return parent::getRecordByUsername($empID);
    }
    
}