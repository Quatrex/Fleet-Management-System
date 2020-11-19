<?php
namespace EmailClient;

use Exception;

class EmailBuilder
{
    private static ?EmailBuilder $instance = null;
    private array $recipients;
    private string $message;
    private bool $subjectFlag;
    private bool $recipientFlag;
    private bool $messageFlag;
    private bool $paragraphFlag;
    private Email $email;


    public static function getInstance() : EmailBuilder
    {
        if (self::$instance == null)
            self::$instance = new self();
        self::$instance->recipients = [];
        self::$instance->subjectFlag = false;
        self::$instance->recipientFlag = false;
        self::$instance->messageFlag = false;
        self::$instance->paragraphFlag = false;
        self::$instance->message = '';
        self::$instance->email = new Email();
        return self::$instance;
    }

    /**
     * Add recipient(s) to the email
     * 
     * @param string|array $recipients
     * 
     * @return EmailBuilder
     */
    public function recipient($recipients) : EmailBuilder
    {
        $this->recipientFlag = true;
        if (is_string($recipients)) 
            $this->recipients[] = $recipients;
        else
            $this->recipients += $recipients;
        return $this;
    }

    /**
     * Set the subject of the email
     * 
     * @param string $subject
     * 
     * @return EmailBuilder
     */
    public function subject(string $subject) : EmailBuilder
    {
        if($this->subjectFlag) 
            throw new Exception('Subject can only be set once.');

        $this->subjectFlag = true;
        $this->email->setField('subject',$subject);
        return $this;
    }

    /**
     * Starts a new paragraph
     * 
     * @return EmailBuilder
     */
    public function paragraph() : EmailBuilder
    {
        if ($this->paragraphFlag)
            throw new Exception('Paragraph cannot be added inside another paragraph.');

        $this->paragraphFlag = true;
        $this->message.= "<p>";
        return $this;
    }

    /**
     * Add text to a paragraph
     * 
     * @param string $text
     * @param string $type valid = 'b' => bold 'i' => itallic 'u' => underline 'q' => quotes
     * 
     * @return EmailBuilder
     */
    public function text(string $text, string $type = '') : EmailBuilder
    {
        if ($text === '') return $this;

        if (!$this->paragraphFlag)
            throw new Exception('Text can only be added inside a paragraph.'); 

        switch($type)
        {
            case '':
                $this->message.= $text . ' ';
                break;
            case 'b':
                $this->message.= "<b>$text</b>" . ' ';
            break;
            case 'u':
                $this->message.= "<u>$text</u>" . ' ';
            break;
            case 'i':
                $this->message.= "<i>$text</i>" . ' ';
            break;
            case 'q':
                $this->message.= "\"$text\"" . ' ';
            break;
            default:
                throw new Exception("Invalid parameter type: $type for text");
        }
        
        return $this;
    }

    /**
     * Closes the existing paragraph
     * 
     * @return EmailBuilder
     */
    public function close() : EmailBuilder
    {
        if (!$this->paragraphFlag)
            throw new Exception('There is no paragraph to close.');

        $this->messageFlag = true;
        $this->paragraphFlag = false;
        $this->message.= "</p>";
        return $this;
    }

    /**
     * Returns the email object
     * 
     * @return Email
     */
    public function getEmail() : Email
    {
        if($this->paragraphFlag)
            throw new Exception('Paragraph must be closed to generate an email.');
        if(!$this->recipientFlag)
            throw new Exception('Recipients must be set to generate an email.');
        if(!$this->subjectFlag)
            throw new Exception('Subject must be set to generate an email.');
        if(!$this->messageFlag)
            throw new Exception('Message must be set to generate an email.');

        $this->email->setField('recipients',$this->recipients);
        $this->email->setField('message',$this->message);
        return $this->email;
    }
}