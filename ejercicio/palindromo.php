<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palindromo</title>
    <link rel="stylesheet" href="palindromo.css">
</head>
<body>
     <div class="contenedor">
        <h2>Verificador de Palíndromos</h2>
        
        <form method="post" action="">
            <p>Introduce una palabra</p>
            <input type="text" name="texto" placeholder="Escribe aquí">
            <input type="submit" name="verificar" value="Verificar">
        </form>
        
        <?php
        if (isset($_POST['verificar'])) {
            $texto = $_POST['texto'];
            
            if (!empty($texto)) {
               
                $texto_limpio = strtolower(str_replace(' ', '', $texto));
                $reverso = '';
                
              
                for ($i = strlen($texto_limpio) - 1; $i >= 0; $i--) {
                    $reverso .= $texto_limpio[$i];
                }
                
               
                if ($texto_limpio == $reverso) {
                    echo "<p class='resultado'>\"$texto\" es un palíndromo.</p>";
                } else {
                    echo "<p class='resultado'>\"$texto\" NO es un palíndromo.</p>";
                }
            } else {
                echo "<p class='resultado'>Por favor, introduce una palabra o frase.</p>";
            }
        }
        ?>
    </div>
</body>
</html>