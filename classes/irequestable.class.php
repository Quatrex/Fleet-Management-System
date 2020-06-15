<?php
interface IRequestable{
    public function placeRequest($date,$time,$dropLocation,$pickLocation,$purpose); //create new request

    public function getMyPendingRequests();

    public function getCancelledRequests();

    public function getApprovedRequests();

    public function getOldRequests();
}
