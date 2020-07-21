<?php

namespace Report;

interface PDFGenerator
{
    /**
     * Generate a pdf for a given HTML format
     * 
     * @param string $html
     */
    public function generatePDF(string $html) : void;
}