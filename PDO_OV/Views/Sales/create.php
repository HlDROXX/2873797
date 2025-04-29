<?php
session_start();
require_once '../../Models/Sale.php';
require_once '../../Models/Product.php';
require_once '../../Models/Client.php';
require_once '../../Models/Employee.php';
require_once '../../Models/SaleType.php';
require_once '../../Models/DetailInvoice.php';

$saleModel = new Sale();
$productModel = new Product();
$clientModel = new Client();
$employeeModel = new Employee();
$saleTypeModel = new SaleType();
$detailInvoiceModel = new DetailInvoice();

$products = $productModel->getAllProducts();
$clients = $clientModel->getAllClients();
$employees = $employeeModel->getAllEmployees();
$salesType = $saleTypeModel->getAllSalesType();

$nroFactura = $saleModel->generar_nro_factura();

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

if (isset($_GET['eliminar'])) {
    $index = (int) $_GET['eliminar'];
    if (isset($_SESSION["carrito"][$index])) {
        unset($_SESSION["carrito"][$index]);
        $_SESSION["carrito"] = array_values($_SESSION["carrito"]);
    }
}

if (isset($_POST['agregar'])) {
    $cod_prod = $_POST["cod_prod"];
    $cantidad = (int) $_POST["cantidad"];

    if ($cod_prod && $cantidad > 0) {
        $producto = $productModel->getProduct($cod_prod);
        if ($producto) {
            $_SESSION["carrito"][] = [
                "cod_prod" => $cod_prod,
                "nombre_prod" => $producto["nombre_prod"],
                "precio" => $producto["valor_unidad"],
                "impuesto" => $producto["impuesto"],
                "cantidad" => $cantidad
            ];
        }
    }
}
if (isset($_POST['guardar'])) {
    $nro_factura = $nroFactura;
    $id_cliente = trim($_POST["id_cliente"]);
    $id_empleado = trim($_POST["id_empleado"]);
    $id_tipo_venta = trim($_POST["id_tipo_venta"]);
    $fecha = date("Y-m-d H:i:s");

    if ($nro_factura && $id_cliente && $id_empleado && $id_tipo_venta && !empty($_SESSION["carrito"])) {
        $totalVenta = 0;
        foreach ($_SESSION["carrito"] as $item) {
            $subtotal = $item["precio"] * $item["cantidad"];
            $iva = $subtotal * ($item["impuesto"] / 100);
            $totalVenta += $subtotal + $iva;
        }

        $ventaData = [
            "nro_factura" => $nroFactura,
            "id_cliente" => $id_cliente,
            "id_empleado" => $id_empleado,
            "id_tipo_venta" => $id_tipo_venta,
            "fecha" => $fecha,
            "valor_total" => $totalVenta,
        ];

        $ventaGuardada = $saleModel->insertSale($ventaData);

        if ($ventaGuardada) {
            foreach ($_SESSION["carrito"] as $item) {
                $subtotal = $item["precio"] * $item["cantidad"];
                $iva = $subtotal * ($item["impuesto"] / 100);
                $total = $subtotal + $iva;

                $detalleData = [
                    "nro_factura" => $nroFactura,
                    "cod_prod" => $item["cod_prod"],
                    "cantidad" => $item["cantidad"],
                    "valor_prod" => $item["precio"],
                    "valor_impuesto" => $iva,
                    "valor_total" => $total
                ];
                $detailInvoiceModel->insertDetailsInvoice($detalleData);
            }

            $_SESSION["carrito"] = [];
            header("Location: list.php?success=Venta creada correctamente");
            exit;
        } else {
            echo "Error al crear la sale";
        }
    } else {
        echo "Faltan datos o no hay productos agregados";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Venta</title>
    <link rel="stylesheet" href="../../styles/principal.css">
    <link rel="stylesheet" href="../../styles/base.css">
</head>

<body>
    <?php include '../navbar.php' ?>

    <div class="container">
        <div class="header">
            <h1>Crear Venta</h1>
        </div>

        <div class="card">
            <form action="" method="POST" class="card-form">

                <div class="input-field">
                    <label for="nro_factura">Número de Factura</label>
                    <input type="text" id="nro_factura" name="nro_factura" value="<?= $nroFactura ?>" readonly>
                </div>

                <div class="input-field">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" id="id_cliente">
                        <option value="">Selecciona el cliente</option>
                        <?php foreach ($clients as $cliente): ?>
                            <option value="<?= $cliente["id_cliente"] ?>"><?= $cliente["nombre_cliente"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-field">
                    <label for="id_empleado">Empleado</label>
                    <select name="id_empleado" id="id_empleado">
                        <option value="">Selecciona el empleado</option>
                        <?php foreach ($employees as $empleado): ?>
                            <option value="<?= $empleado["id_empleado"] ?>"><?= $empleado["nombre_empleado"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-field">
                    <label for="id_tipo_venta">Tipo de Venta</label>
                    <select name="id_tipo_venta" id="id_tipo_venta">
                        <option value="">Selecciona el tipo de sale</option>
                        <?php foreach ($salesType as $tipo): ?>
                            <option value="<?= $tipo["id_tipo_venta"] ?>"><?= $tipo["descripcion"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <hr>

                <h3>Agregar Producto</h3>
                <div class="input-field">
                    <label for="cod_prod">Producto</label>
                    <select name="cod_prod" id="cod_prod">
                        <option value="">Selecciona el producto</option>
                        <?php foreach ($products as $prod): ?>
                            <option value="<?= $prod["cod_prod"] ?>"><?= $prod["nombre_prod"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-field">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" min="1" required>
                </div>

                <div class="card-form-buttons">
                    <button type="submit" name="agregar" class="btn btn-editar">+ Agregar Producto</button>
                </div>
            </form>

            <!-- Tabla del carrito -->
            <h3>Productos Agregados</h3>
            <?php if (!empty($_SESSION["carrito"])): ?>
                <table border="1" style="width: 100%; margin-top: 10px">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>IVA</th>
                            <th>Total</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalVenta = 0;
                        foreach ($_SESSION["carrito"] as $index => $item):
                            $subtotal = $item["precio"] * $item["cantidad"];
                            $iva = $subtotal * ($item["impuesto"] / 100);
                            $total = $subtotal + $iva;
                            $totalVenta += $total;
                            ?>
                            <tr>
                                <td><?= $item["nombre_prod"] ?></td>
                                <td><?= $item["cantidad"] ?></td>
                                <td>$<?= number_format($item["precio"], 2) ?></td>
                                <td>$<?= number_format($iva, 2) ?></td>
                                <td>$<?= number_format($total, 2) ?></td>
                                <td><a href="?eliminar=<?= $index ?>" onclick="return confirm('¿Eliminar producto?')">❌</a></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4"><strong>Total Venta:</strong></td>
                            <td colspan="2"><strong>$<?= number_format($totalVenta, 2) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No se han agregado products aún.</p>
            <?php endif; ?>

            <!-- Guardar sale -->
            <form method="POST">
                <input type="hidden" name="nro_factura" value="<?= htmlspecialchars($_POST['nro_factura'] ?? '') ?>">
                <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($_POST['id_cliente'] ?? '') ?>">
                <input type="hidden" name="id_empleado" value="<?= htmlspecialchars($_POST['id_empleado'] ?? '') ?>">
                <input type="hidden" name="id_tipo_venta"
                    value="<?= htmlspecialchars($_POST['id_tipo_venta'] ?? '') ?>">
                <button type="submit" name="guardar" class="btn btn-editar">Guardar Venta</button>
            </form>

            <div class="card-form-buttons">
                <a href="list.php" class="btn btn-volver">Cancelar</a>
            </div>
        </div>
    </div>
</body>

</html>