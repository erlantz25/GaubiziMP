<?php
require_once __DIR__ . '/../Config/database.php';

class Favorito {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function obtenerPorUsuario($id_usuario) {
        $query = "SELECT l.*, f.fecha_guardado 
                  FROM favoritos f
                  JOIN locales l ON f.id_local = l.id
                  WHERE f.id_usuario = :id_usuario
                  ORDER BY f.fecha_guardado DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function esFavorito($id_usuario, $id_local) {
        $query = "SELECT COUNT(*) FROM favoritos 
                  WHERE id_usuario = :id_usuario AND id_local = :id_local";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_local', $id_local);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function agregar($id_usuario, $id_local) {
        if ($this->esFavorito($id_usuario, $id_local)) return true;
        $query = "INSERT INTO favoritos (id_usuario, id_local) VALUES (:id_usuario, :id_local)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_local', $id_local);
        return $stmt->execute();
    }

    public function quitar($id_usuario, $id_local) {
        $query = "DELETE FROM favoritos WHERE id_usuario = :id_usuario AND id_local = :id_local";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_local', $id_local);
        return $stmt->execute();
    }
}
?>