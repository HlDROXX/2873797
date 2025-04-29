<?php
define('BASE_URL', '/2873797/PDO_OV/Views/');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sidebar con Todas Subsecciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/inicio.css">

</head>

<body>

    <div class="d-flex">
        <div id="sidebar" class="bg-dark p-3">
            <h4>Menú</h4>
            <ul class="nav flex-column">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>home.php">
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#submenuEmpleados" role="button"
                            aria-expanded="false" aria-controls="submenuEmpleados">
                            Empleados
                        </a>
                        <div class="collapse" id="submenuEmpleados">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>Employees/list.php">Lista Empleados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>Employees/create.php">Subir Empleado</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#submenuClientes" role="button"
                            aria-expanded="false" aria-controls="submenuClientes">
                            Clientes
                        </a>
                        <div class="collapse" id="submenuClientes">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>Clients/list.php">Lista Clientes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>Clients/create.php">Subir Cliente</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#submenuProductos" role="button"
                            aria-expanded="false" aria-controls="submenuProductos">
                            Productos
                        </a>
                        <div class="collapse" id="submenuProductos">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>Products/list.php">Lista Productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>Products/create.php">Subir Producto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="<?= BASE_URL ?>Products/Categories/list.php">Categorías</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>Products/States/list.php">Estados</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#submenuVentas" role="button"
                            aria-expanded="false" aria-controls="submenuVentas">
                            Ventas
                        </a>
                        <div class="collapse" id="submenuVentas">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= BASE_URL ?>Sales/list.php">Lista Ventas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>Sales/create.php">Subir Venta</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= BASE_URL ?>Sales/SalesType/list.php">Tipos Venta</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                </ul>
        </div>

        <!-- Contenido -->
        <div class="flex-grow-1 p-4">
            <h1>Contenido Principal</h1>
            <p>Aquí estará el contenido de tu página web.</p>
        </div>


        <section class="summary-grid">
            <a href="<?= BASE_URL ?>Employees/create.php">
                <div class="summary-card">
                    <h3><i class="fas fa-cash-register"></i> Ingresos Hoy</h3>
                    <span>$4,320</span>
                </div>
            </a>
            <a href="<?= BASE_URL ?>Clients/list.php">
                <div class="summary-card">
                    <h3><i class="fas fa-users"></i> Nuevos Usuarios</h3>
                    <span>18</span>
                </div>
            </a>
            <a href="<?= BASE_URL ?>Products/list.php">
                <div class="summary-card">
                    <h3><i class="fas fa-boxes"></i> Inventario</h3>
                    <span>980</span>
                </div>
            </a>
            <div class="summary-card">
                <h3><i class="fas fa-calendar-alt"></i> Total Abril</h3>
                <span>$45,120</span>
            </div>
        </section>

        <section class="action-panel">
            <h2><i class="fas fa-bolt"></i> Acciones Directas</h2>
            <div class="action-buttons">
                <a href="<?= BASE_URL ?>Employees/create.php"><button><i class="fas fa-user-plus"></i> Registrar
                        Empleado</button></a>
                <a href="<?= BASE_URL ?>Clients/create.php"><button><i class="fas fa-user-tag"></i> Agregar
                        Cliente</button></a>
                <a href="<?= BASE_URL ?>Products/create.php"><button><i class="fas fa-box-open"></i> Nuevo
                        Producto</button></a>
                <a href="<?= BASE_URL ?>Sales/create.php"><button><i class="fas fa-receipt"></i> Generar
                        Factura</button></a>
            </div>
        </section>

        <section class="notifications">
            <h2><i class="fas fa-exclamation-circle"></i> Notificaciones</h2>
            <div class="alert-box">
                <p><i class="fas fa-triangle-exclamation"></i> 4 productos con stock bajo</p>
                <p><i class="fas fa-clock"></i> 3 pagos aún no confirmados</p>
            </div>
        </section>

        <section class="ranking">
            <h2><i class="fas fa-star"></i> Rendimiento Comercial</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Total Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>🔝 Ana Torres</td>
                        <td class="resaltado">$29,300</td>
                    </tr>
                    <tr>
                        <td>Pedro Salinas</td>
                        <td>$22,150</td>
                    </tr>
                    <tr>
                        <td>Lucía Méndez</td>
                        <td>$18,700</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>