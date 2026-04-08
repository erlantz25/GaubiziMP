<?php
require_once '../app/Config/database.php';

class Local {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function obtenerTodos() {
        $query = "SELECT * FROM locales ORDER BY provincia, nombre";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    // Método para obtener un solo local por su ID
    public function obtenerPorId($id) {
        $query = "SELECT * FROM locales WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch();
    }
}
?>