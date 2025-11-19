<?php
/*session_start();*/
if ($_SESSION['usuario']['rol'] != 'admin') exit; 
?>


<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Gestión de Usuarios</h4>
    <a href="index.php?c=usuario&a=crear" class="btn btn-primary">+ Nuevo Usuario</a>
</div>

<table class="table table-bordered table-striped shadow-sm">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Email</th>
            <th>Usuario</th>
            <th>Rol</th>
            <th width="150">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['nombres']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['usuario']) ?></td>
            <td><span class="badge bg-<?= $u['rol'] == 'admin' ? 'danger' : 'secondary' ?>"> <?= ucfirst($u['rol']) ?> </span></td>
            
            <td>
                <a href="index.php?c=usuario&a=editar&id=<?= $u['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="index.php?c=usuario&a=eliminar&id=<?= $u['id'] ?>" class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
