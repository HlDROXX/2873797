<?php
require_once '../../Models/Product.php';
require_once '../../Models/Category.php';
require_once '../../Models/State.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: lista-productos.php?error=ID no válido");
    exit;
}

$productModel = new Product();
$categoryModel = new Category();
$stateModel = new State();

$categories = $categoryModel->getAllCategories();
$states = $stateModel->getAllStates();

$product = $productModel->getProduct($id);

if (empty($product)) {
    header("Location: lista.php?error=Producto no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "nombre" => trim($_POST["nombre"] ?? ""),
        "descripcion" => trim($_POST["descripcion"] ?? ""),
        "stock" => trim($_POST["stock"] ?? ""),
        "precio" => trim($_POST["precio"] ?? ""),
        "impuesto" => trim($_POST["impuesto"] ?? ""),
        "id_categoria" => trim($_POST["id_categoria"] ?? ""),
        "id_estado" => trim($_POST["id_estado"] ?? "")
    ];

    if (empty($data["nombre"]) || empty($data["descripcion"]) || empty($data["stock"]) || empty($data["precio"])) {
        echo "Todos los datos son obligatorios.";
    } else {
        $result = $productModel->updateProduct($id, $data);

        if ($result) {
            header("Location: list.php?success=Producto actualizado.");
        } else {
            echo "Error al editar el producto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Editar Producto</h1>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $product['nombre_prod'] ?>" required>
                </div>
                <div class="input-field">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" rows="4"
                        required><?= $product['descripcion_prod'] ?></textarea>
                </div>
                <div class="input-field">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" value="<?= $product['stock_prod'] ?>" min="0" required>
                </div>
                <div class="input-field">
                    <label for="precio">Precio</label>
                    <input type="number" id="precio" name="precio" min="0" step="0.01"
                        value="<?= $product['valor_unidad'] ?>" required>
                </div>
                <div class="input-field">
                    <label for="impuesto">Impuesto</label>
                    <input type="number" id="impuesto" name="impuesto" min="0" step="0.01"
                        value="<?= $product['impuesto'] ?>" required>
                </div>
                <div class="combined-input-field">
                    <div class="input-field">
                        <label for="id_category">Categoría</label>
                        <select name="id_categoria" id="id_category" class="form-select" required>
                            <option value="" disabled>Selecciona una categoría</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id_categoria'] ?>"
                                    <?= $category['id_categoria'] == $product['id_categoria'] ? 'selected' : '' ?>>
                                    <?= $category['nombre_categoria'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="id_state">Estado Producto</label>
                        <select name="id_estado" id="id_state" class="form-select" required>
                            <option value="" disabled>Selecciona un estado</option>
                            <?php foreach ($states as $state): ?>
                                <option value="<?= $state['id_estado'] ?>" <?= $state['id_estado'] == $product['id_estado'] ? 'selected' : '' ?>>
                                    <?= $state['nombre_estado'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Producto</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>