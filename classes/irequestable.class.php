<?php
interface IRequestable{
    public function placeRequest($date,$time,$dropLocation,$pickLocation,$purpose); //create new request

    public function getPendingRequests($requesterID, $status);

    public function getCancelledRequests();

    public function getApprovedRequests();

    public function getOldRequests();
}
