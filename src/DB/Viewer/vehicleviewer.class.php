<?php
namespace DB\Viewer;

use DB\Model\VehicleModel;

class VehicleViewer extends VehicleModel{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function getRecordByID($registrationNo, $isLeased){
        return parent::getRecordByID($registrationNo, $isLeased);
    }

    /**
     * @inheritDoc
     */
    public function getAllRecords(int $offset, array $sort, array $search, array $states){
        return parent::getAllRecords($offset,$sort,$search,$states);
    }

    /**
     * @inheritDoc
     */
    public function isLeasedVehicle($registrationNo) : bool 
    {
        return parent::isLeasedVehicle($registrationNo);
    }

}