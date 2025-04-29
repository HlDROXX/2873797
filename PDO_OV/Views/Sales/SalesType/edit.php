<?php
require_once '../../../Models/SaleType.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido");
    exit;
}

$tipoVentaModelo = new SaleType();
$tipoVenta = $tipoVentaModelo->getSaleType($id);

if (empty($estado)) {
    header("Location: list.php?error=Tipo de venta no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (empty($descripcion)) {
        echo "Todos los datos son obligatorios.";
    } else {
        $resultado = $tipoVentaModelo->updateSaleType($id, $nombre_estado);

        if ($resultado) {
            header("Location: list.php?success=Tipo de venta actualizado.");
        } else {
            echo "Error al editar el tipo de venta.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Tipo de Venta</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Editar Tipo de Venta</h1>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="descripcion">Nombre</label>
                    <input type="text" id="descripcion" name="descripcion" value="<?= $tipoVenta['descripcion'] ?>" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Estado</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>