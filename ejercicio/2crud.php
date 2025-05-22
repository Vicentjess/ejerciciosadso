<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
    <title>Crud</title>
</head>
<body>
    <h1>Nueva Tarea</h1>
    <form action="" method="post">
        <input type="text" name="tarea" placeholder="Escribe tu tarea">
        <button type="submit">Enviar</button>
    </form>
    
    <?php
        session_start();
        $eliminar="Se eliminó la tarea: ";
        $crear="Se guradó la tarea: ";

        if (!isset($_SESSION['tareas'])){
            $_SESSION['tareas'] = [];
        }
         //  para gregar 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tarea = $_POST['tarea'];
            
            if (!empty($tarea)) {
                array_push($_SESSION['tareas'],($tarea));
                echo $crear .($tarea);
            } else {
                echo "Por favor escribe una tarea";
            }
        }

        // para eliminar
        if (isset($_GET['eliminar'])) {
            $index = (int)$_GET['eliminar'];
            if (isset($_SESSION['tareas'][$index])) {
                $tareaEliminada = $_SESSION['tareas'][$index];
                unset($_SESSION['tareas'][$index]);
                $_SESSION['tareas'] = array_values($_SESSION['tareas']); 
                echo $eliminar .($tareaEliminada);
            }
        } 

        echo "<h2>Mi lista de tareas</h2>";
        if (!empty($_SESSION['tareas'])) {
            echo "<ul>";
            foreach ($_SESSION['tareas'] as $index => $tarea) {
                echo "<li>" . $tarea . "<a href='?eliminar=" .$index."'> [Eliminar] </a></li>"; 
            }
            echo "</ul>";
        } else {
            echo "<p>No hay tareas aún</p>";
        }   
    ?>
</body>
</html>
