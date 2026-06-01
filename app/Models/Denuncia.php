<?php
require_once __DIR__ . '/../Config/database.php';

class Denuncia {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function obtenerTipos() {
        $query = "SELECT * FROM tipos_incidente ORDER BY id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function crear($id_usuario, $id_local, $id_tipo_incidente, $descripcion) {
        $query = "INSERT INTO denuncias (id_usuario, id_local, id_tipo_incidente, descripcion_privada, estado)
                  VALUES (:id_usuario, :id_local, :id_tipo, :descripcion, 'pendiente')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':id_local', $id_local);
        $stmt->bindParam(':id_tipo', $id_tipo_incidente);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }
public function obtenerTodasConDetalles() {
    $query = "SELECT d.*, 
                     l.nombre AS nombre_local, l.municipio,
                     t.nombre AS tipo_incidente,
                     u.nickname AS nickname_usuario
              FROM denuncias d
              JOIN locales l ON d.id_local = l.id
              JOIN tipos_incidente t ON d.id_tipo_incidente = t.id
              LEFT JOIN usuarios u ON d.id_usuario = u.id
              ORDER BY FIELD(d.estado, 'pendiente', 'validado', 'rechazado'), d.fecha_hora DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

public function cambiarEstado($id, $estado) {
    $query = "UPDATE denuncias SET estado = :estado WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

public function obtenerValidadasPorLocal($id_local) {
    $query = "SELECT d.fecha_hora, t.nombre AS tipo_incidente
              FROM denuncias d
              JOIN tipos_incidente t ON d.id_tipo_incidente = t.id
              WHERE d.id_local = :id_local AND d.estado = 'validado'
              ORDER BY d.fecha_hora DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id_local', $id_local);
    $stmt->execute();
    return $stmt->fetchAll();
}
}
?>