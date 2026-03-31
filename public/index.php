<?php
// ==========================================
// FRONT CONTROLLER - GAUBIZI
// ==========================================

// Mostrar errores (Recuerda quitar esto cuando el TFG esté terminado)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Capturar la ruta solicitada; si no hay ninguna, cargamos 'home' por defecto
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// Enrutador básico
switch ($url) {
    case 'locales':
        // 1. Cargamos el controlador de locales
        require_once '../app/Controllers/LocalController.php';
        
        // 2. Lo instanciamos
        $controlador = new LocalController();
        
        // 3. Ejecutamos su método principal
        $controlador->index(); 
        break;

    case 'home':
        echo "<h1>¡Bienvenido a Gaubizi!</h1>";
        echo "<p>Página de inicio en construcción. Haz clic aquí para <a href='index.php?url=locales'>Ver el Directorio de Locales</a> y probar el MVC.</p>";
        break;

    case 'registro':
        require_once '../app/Controllers/AuthController.php';
        $auth = new AuthController();
        $auth->mostrarRegistro();
        break;

    case 'procesar-registro':
        require_once '../app/Controllers/AuthController.php';
        $auth = new AuthController();
        $auth->procesarRegistro();
        break;

    default:
        // Si el usuario escribe una URL que no existe
        echo "<h1>Error 404</h1>";
        echo "<p>La página que buscas no se encuentra en Euskal Herria ni en ningún otro sitio.</p>";
        echo "<a href='index.php?url=home'>Volver al inicio</a>";
        break;
}
?>