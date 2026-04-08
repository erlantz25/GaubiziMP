<?php
require_once '../app/Models/Local.php';

class LocalController {
    
    // Método para mostrar la lista de locales
    public function index() {
        // 1. Instanciamos el modelo
        $modeloLocal = new Local();
        
        // 2. Extraemos todos los locales de la base de datos
        $locales = $modeloLocal->obtenerTodos();
        
        // 3. Cargamos la vista. Como hemos definido $locales justo arriba, 
        // la vista ya podrá usar esa variable sin dar error.
        require_once '../app/Views/locales/index.php';
    }

    // Método para ver un local específico (el que hicimos el otro día)
    public function ver() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $modeloLocal = new Local();
            $local = $modeloLocal->obtenerPorId($id);

            if ($local) {
                require_once '../app/Views/locales/detalle.php';
            } else {
                echo "Local no encontrado.";
            }
        }
    }
}
?>