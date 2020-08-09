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

    public function getEmails(string $position)
    {
        return parent::getEmails($position);
    }

    public function getAllEmployees(int $offset)
    {
        return parent::getAllEmployees($offset);
    }
    
    public function getEmployeesByPosition(string $position, int $offset)
    {
        parent::getEmployeesByPosition($position, $offset);
    }
}