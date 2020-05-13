<?php
interface IRequestable{
    public function placeRequest($date,$time,$dropLocation,$pickLocation,$purpose,$requesterID); //create new request
    public function getRequests(); //check database for requests placed by the requester and return an array oof requests
}
