<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Tablas de Multiplicar</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: var(--dark-color);
        }
        
        h1 {
            color: var(--secondary-color);
            margin-bottom: 2rem;
            text-align: center;
            font-size: 2.5rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }
        
        .container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 600px;
            margin-bottom: 2rem;
        }
        
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .input-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }
        
        label {
            font-weight: 600;
            color: var(--secondary-color);
            min-width: 80px;
        }
        
        input[type="text"] {
            flex: 1;
            padding: 0.8rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            min-width: 200px;
        }
        
        input[type="text"]:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        input[type="submit"] {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            align-self: flex-end;
        }
        
        input[type="submit"]:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .result-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 600px;
            margin-top: 1rem;
            animation: fadeIn 0.5s ease-out;
        }
        
        .result-title {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.8rem;
        }
        
        .multiplication-table {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.8rem;
        }
        
        .multiplication-item {
            background-color: var(--light-color);
            padding: 0.8rem;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .multiplication-item:nth-child(odd) {
            background-color: #e9ecef;
        }
        
        .multiplication-item:hover {
            background-color: var(--accent-color);
            color: white;
            transform: scale(1.03);
        }
        
        @media (max-width: 600px) {
            .multiplication-table {
                grid-template-columns: 1fr;
            }
            
            h1 {
                font-size: 1.8rem;
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, hagamos las tablas de multiplicar</h1>
        <form action="" method="POST">
            <div class="input-group">
                <label for="numero">Número:</label>
                <input type="text" name="numero" id="numero" placeholder="Ingresa un número">
            </div>
            <input type="submit" value="Generar Tabla">
        </form>
    </div>
    
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div class="result-container">
            <h2 class="result-title">Tabla del <?php echo htmlspecialchars($_POST['numero']); ?></h2>
            <div class="multiplication-table">
                <?php
                    $numero = intval($_POST['numero']);
                    for($m = 0; $m <= 10; $m++) {
                        echo '<div class="multiplication-item">';
                        echo "$numero x $m = ".($numero * $m);
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>