<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Avanzada</title>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --info: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --border-radius: 10px;
            --box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .calculadora {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 30px;
            width: 100%;
            max-width: 500px;
            transition: transform 0.3s ease;
        }

        .calculadora:hover {
            transform: translateY(-5px);
        }

        h2 {
            color: var(--secondary);
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 600;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        label {
            font-weight: 500;
            color: var(--dark);
            font-size: 16px;
        }

        input[type="number"] {
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type="number"]:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 10px;
        }

        button[type="submit"] {
            padding: 12px;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            color: white;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .suma {
            background-color: var(--success);
        }

        .resta {
            background-color: var(--info);
        }

        .multi {
            background-color: var(--warning);
        }

        .dividir {
            background-color: var(--primary);
        }

        .limpiar {
            background-color: var(--danger);
            grid-column: span 3;
        }

        .resultado {
            margin-top: 25px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: var(--border-radius);
            text-align: center;
            font-size: 18px;
            font-weight: 500;
            color: var(--dark);
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-left: 5px solid var(--primary);
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 600px) {
            .buttons {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .limpiar {
                grid-column: span 2;
            }
            
            .calculadora {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="calculadora">
        <h2>Calculadora Básica</h2>
        
        <form method="post">
            <div class="input-group">
                <label for="numero1">Número 1:</label>
                <input type="number" name="numero1" id="numero1" step="any" required>
            </div>
            
            <div class="input-group">
                <label for="numero2">Número 2:</label>
                <input type="number" name="numero2" id="numero2" step="any" required>
            </div>
            
            <div class="buttons">
                <button type="submit" name="operacion" value="sumar" class="suma">Sumar</button>
                <button type="submit" name="operacion" value="restar" class="resta">Restar</button>
                <button type="submit" name="operacion" value="multiplicar" class="multi">Multiplicar</button>
                <button type="submit" name="operacion" value="dividir" class="dividir">Dividir</button>
                <button type="submit" name="operacion" value="limpiar" class="limpiar">Limpiar</button>
            </div>
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