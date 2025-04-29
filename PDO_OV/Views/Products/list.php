<?php
require_once '../../Models/Product.php';

$productModel = new Product();
$listProducts = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Lista de Productos</h1>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listProducts)): ?>
                        <?php foreach ($listProducts as $product): ?>
                            <tr>
                                <td><?= $product["cod_prod"] ?></td>
                                <td><?= $product["nombre_prod"] ?></td>
                                <td><?= number_format($product["valor_unidad"], 2, ',', '.') ?></td>
                                <td><?= $product["stock_prod"] ?></td>
                                <td><?= $product["nombre_categoria"] ?></td>
                                <td><?= $product["nombre_estado"] ?></td>
                                <td>
                                    <a href="view.php?id=<?= $product['cod_prod']; ?>" class="btn btn-ver">Ver</a>
                                    <a href="edit.php?id=<?= $product['cod_prod']; ?>"
                                        class="btn btn-editar">Editar</a>
                                    <a href="delete.php?id=<?= $product['cod_prod']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay productos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>