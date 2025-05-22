<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="calculadora.css">
</head>
<body>
    <div class="calculadora">
        <h2>Calculadora Básica</h2>
        
        <form method="post">
            <label for="numero1">Número 1:</label>
            <input type="number" name="numero1" id="numero1" step="any" required>
            <br>
            
            <label for="numero2">Número 2:</label>
            <input type="number" name="numero2" id="numero2" step="any" required>
            <br><br>
            
            <button type="submit" name="operacion" value="sumar" class="suma">Sumar</button>
            <button type="submit" name="operacion" value="restar" class="resta">Restar</button>
            <button type="submit" name="operacion" value="multiplicar" class="multi">Multiplicar</button>
            <button type="submit" name="operacion" value="dividir" class="dividir">Dividir</button>
            <button type="submit" name="operacion" value="limpiar" class="limpiar">Limpiar</button>
        </form>
        
        <div class="resultado">
            <?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $numero1 = $_POST["numero1"];
                $numero2 = $_POST["numero2"];
                $operacion = $_POST["operacion"];
                
                if ($operacion != "limpiar") {
                    switch ($operacion) {
                        case "sumar":
                            $resultado = $numero1 + $numero2;
                            break;
                        case "restar":
                            $resultado = $numero1 - $numero2;
                            break;
                        case "multiplicar":
                            $resultado = $numero1 * $numero2;
                            break;
                        case "dividir":
                            if ($numero2 != 0) {
                                $resultado = $numero1 / $numero2;
                            } else {
                                $resultado = "Error: División por cero";
                            }
                            break;
                        default:
                            $resultado = "Operación no válida";
                    }
                    
                    echo "El resultado es: " . $resultado;
                }
            }
            ?>
        </div>
    </div>
    
</body>
</html>