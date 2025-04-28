<?php
require_once '../../../Models/SaleType.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido.");
    exit;
}

$tipoVentaModelo = new SaleType();
$tipoVenta = $tipoVentaModelo->getSaleType($id);

if (empty($tipoVenta)) {
    header("Location: list.php?error=Tipo Venta no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $tipoVentaModelo->deleteSaleType($id);

    if ($resultado) {
        header("Location: list.php?success=Tipo Venta Eliminado.");
    } else {
        echo "Error al editar el tipo venta.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Tipo Venta</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <h1>Eliminar Tipo Venta</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar este tipo de venta</strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="list.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>