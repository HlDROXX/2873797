<?php
require_once '../../Models/Sale.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: lista-ventas.php?error=ID no válido");
    exit;
}

$productModel = new Sale();
$saleGet = $productModel->getSale($id);
$sale = $saleGet[0];

if (empty($sale)) {
    header("Location: list.php?error=Venta no encontrado.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Venta</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Detalles de Venta</h1>
        </div>
        <div class="card gap-flex">
            <p><strong>Numero de Factura:</strong> <?= $sale["nro_factura"] ?></p>
            <p><strong>Fecha:</strong> <?= date("d/m/Y", strtotime($sale["fecha_venta"])) ?></p>
            <p><strong>Cliente:</strong> <?= $sale["nombre_cliente"] ?></p>
            <p><strong>Empleado:</strong> <?= $sale["nombre_empleado"] ?></p>
            <p><strong>Tipo de Venta:</strong> <?= $sale["tipo_venta"] ?></p>
            <p><strong>Producto:</strong> <?= $sale["nombre_prod"] ?></p>
            <p><strong>Cantidad:</strong> <?= $sale["cantidad"] ?></p>
            <p><strong>Total:</strong> <?= $sale["valor_total"] ?></p>
        </div>
        <a href="list.php" class="btn btn-volver">Volver</a>
    </div>
</body>

</html>