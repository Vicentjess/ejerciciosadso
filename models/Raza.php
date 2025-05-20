<?php
require_once __DIR__ . '/../config/Database.php';

class Raza {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM razas");
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return array
     */
    public function getById($id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM razas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
