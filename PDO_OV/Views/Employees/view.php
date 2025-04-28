<?php
require_once '../../Models/Employee.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    header("Location: list.php?error=ID no válido");
    exit;
}

$employeeModel = new Employee();
$employee = $employeeModel->getEmployee($id);

if (empty($employee)) {
    header("Location: list.php?error=Empleado no encontrado.");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver Empleado</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Detalles de Empleado</h1>
        </div>
        <div class="card gap-flex">
            <p><strong>ID:</strong> <?= $employee["id_empleado"] ?></p>
            <p><strong>Nombre:</strong> <?= $employee["nombre_empleado"] ?></p>
            <p><strong>Correo:</strong> <?= $employee["correo"] ?></p>
            <p><strong>Usuario:</strong> <?= $employee["usuario"] ?></p>
        </div>
        <a href="list.php" class="btn btn-volver">Volver</a>
    </div>
</body>

</html>