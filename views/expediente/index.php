<?php
/*session_start();*/
if(!isset($_SESSION['usuario'])){
  header("Location: index.php");
  exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Expedientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body class="container mt-5">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Listado de Expedientes</h3>
    <div>
      <span class="me-2">👥<?= htmlspecialchars($_SESSION['usuario']['nombres'] ?? '') ?></span>
      <a href="index.php?c=login&a=salir" class="btn btn-danger btn-sm">Cerrar sesión</a>
    </div>
  </div>

  <a href="index.php?c=expediente&a=crear" class="btn btn-success mb-3">+ Nuevo Expediente</a>

  <form method="GET" class="mb-4 d-flex" action="index.php">
    <input type="hidden" name="c" value="expediente">
    <input type="hidden" name="a" value="index">
    <input type="text" name="q" class="form-control me-2" placeholder="Buscar por: Expediente, Tipo documento, Asunto ó Firmado por" 
          value="<?= htmlspecialchars($busqueda ?? '') ?>">
    <button class="btn btn-outline-primary" type="submit">Buscar</button>
  </form>

  <table class="table table-hover shadow-sm">
    <thead class="table-dark text-center align-middle">
      <tr>
        <th>Año</th>
        <th>N° Expediente</th>
        <th>Tipo Documento</th>
        <th>N° Documento</th>
        <th>Asunto</th>
        <th>N° Folio</th>
        <th>Fecha Recepción</th>
        <th>Firmado Por</th>
        <th>Entidad Remite</th>
        <th>Adjunto</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody class="text-center align-middle">
      <?php if (!empty($data)): ?>
        <?php foreach ($data as $exp): ?>
          <tr>
            <td><?= $exp->ano_eje ?></td>  
            <td><?= $exp->nro_expediente ?></td>
            <td><?= htmlspecialchars($exp->tipo_documento) ?></td>
            <td><?= htmlspecialchars($exp->nro_documento) ?></td>
            <td><?= htmlspecialchars($exp->asunto) ?></td>
            <td><?= $exp->nro_folio ?></td>
            <td><?= date('d/m/Y H:i', strtotime($exp->fecha_recibido)) ?></td>
            <td><?= htmlspecialchars($exp->firmado_por) ?></td>
            <td><?= htmlspecialchars($exp->entidad_remite) ?></td>
            <td>
            <?php if(!empty($exp->doc_adjunto)): ?>
              <a href="uploads/<?= urlencode($exp->doc_adjunto) ?>" target="_blank">Ver</a>
            <?php else: ?>
              -
            <?php endif; ?>
            </td>

<<<<<<< HEAD
            <td>
=======
            <td class="d-flex justify-content-center gap-1">
>>>>>>> c65da5af84c636c7607ee1dbda2f18baa4a43bd6
            <p title="Modificar"><a href="index.php?c=expediente&a=editar&ano_eje=<?= $exp->ano_eje ?>&nro_expediente=<?= $exp->nro_expediente ?>" class="btn btn-warning btn-sm"> <i class="fa fa-edit"></i></a> </p>
            <!--<p title="Eliminar"><a href="index.php?c=expediente&a=eliminar&ano_eje=<?= $exp->ano_eje ?>&nro_expediente=<?= $exp->nro_expediente ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar expediente?')"> <i class="fa fa-trash"></i> </a></p>-->
            </td>

          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="9" class="text-center text-muted">No hay registros</td>
        </tr>
      <?php endif; ?>
    </tbody>
</table>

<!-- Paginación -->
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
      <a class="page-link" href="index.php?c=expediente&a=index&page=<?= $pagina - 1 ?>&q=<?= urlencode($busqueda) ?>">Anterior</a>
    </li>

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <li class="page-item <?= ($i == $pagina) ? 'active' : '' ?>">
        <a class="page-link" href="index.php?c=expediente&a=index&page=<?= $i ?>&q=<?= urlencode($busqueda) ?>"><?= $i ?></a>
      </li>
    <?php endfor; ?>

    <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
      <a class="page-link" href="index.php?c=expediente&a=index&page=<?= $pagina + 1 ?>&q=<?= urlencode($busqueda) ?>">Siguiente</a>
    </li>
  </ul>
</nav>

</body>
</html>