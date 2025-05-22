<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="cont">
        <form action="" method="POST">
        Numero:<input type="text" name="numero"><br>
        <input type="submit" value="Enviar">
        </form>
    </div>
<?php
if (isset($_POST["numero"])){
    $numero=($_POST['numero']);
        if($numero >= 1){
            echo $numero . " Es un numero positivo";
        }elseif($numero < 0){
            echo $numero . " Es un numero negativo";
        }else{
            echo " El numero es cero";
        }   
    }
?>
</body>
</html>