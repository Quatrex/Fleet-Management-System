<?php
namespace EmailClient;

interface Mailer
{
    /**
     * Set up the connection with the mail server
     */
    public function config() : void;

    /**
     * Send an email
     * 
     * @param Email $email
     */
    public function send(Email $email) : void;
}