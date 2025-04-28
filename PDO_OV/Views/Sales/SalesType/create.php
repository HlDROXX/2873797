<?php
require_once '../../../Models/SaleType.php';

$tipoVentaModelo = new SaleType();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = trim($_POST["descripcion"] ?? "");

    if (empty($descripcion)) {
        echo "Todos los datos son obligatorios.";
    } else {

        $resultado = $tipoVentaModelo->insertSaleType($descripcion);

        if ($resultado) {
            header("Location: list.php?success=Tipo de venta creado.");
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
    <title>Crear Estado</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Subir Estado</h1>
        </div>
        <div class="card">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="descripcion">Nombre</label>
                    <input type="text" name="descripcion" id="descripcion" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Estado</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>