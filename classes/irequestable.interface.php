<?php
interface IRequestable{
    public function placeRequest($date,$time,$dropLocation,$pickLocation,$purpose,$requesterID); //create new request

    public function getPendingRequests();

    public function getCancelledRequests();

    public function getApprovedRequests();

    public function getOldRequests();
}
