<?php
require_once '../../Models/Sale.php';

$ventaModelo = new Sale();
$listaVentas = $ventaModelo->getAllSales();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Ventas</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Lista de Ventas</h1>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Factura</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Empleado</th>
                        <th>Tipo de Venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listaVentas)): ?>
                        <?php foreach ($listaVentas as $sale): ?>
                            <tr>
                                <td><?= $sale["nro_factura"] ?></td>
                                <td><?= $sale["fecha_venta"] ?></td>
                                <td><?= $sale["nombre_cliente"] ?></td>
                                <td><?= $sale["nombre_empleado"] ?></td>
                                <td><?= $sale["descripcion"] ?></td>
                                <td>
                                    <a href="view.php?id=<?= $sale['nro_factura']; ?>" class="btn btn-ver">Ver</a>
                                    <a href="edit.php?id=<?= $sale['nro_factura']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="../pdf.php?id=<?= $sale['nro_factura'] ?>" class="btn btn-eliminar" target="_blank">Factura</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay ventas registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>