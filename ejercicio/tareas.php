<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();


if (!isset($_SESSION['tareas']) || !is_array($_SESSION['tareas'])) {
    $_SESSION['tareas'] = [];
}



// CREAR tarea
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nueva_tarea'])) {
    $tarea_texto = trim($_POST['nueva_tarea']);
    if (!empty($tarea_texto)) {
        $nueva_tarea = [
            'id' => uniqid(),
            'texto' => htmlspecialchars($tarea_texto, ENT_QUOTES, 'UTF-8'),
            'completada' => false,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_modificacion' => null
        ];
        $_SESSION['tareas'][] = $nueva_tarea;
    }
}

// ELIMINAR tarea (con validación de existencia)
if (isset($_GET['eliminar'])) {
    $id_eliminar = $_GET['eliminar'];
    $indice = null;
    
    foreach ($_SESSION['tareas'] as $key => $tarea) {
        if (isset($tarea['id']) && $tarea['id'] == $id_eliminar) {
            $indice = $key;
            break;
        }
    }
    
    if ($indice !== null) {
        unset($_SESSION['tareas'][$indice]);
        $_SESSION['tareas'] = array_values($_SESSION['tareas']); // Reindexar
    }
}

// ACTUALIZAR estado de completado
if (isset($_GET['completar'])) {
    $id_completar = $_GET['completar'];
    
    foreach ($_SESSION['tareas'] as &$tarea) {
        if (isset($tarea['id']) && $tarea['id'] == $id_completar) {
            $tarea['completada'] = !$tarea['completada'];
            $tarea['fecha_modificacion'] = date('Y-m-d H:i:s');
            break;
        }
    }
    unset($tarea); // Romper la referencia
}

// EDITAR tarea (preparación)
$tarea_editando = null;
if (isset($_GET['editar'])) {
    $id_editar = $_GET['editar'];
    
    foreach ($_SESSION['tareas'] as $tarea) {
        if (isset($tarea['id']) && $tarea['id'] == $id_editar) {
            $tarea_editando = $tarea;
            break;
        }
    }
}

// GUARDAR edición
if (isset($_POST['guardar_edicion']) && isset($_POST['id_tarea'])) {
    $id_editar = $_POST['id_tarea'];
    $nuevo_texto = trim($_POST['tarea_editada']);
    
    if (!empty($nuevo_texto)) {
        foreach ($_SESSION['tareas'] as &$tarea) {
            if (isset($tarea['id']) && $tarea['id'] == $id_editar) {
                $tarea['texto'] = htmlspecialchars($nuevo_texto, ENT_QUOTES, 'UTF-8');
                $tarea['fecha_modificacion'] = date('Y-m-d H:i:s');
                break;
            }
        }
        unset($tarea); // Romper la referencia
        
        header("Location: ".strtok($_SERVER['REQUEST_URI'], '?'));
        exit;
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
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-container {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        input[type="text"] {
            padding: 8px;
            width: 70%;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
        .tarea {
            background: white;
            padding: 10px 15px;
            margin: 8px 0;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .tarea.completada {
            opacity: 0.7;
        }
        .tarea-texto {
            flex-grow: 1;
        }
        .tarea-texto.completada {
            text-decoration: line-through;
            color: #777;
        }
        .acciones a {
            margin-left: 10px;
            text-decoration: none;
            color: #333;
        }
        .acciones a:hover {
            color: #4CAF50;
        }
        .fecha {
            font-size: 0.8em;
            color: #999;
            margin-top: 5px;
        }
        .no-tareas {
            text-align: center;
            color: #777;
            padding: 20px;
        }
        h1{
            display: flex;
        }
    </style>
</head>
<body>
    <h1>Gestor de Tareas</h1>
    
    <div class="form-container">
        <?php if ($tarea_editando !== null && isset($tarea_editando['id'])): ?>
            <h2>Editar Tarea</h2>
            <form method="post">
                <input type="hidden" name="id_tarea" value="<?php echo htmlspecialchars($tarea_editando['id']); ?>">
                <input type="text" name="tarea_editada" value="<?php echo htmlspecialchars($tarea_editando['texto'] ?? ''); ?>" required>
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
        <div class="no-tareas">
            <p>No hay tareas registradas. ¡Agrega tu primera tarea!</p>
        </div>
    <?php else: ?>
        <div class="tareas-lista">
            <?php foreach ($_SESSION['tareas'] as $tarea): ?>
                <?php if (isset($tarea['id'], $tarea['texto'])): ?>
                    <div class="tarea <?php echo ($tarea['completada'] ?? false) ? 'completada' : ''; ?>">
                        <div class="tarea-texto <?php echo ($tarea['completada'] ?? false) ? 'completada' : ''; ?>">
                            <?php echo htmlspecialchars($tarea['texto']); ?>
                            <div class="fecha">
                                Creada: <?php echo htmlspecialchars($tarea['fecha_creacion'] ?? 'Fecha no disponible'); ?>
                                <?php if (isset($tarea['fecha_modificacion']) && !empty($tarea['fecha_modificacion'])): ?>
                                    <br>Modificada: <?php echo htmlspecialchars($tarea['fecha_modificacion']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="acciones">
                            <a href="?completar=<?php echo htmlspecialchars($tarea['id']); ?>" title="<?php echo ($tarea['completada'] ?? false) ? 'Marcar como pendiente' : 'Marcar como completada'; ?>">
                                <?php echo ($tarea['completada'] ?? false) ? '↩️ Revertir' : '✅ Completar'; ?>
                            </a>
                            <a href="?editar=<?php echo htmlspecialchars($tarea['id']); ?>" title="Editar tarea">✏️ Editar</a>
                            <a href="?eliminar=<?php echo htmlspecialchars($tarea['id']); ?>" title="Eliminar tarea" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">🗑️ Eliminar</a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>