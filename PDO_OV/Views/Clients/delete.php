<?php
require_once '../../Models/Client.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido.");
    exit;
}

$ClientModel = new Client();
$client = $ClientModel->getClient($id);

if (empty($client)) {
    header("Location: list.php?error=Cliente no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $ClientModel->deleteClient($id);

    if ($result) {
        header("Location: list.php?success=Cliente Eliminado.");
    } else {
        echo "Error al eliminar el cliente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <h1>Eliminar Cliente</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar al cliente <strong><?= $client["nombre_cliente"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="list.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>