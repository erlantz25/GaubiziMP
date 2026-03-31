<?php
require_once '../app/Models/Local.php';

class LocalController {
    
    public function index() {
        // 1. Instanciamos el modelo
        $modeloLocal = new Local();
        
        // 2. Le pedimos todos los locales de la base de datos
        $listaLocales = $modeloLocal->obtenerTodos();
        
        // 3. Cargamos la vista y le pasamos los datos
        // Al hacer require_once aquí, la vista tiene acceso a la variable $listaLocales
        require_once '../app/Views/locales/index.php';
    }
}
?>