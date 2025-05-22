<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Inicializar array de tareas si no existe
$_SESSION['tareas'] = $_SESSION['tareas'] ?? [];

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nueva_tarea'])) {
        $tarea_texto = trim($_POST['nueva_tarea']);
        if (!empty($tarea_texto)) {
            $_SESSION['tareas'][] = [
                'id' => uniqid(),
                'texto' => htmlspecialchars($tarea_texto),
                'completada' => false,
                'fecha_creacion' => date('Y-m-d H:i:s')
            ];
        }
    } elseif (isset($_POST['guardar_edicion'])) {
        foreach ($_SESSION['tareas'] as &$tarea) {
            if ($tarea['id'] == $_POST['id_tarea']) {
                $tarea['texto'] = htmlspecialchars(trim($_POST['tarea_editada']));
                $tarea['fecha_modificacion'] = date('Y-m-d H:i:s');
                break;
            }
        }
        header("Location: ".strtok($_SERVER['REQUEST_URI'], '?'));
        exit;
    }
}

// Procesar acciones GET
if (isset($_GET['eliminar'])) {
    $_SESSION['tareas'] = array_filter($_SESSION['tareas'], fn($t) => $t['id'] != $_GET['eliminar']);
} elseif (isset($_GET['completar'])) {
    foreach ($_SESSION['tareas'] as &$t) {
        if ($t['id'] == $_GET['completar']) {
            $t['completada'] = !$t['completada'];
            $t['fecha_modificacion'] = date('Y-m-d H:i:s');
            break;
        }
    }
}

// Preparar tarea para edición
$tarea_editando = null;
if (isset($_GET['editar'])) {
    foreach ($_SESSION['tareas'] as $t) {
        if ($t['id'] == $_GET['editar']) {
            $tarea_editando = $t;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .form-container { background: #f5f5f5; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        input[type="text"] { padding: 8px; width: 70%; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 8px 15px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #45a049; }
        .tarea { background: white; padding: 10px 15px; margin: 8px 0; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .tarea.completada { opacity: 0.7; }
        .tarea-texto { flex-grow: 1; }
        .tarea-texto.completada { text-decoration: line-through; color: #777; }
        .acciones a { margin-left: 10px; text-decoration: none; color: #333; }
        .acciones a:hover { color: #4CAF50; }
        .fecha { font-size: 0.8em; color: #999; margin-top: 5px; }
        .no-tareas { text-align: center; color: #777; padding: 20px; }
        h1 { display: flex; }
    </style>
</head>
<body>
    <h1>Gestor de Tareas</h1>
    
    <div class="form-container">
        <?php if ($tarea_editando): ?>
            <h2>Editar Tarea</h2>
            <form method="post">
                <input type="hidden" name="id_tarea" value="<?= htmlspecialchars($tarea_editando['id']) ?>">
                <input type="text" name="tarea_editada" value="<?= htmlspecialchars($tarea_editando['texto']) ?>" required>
                <button type="submit" name="guardar_edicion">Guardar Cambios</button>
                <a href="?">Cancelar</a>
            </form>
        <?php else: ?>
            <h2>Agregar Nueva Tarea</h2>
            <form method="post">
                <input type="text" name="nueva_tarea" placeholder="Escribe una nueva tarea..." required>
                <button type="submit">Agregar Tarea</button>
            </form>
        <?php endif; ?>
    </div>
    
    <h2>Lista de Tareas</h2>
    <?php if (empty($_SESSION['tareas'])): ?>
        <div class="no-tareas">No hay tareas registradas. ¡Agrega tu primera tarea!</div>
    <?php else: ?>
        <div class="tareas-lista">
            <?php foreach ($_SESSION['tareas'] as $t): ?>
                <div class="tarea <?= $t['completada'] ? 'completada' : '' ?>">
                    <div class="tarea-texto <?= $t['completada'] ? 'completada' : '' ?>">
                        <?= htmlspecialchars($t['texto']) ?>
                        <div class="fecha">
                            Creada: <?= htmlspecialchars($t['fecha_creacion']) ?>
                            <?php if (!empty($t['fecha_modificacion'])): ?>
                                <br>Modificada: <?= htmlspecialchars($t['fecha_modificacion']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="acciones">
                        <a href="?completar=<?= htmlspecialchars($t['id']) ?>" title="<?= $t['completada'] ? 'Marcar como pendiente' : 'Marcar como completada' ?>">
                            <?= $t['completada'] ? '↩️ Revertir' : '✅ Completar' ?>
                        </a>
                        <a href="?editar=<?= htmlspecialchars($t['id']) ?>" title="Editar tarea">✏️ Editar</a>
                        <a href="?eliminar=<?= htmlspecialchars($t['id']) ?>" title="Eliminar tarea" onclick="return confirm('¿Estás seguro?')">🗑️ Eliminar</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>