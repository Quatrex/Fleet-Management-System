<?php
namespace EmailClient;

use DB\Viewer\EmployeeViewer;
use DB\Viewer\RequestViewer;

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
    }

    public static function getInstance() : EmailClient 
    {
        if (EmailClient::$instance == null)
            EmailClient::$instance = new EmailClient();
        return EmailClient::$instance;
    }

    /**
     * Notify JOs about the new request
     * 
     * @param INotifiableRequest $request
     */
    public function notifyRequestSubmission(INotifiableRequest $request) : void
    {
        //email to the JOs
        $this->initializeEmails('jo');

        $email = new Email();
        $email->setSubject('Vehicle Request Awaiting Justification');
        $email->setMessage("New vehicle request is made.");
        $email->addRecepients($this->joEmails);

        $this->mailer->send($email);
    }

    public function notifyJustificationApprove(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = new Email();
        $email->setSubject('Vehicle Request Justification');
        $email->setMessage('One of your vehicle request has been justified.');

        $requestViewer = new RequestViewer();
        $email->addRecepient($requestViewer->getEmail($request->getField('requestID'),'requester'));

        $this->mailer->send($email);

        //email to the CAOs
        $this->initializeEmails('cao');

        $email = new Email();
        $email->setSubject('Vehicle Request Awaiting Approval');
        $email->setMessage("New vehicle request has been justified.");
        $email->addRecepients($this->caoEmails);

        $this->mailer->send($email);
    }

    public function notifyJustificationDeny(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = new Email();
        $email->setSubject('Vehicle Request Justification');
        $email->setMessage('Justification for a one of your request has been denied.');

        $requestViewer = new RequestViewer();
        $email->addRecepient($requestViewer->getEmail($request->getField('requestID'),'requester'));

        $this->mailer->send($email);

    }

    public function notifyApprovalApprove(INotifiableRequest $request) : void
    {
        //email to the requester
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');
        $email->setMessage('One of your vehicle request has been approved.');

        $requestViewer = new RequestViewer();
        $email->addRecepient($requestViewer->getEmail($request->getField('requestID'),'requester'));

        $this->mailer->send($email);

        //email to the VPMOs
        $this->initializeEmails('vpmo');

        $email = new Email();
        $email->setSubject('Vehicle Request Awaiting Scheduling');
        $email->setMessage("New vehicle request has been approved.");
        $email->addRecepients($this->vpmoEmails);

        $this->mailer->send($email);
    }

    public function notifyApprovalDeny(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');
        $email->setMessage('Approval for a one of your request has been denied.');

        $requestViewer = new RequestViewer();
        $email->addRecepient($requestViewer->getEmail($request->getField('requestID'),'requester'));

        $this->mailer->send($email);

        //email to the JO
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');
        $email->setMessage('Approval for a one of your justified request has been denied.');

        $requestViewer = new RequestViewer();
        $email->addRecepient($requestViewer->getEmail($request->getField('justifiedBY'),'jo'));

        $this->mailer->send($email);
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
                    $this->vpmoEmails = $employeeViewer->getEmails('jo');
                }
                break;
        }
    }
}