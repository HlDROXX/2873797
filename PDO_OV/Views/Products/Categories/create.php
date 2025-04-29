<?php
require_once '../../../Models/Category.php';

$categoryModel = new Category();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_categoria = trim($_POST["nombre"] ?? "");

    if (empty($nombre_categoria)) {
        echo "Todos los datos son obligatorios.";
    } else {
        $resultado = $categoryModel->insertCategory($nombre_categoria);

        if ($resultado) {
            header("Location: list.php?success=Categoria creado.");
        } else {
            echo "Error al editar el categoria.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Categoria</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
<div class="container">
        <div class="header">
            <h1>Crear Categoria</h1>
        </div>
    <?php include '../../navbar.php' ?>


        <div class="formulario-crear">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre Categoria</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Categoria</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>