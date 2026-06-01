<?php
require_once '../app/Models/Local.php';

class LocalController {
    
    public function index() {
        $modeloLocal = new Local();
        
        $locales = $modeloLocal->obtenerTodos();
        
        require_once '../app/Views/locales/index.php';
    }

    public function ver() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $modeloLocal = new Local();
        $local = $modeloLocal->obtenerPorId($id);

        if ($local) {
            require_once __DIR__ . '/../Models/Denuncia.php';
            require_once __DIR__ . '/../Models/Resena.php';
            $modeloDenuncia = new Denuncia();
            $modeloResena   = new Resena();
            $denunciasPublicas = $modeloDenuncia->obtenerValidadasPorLocal($id);
            $resenas           = $modeloResena->obtenerPorLocal($id);
            $mediaResenas      = $modeloResena->obtenerMedia($id);
            $yaReseno          = isset($_SESSION['usuario_id']) ? $modeloResena->yaReseno($_SESSION['usuario_id'], $id) : false;
            require_once '../app/Views/locales/detalle.php';
        } else {
            echo "Local no encontrado.";
        }
    }
}
public function guardarResena() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: index.php?url=login");
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_local    = intval($_POST['id_local']);
        $estrellas   = intval($_POST['estrellas']);
        $comentario  = trim($_POST['comentario']);

        if ($estrellas < 1 || $estrellas > 5 || empty($comentario)) {
            header("Location: index.php?url=local&id=$id_local&msg=resena_error");
            exit();
        }

        require_once '../app/Models/Resena.php';
        $modelo = new Resena();
        $resultado = $modelo->crear($_SESSION['usuario_id'], $id_local, $estrellas, $comentario);
        header("Location: index.php?url=local&id=$id_local&msg=resena_$resultado");
        exit();
    }
}
}
?>