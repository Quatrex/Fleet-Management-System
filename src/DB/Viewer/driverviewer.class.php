<?php
namespace DB\Viewer;

use DB\Model\DriverModel;

class DriverViewer extends DriverModel{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function getRecordByID($driverId){
        return parent::getRecordByID($driverId);
    }

    /**
     * @inheritDoc
     */
    public function getAllRecords(int $offset, array $sort, array $search){
        $results = parent::getAllRecords($offset,$sort,$search);
        return $results;
    }

}