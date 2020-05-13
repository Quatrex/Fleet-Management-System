<?php
class Request
{
    private int $requestID; 
    private $createdDate; //how handle 'date' in php? 
    private $date; //how handle 'date' in php? 
    private $time; //how handle 'time' in php? 
    private string $dropLocation;
    private string $pickLocation;
    private string $purpose; 
    private string $requesterID; //EmpID
    private string $comments; //recheck implementation of  "HashMap(String,Employee)"
    private int $state;
    private string $justifiedBy; //EmpID
    private string $approvedBy; //EmpID
}