<?php

use EmailClient\EmailClient;
use EmailClient\INotifiableRequest;

include_once '../includes/autoloader.inc.php';

class Request implements INotifiableRequest
{
    public function getField(string $field)
    {
        if ($field == 'requestID')
            return '53';
    }
}

$ec = EmailClient::getInstance();
// $ec->notifyRequestSubmission(new Request);
$ec->notifyJustificationApprove(new Request);
echo "Done";
