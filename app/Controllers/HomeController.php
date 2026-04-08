<?php
class HomeController {
    public function index() {
        // Aquí podríamos cargar datos del modelo más adelante (estadísticas, etc.)
        // Por ahora, solo cargamos la vista premium
        require_once '../app/Views/home/index.php';
    }
}
?>