<?php
define('BASE_URL', '/2873797/PDO_OV/Views/')
    ?>

<div class="navbar">
    <div class="dropdown">
    <button onclick="window.location.href='/2873797/PDO_OV/Views/home.php'" class="dropbtn">Inicio</button>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Empleados   
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?= BASE_URL ?>Employees/list.php">Lista Empleados</a>
            <a href="<?= BASE_URL ?>Employees/create.php">Subir Empleado</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Clientes
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?= BASE_URL ?>Clients/list.php">Lista Clientes</a>
            <a href="<?= BASE_URL ?>Clients/create.php">Subir Cliente</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Productos
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?= BASE_URL ?>Products/list.php">Lista Productos</a>
            <a href="<?= BASE_URL ?>Products/create.php">Subir Producto</a>
            <a href="<?= BASE_URL ?>Products/Categories/list.php">Categorías</a>
            <a href="<?= BASE_URL ?>Products/States/list.php">Estados</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Ventas
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="<?= BASE_URL ?>Sales/list.php">Lista Ventas</a>
            <a href="<?= BASE_URL ?>Sales/create.php">Subir Venta</a>
            <a href="<?= BASE_URL ?>Sales/SalesType/list.php">Tipos Venta</a>
        </div>
    </div>
</div>