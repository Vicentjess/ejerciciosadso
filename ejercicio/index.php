<!DOCTYPE html>
<html lang="es"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario PHP</title>
</head>
<body>
    <h1>Bienvenido</h1>
    <form action="" method="post"> 
        Nombre: <input type="text" name="nombre"> 
        <input type="submit" value="Enviar">
    </form>

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $nombre = ($_POST['nombre']); 
            echo "<p>¡Hola, <strong>$nombre</strong>! Bienvenido a mi página.</p>";
        }
    ?> 
</body>
</html>