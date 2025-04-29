<?php
require_once('../fpdf186/fpdf.php');
require_once '../Models/Sale.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(0, 10, 'FACTURA', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }
}

$ventas = new Sale();

$nro_factura = $_GET['id'] ?? null;

if (!$nro_factura) {
    die('No se especificó factura');
}

$header = $ventas->getSaleHeader($nro_factura);
$details = $ventas->getSaleDetails($nro_factura);

if (!$header || empty($details)) {
    die('Factura no encontrada');
}

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Factura No.: ' . $header['nro_factura'], 0, 1);
$pdf->Cell(50, 10, 'Fecha: ' . $header['fecha_venta'], 0, 1);
$pdf->Cell(50, 10, 'Cliente: ' . $header['nombre_cliente'], 0, 1);
$pdf->Cell(50, 10, 'Empleado: ' . $header['nombre_empleado'], 0, 1);
$pdf->Cell(50, 10, 'Tipo de Venta: ' . $header['tipo_venta'], 0, 1);

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 10, 'Producto', 1);
$pdf->Cell(20, 10, 'Cant.', 1);
$pdf->Cell(30, 10, 'V.Unitario', 1);
$pdf->Cell(30, 10, 'Impuesto', 1);
$pdf->Cell(30, 10, 'Total', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);

foreach ($details as $item) {
    $pdf->Cell(70, 10, $item['nombre_prod'], 1);
    $pdf->Cell(20, 10, $item['cantidad'], 1, 0, 'C');
    $pdf->Cell(30, 10, '$' . number_format($item['valor_prod'], 2), 1, 0, 'R');
    $pdf->Cell(30, 10, '$' . number_format($item['valor_impuesto'], 2), 1, 0, 'R');
    $pdf->Cell(30, 10, '$' . number_format($item['valor_total'], 2), 1, 0, 'R');
    $pdf->Ln();
}

$pdf->Output();
?>