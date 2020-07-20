<?php
namespace EmailClient;

use DB\Viewer\EmployeeViewer;

class EmailClient {
    private static ?EmailClient $instance = null;
    private Mailer $mailer;
    private ?array $joEmails = null;
    private ?array $caoEmails = null;
    private ?array $vpmoEmails = null;

    private function __construct()
    {
        $this->mailer = new PHPMailerAdapter();
        $this->mailer->config();
        if (!isset($_SESSION['emails'])) $_SESSION['emails'] = [];
    }

    public static function getInstance() : EmailClient 
    {
        if (self::$instance === null)
            self::$instance = new self();
        return self::$instance;
    }

    /**
     * Generate email to JOs about the request submission
     * 
     * @param INotifiableRequest $request
     */
    public function notifyRequestSubmission(INotifiableRequest $request) : void
    {
        //email to the JOs
        $this->initializeEmails('jo');

        $email = new Email();
        $email->setSubject('Vehicle Request Awaiting Justification');

        $dateTime = $request->getField('dateOfTrip') . ' ' . $request->getField('timeOfTrip');
        $requesterName = $request->getField('requester')->getField('firstName') . ' '. 
                         $request->getField('requester')->getField('lastName');
        $designation = $request->getField('requester')->getField('designation');
        $purpose = $request->getField('purpose');

        $email->setMessage(
            "<p> New vehicle request is made by $requesterName, $designation.
            This request must be justified before $dateTime. </p>
            <p> Purpose of the request : \"$purpose\"");
        $email->addRecepients($this->joEmails);

        $_SESSION['emails'][] = $email;
    }

    /**
     * Generate email to requester and CAOs about the justification approve
     * 
     * @param INotifiableRequest $request
     */
    public function notifyJustificationApprove(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = new Email();
        $email->setSubject('Vehicle Request Justification');

        $dateTime = $request->getField('dateOfTrip') . ' ' . $request->getField('timeOfTrip');
        $pickLocation = $request->getField('pickLocation');
        $dropLocation = $request->getField('dropLocation');
        $purpose = $request->getField('purpose');
        $message = "<p> Justification is <b>approved</b> for the vehicle request you made for $dateTime from <i>$pickLocation</i> to <i>$dropLocation</i>.</p>
                    <p> Purpose of the request : \"$purpose\" </p>";

        $JOComment = $request->getField('JOComment');
        if ($JOComment !== '')
            $message .= "<p>Justifying Officer comments, \"$JOComment\"";
        $email->setMessage($message);

        $email->addRecepient($request->getField('requester')->getField('email'));

        $_SESSION['emails'][] = $email;;

        //email to the CAOs
        $this->initializeEmails('cao');

        $email = new Email();
        $email->setSubject('Vehicle Request Awaiting Approval');

        $requesterName = $request->getField('requester')->getField('firstName') . ' '. 
                         $request->getField('requester')->getField('lastName');
        $designation = $request->getField('requester')->getField('designation');

        $message = "<p> Justification is approved for a request made by $requesterName, $designation.
                    This request must be approved before $dateTime. </p>
                    <p> Purpose of the request : \"$purpose\" </p>";

        if (strlen($JOComment) > 0)
            $message .= "<p>Justifying Officer comments, \"$JOComment\"";

        $email->setMessage($message);
        $email->addRecepients($this->caoEmails);

        $_SESSION['emails'][] = $email;
    }

    /**
     * Generate email to requester about the justification deny
     * 
     * @param INotifiableRequest $request
     */
    public function notifyJustificationDeny(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = new Email();
        $email->setSubject('Vehicle Request Justification');

        $dateTime = $request->getField('dateOfTrip') . ' ' . $request->getField('timeOfTrip');
        $pickLocation = $request->getField('pickLocation');
        $dropLocation = $request->getField('dropLocation');
        $purpose = $request->getField('purpose');
        $message = "<p> Justification is <b>denied</b> for the vehicle request you made for $dateTime from <i>$pickLocation</i> to <i>$dropLocation</i>.</p>
                    <p> Purpose of the request : \"$purpose\" </p>";

        $JOComment = $request->getField('JOComment');
        if (strlen($JOComment) > 0)
            $message .= "<p>Justifying Officer comments, \"$JOComment\"";
        $email->setMessage($message);

        $email->addRecepient($request->getField('requester')->getField('email'));

        $_SESSION['emails'][] = $email;
    }

    /**
     * Generate email to requester and VPMOs about the approval approve
     * 
     * @param INotifiableRequest $request
     */
    public function notifyApprovalApprove(INotifiableRequest $request) : void
    {
        //email to the requester
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');
          
        $dateTime = $request->getField('dateOfTrip') . ' ' . $request->getField('timeOfTrip');
        $pickLocation = $request->getField('pickLocation');
        $dropLocation = $request->getField('dropLocation');
        $purpose = $request->getField('purpose');
        $message = "<p> Chief Administrative Officer has <b>approved</b> your vehicle request made for $dateTime from <i>$pickLocation</i> to <i>$dropLocation</i>.</p>
                    <p> Purpose of the request : \"$purpose\" </p>";

        $CAOComment = $request->getField('CAOComment');
        if (strlen($CAOComment) > 0)
            $message .= "<p>Chief Administrative Officer comments, \"$CAOComment\"";
        $email->setMessage($message);

        $email->addRecepient($request->getField('requester')->getField('email'));

        $_SESSION['emails'][] = $email;;

        //email to the VPMOs
        $this->initializeEmails('vpmo');

        $email = new Email();
        $email->setSubject('Vehicle Request Awaiting Scheduling');
        $requesterName = $request->getField('requester')->getField('firstName') . ' '. 
                         $request->getField('requester')->getField('lastName');
        $designation = $request->getField('requester')->getField('designation');

        $message = "<p> Chief Administrative Officer has approved a request made by $requesterName, $designation.
                    This request must be scheduled before $dateTime. </p>
                    <p> Purpose of the request : \"$purpose\" </p>";

        $JOComment = $request->getField('JOComment');
        if (strlen($JOComment) > 0)
            $message .= "<p>Justifying Officer comments, \"$JOComment\"";

        $CAOComment = $request->getField('CAOComment');
        if (strlen($CAOComment) > 0)
            $message .= "<p>Chief Administrative Officer comments, \"$CAOComment\"";

        $email->setMessage($message);

        $email->addRecepients($this->vpmoEmails);

        $_SESSION['emails'][] = $email;
    }

    /**
     * Generate email to requester and JO about the approval deny
     * 
     * @param INotifiableRequest $request
     */
    public function notifyApprovalDeny(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');

        $dateTime = $request->getField('dateOfTrip') . ' ' . $request->getField('timeOfTrip');
        $pickLocation = $request->getField('pickLocation');
        $dropLocation = $request->getField('dropLocation');
        $purpose = $request->getField('purpose');
        $message = "<p> Chief Administrative Officer has <b>disapproved</b> your vehicle request made for $dateTime from <i>$pickLocation</i> to <i>$dropLocation</i>.</p>
                    <p> Purpose of the request : \"$purpose\" </p>";

        $CAOComment = $request->getField('CAOComment');
        if (strlen($CAOComment) > 0)
            $message .= "<p>Chief Administrative Officer comments, \"$CAOComment\"";
        $email->setMessage($message);

        $email->addRecepient($request->getField('requester')->getField('email'));

        $_SESSION['emails'][] = $email;

        //email to the JO
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');
        $message = "<p> Chief Administrative Officer has <b>disapproved</b> a vehicle you justified for $dateTime from <i>$pickLocation</i> to <i>$dropLocation</i>. </p>
                    <p> Purpose of the request : \"$purpose\" </p>";

        $CAOComment = $request->getField('CAOComment');
        if (strlen($CAOComment) > 0)
            $message .= "<p>Chief Administrative Officer comments, \"$CAOComment\"";
        $email->setMessage($message);

        $email->addRecepient($request->getField('justifiedBy')->getField('email'));

        $_SESSION['emails'][] = $email;
    }

    /**
     * Generate an email to the requester about the schedule 
     * 
     * @param INotifiableRequest $request
     */
    public function notifySchedule(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');

        $dateTime = $request->getField('dateOfTrip') . ' ' . $request->getField('timeOfTrip');
        $pickLocation = $request->getField('pickLocation');
        $dropLocation = $request->getField('dropLocation');
        $purpose = $request->getField('purpose');
        $driver= $request->getField('driver');
        $driverName = $driver->getField('firstName') . ' ' . $driver->getField('lastName'); 
        $vehicleModel = $request->getField('vehicle')->getField('model');
        $message = "<p> Vehicle Pool Management Officer has <b>scheduled</b> your vehicle request made for $dateTime from <i>$pickLocation</i> to <i>$dropLocation</i>.</p>
                    <p> Purpose of the request : \"$purpose\" </p>
                    <p> Name of the Driver : $driverName </p>
                    <p> Vehicle model : $vehicleModel </p>";
                    
        $email->setMessage($message);

        $email->addRecepient($request->getField('requester')->getField('email'));

        $_SESSION['emails'][] = $email;;
    }

    /**
     * Initialize emails of the respective authorities if they are null
     * 
     * @param string $position
     */
    private function initializeEmails(string $position) : void
    {
        switch ($position)
        {
            case 'jo':
                if ($this->joEmails === null)
                {
                    $employeeViewer = new EmployeeViewer();
                    $this->joEmails = $employeeViewer->getEmails('jo');
                }
                break;
            case 'cao':
                if ($this->caoEmails === null)
                {
                    $employeeViewer = new EmployeeViewer();
                    $this->caoEmails = $employeeViewer->getEmails('cao');
                }
                break;
            case 'vpmo':
                if ($this->vpmoEmails === null)
                {
                    $employeeViewer = new EmployeeViewer();
                    $this->vpmoEmails = $employeeViewer->getEmails('vpmo');
                }
                break;
        }
    }

    public function sendEmails()
    {
        foreach ($_SESSION['emails'] as $key => $email)
        {
            $_SESSION['emails'][] = $email;;
            unset($_SESSION['emails'][$key]);
        }
    }
}
