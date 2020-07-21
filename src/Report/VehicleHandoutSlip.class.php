<?php

namespace Report;


class VehicleHandoutSlip implements IVisitor{
    private PDFGenerator $pdfGen;

    private string $requesterFirstName;
    private string $requesterLastName;
    private string $requesterDesignation;

    private string $justifierFirstName;
    private string $justifierLastName;
    private string $justifierDesignation;

    private string $approverFirstName;
    private string $approverLastName;
    private string $approverDesignation;

    private string $purpose;
    private string $dateOfTrip;
    private string $timeOfTrip;
    private string $dropLocation;
    private string $pickLocation;

    public function __construct()
    {
        $this->pdfGen = new MpdfPDFGenerator();
    }

    /**
     * Displays a pdf version of the vehicle handout slip
     */
    public function print() : void
    {
        $html =
        '<h1 style="text-align: center; font-family: sans-serif; font-size: 36;"> Vehicle Handout Slip </h1><p></p>
        <table style="border-spacing: 5px">
        <tr>
            <td height="42"; style="font-family: sans-serif";><b>Name & Designation</b> : </td>
            <td>' .  $this->requesterFirstName . ' ' . 
                $this->requesterLastName . ', ' . $this->requesterDesignation . '</td>
        </tr><tr>
            <td height="42"; style="font-family: sans-serif";><b>Purpose</b> : </td>
            <td>' . $this->purpose . '</td>
        </tr><tr>
            <td height="42"; style="font-family: sans-serif";><b>Date & Time</b> : </td>
            <td>' . $this->dateOfTrip . ' ' . $this->timeOfTrip . '</td>
        </tr><tr>
            <td height="42"; style="font-family: sans-serif";><b>From</b> : </td>
            <td>' . $this->pickLocation . '</td>
        </tr><tr>
            <td height="42"; style="font-family: sans-serif";><b>To</b> : </td>
            <td>' . $this->dropLocation . '</td>
        </tr><tr>
            <td height="42"; style="font-family: sans-serif";><b>Recommended by</b> : </td>
            <td>' . $this->justifierFirstName . ' ' . 
                $this->justifierLastName . ', ' . $this->justifierDesignation . '</td>
        </tr><tr>
            <td height="42"; style="font-family: sans-serif";><b>Approved by</b> : </td>
            <td>' . $this->approverFirstName . ' ' . 
                $this->approverLastName . ', ' . $this->approverDesignation . '</td>
        </tr></table>';
        $this->pdfGen->generatePDF($html);
    }

    public function visit(IVisitable $visitable,string $visitableType)
    {
        if($visitableType=='request'){
            $values=$visitable->getInfo();

            $this->purpose=$values['purpose'];
            $this->dateOfTrip=$values['dateOfTrip'];
            $this->timeOfTrip=$values['timeOfTrip'];
            $this->dropLocation=$values['dropLocation'];
            $this->pickLocation=$values['pickLocation'];
        }
        elseif($visitableType=='requester'){
            $values=$visitable->getInfo();

            $this->requesterFirstName=$values['firstName'];
            $this->requesterLastName=$values['lastName'];
            $this->requesterDesignation=$values['designation'];
        }
        elseif($visitableType=='justifiedBy'){
            $values=$visitable->getInfo();

            $this->justifierFirstName=$values['firstName'];
            $this->justifierLastName=$values['lastName'];
            $this->justifierDesignation=$values['designation'];
        }
        elseif($visitableType=='approvedBy'){
            $values=$visitable->getInfo();

            $this->approverFirstName=$values['firstName'];
            $this->approverLastName=$values['lastName'];
            $this->approverDesignation=$values['designation'];
        }
    }

    public function getField($field)
    {
        if (property_exists($this, $field)) {
            return $this->$field;
        }
        return null;
    }
}