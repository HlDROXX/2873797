<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="stylesheet" href="../styles/principal.css">
  <link rel="stylesheet" href="../styles/base.css">
  <link rel="stylesheet" href="../styles/inicio.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php include 'navbar.php' ?>

  <header class="main-header">
    <h1><i class="fas fa-chart-line"></i> Panel General</h1>
    <p>Visión rápida del estado actual del negocio</p>
  </header>

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
      <a href="<?= BASE_URL ?>Clients/create.php"><button><i class="fas fa-user-tag"></i> Agregar Cliente</button></a>
      <a href="<?= BASE_URL ?>Products/create.php"><button><i class="fas fa-box-open"></i> Nuevo Producto</button></a>
      <a href="<?= BASE_URL ?>Sales/create.php"><button><i class="fas fa-receipt"></i> Generar Factura</button></a>
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
</body>

</html>