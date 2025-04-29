<?php
require_once '../../../Models/State.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido.");
    exit;
}

$stateModel = new State();
$state = $stateModel->getState($id);

if (empty($state)) {
    header("Location: list.php?error=Estado no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $stateModel->deleteState($id);

    if ($result) {
        header("Location: list.php?success=Estado Eliminado.");
    } else {
        echo "Error al eliminar el estado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Estado</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <h1>Eliminar Estado</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar el estado <strong><?= $state["nombre_estado"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="list.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>