<?php
require_once '../app/Config/database.php';

class Usuario {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Método para registrar un nuevo usuario
    public function registrar($nickname, $email, $password) {
        try {
            // 1. Encriptamos la contraseña con Bcrypt (Cumpliendo RNF-03)
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // 2. Preparamos la consulta SQL (evitando inyecciones)
            $query = "INSERT INTO usuarios (nickname, email, password, rol, nivel_confianza) 
                      VALUES (:nickname, :email, :password, 'user', 10)";
            
            $stmt = $this->conn->prepare($query);

            // 3. Vinculamos los parámetros
            $stmt->bindParam(':nickname', $nickname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);

            // 4. Ejecutamos y devolvemos true si ha ido bien
            if($stmt->execute()) {
                return true;
            }
            return false;

        } catch(PDOException $e) {
            // Si el nickname o email ya existen, saltará un error por el UNIQUE de la BD
            return false;
        }
    }
}
?>