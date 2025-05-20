<a href="index.php?action=create" class="btn btn-success mb-3">Agregar Mascota</a>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Raza</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($mascotas as $m): ?>
        <tr>
            <td><?= htmlspecialchars($m['nombre']) ?></td>
            <td><?= $m['edad'] ?></td>
            <td><?= htmlspecialchars($m['raza_nombre']) ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $m['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                <a href="index.php?action=delete&id=<?= $m['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta mascota?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
