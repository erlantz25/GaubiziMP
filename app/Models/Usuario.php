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
            // 1. Encriptamos la contraseña
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // 2. Preparamos la consulta SQL
            $query = "INSERT INTO usuarios (nickname, email, password, rol, nivel_confianza) 
                      VALUES (:nickname, :email, :password, 'user', 10)";
            
            $stmt = $this->conn->prepare($query);

            // 3. Vinculamos parámetros
            $stmt->bindParam(':nickname', $nickname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $passwordHash);

            // 4. Ejecutamos
            if($stmt->execute()) {
                return true;
            }
            return false;

        } catch(PDOException $e) {
            return false;
        }
    }

    // Método para iniciar sesión
    public function login($email, $password) {
        // 1. Buscamos al usuario
        $query = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch();

        // 2. Verificamos la contraseña encriptada
        if ($usuario && password_verify($password, $usuario['password'])) {
            // Quitamos el password del array antes de mandarlo de vuelta por seguridad
            unset($usuario['password']);
            return $usuario;
        }

        return false;
    }
}
?>