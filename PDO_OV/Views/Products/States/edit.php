<?php
require_once '../../../Models/State.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido");
    exit;
}

$stateModel = new State();
$state = $stateModel->getState($id);

if (empty($state)) {
    header("Location: list.php?error=Estado no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_estado = trim($_POST["nombre"] ?? "");

    if (empty($nombre_estado)) {
        echo "Todos los datos son obligatorios.";
    } else {
        $result = $stateModel->updateState($id, $nombre_estado);

        if ($result) {
            header("Location: list.php?success=Estado actualizado.");
        } else {
            echo "Error al editar el estado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Estado</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Editar Estado</h1>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $state['nombre_estado'] ?>" required>
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