<?php
namespace EmailClient;

class Email {
    private String $receipent;
    private String $subject;
    private String $message;

    public function setRecepient($receipent) {
        $this->receipent = $receipent;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getRecepient() {
        return $this->receipent;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getMessage() {
        return $this->message;
    }
}