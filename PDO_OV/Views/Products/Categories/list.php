<?php
require_once '../../../Models/Category.php';

$categoryModel = new Category();
$listCategory = $categoryModel->getAllCategories();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Categorias</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Lista de Categorias</h1>
        </div>
        <a href="create.php" class="add-btn">Agregar Categoria</a>
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
                    <?php if (!empty($listCategory)): ?>
                        <?php foreach ($listCategory as $category): ?>
                            <tr>
                                <td><?= $category['id_categoria'] ?></td>
                                <td><?= $category['nombre_categoria'] ?></td>
                                <td>
                                    <a href="edit.php?id=<?= $category['id_categoria']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="delete.php?id=<?= $category['id_categoria']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay categorias registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>