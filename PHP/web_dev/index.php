<?php
//pdf e qrcode: utilizzo una libreria esterna
//cmd: composer require tecnickcom/tcpdf
require('vendor/tecnickcom/tcpdf/tcpdf.php');
$name = '5E';

$lastname = 'Violamarchesini';

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFillColor(179, 179, 179);
//$pdf->Rect(0, 0, 210, 297, "F"); //il bro prende sfondo grigio
$pdf->Cell(0, 10, 'Ciao questo è il tuo ticket', 0, 1, "C");
$pdf->Ln(10);
$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetTextColor(0, 0, 255); //colore font
$pdf->Cell(0, 10, "Nome: {$name}", 0, 1, "L" );
$pdf->Cell(0, 10, "Last name: {$lastname}", 0, 1, "L" );
$pdf->Cell(0, 10, "Data e ora:".date("d/m/y H:i"), 0, 1, "R" );
$pdf->write2DBarcode("Ciao {$name} {$lastname} - Uffizi Firenze, data: ".date("d/m/y H:i"), 'QRCODE,L', 10, 80, 50, 50, [], 'N');
$pdf->Image('logo.jpg', $pdf->getPageWidth()-40, $pdf->getPageHeight()-60, 30, 30);
$pdf->Output("Ticket.pdf", "I");