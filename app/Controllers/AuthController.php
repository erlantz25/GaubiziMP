<?php
require_once __DIR__ . '/../Models/Usuario.php';

class AuthController {

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
                header("Location: index.php?url=login&msg=registro_ok");
                exit();
            } else {
                header("Location: index.php?url=registro&error=ya_existe");
                exit();
            }
        }
    }

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
                $_SESSION['usuario_id'] = $datosUsuario['id'];
                $_SESSION['nickname'] = $datosUsuario['nickname'];
                $_SESSION['rol'] = $datosUsuario['rol'];
                header("Location: index.php?url=home");
                exit();
            } else {
                header("Location: index.php?url=login&error=credenciales");
                exit();
            }
        }
    }
}
?>
