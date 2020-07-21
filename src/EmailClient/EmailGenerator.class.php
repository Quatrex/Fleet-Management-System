<?php
namespace EmailClient;

use Exception;
use DB\Viewer\EmployeeViewer;

class EmailGenerator
{
    private ?array $joEmails;
    private ?array $caoEmails;
    private ?array $vpmoEmails;

    public function __construct()
    {
        $this->joEmails = null;
        $this->caoEmails = null;
        $this->vpmoEmails = null;
    }

    /**
     * Generate the email for the first notification of the recipient.
     * code 1 : new request submitted to JO.
     * code 2 : new request justified to CAO.
     * code 3 : new request approved to VPMO.
     * 
     * @param INotifiableRequest $request
     * @param int $code
     * 
     * @return Email
     */
    public function firstRequestNotification(INotifiableRequest $request, int $code) : Email
    {
        $values = $this->getRequestValues($request);

        switch($code)
        {
            case 1:
                $this->initializeEmails('jo');
                $emails = $this->joEmails;
                $subject = 'Vehicle Request Awaiting Justification';
                $message = 'New vehicle request is';
                $command = 'justified';
            break;

            case 2:
                $this->initializeEmails('cao');
                $emails = $this->caoEmails;
                $subject = 'Vehicle Request Awaiting Approval';
                $message = 'Justifying Officer has justified a request';
                $command = 'approved';
            break;

            case 3:
                $this->initializeEmails('vpmo');
                $emails = $this->vpmoEmails;
                $subject = 'Vehicle Request Awaiting Scheduling';
                $message = 'Chief Administrative Officer has approved a request';
                $command = 'scheduled';
            break;
        }
        $builder = EmailBuilder::getInstance();

        return $builder ->recipient($emails)
                        ->subject($subject)
                        ->paragraph()
                            ->text("$message made by ".$values['RequesterName'].', '.$values['Designation'].
                            ". This request must be $command before ".$values['DateTime'].'.')
                            ->close()
                         ->paragraph()
                            ->text("Purpose of the request :")
                            ->text($values['Purpose'],'q')
                            ->close()
                         ->paragraph()
                            ->text($values['JOMessage'])
                            ->text($values['JOComment'],'q')
                            ->close()
                        ->paragraph()
                            ->text($values['CAOMessage'])
                            ->text($values['CAOComment'],'q')
                            ->close()
                        ->getEmail();
    }

    /**
     * Generate the email for update of a request to the recipient.
     * code 1 : request justified to requester.
     * code 2 : request denied to requester.
     * code 3 : request approved to requester.
     * code 4 : request disapproved to requester.
     * code 5 : request disapproved to jo.
     * 
     * @param INotifiableRequest $request
     * @param int $code
     * 
     * @return Email
     */
    public function updateRequestNotification(INotifiableRequest $request, int $code)
    {
        $values = $this->getRequestValues($request);

        $email = htmlentities($request->getField('requester')->getField('email'));
        $action = 'made';
       

        switch($code)
        {
            case 1:
                $subject = 'Vehicle Request Justification';
                $message = 'Justifying Officer has';
                $command = 'justified';
            break;

            case 2:
                $subject = 'Vehicle Request Justification';
                $message = 'Justifying Officer has';
                $command = 'denied';
            break;

            case 3:
                $subject = 'Vehicle Request Approval';
                $message = 'Chief Administrative Officer has';
                $command = 'approved';
            break;

            case 4:
                $subject = 'Vehicle Request Approval';
                $message = 'Chief Administrative Officer has';
                $command = 'disapproved';
            break;

            case 5:
                $subject = 'Vehicle Request Approval';
                $message = 'Chief Administrative Officer has';
                $command = 'disapproved';
                $email = htmlentities($request->getField('justifiedBy')->getField('email'));
                $action = 'justified';
        }

        $builder = EmailBuilder::getInstance();

        return $builder ->recipient($email)
                        ->subject($subject)
                        ->paragraph()
                            ->text($message)
                            ->text($command,'b')
                            ->text("the vehicle request you $action for ".$values['DateTime']." from")
                            ->text($values['PickLocation'],'i')
                            ->text('to')
                            ->text($values['DropLocation'].'.','i')
                            ->close()
                        ->paragraph()
                            ->text("Purpose of the request :")
                            ->text($values['Purpose'],'q')
                            ->close()
                        ->paragraph()
                            ->text($values['JOMessage'])
                            ->text($values['JOComment'],'q')
                            ->close()
                        ->paragraph()
                            ->text($values['CAOMessage'])
                            ->text($values['CAOComment'],'q')
                            ->close()
                         ->getEmail();
                    
    }

     /**
     * Generate an email about the scheduled request to the requester
     * 
     * @param INotifiableRequest $request
     * @param int $code
     * 
     * @return Email
     */
    public function scheduleRequestNotification(INotifiableRequest $request)
    {
        $values = $this->getRequestValues($request);
        $email = htmlentities($request->getField('requester')->getField('email'));
        $driver = $request->getField('driver');
        $driverName = htmlentities($driver->getField('firstName') . ' ' . $driver->getField('lastName')); 
        $vehicleModel = htmlentities($request->getField('vehicle')->getField('model'));

        $builder = EmailBuilder::getInstance();

        return $builder ->recipient($email)
                        ->subject('Vehicle Request Approval')
                        ->paragraph()
                            ->text('Vehicle Pool Management Officer has')
                            ->text('scheduled','b')
                            ->text("the vehicle request you made for ".$values['DateTime']." from")
                            ->text($values['PickLocation'],'i')
                            ->text('to')
                            ->text($values['DropLocation'].'.','i')
                            ->close()
                        ->paragraph()
                            ->text("Purpose of the request :")
                            ->text($values['Purpose'],'q')
                            ->close()
                        ->paragraph()
                            ->text("Name of the Driver : $driverName")
                            ->close()
                        ->paragraph()
                            ->text("Vehicle model : $vehicleModel")
                            ->close()
                        ->getEmail();
    }

    /**
     * Get details from the request object
     * 
     * @param INotifiableRequest $request
     * 
     * @return array information about the request
     */
    private function getRequestValues(INotifiableRequest $request)
    {
        $values['DateTime'] = htmlentities($request->getField('dateOfTrip') . ' ' . $request->getField('timeOfTrip'));
        $values['RequesterName'] = htmlentities($request->getField('requester')->getField('firstName') . ' '. 
                                    $request->getField('requester')->getField('lastName'));
        $values['Designation'] = htmlentities($request->getField('requester')->getField('designation'));
        $values['Purpose'] = htmlentities($request->getField('purpose'));
        $values['PickLocation'] = htmlentities($request->getField('pickLocation'));
        $values['DropLocation'] = htmlentities($request->getField('dropLocation'));

        $values['JOComment'] = htmlentities($request->getField('JOComment'));
        $values['JOMessage'] = '';
        if (strlen($values['JOComment']) > 0)
            $values['JOMessage'] = 'Justifying Officer comments,';

        $values['CAOComment'] = htmlentities($request->getField('CAOComment'));
        $values['CAOMessage'] = '';
        if (strlen($values['CAOComment']) > 0)
            $values['CAOMessage'] = 'Chief Administrative Officer comments,';

        return $values;
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
            default:
                throw new Exception("Invalid parameter $position for EmailGenerator::initializeEmails");
        }
    }
}

