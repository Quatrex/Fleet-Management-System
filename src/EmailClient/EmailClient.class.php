<?php
namespace EmailClient;


class EmailClient {
    private static ?EmailClient $instance = null;
    private Mailer $mailer;
    private array $emailQueue;
    private EmailGenerator $emailGen;

    private function __construct()
    {
        $this->mailer = new PHPMailerAdapter();
        $this->emailQueue = [];
        $this->emailGen = new EmailGenerator();

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
        $email = $this->emailGen->firstRequestNotification($request,1);
        $this->emailQueue[] = $email;
    }

    /**
     * Generate email to requester and CAOs about the justification approve
     * 
     * @param INotifiableRequest $request
     */
    public function notifyJustificationApprove(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = $this->emailGen->updateRequestNotification($request,1);
        $this->emailQueue[] = $email;

        //email to the CAOs
        $email = $this->emailGen->firstRequestNotification($request,2);
        $this->emailQueue[] = $email;
    }

    /**
     * Generate email to requester about the justification deny
     * 
     * @param INotifiableRequest $request
     */
    public function notifyJustificationDeny(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = $this->emailGen->updateRequestNotification($request,2);
        $this->emailQueue[] = $email;
    }

    /**
     * Generate email to requester and VPMOs about the approval approve
     * 
     * @param INotifiableRequest $request
     */
    public function notifyApprovalApprove(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = $this->emailGen->updateRequestNotification($request,3);
        $this->emailQueue[] = $email;

        //email to the VPMOs
        $email = $this->emailGen->firstRequestNotification($request,3);
        $this->emailQueue[] = $email;
    }

    /**
     * Generate email to requester and JO about the approval deny
     * 
     * @param INotifiableRequest $request
     */
    public function notifyApprovalDeny(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = $this->emailGen->updateRequestNotification($request,4);
        $this->emailQueue[] = $email;

        //email to the JO
        $email = $this->emailGen->updateRequestNotification($request,5);
        $this->emailQueue[] = $email;
    }

    /**
     * Generate an email to the requester about the schedule 
     * 
     * @param INotifiableRequest $request
     */
    public function notifySchedule(INotifiableRequest $request) : void
    {
        //email to the Requester
        $email = $this->emailGen->scheduleRequestNotification($request);
        $this->emailQueue[] = $email;
    }


    public function sendEmails()
    {
        $this->mailer->config();
        foreach ($this->emailQueue as $email)
            $this->mailer->send($email);
    }
}
