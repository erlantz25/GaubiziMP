<?php
require_once __DIR__ . '/../Models/Favorito.php';
require_once __DIR__ . '/../Models/Usuario.php';

class PerfilController {

    private function verificarLogin() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?url=login");
            exit();
        }
    }

    public function index() {
        $this->verificarLogin();

        $id_usuario = $_SESSION['usuario_id'];

        $modeloUsuario = new Usuario();
        $usuario = $modeloUsuario->obtenerPorId($id_usuario);

        $modeloFavorito = new Favorito();
        $favoritos = $modeloFavorito->obtenerPorUsuario($id_usuario);

        require_once '../app/Views/perfil/index.php';
    }

    public function guardarFavorito() {
        $esAjax = isset($_POST['ajax']) && $_POST['ajax'] === '1';
        $this->verificarLogin();

        if (isset($_POST['id_local'])) {
            $modeloFavorito = new Favorito();
            $modeloFavorito->agregar($_SESSION['usuario_id'], $_POST['id_local']);
        }

        $id_local = $_POST['id_local'] ?? '';
        if ($esAjax) {
    header('Content-Type: application/json');
    echo json_encode(['ok' => true]);
    exit();
}
        header("Location: index.php?url=local&id=" . $id_local . "&msg=favorito_ok");
        exit();
    }

    public function quitarFavorito() {
        $esAjax = isset($_POST['ajax']) && $_POST['ajax'] === '1';
        $this->verificarLogin();

        if (isset($_POST['id_local'])) {
            $modeloFavorito = new Favorito();
            $modeloFavorito->quitar($_SESSION['usuario_id'], $_POST['id_local']);
        }

        $origen = $_POST['origen'] ?? 'perfil';
        if ($origen == 'perfil') {
            if ($esAjax) {
    header('Content-Type: application/json');
    echo json_encode(['ok' => true]);
    exit();
}
            header("Location: index.php?url=perfil&msg=favorito_quitado");
        } else {
            if ($esAjax) {
    header('Content-Type: application/json');
    echo json_encode(['ok' => true]);
    exit();
}
            header("Location: index.php?url=local&id=" . $_POST['id_local'] . "&msg=favorito_quitado");
        }
        exit();
    }
}
?>