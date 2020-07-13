<?php
namespace Employee\Factory\Privileged;

use DB\Controller\EmployeeController;
use DB\Viewer\EmployeeViewer;

class Administrator extends PrivilegedEmployee
{
    public function getAllEmployees(){
        //return an array of all employees (implement sperately for drivers)
    }

    public function createNewAccount(){
        //create a new employee account
    }

    public function updateAccount(){
        //update an existing employee account's details
    }

    public function removeAccount(){
        //delete an employee account
    }
}
