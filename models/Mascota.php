<?php
require_once __DIR__ . '/../config/Database.php';

class Mascota
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $stmt = $this->pdo->query("
            SELECT mascotas.*, razas.nombre AS raza_nombre 
            FROM mascotas 
            LEFT JOIN razas ON mascotas.raza_id = razas.id
        ");
        return $stmt->fetchAll();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM mascotas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }



    /**
     * @param $nombre
     * @param $edad
     * @param $raza_id
     * @return bool
     */
    public function create($nombre, $edad, $raza_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO mascotas (nombre, edad, raza_id) VALUES (?, ?, ?)");
        return $stmt->execute([$nombre, $edad, $raza_id]);
    }

    /**
     * @param $id
     * @param $nombre
     * @param $edad
     * @param $raza_id
     * @return bool
     */
    public function update($id, $nombre, $edad, $raza_id)
    {
        $stmt = $this->pdo->prepare("UPDATE mascotas SET nombre = ?, edad = ?, raza_id = ? WHERE id = ?");
        return $stmt->execute([$nombre, $edad, $raza_id, $id]);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM mascotas WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>
