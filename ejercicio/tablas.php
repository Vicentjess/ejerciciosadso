<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>  
</head>
<body>
<h1>Bienvenido hagamos las tablas de Multiplicar</h1>
    <form action="" method="POST"> 
        Numero: <input type="text" name="numero"> 
        <input type="submit" value="Enviar">
    </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $numero = ($_POST['numero']); 
            
            echo "Tabla del $numero <br>";
            for($m=0; $m<=10; $m++) 
            echo "$numero x $m = ".$numero*$m."<br>"; 
 
        }
    ?>  
</body>
</html> 


