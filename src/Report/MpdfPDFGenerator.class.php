<?php

namespace Report;
require_once '../lib/Mpdf/vendor/autoload.php';

use Mpdf\Mpdf;

class MpdfPDFGenerator implements PDFGenerator
{
    /**
     * @inheritDoc
     */
    public function generatePDF(string $html): void
    {
        $mpdf = new Mpdf(['default_font_size' => 12,
                        'default_font' => 'freeserif',
                        'mode' => 'utf-8', 
                        'format' => [190, 140]]);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}