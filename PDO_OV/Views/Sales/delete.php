<?php
require_once '../../Models/Sale.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: list.php?error=ID no válido.");
    exit;
}

$saleModel = new Sale();
$sale = $saleModel->getSale($id);

if (empty($sale)) {
    header("Location: list.php?error=Venta no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $saleModel->deleteSale($id);

    if ($result) {
        header("Location: list.php?success=Venta Eliminado.");
    } else {
        echo "Error al editar el sale.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Venta</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <h1>Eliminar Venta</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar la sale <strong><?= $sale["nro_factura"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="list.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>