<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD
  <title>Iniciar Sesión - Mesa de Partes</title>
=======
  <title>Iniciar Sesión - MPartes</title>
>>>>>>> c65da5af84c636c7607ee1dbda2f18baa4a43bd6
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="views/css/login.css"/>  

</head>
<body>

  <div class="card">
    <div class="card-header">
      <!-- Escudo del municipio -->
      <img src="assets/img/EscudoMuni.png" alt="Escudo del Municipio">
      <h5 class="mt-2 mb-0">Municipalidad Distrital de José Crespo y Castillo</h5>
    </div>

    <div class="card-body">
      <h5 class="text-center mb-4 text-primary">Iniciar Sesión</h5>

      <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form action="index.php?c=login&a=acceder" method="POST">
        <div class="mb-3">
          <label class="form-label">Usuario</label>
          <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="clave" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
      </form>
    </div>

    <div class="text-center pb-3 text-muted small">
        <p class="mt-4 mb-0 text-muted" style="font-size: 0.9rem;">
            © <?= date('Y') ?> Mesa de Partes
        </p>
        <p class="mt-4 mb-0 text-muted" style="font-size: 0.9rem;">
            Sistema de Gestión de Expedientes
        </p>
    </div>
  </div>

</body>
</html>
