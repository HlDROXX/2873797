<?php
require_once '../../Models/Client.php';

$ClientModel = new Client();
$listClients = $ClientModel->getAllClients();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Lista de Clientes</h1>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Identidad</th>
                        <th>Direccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listClients)): ?>
                        <?php foreach ($listClients as $client): ?>
                            <tr>
                                <td><?= $client['id_cliente'] ?></td>
                                <td><?= $client['nombre_cliente'] ?></td>
                                <td><?= $client['nro_identidad'] ?></td>
                                <td><?= $client['direccion_cliente'] ?></td>
                                <td>
                                    <a href="view.php?id=<?= $client['id_cliente']; ?>" class="btn btn-ver">Ver</a>
                                    <a href="edit.php?id=<?= $client['id_cliente']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="delete.php?id=<?= $client['id_cliente']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay clientes registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>