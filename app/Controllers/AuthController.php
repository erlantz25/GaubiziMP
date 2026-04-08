<?php
require_once '../app/Models/Usuario.php';

class AuthController {

    // ==========================================
    // MÉTODOS DE REGISTRO
    // ==========================================
    public function mostrarRegistro() {
        require_once '../app/Views/auth/registrar.php';
    }

    public function procesarRegistro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuarioModel = new Usuario();
            if ($usuarioModel->registrar($nickname, $email, $password)) {
                // Redirigir al login con un mensaje de éxito
                header("Location: index.php?url=login&msg=registro_ok");
            } else {
                echo "Error: El usuario o email ya existen. <a href='index.php?url=registro'>Volver</a>";
            }
        }
    }

    // ==========================================
    // MÉTODOS DE LOGIN
    // ==========================================
    public function mostrarLogin() {
        require_once '../app/Views/auth/login.php';
    }

    public function procesarLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $usuarioModel = new Usuario();
            $datosUsuario = $usuarioModel->login($email, $password);

            if ($datosUsuario) {
                // Éxito: Guardamos los datos en la sesión
                $_SESSION['usuario_id'] = $datosUsuario['id'];
                $_SESSION['nickname'] = $datosUsuario['nickname'];
                $_SESSION['rol'] = $datosUsuario['rol'];

                // Lo mandamos al inicio (donde ahora verá su nombre) o a locales
                header("Location: index.php?url=home");
            } else {
                echo "Error: Credenciales incorrectas. <a href='index.php?url=login'>Inténtalo de nuevo</a>";
            }
        }
    }
}
?>