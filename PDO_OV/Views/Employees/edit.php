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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "nombre" => trim($_POST["nombre"] ?? ""),
        "email" => trim($_POST["email"] ?? ""),
        "usuario" => trim($_POST["usuario"] ?? "")
    ];

    if (empty($data["nombre"]) || empty($data["email"]) || empty($data["usuario"])) {
        echo "Todos los datos son obligatorios.";
    }else {
        $result = $employeeModel->updateEmployee($id, $data);

        if ($result) {
            header("Location: list.php?success=Empleado actualizado.");
        } else {
            echo "Error al editar el empleado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Editar Empleado</h1>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?= $employee['nombre_empleado'] ?>" required>
                </div>

                <div class="input-field">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" value="<?= $employee['usuario'] ?>" required>
                </div>

                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= $employee['correo'] ?>" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Empleado</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>