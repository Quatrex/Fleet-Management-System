<?php

class Model extends DBH
{

    protected function addRecord($date, $time, $pickup, $dropoff, $purpose, $requesterID)
    {

        $conn = $this->connect();

        if (empty($date)  || empty($time) || empty($pickup) || empty($dropoff) || empty($purpose)) {
        } else {

            $sql = "INSERT INTO request(DateOfTrip,TimeOfTrip,DropLocation,PickLocation,RequesterID,Purpose) VALUES(?,?,?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            } else {
                mysqli_stmt_bind_param($stmt, "ssssis", $date, $time, $dropoff, $pickup, $requesterID, $purpose);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }


    protected function getRecords($requesterID, $status)
    {

        $conn = $this->connect();

        if ($stmt = $conn->prepare("SELECT * FROM `request` WHERE `RequesterID`=? AND `Status`=?")) {
            $stmt->bind_param('ii', $requesterID, $status);
            $stmt->execute();
            $result = $stmt->get_result();
            $num = $result->num_rows;

            $requests = array();
            for ($j = 0; $j < $num; ++$j) {
                $row = mysqli_fetch_assoc($result);

                $requestID = $row['RequestID'] == null ? "" : $row['RequestID'];
                $createdDate = $row['CreatedDate'] == null ? "" : $row['CreatedDate'];
                $status = $row['Status'] == null ? "" : $row['Status'];
                $dateOfTrip = $row['DateOfTrip'] == null ? "" : $row['DateOfTrip'];
                $timeOfTrip = $row['TimeOfTrip'] == null ? "" : $row['TimeOfTrip'];
                $dropLocation = $row['DropLocation'] == null ? "" : $row['DropLocation'];
                $pickLocation = $row['PickLocation'] == null ? "" : $row['PickLocation'];
                $requesterID = $row['RequesterID'] == null ? "" : $row['RequesterID'];
                $purpose = $row['Purpose'] == null ? "" : $row['Purpose'];
                $justifiedBy = $row['JustifiedBy'] == null ? "" : $row['JustifiedBy'];
                $approvedBy = $row['ApprovedBy'] == null ? "" : $row['ApprovedBy'];
                $JOComment = $row['JOComment'] == null ? "" : $row['JOComment'];
                $CAOComment = $row['CAOComment'] == null ? "" : $row['CAOComment'];

                $request = new Request($dateOfTrip, $timeOfTrip, $dropLocation, $pickLocation, $purpose, $requesterID);
                $request->requestID = $requestID;
                $request->createdDate = $createdDate;
                $request->justifiedBy = $justifiedBy;
                $request->approvedBy = $approvedBy;
                $request->JOcomment = $JOComment;
                $request->CAOcomment = $CAOComment;
                $request->state = $status;

                array_push($requests, $request);
            }

            $stmt->close();
            return $requests;
        } else {
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

    protected function getRecordsEmp($position)
    {

        $conn = $this->connect();

        if ($stmt = $conn->prepare("SELECT `Email` FROM `employee` WHERE `Position`=?")) {
            $stmt->bind_param('s', $position);
            $stmt->execute();
            $result = $stmt->get_result();
            $num = $result->num_rows;

            $emails = array();
            for ($j = 0; $j < $num; ++$j) {
                $row = mysqli_fetch_assoc($result);
                array_push($emails, $row['Email']);
            }

            $stmt->close();
            return $emails;
        } else {
            return false;
        }
    }

    protected function checkPassword($username, $pass)
    {

        $conn = $this->connect();

        if ($stmt = $conn->prepare('SELECT empid,firstname,lastname,position,email,password FROM employee WHERE username = ?')) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($empid, $firstname, $lastname, $position, $email, $password);
                $stmt->fetch();
                if ($pass === $password) {
                    //TODO: password hashing
                    //if (password_verify($_POST['password'], $password)) {
                    $stmt->close();
                    return [$username,$empid, $firstname, $lastname, $position, $email, $password];
                    
                } else {
                    $stmt->close();
                    return false;
                }
            } else {
                $stmt->close();
                return false;
            }

            $stmt->close();
        }else {
            return false;
        }
    }
}
