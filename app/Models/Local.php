<?php
require_once __DIR__ . '/../Config/database.php';

class Local {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function obtenerTodos() {
    $query = "SELECT l.*, 
                     COUNT(CASE WHEN d.estado = 'validado' THEN 1 END) as total_denuncias
              FROM locales l
              LEFT JOIN denuncias d ON l.id = d.id_local
              GROUP BY l.id
              ORDER BY l.provincia, l.nombre";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

    public function obtenerPorId($id) {
        $query = "SELECT * FROM locales WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
}
?>