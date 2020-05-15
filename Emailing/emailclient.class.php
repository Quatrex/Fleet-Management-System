<?php
require_once 'PHPMailer/PHPMailerAutoload.php';

class EmailClient {
    private PHPMailer $mail;

    //referencing the arrays of JOs, CAOs, and VPMOs
    private $jos;
    private $caos;
    private $vpmos;

    function __construct() {

        $this->mail = new PHPMailer();

        //initialize the arrays of JOs, CAOs, and VPMOs
    }

    public function notifyRequestSubmission(Request $request) {
        //notifying all the JOs about the new vehicle request

        $emailTemplate = new Email();
        $emailTemplate ->setSubject("New Vehicle Request");
        $emailTemplate ->setMessage($request ->getRequesterFullName() . " has requested a vehicle");

        //sending emails to JOs
        foreach ($this ->jos as $jo) {
            $email = clone $emailTemplate;
            $email ->setRecepient($jo ->getEmail());
            $this -> sendMail($email);
        }
    }

    public function notifyJOApproval(Request $request) {
        //notify both CAOs and the requester about the justification

        $emailTemplate = new Email();
        $emailTemplate ->setSubject("Request Justification");
        $emailTemplate ->setMessage($request ->getJOFullName(). " has approved the justification for the vehicle request.");

        //sending emails to CAOs
        foreach ($this ->caos as $cao) {
            $email = clone $emailTemplate;
            $email ->setRecepient($cao ->getEmail());
            $this -> sendMail($email);
        }

        //sending email to the requester
        $email = clone $emailTemplate;
        $email ->setRecepient($request ->getRequesterEmail());
        $this -> sendMail($email);
    }

    public function notifyJODenial(Request $request) {
        //notify the requester about the justification denial

        $email =  new Email();
        $email ->setSubject("Request Justification");
        $email ->setMessage($request ->getJOFullName(). " has denied the justification for the vehicle request.");
        $email ->setRecepient($request ->getRequesterEmail());
        $this -> sendMail($email);  
    }

    public function notifyCAOApproval(Request $request) {
        //notify both CAOs and the requester about the approval

        $emailTemplate = new Email();
        $emailTemplate ->setSubject("Request Approval");
        $emailTemplate ->setMessage($request ->getCAOFullName(). " has approved the vehicle request.");

        //sending emails to VPMOs
        foreach ($this ->vpmos as $vpmo) {
            $email = clone $emailTemplate;
            $email ->setRecepient($vpmo ->getEmail());
            $this -> sendMail($email);
        }

        //sending email to the JO
        $email = clone $emailTemplate;
        $email ->setRecepient($request ->getJOEmail());
        $this -> sendMail($email);

        //sending email to the requester
        $email = clone $emailTemplate;
        $email ->setRecepient($request ->getRequesterEmail());
        $this -> sendMail($email);
    }

    public function notifyCAODenial(Request $request) {
        //notify both the JO and the requester about the denial

        $emailTemplate = new Email();
        $emailTemplate ->setSubject("Request Approval");
        $emailTemplate ->setMessage($request ->getCAOFullName(). " has denied the vehicle request.");

        //sending email to the JO
        $email = clone $emailTemplate;
        $email ->setRecepient($request ->getJOEmail());
        $this -> sendMail($email);

        //sending email to the requester
        $email = clone $emailTemplate;
        $email ->setRecepient($request ->getRequesterEmail());
        $this -> sendMail($email);
    }

    private function sendMail(Email $email) {
        //establishing the conncetion with the mail server and sending the composed message

        //initialize settings
        $this ->mail ->Hostname = 'localhost.localdomain';
        $this ->mail ->IsSmtp(true);
        if (!$this->mail->isSMTP()) return; // smtp authentification failed  
        $this ->mail ->SMTPDebug = 0;
        $this ->mail ->SMTPAuth = true;
        $this ->mail ->SMTPSecure = 'tls';
        $this ->mail ->Host = "smtp.gmail.com";
        $this ->mail ->Port = 587; 
        $this ->mail ->IsHTML(true);
        $this ->mail ->Username = ""; //set email address
        $this ->mail ->Password = ""; //set password
        $this ->mail ->SetFrom("noreply@quatrex.lk");

        //composing message
        $this ->mail ->AddAddress($email ->getRecepient());
        $this ->mail ->Subject = $email ->getRecepient();
        $this ->mail ->Body = $email ->getMessage();
        
        //sending the email
        try {
            $this ->mail->Send();
            echo "Mail sent";
        } catch (phpmailerException $e) {
            $e -> errorMessage();
            echo "Mail not sent";
        }
    }
}