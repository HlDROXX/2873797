<?php
require_once('../fpdf186/fpdf.php');
require_once '../Models/Sale.php';

class PDF extends FPDF
{
    function Header()
{
    
    //$this->Image('../ruta/logo.png', 10, 10, 30); // Cambia la ruta
    $this->SetFont('Arial', 'B', 16);
    $this->SetTextColor(0, 102, 204);
    $this->Cell(0, 10, 'FACTURA DE VENTA', 0, 1, 'C');
    $this->Ln(10);
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
$pdf->SetFillColor(200, 220, 255);
$pdf->SetTextColor(0);
$pdf->Cell(60, 10, 'Producto', 1, 0, 'C', true);
$pdf->Cell(20, 10, 'Cant.', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'V.Unitario', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'IVA 19%', 1, 0, 'C', true);
$pdf->Cell(35, 10, 'Total', 1, 1, 'C', true);

$pdf->Ln();


$pdf->SetFont('Arial', '', 12);
$fill = false;
foreach ($details as $item) {
    $pdf->SetFillColor($fill ? 245 : 255, 245, 245); // Alternar color de fila
    $pdf->Cell(60, 10, $item['nombre_prod'], 1, 0, 'L', $fill);
    $pdf->Cell(20, 10, $item['cantidad'], 1, 0, 'C', $fill);
    $pdf->Cell(30, 10, '$' . number_format($item['valor_prod'], 2), 1, 0, 'R', $fill);
    $pdf->Cell(25, 10, '$' . number_format($item['valor_impuesto'], 2), 1, 0, 'R', $fill);
    $pdf->Cell(35, 10, '$' . number_format($item['valor_total'], 2), 1, 1, 'R', $fill);
    $fill = !$fill;
}

$pdf->Output();
?>