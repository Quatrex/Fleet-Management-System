<?php

class Model extends DBH
{

    protected function addRecord($date, $time, $pickup, $dropoff, $purpose, $requesterID)
    {
        $conn = $this->connect();

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


    protected function getRecords($requesterID, $status)
    {

        $conn = $this->connect();

        if ($stmt = $conn->prepare("SELECT * FROM request WHERE 'RequesterID'=? AND 'Status'=?")) {
            $stmt->bind_param($requesterID, $status);
            $stmt->execute();
            $result = $stmt->store_result();
            $num = $result->num_rows;

            $requests=array();
            for ($j = 0; $j < $num; ++$j) {
                $row = $result->fetch_array(MYSQLI_ASSOC);

                $requestID = $row['RequestID'];
                $createdDate = $row['CreatedDate'];
                $status = $row['Status'];
                $dateOfTrip = $row['DateOfTrip'];
                $timeOfTrip = $row['TimeOfTrip'];
                $dropLocation = $row['DropLocation'];
                $pickLocation = $row['PickLocation'];
                $requesterID = $row['RequesterID'];
                $purpose = $row['Purpose'];
                $justifiedBy = $row['JustifiedBy'];
                $approvedBy = $row['ApprovedBy'];
                $JOComment = $row['JOComment'];
                $CAOComment = $row['CAOComment'];

                $request= new Request($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$purpose,$requesterID);
                $request->requestID=$requestID;
                $request->createdDate=$createdDate;
                $request->justifiedBy=$justifiedBy;
                $request->approvedBy=$approvedBy;
                $request->JOcomment=$JOComment;
                $request->CAOcomment=$CAOComment;
                
                array_push($requests,$request);
            }

            $stmt->close();
            return $requests;
        }
        else{
            return false;
        }

        // $sql = "SELECT * FROM $table WHERE 'RequesterID'=? AND 'Status'=?";

        // $stmt = mysqli_stmt_init($conn);
        // if (!mysqli_stmt_prepare($stmt, $sql)) {
        // } else {
        //     mysqli_stmt_bind_param($stmt, "si", $requesterID, $status);
        //     mysqli_stmt_execute($stmt);
        // }
        // mysqli_stmt_close($stmt);
        // mysqli_close($conn);
    }
}
