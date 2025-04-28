<?php
require_once '../../Models/Product.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: list.php?error=ID no válido");
    exit;
}

$productModel = new Product();
$product = $productModel->getProduct($id);

if (empty($product)) {
    header("Location: list.php?error=Producto no encontrado.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Producto</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <ul class="breadcrumb">
            <h1>Detalles de Producto</h1>
        </div>
        <div class="card gap-flex">
            <p><strong>Nombre:</strong> <?= $product["nombre_prod"] ?></p>
            <p><strong>Descripción:</strong> <?= $product["descripcion_prod"] ?></p>
            <p><strong>Stock Disponible:</strong> <?= $product["stock_prod"] ?></p>
            <p><strong>Precio por Unidad:</strong> $<?= number_format($product["valor_unidad"], 2) ?></p>
            <p><strong>Impuesto:</strong> <?= $product["impuesto"] ?>%</p>
            <p><strong>Categoría:</strong> <?= $product["nombre_categoria"] ?></p>
            <p><strong>Estado:</strong> <?= $product["nombre_estado"] ?></p>
        </div>
        <a href="list.php" class="btn btn-volver">Volver</a>
    </div>
</body>

</html>