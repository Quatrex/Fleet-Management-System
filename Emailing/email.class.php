<?php

class Email {
    private String $receipent;
    private String $subject;
    private String $message;

    function __construct()
    {
        
    }

    public function setRecepient($receipent) {
        $this->$receipent = $receipent;
    }

    public function setSubject($subject) {
        $this->$subject = $subject;
    }

    public function setMessage($message) {
        $this->$message = $message;
    }
}