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
        echo "<h1>¡Bienvenido a Gaubizi!</h1>";
        // Si hay un nickname en la sesión, el usuario está logueado
        if(isset($_SESSION['nickname'])) {
            echo "<p>Kaixo, <strong>" . htmlspecialchars($_SESSION['nickname']) . "</strong>! Ya estás dentro del sistema.</p>";
            echo "<p><a href='index.php?url=locales'>Ir al Directorio de Locales</a> | <a href='index.php?url=logout'>Cerrar sesión</a></p>";
        } else {
            // Si no está logueado, mostramos opciones de entrada
            echo "<p>La comunidad para un ocio seguro. <a href='index.php?url=login'>Iniciar Sesión</a> | <a href='index.php?url=registro'>Registrarse</a></p>";
        }
        break;

    default:
        // Si el usuario escribe una URL que no existe
        echo "<h1>Error 404</h1>";
        echo "<p>La página que buscas no se encuentra en Euskal Herria ni en ningún otro sitio.</p>";
        echo "<a href='index.php?url=home'>Volver al inicio</a>";
        break;
}
?>