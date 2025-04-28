<?php
require_once '../../../Models/State.php';

$stateModel = new State();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_estado = trim($_POST["nombre"] ?? "");

    if (empty($nombre_estado)) {
        echo "Todos los datos son obligatorios.";
    } else {

        $result = $stateModel->insertState($nombre_estado);

        if ($result) {
            header("Location: list.php?success=Estado creado.");
        } else {
            echo "Error al crear el estado.";
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
                    <label for="nombre">Nombre Estado</label>
                    <input type="text" name="nombre" id="nombre" required>
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