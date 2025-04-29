<?php
require_once '../../Models/Employee.php';

$employeeModel = new Employee();
$listEmployees = $employeeModel->getAllEmployees();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Lista de Empleados</h1>
        </div>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($listEmployees)): ?>
                        <?php foreach ($listEmployees as $empleado): ?>
                            <tr>
                                <td><?= $empleado['id_empleado'] ?></td>
                                <td><?= $empleado['nombre_empleado'] ?></td>
                                <td><?= $empleado['usuario'] ?></td>
                                <td><?= $empleado['correo'] ?></td>
                                <td>
                                    <a href="view.php?id=<?= $empleado['id_empleado']; ?>" class="btn btn-ver">Ver</a>
                                    <a href="edit.php?id=<?= $empleado['id_empleado']; ?>" class="btn btn-editar">Editar</a>
                                    <a href="delete.php?id=<?= $empleado['id_empleado']; ?>"
                                        class="btn btn-eliminar">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">No hay empleados registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>