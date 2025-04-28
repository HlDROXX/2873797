<?php
require_once '../../Models/Employee.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido.");
    exit;
}

$employeeModel = new Employee();
$employee = $employeeModel->getEmployee($id);

if (empty($employee)) {
    header("Location: list.php?error=Empleado no encontrado.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $employeeModel->deleteEmployee($id);

    if ($result) {
        header("Location: list.php?success=Empleado Eliminado.");
    } else {
        echo "Error al eliminar el empleado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Empleado</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <h1>Eliminar Empleado</h1>
        <div class="card gap-flex">
            <p>¿Estás seguro de que deseas eliminar al empleado <strong><?= $employee["nombre_empleado"] ?></strong>?
            </p>
            <form action="" method="POST">
                <button type="submit" class="btn btn-eliminar">Sí, eliminar</button>
                <a href="list.php" class="btn btn-volver">Cancelar</a>
            </form>
        </div>
    </div>
</body>

</html>