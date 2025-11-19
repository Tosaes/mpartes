<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

  <h3 class="mb-4">Editar Usuario</h3>

  <form action="index.php?c=usuario&a=actualizar" method="post" class="row g-3">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

    <div class="col-md-6">
      <label class="form-label">Nombres</label>
      <input type="text" name="nombres" value="<?= htmlspecialchars($usuario['nombres']) ?>" class="form-control" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Usuario</label>
      <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Nueva Contraseña (opcional)</label>
      <input type="password" name="clave" class="form-control">
    </div>
    <div class="col-md-4">
      <label class="form-label">Rol</label>
      <select name="rol" class="form-select">
        <option value="admin" <?= $usuario['rol']=='admin'?'selected':'' ?>>Admin</option>
        <option value="usuario" <?= $usuario['rol']=='usuario'?'selected':'' ?>>Usuario</option>
      </select>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Actualizar</button>
      <a href="index.php?c=usuario&a=index" class="btn btn-secondary">Cancelar</a>
    </div>
  </form>

</body>
</html>
