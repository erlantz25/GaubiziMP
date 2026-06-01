<?php
require_once __DIR__ . '/../Models/Local.php';

class MapaController {

    public function index() {
        $modeloLocal = new Local();
        $locales = $modeloLocal->obtenerTodos();
        require_once '../app/Views/mapa/index.php';
    }
}
?>