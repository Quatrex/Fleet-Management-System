<?php
namespace DB\Viewer;

use DB\Model\VehicleModel;

class VehicleViewer extends VehicleModel{
    public function __construct()
    {
        parent::__construct();
    }

    public function getRecordByID($registrationNo){
        return parent::getRecordByID($registrationNo);
    }

    public function getAllRecords(){
        $results = parent::getAllRecords();
        return $results;
    }

}