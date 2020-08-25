<?php
namespace DB\Viewer;

use DB\Model\EmployeeModel;

class EmployeeViewer extends EmployeeModel{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get employee details from the database.
     */
    public function getRecordByID($empID){
        return parent::getRecordByID($empID);
    }

    public function getRecordByUsername($userName){
        return parent::getRecordByUsername($userName);
    }

    public function checkPassword($userName,$password){
        return parent::checkPassword($userName,$password);
    }

    public function checkPasswordByID($empID,$oldPassword){
        return parent::checkPasswordByID($empID,$oldPassword);
    }

    public function getEmails(string $position)
    {
        return parent::getEmails($position);
    }

    public function getAllEmployees(int $offset, array $sort, array $search)
    {
        return parent::getAllEmployees($offset,$sort,$search);
    }
    
    public function getEmployeesByPosition(string $position, int $offset, array $sort, array $search)
    {
        parent::getEmployeesByPosition($position, $offset,$sort,$search);
    }
}