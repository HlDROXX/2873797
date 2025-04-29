<?php
require_once '../../../Models/Category.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido.");
    exit;
}

$categoryModel = new Category();
$category = $categoryModel->getCategory($id);

if (empty($category)) {
    header("Location: list.php?error=Categoria no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $categoryModel->deleteCategory($id);

    if ($result) {
        header("Location: list.php?success=Categoria Eliminado.");
    } else {
        echo "Error al editar el categoria.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Categoria</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <h1>Eliminar Categoria</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar al categoria <strong><?= $category["nombre_categoria"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="list.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>