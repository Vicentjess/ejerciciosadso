<?php


class Database
{
    private string $host = 'localhost';  // Quitamos el puerto 3306 (es el default)
    private string $db = 'crudsena';
    private string $user = 'root';
    private string $pass = '';  // Contraseña vacía (default en XAMPP)
    private string $charset = 'utf8mb4';
    private PDO $pdo;
    private string $error;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            // Mensaje de error más descriptivo
            $this->error = "ERROR DE CONEXIÓN: " . $e->getMessage() . 
                          " - Revise: Usuario: '{$this->user}', Contraseña: '{$this->pass}', BD: '{$this->db}'";
            throw new RuntimeException($this->error);
        }
    }

    public function getConnection(): PDO
    {
        if (!isset($this->pdo)) {
            throw new RuntimeException("No hay conexión a la base de datos");
        }
        return $this->pdo;
    }

    private static $instance = null;

    public static function getInstance(): self {
    if (self::$instance === null) {
        self::$instance = new self();
    }
    return self::$instance;
    }
    
}