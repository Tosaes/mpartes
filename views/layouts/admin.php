<?php
// layouts/admin.php
/*session_start();*/
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php?c=login&a=index");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel Administrativo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="views/css/paneladmin.css"/>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4>Mesa de Partes</h4>
    <a href="index.php?c=usuario&a=index" class="<?= ($_GET['c'] ?? '') == 'usuario' ? 'active' : '' ?>">👥 Usuarios</a>
    <a href="index.php?c=expediente&a=index" class="<?= ($_GET['c'] ?? '') == 'expediente' ? 'active' : '' ?>">📂 Registrar Expediente</a>
  </div>

  <!-- Main content -->
  <div class="content">
   
  
    <!-- Header -->
    <div class="topbar">
        <div><strong>Municipalidad Distrital de José Crespo y Castillo</strong></div>
        <div>
        <span class="me-2">👤 <?= htmlspecialchars($_SESSION['usuario']['nombres'] ?? '') ?></span>
        <a href="index.php?c=login&a=salir" class="btn btn-outline-danger btn-sm">Cerrar sesión</a>
        </div>
    </div>

    <!-- contenido de las vistas -->
    <div class="main">
      <?php if (isset($vista)) include $vista; ?>
    </div>
  </div>

</body>
</html>
