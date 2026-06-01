<?php
require_once __DIR__ . '/../Models/Denuncia.php';

class AdminController {

    private function verificarAcceso() {
        if (!isset($_SESSION['rol']) || 
            ($_SESSION['rol'] !== 'admin' && $_SESSION['rol'] !== 'mod')) {
            header("Location: index.php?url=home");
            exit();
        }
    }

    public function panel() {
        $this->verificarAcceso();

        $modeloDenuncia = new Denuncia();
        $denuncias = $modeloDenuncia->obtenerTodasConDetalles();
        require_once __DIR__ . '/../Models/Resena.php';
$modeloResena = new Resena();
$resenas = $modeloResena->obtenerTodasAdmin();

        require_once '../app/Views/admin/panel.php';
    }

    public function cambiarEstado() {
        $this->verificarAcceso();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_denuncia = $_POST['id_denuncia'];
            $nuevo_estado = $_POST['nuevo_estado'];

            if (!in_array($nuevo_estado, ['validado', 'rechazado', 'pendiente'])) {
                header("Location: index.php?url=admin");
                exit();
            }

            $modeloDenuncia = new Denuncia();
            $modeloDenuncia->cambiarEstado($id_denuncia, $nuevo_estado);
        }

        header("Location: index.php?url=admin&msg=ok");
        exit();
    }
    public function cambiarVisibilidadResena() {
    $this->verificarAcceso();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once __DIR__ . '/../Models/Resena.php';
        $id = $_POST['id_resena'];
        $visible = $_POST['visible'];
        if (!in_array($visible, ['0', '1'])) {
            header("Location: index.php?url=admin");
            exit();
        }
        $modelo = new Resena();
        $modelo->cambiarVisibilidad($id, $visible);
    }
    header("Location: index.php?url=admin&tab=resenas&msg=ok");
    exit();
}
}
?>