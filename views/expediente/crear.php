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
  <title>Nuevo Expediente</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body class="container mt-5">
  <h3>Registrar Nuevo Expediente</h3>
  
  <form action="index.php?c=expediente&a=guardar" method="POST" enctype="multipart/form-data" class="mt-4">
      
      <div class="col-md-2">
        <input type="hidden" name="ano_eje" value="<?= date('Y') ?>" class="form-control" readonly> <!-- campo que se guardar, pero esta oculto -->
      </div>

      <div class="col-md-3">
        <input type="hidden" name="nro_expediente" value="<?= $siguienteNumero ?>" class="form-control" readonly> <!-- campo que se guardar, pero esta oculto -->
      </div>

      <!-- solo para estetica -->
      <div class="col-md-12">
        <label class="form-label">N° Expediente</label>  
        <h3><?= date('Y') . '-' . $siguienteNumero ?></h3>
      </div>  
      <!------------------->
    <br>
    <div class="row mb-3">       
      <div class="col-md-4">
        <label class="form-label">Tipo de Documento</label>
        <select name="tipo_documento" class="form-select" required>
          <option value="Sin-opción">--Selecciona una Opción--</option>
          <option value="Carta">Carta</option>
          <option value="Carta Multiple">Carta Multiple</option>
          <option value="Escrito">Escrito</option>
          <option value="Oficio">Oficio</option>
          <option value="Oficio Multiple">Oficio Multiple</option>
          <option value="Solicitud">Solicitud</option>
        </select>

      </div>
      <div class="col-md-3">
        <label class="form-label">N° Documento</label>
        <input type="text" name="nro_documento" class="form-control" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Asunto</label>
      <input type="text" name="asunto" class="form-control" required>
    </div>

    <div class="row mb-3">
      <div class="col-md-2">
        <label class="form-label">N° Folio</label>
        <input type="number" name="nro_folio" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Fecha Recibido</label>
        <input type="datetime-local" name="fecha_recibido" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Firmado Por</label>
        <input type="text" name="firmado_por" class="form-control" required>
      </div>
      <div class="col-md-3">
        <label class="form-label">Entidad Remite</label>
        <input type="text" name="entidad_remite" class="form-control" required>
      </div>
    </div>

    <div class="row mb-3">
      <div class="col-md-3">
        <label class="form-label">Oficina</label>
        <select name="idoficina" class="form-select" required>
          <option value="">-- Seleccione una oficina --</option>
          <?php foreach ($oficinas as $ofi): ?>
            <option value="<?= $ofi['idoficina'] ?>"><?= htmlspecialchars($ofi['oficina']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label">Documento Adjunto</label>
        <input type="file" name="doc_adjunto" class="form-control">
      </div>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php?c=expediente&a=index" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
