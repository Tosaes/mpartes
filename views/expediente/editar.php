<?php
/*session_start();*/
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>


<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Expediente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h3>Editar Expediente</h3>
  <form action="index.php?c=expediente&a=actualizar" method="POST" enctype="multipart/form-data" class="mt-4">
    <input type="hidden" name="ano_eje" value="<?= $expediente['ano_eje'] ?>">
    <label class="form-label">Nº Expediente:</label>
    <h3><?= $expediente['ano_eje'] . '-' . $expediente['nro_expediente'] ?></h3>
    <input type="hidden" name="nro_expediente" class="form-control" value="<?= $expediente['nro_expediente'] ?>" required>
    <input type="hidden" name="doc_adjunto_actual" value="<?= $expediente['doc_adjunto'] ?>">

    <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Tipo de Documento</label>
          <input type="text" name="tipo_documento" class="form-control" value="<?= $expediente['tipo_documento'] ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">N° Documento</label>
          <input type="text" name="nro_documento" class="form-control" value="<?= $expediente['nro_documento'] ?>" required>
        </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Asunto</label>
      <input type="text" name="asunto" class="form-control" value="<?= $expediente['asunto'] ?>" required>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
          <label class="form-label">N° Folio</label>
          <input type="number" name="nro_folio" class="form-control" value="<?= $expediente['nro_folio'] ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">Fecha Recibido</label>
          <input type="datetime-local" name="fecha_recibido" class="form-control" 
            value="<?= date('Y-m-d\TH:i', strtotime($expediente['fecha_recibido'])) ?>" required>
        </div>
        <div class="col-md-5">
          <label class="form-label">Firmado Por</label>
          <input type="text" name="firmado_por" class="form-control" value="<?= $expediente['firmado_por'] ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label">Entidad Remite</label>
          <input type="text" name="entidad_remite" class="form-control" value="<?= $expediente['entidad_remite'] ?>" required>
        </div>

        <div class="mb-3">
          <label>Oficina</label>
          <select name="idoficina" class="form-select" required>
            <option value="">-- Seleccione una oficina --</option>
            <?php foreach ($oficinas as $ofi): ?>
              <option value="<?= $ofi['idoficina'] ?>" 
                <?= ($expediente['idoficina'] == $ofi['idoficina']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($ofi['oficina']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label">Documento Adjunto</label>
          <input type="file" name="doc_adjunto" class="form-control">
          <?php if(!empty($expediente['doc_adjunto'])): ?>
            <small>Archivo actual: 
              <a href="uploads/<?= urlencode($expediente['doc_adjunto']) ?>" target="_blank"><?= $expediente['doc_adjunto'] ?></a>
            </small>
          <?php endif; ?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php?c=expediente&a=index" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>