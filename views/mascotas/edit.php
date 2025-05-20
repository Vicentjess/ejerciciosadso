<form method="POST" action="index.php?action=update&id=<?= $mascota['id'] ?>">
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($mascota['nombre']) ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Edad:</label>
        <input type="number" name="edad" value="<?= $mascota['edad'] ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Raza:</label>
        <select name="raza_id" class="form-control" required>
            <?php foreach ($razas as $r): ?>
                <option value="<?= $r['id'] ?>" <?= $r['id'] == $mascota['raza_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($r['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>
