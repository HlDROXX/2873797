<?php
require_once '../../Models/Employee.php';

$employeeModel = new Employee();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "nombre" => trim($_POST["nombre"] ?? ""),
        "email" => trim($_POST["email"] ?? ""),
        "usuario" => trim($_POST["usuario"] ?? ""),
        "password" => trim($_POST["password"] ?? ""),
        "confirmarPassword" => trim($_POST["confirmarPassword"] ?? "")
    ];

    if (empty($data["nombre"]) || empty($data["email"]) || empty($data["usuario"]) || empty($data["password"])) {
        echo "Todos los datos son obligatorios.";
    }
    if ($data["password" != $data["confirmarPassword"]]) {
        echo "La contraseña y la confirmación de tu contraseña deben ser iguales.";
    } else {
        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);

        $result = $employeeModel->insertEmployee($data);

        if ($result) {
            header("Location: list.php?success=Empleado creado.");
        } else {
            echo "Error al crear el empleado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Empleado</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Subir Empleado</h1>
        </div>
        <div class="card">
            <form action="" method="POST" class="card-form">
                <div class="input-field">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="input-field">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" required>
                </div>
                <div class="input-field">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="input-field">
                    <label for="confirmPassword">Confirmar Contraseña</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" required>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Guardar Empleado</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>