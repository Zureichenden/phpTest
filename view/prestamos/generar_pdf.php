<?php
require_once("c://xampp/htdocs/phpTest/fpdf/fpdf.php");
$rows = json_decode($_GET['rows'], true);

class PDF extends FPDF {
    function Header() {
        // Encabezado
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Amortizaciones del Cliente', 0, 1, 'C');
    
        // Nombres de las columnas
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 10, 'ID Prestamo', 1);
        $this->Cell(30, 10, 'ID Amortizacion', 1);
        $this->Cell(30, 10, 'NO. Pago', 1);
        $this->Cell(30, 10, 'Fecha', 1);
        $this->Cell(30, 10, 'Prestamo', 1);
        $this->Cell(30, 10, 'Interes', 1);
        $this->Cell(30, 10, 'Abono', 1);
        $this->Ln();
    }
    
    function Footer() {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
    
    function ChapterTitle($title) {
        // Título del capítulo
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $title, 0, 1);
    }
}

if (isset($_GET['rows'])) {
    $rows = json_decode(urldecode($_GET['rows']), true);

    $pdf = new PDF();
    $pdf->AddPage();

    foreach ($rows as $row) {
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(30, 10, $row['prestamo_id'], 1);
        $pdf->Cell(30, 10, $row['amortizacion_id'], 1);
        $pdf->Cell(30, 10, $row['NO_PAGO'], 1);
        $pdf->Cell(30, 10, date("d/m/Y", strtotime($row['fecha'])), 1);
        $pdf->Cell(30, 10, '$' . number_format($row['monto_pago'], 2), 1);
        $pdf->Cell(30, 10, '$' . number_format($row['interes'], 2), 1);
        $pdf->Cell(30, 10, '$' . number_format($row['abono'], 2), 1);
        $pdf->Ln();
    }

    // Salida del PDF al navegador
    $pdf->Output();
}
