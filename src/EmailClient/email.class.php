<?php
namespace EmailClient;

use Exception;

class Email {
    private array $recipients;
    private string $subject;
    private string $message;

    /**
     * Getter
     * 
     * @param string $field valid = 'subject' 'recipients' 'message'
     * 
     * @return string|array
     */
    public function getField(string $field)
    {
        if (property_exists($this, $field))
            return $this->$field;
        throw new Exception("Invalid parameter $field for getField");
    }

    /**
     * Setter
     * 
     * @param string $field valid = 'subject' 'recipients' 'message'
     * @param string|array $value
     */
    public function setField(string $field, $value) : void
    {
        if (property_exists($this, $field))
        {
            $this->$field = $value;
            return;
        }
        throw new Exception("Invalid parameter $field for setField");
    }
}