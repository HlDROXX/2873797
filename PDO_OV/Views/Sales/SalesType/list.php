<?php
require_once '../../../Models/SaleType.php';

$tipoVentaModelo = new SaleType();
$listaTiposVenta = $tipoVentaModelo->getAllSalesType();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Tipos Venta</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Lista de Tipos Venta</h1>
        </div>
        <a href="create.php" class="add-btn">Agregar Tipo Venta</a>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaTiposVenta)): ?>
                        <?php foreach ($listaTiposVenta as $tipoVenta): ?>
                            <tr>
                                <td><?= $tipoVenta['id_tipo_venta'] ?></td>
                                <td><?= $tipoVenta['descripcion'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $tipoVenta['id_tipo_venta']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="delete.php?id=<?= $tipoVenta['id_tipo_venta']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay tiposVenta registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>