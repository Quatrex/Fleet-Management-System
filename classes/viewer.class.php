<?php

class Viewer extends Model{
    public function getRecords($requesterID,$status){
        return parent::getRecords($requesterID,$status);
    }
}