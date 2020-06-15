<?php

abstract class Model extends DBH
{
    protected $tableName;

    //write a general code for addRecord. use a key(column name)-value(data value) pair array to get values
    protected function addRecord($tableName,$columnNames,$columnVals,$columnDataTypes)//$date, $time, $pickup, $dropoff, $purpose, $requesterID) // rework the function
    {
        
        $conn = $this->connect();


        $sql = "INSERT INTO request(DateOfTrip,TimeOfTrip,DropLocation,PickLocation,RequesterID,Purpose) VALUES(?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
        } else {
            mysqli_stmt_bind_param($stmt, "ssssis", $date, $time, $dropoff, $pickup, $requesterID,$purpose);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

    protected function getRecords($tableName,$columnNames,$columnVals,$columnDataTypes){
        $conn=$this->connect();

        $count=0;
        $condition="";
        foreach ($columnNames as $key => $value) {

            $condition=$condition."`".$value."`"."=?";
            if(sizeof($columnNames)>($count+1)){
                $condition=$condition." AND ";
            }
            $count+=1;
        }

        $preStatement="SELECT * FROM `".$tableName."` WHERE ";
        //"SELECT * FROM `request` WHERE `RequesterID`=? AND `Status`=?"
        $sql = $preStatement.$condition; //"SELECT * FROM $table WHERE 'RequesterID'=? AND 'Status'=?";
        //$sql="SELECT * FROM `employee` WHERE `EmpID`=?";
        $stmt = mysqli_stmt_init($conn);
        $result=false;
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            //TODO
        } else {
            switch (sizeof($columnVals)) {
                case 1:
                    mysqli_stmt_bind_param($stmt, $columnDataTypes, $columnVals[0]);
                    break;
                case 2:
                    mysqli_stmt_bind_param($stmt, $columnDataTypes, $columnVals[0],$columnVals[1]);
                    break;
                case 3:
                    mysqli_stmt_bind_param($stmt, $columnDataTypes, $columnVals[0],$columnVals[1],$columnVals[2]);
                    break;
                default:
                  //code to be executed if n is different from all labels;
              }
            //mysqli_stmt_bind_param($stmt, "si", "1", 2 ); //need to put switch case to varying sizes
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $result;
    }

    protected function getRecordsEmp($position)
    {

        $conn = $this->connect();

        if ($stmt = $conn->prepare("SELECT `Email` FROM `employee` WHERE `Position`=?")) {
            $stmt->bind_param('s',$position);
            $stmt->execute();
            $result = $stmt->get_result();
            $num = $result->num_rows;

            $emails=array();
            for ($j = 0; $j < $num; ++$j) {
                $row = mysqli_fetch_assoc($result);
                array_push($emails,$row['Email']);
            }

            $stmt->close();
            return $emails;
        }
        else{
            return false;
        }
    }
}


    // protected function getRecords($requesterID, $status) //rework the function
    // {

    //     $conn = $this->connect();

    //     if ($stmt = $conn->prepare("SELECT * FROM `request` WHERE `RequesterID`=? AND `Status`=?")) {
    //         $stmt->bind_param('ii',$requesterID,$status);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         $num = $result->num_rows;

    //         $requests=array();
    //         for ($j = 0; $j < $num; ++$j) {
    //             $row = mysqli_fetch_assoc($result);

    //             $requestID = $row['RequestID']==null?"":$row['RequestID'];
    //             $createdDate = $row['CreatedDate']==null?"":$row['CreatedDate'];
    //             $status = $row['Status']==null?"":$row['Status'];
    //             $dateOfTrip = $row['DateOfTrip']==null?"":$row['DateOfTrip'];
    //             $timeOfTrip = $row['TimeOfTrip']==null?"":$row['TimeOfTrip'];
    //             $dropLocation = $row['DropLocation']==null?"":$row['DropLocation'];
    //             $pickLocation = $row['PickLocation']==null?"":$row['PickLocation'];
    //             $requesterID = $row['RequesterID']==null?"":$row['RequesterID'];
    //             $purpose = $row['Purpose']==null?"":$row['Purpose'];
    //             $justifiedBy = $row['JustifiedBy']==null?"":$row['JustifiedBy'];
    //             $approvedBy = $row['ApprovedBy']==null?"":$row['ApprovedBy'];
    //             $JOComment = $row['JOComment']==null?"":$row['JOComment'];
    //             $CAOComment = $row['CAOComment']==null?"":$row['CAOComment'];

    //             $request= new Request($dateOfTrip,$timeOfTrip,$dropLocation,$pickLocation,$purpose,$requesterID);
    //             $request->requestID=$requestID;
    //             $request->createdDate=$createdDate;
    //             $request->justifiedBy=$justifiedBy;
    //             $request->approvedBy=$approvedBy;
    //             $request->JOcomment=$JOComment;
    //             $request->CAOcomment=$CAOComment;
    //             $request->state=$status;

    //             array_push($requests,$request);
    //         }

    //         $stmt->close();
    //         return $requests;
    //     }
    //     else{
    //         return false;
    //     }
    // }