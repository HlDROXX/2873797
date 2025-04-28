<?php
require_once '../../Models/Product.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: list.php?error=ID no válido.");
    exit;
}

$productModel = new Product();
$product = $productModel->getProduct($id);

if (empty($product)) {
    header("Location: list.php?error=Producto no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $productModel->deleteProduct($id);

    if ($result) {
        header("Location: list.php?success=Producto Eliminado.");
    } else {
        echo "Error al eliminar el producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <h1>Eliminar Producto</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar el producto <strong><?= $product["nombre_prod"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="list.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>