<?php
require_once '../../../Models/Category.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido");
    exit;
}

$categoryModel = new Category();
$category = $categoryModel->getCategory($id);

if (empty($category)) {
    header("Location: list.php?error=Categoria no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_estado = trim($_POST["nombre"] ?? "");

    if (empty($nombre_estado)) {
        echo "Todos los datos son obligatorios.";
    } else {
        $result = $categoryModel->updateCategory($id, $nombre_estado);

        if ($result) {
            header("Location: list.php?success=Categoria actualizado.");
        } else {
            echo "Error al editar la categoria.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Categoria</title>
    <link rel="stylesheet" href="../../../styles/principal.css">
    <link rel="stylesheet" href="../../../styles/base.css">
</head>

<body>
    <?php include '../../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Editar Categoria</h1>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $category['nombre_categoria'] ?>" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Categoria</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>