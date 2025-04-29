<?php
require_once '../../Models/Product.php';
require_once '../../Models/Category.php';
require_once '../../Models/State.php';

$productModel = new Product();
$categoryModel = new Category();
$stateModel = new State();

$categories = $categoryModel->getAllCategories();
$states = $stateModel->getAllStates();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "codigo" => trim($_POST["codigo"] ?? ""),
        "nombre" => trim($_POST["nombre"] ?? ""),
        "descripcion" => trim($_POST["descripcion"] ?? ""),
        "stock" => trim($_POST["stock"] ?? ""),
        "precio" => trim($_POST["precio"] ?? ""),
        "impuesto" => trim($_POST["impuesto"] ?? ""),
        "id_categoria" => trim($_POST["id_categoria"] ?? ""),
        "id_estado" => trim($_POST["id_estado"] ?? "")
    ];

    if (empty($data["codigo"]) || empty($data["nombre"]) || empty($data["descripcion"]) || empty($data["stock"]) || empty($data["precio"])) {
        echo "Todos los datos son obligatorios.";
    } else {
        $result = $productModel->insertProduct($data);

        if ($result) {
            header("Location: list.php?success=Producto creado.");
        } else {
            echo "Error al crear el producto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Crear Producto</h1>
        </div>
        <?php include '../navbar.php' ?>


        <div class="formulario-crear    ">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="codigo">Código</label>
                    <input type="text" id="codigo" name="codigo" required>
                </div>
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="input-field">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" rows="4" required></textarea>
                </div>
                <div class="input-field">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" min="0" required>
                </div>
                <div class="input-field">
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" min="0" step="0.01" required>
                </div>
                <div class="input-field">
                    <label for="impuesto">Impuesto</label>
                    <input type="number" id="impuesto" name="impuesto" min="0" step="0.01" required>
                </div>
                <div class="combined-input-field">
                    <div class="input-field">
                        <label for="id_categoria">Categoría</label>
                        <select name="id_categoria" id="id_categoria" class="form-select" required>
                            <option value="">Selecciona una categoría</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id_categoria'] ?>">
                                    <?= $categoria['nombre_categoria'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <label for="id_estado">Estado Producto</label>
                        <select name="id_estado" id="id_estado" class="form-select" required>
                            <option value="">Selecciona un estado</option>
                            <?php foreach ($estados as $estado): ?>
                                <option value="<?= $estado['id_estado'] ?>">
                                    <?= $estado['nombre_estado'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Producto</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>