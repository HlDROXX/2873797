<?php
require_once '../../Models/Client.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido");
    exit;
}

$ClientModel = new Client();
$client = $ClientModel->getClient($id);

if (empty($client)) {
    header("Location: list.php?error=Cliente no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "identidad" => trim($_POST["identidad"] ?? ""),
        "nombre" => trim($_POST["nombre"] ?? ""),
        "direccion" => trim($_POST["direccion"] ?? "")
    ];

    if (empty($data["identidad"]) || empty($data["nombre"]) || empty($data["direccion"])) {
        echo "Todos los datos son obligatorios.";
    }else {
        $result = $ClientModel->updateClient($id, $data);

        if ($result) {
            header("Location: list.php?success=Cliente actualizado.");
        } else {
            echo "Error al editar el cliente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Editar Cliente</h1>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="identidad">Numero de Identidad</label>
                    <input type="text" id="identidad" name="identidad" value="<?= $client['nro_identidad'] ?>" required>
                </div>

                <div class="input-field">
                    <label for="nombre">Nombre Cliente</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $client['nombre_cliente'] ?>" required>
                </div>

                <div class="input-field">
                    <label for="direccion">Direccion Cliente</label>
                    <input type="text" id="direccion" name="direccion" value="<?= $client['direccion_cliente'] ?>" required>
                </div>

                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Cliente</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>