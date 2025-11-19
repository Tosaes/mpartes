<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nuevo Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

  <h3 class="mb-4">Registrar Nuevo Usuario</h3>

  <form action="index.php?c=usuario&a=guardar" method="post" class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Nombres</label>
      <input type="text" name="nombres" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Usuario</label>
      <input type="text" name="usuario" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Contraseña</label>
      <input type="password" name="clave" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Rol</label>
      <select name="rol" class="form-select">
        <option value="admin">Admin</option>
        <option value="usuario">Usuario</option>
      </select>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <a href="index.php?c=usuario&a=index" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>

</body>
</html>
