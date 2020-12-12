<?php

namespace DB\Controller;


use DB\Model\EmployeeModel;

class EmployeeController extends EmployeeModel
{
    /**
     * @inheritDoc
     */
    public function saveRecord($empID, $firstName, $lastName, $position, $designation, $email, $password, $profilePicturePath, $contactNumber)
    {
        parent::saveRecord($empID, $firstName, $lastName, $position, $designation, $email, $password, $profilePicturePath, $contactNumber);
    }

    /**
     * @inheritDoc
     */
    public function updateEmployeeInfo($empID, $newEmpID, $firstName, $lastName, $position, $designation, $email, $contactNumber)
    {
        parent::updateEmployeeInfo($empID, $newEmpID, $firstName, $lastName, $position, $designation, $email, $contactNumber);
    }

    /**
     * @inheritDoc
     */
    public function updateEmployeePassword($empID, $newPassword)
    {
        parent::updateEmployeePassword($empID, $newPassword);
    }

    /**
     * @inheritDoc
     */
    public function updateEmployeeProfilePicture($empID,string $imagePath)
    {
        parent::updateEmployeeProfilePicture($empID,$imagePath);
    }

    /**
     * @inheritDoc
     */
    public function deleteEmployee($empID)
    {
        parent::deleteEmployee($empID);
    }
}
