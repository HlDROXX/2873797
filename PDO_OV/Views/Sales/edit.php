<?php
require_once '../../Models/Sale.php';
require_once '../../Models/Client.php';
require_once '../../Models/Employee.php';
require_once '../../Models/SaleType.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id <= 0) {
    header("Location: list.php?error=ID no válido");
    exit;
}

$saleModel = new Sale();
$clientModel = new Client();
$employeeModel = new Employee();
$saleTypeModel = new SaleType();

$clients = $clientModel->getAllClients();
$employees = $employeeModel->getAllEmployees();
$salesType = $saleTypeModel->getAllSalesType();
$sale = $saleModel->getSale($id);

if (empty($sale)) {
    header("Location: list.php?error=Venta no encontrada.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "id_cliente" => trim($_POST["id_cliente"] ?? ""),
        "id_empleado" => trim($_POST["id_empleado"] ?? ""),
        "id_tipo_venta" => trim($_POST["id_tipo_venta"] ?? ""),
    ];

    if (empty($data["id_cliente"]) || empty($data["id_empleado"]) || empty($data["id_tipo_venta"])) {
        echo "Todos los datos son obligatorios.";
    } else {
        $resultado = $saleModel->updateSale($id, $data);

        if ($resultado) {
            header("Location: list.php?success=Venta actualizado.");
        } else {
            echo "Error al editar la venta.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Venta</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Editar Venta</h1>
        </div>
        <div class="card gap-flex">
            <form action="" method="POST" class="card-form">
                <div class="combined-input-field">
                    <div class="input-field">
                        <label for="id_cliente">Cliente</label>
                        <select name="id_cliente" id="id_cliente" class="form-select" required>
                            <option value="" disabled>Selecciona un Cliente</option>
                            <?php foreach ($clients as $client): ?>
                                <option value="<?= $client['id_cliente'] ?>" <?= $client['id_cliente'] == $client['id_cliente'] ? 'selected' : '' ?>>
                                    <?= $client['nombre_cliente'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="input-field">
                        <label for="id_empleado">Empleado</label>
                        <select name="id_empleado" id="id_empleado" class="form-select" required>
                            <option value="" disabled>Selecciona un Empleado</option>
                            <?php foreach ($employees as $employee): ?>
                                <option value="<?= $employee['id_empleado'] ?>"
                                    <?= $employee['id_empleado'] == $employee['id_empleado'] ? 'selected' : '' ?>>
                                    <?= $employee['nombre_empleado'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="input-field">
                        <label for="id_tipo_venta">Tipo Venta</label>
                        <select name="id_tipo_venta" id="id_tipo_venta" class="form-select" required>
                            <option value="" disabled>Selecciona un Tipo de Venta</option>
                            <?php foreach ($salesType as $saleType): ?>
                                <option value="<?= $saleType['id_tipo_venta'] ?>"
                                    <?= $saleType['id_tipo_venta'] == $saleType['id_tipo_venta'] ? 'selected' : '' ?>>
                                    <?= $saleType['id_tipo_venta'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-form-buttons">
                    <button type="submit" class="btn btn-editar">Editar Venta</button>
                    <a href="list.php" class="btn btn-volver">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>