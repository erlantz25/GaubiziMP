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
}
?>