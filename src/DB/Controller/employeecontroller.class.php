<?php
namespace DB\Controller;


use DB\Model\EmployeeModel;

class EmployeeController extends EmployeeModel{
    public function saveRecord($empID, $firstName, $lastName, $position, $email, $username, $password) {
        parent::saveRecord($empID, $firstName, $lastName, $position, $email, $username, $password);
    }
}