<?php
require_once '../app/Models/Usuario.php';

class AuthController {

    // Muestra el formulario
    public function mostrarRegistro() {
        require_once '../app/Views/auth/registrar.php';
    }

    // Procesa el envío del formulario
    public function procesarRegistro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuarioModel = new Usuario();
            if ($usuarioModel->registrar($nickname, $email, $password)) {
                // Si sale bien, lo mandamos al login (que crearemos luego)
                header("Location: index.php?url=home&registro=success");
            } else {
                echo "Error: El usuario o email ya existen.";
            }
        }
    }
}