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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Cliente</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Detalles de Cliente</h1>
        </div>
        <div class="card gap-flex">
            <p><strong>Numero Identidad:</strong> <?= $client["nro_identidad"] ?></p>
            <p><strong>Nombre Cliente:</strong> <?= $client["nombre_cliente"] ?></p>
            <p><strong>Dirección Cliente:</strong> <?= $client["direccion_cliente"] ?></p>
        </div>
        <a href="list.php" class="btn btn-volver">Volver</a>
    </div>
</body>

</html>