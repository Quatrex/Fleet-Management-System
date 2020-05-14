<?php

class Model extends DBH{
    
    protected function addRecord($date,$time,$pickup,$dropoff,$purpose,$requesterID){
        $conn=$this->connect();
        
        if (empty($date)  || empty($time) || empty($pickup) || empty($dropoff)) {
        } else {
        
            $sql = "INSERT INTO request(DateOfTrip,TimeOfTrip,DropLocation,PickLocation,RequesterID) VALUES(?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            } else {
                mysqli_stmt_bind_param($stmt, "ssssi", $date, $time, $dropoff, $pickup, $requesterID);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
}