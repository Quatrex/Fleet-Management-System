<?php
namespace DB\Controller;


use DB\Model\EmployeeModel;

class EmployeeController extends EmployeeModel{
    public function saveRecord($empID, $firstName, $lastName, $position, $designation, $email, $username, $password) {
        parent::saveRecord($empID, $firstName, $lastName, $position, $designation, $email, $username, $password);
    }

    public function updateEmployeeInfo($prevEmpID, $empID, $firstName, $lastName, $position, $designation, $email, $username){
        parent::updateEmployeeInfo($prevEmpID, $empID, $firstName, $lastName, $position, $designation, $email, $username);
    }

    public function deleteEmployee($empID){
        parent::deleteEmployee($empID);
    }
}