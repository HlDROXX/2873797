<?php
require_once '../../Models/Client.php';

$ClientModel = new Client();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "identidad" => trim($_POST["identidad"] ?? ""),
        "nombre" => trim($_POST["nombre"] ?? ""),
        "direccion" => trim($_POST["direccion"] ?? "")
    ];

    if (empty($data["identidad"]) || empty($data["nombre"]) || empty($data["direccion"])) {
        echo "Todos los datos son obligatorios.";
    } else {

        $result = $ClientModel->insertClient($data);

        if ($result) {
            header("Location: list.php?success=Cliente creado.");
        } else {
            echo "Error al crear el cliente.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Cliente</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Crear Cliente</h1>
        </div>
        <?php include '../navbar.php' ?>
        <div class="formulario-crear">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="identidad">Numero de Identidad</label>
                    <input type="text" name="identidad" id="identidad" required>
                </div>
                <div class="input-field">
                    <label for="nombre">Nombre Cliente</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="input-field">
                    <label for="direccion">Direccion Cliente</label>
                    <input type="text" name="direccion" id="direccion" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Cliente</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>