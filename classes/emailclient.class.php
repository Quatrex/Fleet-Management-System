<?php
require_once 'PHPMailer/PHPMailerAutoload.php';

class EmailClient {
    //referencing the arrays of JOs, CAOs, and VPMOs
    private $jos;
    private $caos;
    private $vpmos;
    private $viewer;

    function __construct() {
        // $this ->viewer = new Viewer();

        //initialize the arrays of JOs, CAOs, and VPMOs
        $this ->jos = $this ->viewer ->getRecordsEmp('jo');
        $this ->caos = $this ->viewer ->getRecordsEmp('cao');
        $this ->vpmos = $this ->viewer ->getRecordsEmp('vpmo');
    }

    public function notifyRequestSubmission(Request $request) {
        //notifying all the JOs about the new vehicle request
        $emailTemplate = new Email();
        $emailTemplate ->setSubject("New Vehicle Request");
        $emailTemplate ->setMessage($request ->getRequesterFullName() . " has requested a vehicle");

        //sending emails to JOs
        foreach ($this ->jos as $jo) {
            $email = clone $emailTemplate;
            $email ->setRecepient($jo);
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
            $email ->setRecepient($cao );
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
            $email ->setRecepient($vpmo);
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
        $mail = new PHPMailer();
        //establishing the conncetion with the mail server and sending the composed message

        //initialize settings
        //$this ->mail ->Hostname = 'localhost.localdomain';
        $mail ->IsSmtp(true);

        /*
        if (!$mail->isSMTP()) {
            echo "SMTP auth failed";
            //return; // smtp authentification failed  
        }
        */

        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail ->IsHTML(true);
        $mail->Username = "oopassign1@gmail.com"; //set email address
        $mail->Password = "pleasedontremovenetwork"; //set password
        $mail->SetFrom("noreply@quatrex.lk");

        //composing message
        $mail ->AddAddress($email ->getRecepient());
        $mail ->Subject = $email ->getSubject();
        $mail ->Body = $email ->getMessage();
        
        //if ($this ->mail -> send()) echo "EMAIL SENTTT!";
        //sending the email
        try {
            $mail->Send();
            //echo "Mail sent";
        } catch (phpmailerException $e) {
            $e -> errorMessage();
            echo "Mail not sent";
        }
        //$this ->clearMail();
    }
    /*
    private function clearMail() {
        //clear the details in the PHPMailer

        $this ->mail ->clearAddresses();
        $this ->mail ->Body = "";
        $this ->mail ->Subject = "";
    }
    */
}