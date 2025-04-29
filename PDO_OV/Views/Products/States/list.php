<?php
require_once '../../../Models/State.php';

$stateModel = new State();
$listStates = $stateModel->getAllStates();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Estados</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Lista de Estados</h1>
        </div>
        <?php include '../../navbar.php' ?> 
        <a href="create.php" class="add-btn">Agregar Estado</a>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listStates)): ?>
                        <?php foreach ($listStates as $state): ?>
                            <tr>
                                <td><?= $state['id_estado'] ?></td>
                                <td><?= $state['nombre_estado'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $state['id_estado']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="delete.php?id=<?= $state['id_estado']; ?>" class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay estados registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>