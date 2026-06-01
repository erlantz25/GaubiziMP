<?php
require_once __DIR__ . '/../Models/Denuncia.php';
require_once __DIR__ . '/../Models/Local.php';

class DenunciaController {

    public function mostrarFormulario() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?url=login");
            exit();
        }

        if (!isset($_GET['id_local'])) {
            header("Location: index.php?url=locales");
            exit();
        }

        $id_local = $_GET['id_local'];

        $modeloLocal = new Local();
        $local = $modeloLocal->obtenerPorId($id_local);

        if (!$local) {
            header("Location: index.php?url=locales");
            exit();
        }

        $modeloDenuncia = new Denuncia();
        $tipos = $modeloDenuncia->obtenerTipos();

        require_once '../app/Views/denuncias/crear.php';
    }

    public function procesar() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?url=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario    = $_SESSION['usuario_id'];
            $id_local      = $_POST['id_local'];
            $id_tipo       = $_POST['id_tipo_incidente'];
            $descripcion   = trim($_POST['descripcion_privada']);

            if (empty($descripcion) || empty($id_tipo)) {
                header("Location: index.php?url=reportar&id_local=" . $id_local . "&error=campos");
                exit();
            }

            $modeloDenuncia = new Denuncia();
            if ($modeloDenuncia->crear($id_usuario, $id_local, $id_tipo, $descripcion)) {
                header("Location: index.php?url=local&id=" . $id_local . "&msg=reporte_ok");
                exit();
            } else {
                header("Location: index.php?url=reportar&id_local=" . $id_local . "&error=db");
                exit();
            }
        }
    }
}
?>