<?php
namespace EmailClient;

class Email {
    private array $recipients;
    private String $subject;
    private String $message;

    public function __construct()
    {
        $this->recipients = array();
    }

    /**
     * Add recipient to an email
     * 
     * @param string $recipient
     */
    public function addRecepient(string $recipient) : void
    {
        array_push($this->receipents, $recipient);
    }

    /**
     * Add recipient to an email
     * 
     * @param array(String) $recipients
     * 
     */
    public function addRecepients(array $recipients) : void
    {
        $this->recipients += $recipients;
    }

    /**
     * Set the subject of the email
     * 
     * @param string $subject
     */
    public function setSubject(string $subject) 
    {
        $this->subject = $subject;
    }

    /**
     * Set the message of the email
     * 
     * @param string $message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    public function getRecepient() : array
    {
        return $this->recipients;
    }

    public function getSubject() : string
    {
        return $this->subject;
    }

    public function getMessage() : string
    {
        return $this->message;
    }
}