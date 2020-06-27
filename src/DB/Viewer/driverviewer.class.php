<?php
namespace DB\Viewer;

use DB\Model\DriverModel;

class DriverViewer extends DriverModel{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRecordByID($driverId){
        return parent::getRecordByID($driverId);
    }

    public function getAllRecords(){
        $results = parent::getAllRecords();
        return $results;
    }

}