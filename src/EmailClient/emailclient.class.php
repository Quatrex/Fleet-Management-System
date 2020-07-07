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
        $this->initializeEmails('jo');

        $email = new Email();
        $email->setSubject('New Vehicle Request');
        $email->setMessage("New vehicle request is made.");
        $email->addRecepients($this->joEmails);

        $this->mailer->send($email);
    }

    public function notifyJustificationApprove(INotifiableRequest $request) : void
    {
        $email = new Email();
        $email->setSubject('Vehicle Request Justification');
        $email->setMessage('One of your vehicle request has been justified.');

        $employeeViewer = new EmployeeViewer();
        // $email->addRecepient($employeeViewer->getEmail('requester'));

    }

    public function notifyJustificationDeny(INotifiableRequest $request) : void
    {
        $email = new Email();
        $email->setSubject('Vehicle Request Justification');

    }

    public function notifyApprovalApprove(INotifiableRequest $request) : void
    {
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');

    }

    public function notifyApprovalDeny(INotifiableRequest $request) : void
    {
        $email = new Email();
        $email->setSubject('Vehicle Request Approval');
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