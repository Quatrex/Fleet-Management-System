<?php
namespace DB\Viewer;

use DB\Model\EmployeeModel;

class EmployeeViewer extends EmployeeModel{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function getRecordByID($empID){
        return parent::getRecordByID($empID);
    }

    /**
     * @inheritDoc
     */
    public function getRecordByEmail($email){
        return parent::getRecordByEmail($email);
    }

    /**
     * @inheritDoc
     */
    public function checkPasswordByID($empID,$oldPassword){
        return parent::checkPasswordByID($empID,$oldPassword);
    }

    /**
     * @inheritDoc
     */
    public function getEmails(string $position)
    {
        return parent::getEmails($position);
    }

    /**
     * @inheritDoc
     */
    public function getAllEmployees(int $offset, array $sort, array $search)
    {
        return parent::getAllEmployees($offset,$sort,$search);
    }

    /**
     * @inheritDoc
     */
    public function getEmployeesByPosition(string $position, int $offset, array $sort, array $search)
    {
        parent::getEmployeesByPosition($position, $offset,$sort,$search);
    }
}