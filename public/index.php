<?php
// ==========================================
// FRONT CONTROLLER - GAUBIZI
// ==========================================

// 1. ARRANCAR EL MOTOR DE SESIONES (¡Debe ser lo primero!)
session_start();

// Mostrar errores (Recuerda quitar esto cuando el TFG esté terminado)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Capturar la ruta solicitada; si no hay ninguna, cargamos 'home' por defecto
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

// Enrutador básico
switch ($url) {
    case 'locales':
        require_once '../app/Controllers/LocalController.php';
        $controlador = new LocalController();
        $controlador->index(); 
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

    case 'login':
        require_once '../app/Controllers/AuthController.php';
        $auth = new AuthController();
        $auth->mostrarLogin();
        break;

    case 'procesar-login':
        require_once '../app/Controllers/AuthController.php';
        $auth = new AuthController();
        $auth->procesarLogin();
        break;

    case 'logout':
        // Destruimos la sesión y mandamos al inicio
        session_destroy();
        header("Location: index.php?url=home");
        break;

    case 'home':
        require_once '../app/Controllers/HomeController.php';
        $home = new HomeController();
        $home->index();
        break;

    
    
    case 'local':
        require_once '../app/Controllers/LocalController.php';
        $controlador = new LocalController();
        $controlador->ver();
        break;

    default:
        // Por ahora, si escriben una ruta falsa, los mandamos al inicio
        header("Location: index.php?url=home");
        break;
}
?>