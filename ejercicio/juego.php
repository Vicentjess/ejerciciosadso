<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivina el Número</title>
    <style>
       /* body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .cont { margin: 20px auto; padding: 20px; max-width: 300px; border: 1px solid #ccc; border-radius: 5px; }
        input[type="text"] { padding: 8px; margin: 5px; }
        input[type="submit"] { padding: 8px 15px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .message { margin-top: 15px; padding: 10px; border-radius: 4px; }
        .success { background: #dff0d8; color: #3c763d; }
        .error { background: #f2dede; color: #a94442; }*/
    </style>
</head>
<body>
<div class="cont">
    <h2>Adivina el número (1-10)</h2>
    <form action="" method="POST">
        Tu número: <input type="number" name="numero" min="1" max="10" required><br>
        <input type="submit" value="Intentar">
    </form>
    
    <?php
    session_start();
    
    if (!isset($_SESSION['target'])) {
        $_SESSION['target'] = rand(1, 10);
    }

    if (isset($_POST["numero"])) {
        $intento = (int)$_POST['numero'];
        $target = $_SESSION['target'];
        
        if ($intento == $target) {
            echo '<div class="message success">¡Correcto! Era el '.$target.'. Juego reiniciado.</div>';
            
            $_SESSION['target'] = rand(1, 10);
        } elseif ($intento < $target) {
            echo '<div class="message error">Más alto. Intenta otra vez.</div>';
        } else {
            echo '<div class="message error">Más bajo. Intenta otra vez.</div>';
        }
    }
    ?>
</div>
</body>
</html>