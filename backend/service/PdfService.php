<?php
namespace Backend\Service;

use FPDF;

class PdfService
{

    public static function make($data){
        $pdf=new FPDF();
        //Add a new page
        $pdf->AddPage();

        // Set the font for the text
        $pdf->SetFont('Arial', 'B', 18);

        // Prints a cell with given text
        $pdf->Cell(60,20,'Requirements');


        // return the generated output
        return $pdf->Output('', 'S');

    }
}