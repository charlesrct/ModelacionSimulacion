<?php

header('Content-type: application/pdf');
header("Cache-Control: no-cache");
header("Accept-Ranges: none");
header("Expires: 0");
header("Content-Disposition: attachment; filename=tabla-pdf.pdf");

require('fpdf.php');

class PDF extends FPDF {

// Cargar los datos
    function LoadData($file) {
// Leer las líneas del fichero
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

// Tabla simple
    function BasicTable($header, $data) {
// Cabecera
        foreach ($header as $col)
            $this->Cell(40, 7, $col, 1);
        $this->Ln();
// Datos
        foreach ($data as $row) {
            foreach ($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

// Una tabla más completa
    function ImprovedTable($header, $data) {
// Anchuras de las columnas
        $w = array(40, 35, 45, 40);
// Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $this->Ln();
// Datos
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R');
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R');
            $this->Ln();
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

// Tabla coloreada
    function FancyTable($header, $data) {
// Color de la cabecera y líneas, ancho de línea y fuente en negrita
        $this->SetFillColor(55, 110, 60);
        $this->SetTextColor(255);
        $this->SetDrawColor(55, 80, 60);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
// Cabecera
        $w = array(40, 35, 45, 40);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
// Restauración de colores y fuentes para el cuerpo de la tabla
        $this->SetFillColor(225, 230, 185);
        $this->SetTextColor(0);
        $this->SetFont('');
// Datos
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
// Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

}

$pdf = new PDF();
$jugada = $_REQUEST["jugadas"];
// Títulos de las columnas
$header = array('Jugada', 'Dado 1', 'Dado 2', 'Suma');
//Llenando el cuerpo de la tabla de forma dinamica.
$jugada1 = explode(" ::: ", $jugada);
for ($i = 0; $i < (count($jugada1) - 1); $i++) {
    $jugadas = explode(" :: ", $jugada1[$i]);
    $data[$i] = array(($i + 1), $jugadas[0], $jugadas[1], ($jugadas[0] + $jugadas[1]));
}
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
//Generamos 3 tipos de tablas:
$pdf->BasicTable($header, $data);
$pdf->AddPage();
$pdf->ImprovedTable($header, $data);
$pdf->AddPage();
$pdf->FancyTable($header, $data);
$pdf->Output();
?>

