<form method="POST" action="index.php?action=store">
    <div class="form-group">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Edad:</label>
        <input type="number" name="edad" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Raza:</label>
        <select name="raza_id" class="form-control" required>
            <option value="">Seleccione una raza</option>
            <?php foreach ($razas as $r): ?>
                <option value="<?= $r['id'] ?>"><?= htmlspecialchars($r['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
</form>
