<?php
require_once __DIR__ . '/../Config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function registrar($nickname, $email, $password) {
        try {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO usuarios (nickname, email, password, rol, nivel_confianza) 
                      VALUES (:nickname, :email, :password, 'user', 10)";
            
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(':nickname', $nickname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);

            if($stmt->execute()) {
                return true;
            }
            return false;

        } catch(PDOException $e) {
            return false;
        }
    }

public function obtenerPorId($id) {
    $query = "SELECT id, nickname, email, rol, nivel_confianza, fecha_registro 
              FROM usuarios WHERE id = :id LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

    public function login($email, $password) {
        $query = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            unset($usuario['password']);
            return $usuario;
        }

        return false;
    }
}
?>