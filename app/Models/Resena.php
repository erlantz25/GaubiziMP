<?php
require_once __DIR__ . '/../Config/database.php';

class Resena {
    private $conn;
    private $palabrasOfensivas = ['idiota','imbecil','mierda','puta','puto','gilipollas','capullo','bastardo','subnormal','inutil'];

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    private function pasaFiltro($texto) {
        $t = strtolower($texto);
        foreach ($this->palabrasOfensivas as $p) {
            if (strpos($t, $p) !== false) return false;
        }
        return true;
    }

    public function yaReseno($id_usuario, $id_local) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM resenas WHERE id_usuario = :u AND id_local = :l");
        $stmt->bindParam(':u', $id_usuario);
        $stmt->bindParam(':l', $id_local);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function crear($id_usuario, $id_local, $estrellas, $comentario) {
        if ($this->yaReseno($id_usuario, $id_local)) return 'duplicada';
        $visible = $this->pasaFiltro($comentario) ? 1 : 0;
        $query = "INSERT INTO resenas (id_usuario, id_local, estrellas, comentario_publico, visible)
                  VALUES (:u, :l, :e, :c, :v)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':u', $id_usuario);
        $stmt->bindParam(':l', $id_local);
        $stmt->bindParam(':e', $estrellas);
        $stmt->bindParam(':c', $comentario);
        $stmt->bindParam(':v', $visible);
        $stmt->execute();
        return $visible ? 'ok' : 'pendiente';
    }

    public function obtenerPorLocal($id_local) {
        $query = "SELECT r.*, u.nickname FROM resenas r
                  JOIN usuarios u ON r.id_usuario = u.id
                  WHERE r.id_local = :l AND r.visible = 1
                  ORDER BY r.fecha DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':l', $id_local);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function obtenerMedia($id_local) {
        $stmt = $this->conn->prepare("SELECT ROUND(AVG(estrellas),1) as media, COUNT(*) as total FROM resenas WHERE id_local = :l AND visible = 1");
        $stmt->bindParam(':l', $id_local);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function obtenerTodasAdmin() {
        $query = "SELECT r.*, u.nickname, l.nombre as nombre_local
                  FROM resenas r
                  JOIN usuarios u ON r.id_usuario = u.id
                  JOIN locales l ON r.id_local = l.id
                  ORDER BY r.visible ASC, r.fecha DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function cambiarVisibilidad($id, $visible) {
        $stmt = $this->conn->prepare("UPDATE resenas SET visible = :v WHERE id = :id");
        $stmt->bindParam(':v', $visible);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>