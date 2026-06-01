<?php
session_start();

$url = isset($_GET['url']) ? $_GET['url'] : 'home';

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

    case 'reportar':
    require_once '../app/Controllers/DenunciaController.php';
    $denuncia = new DenunciaController();
    $denuncia->mostrarFormulario();
    break;

case 'enviar-reporte':
    require_once '../app/Controllers/DenunciaController.php';
    $denuncia = new DenunciaController();
    $denuncia->procesar();
    break;

    case 'admin':
    require_once '../app/Controllers/AdminController.php';
    $admin = new AdminController();
    $admin->panel();
    break;

case 'cambiar-estado':
    require_once '../app/Controllers/AdminController.php';
    $admin = new AdminController();
    $admin->cambiarEstado();
    break;

    case 'mapa':
    require_once '../app/Controllers/MapaController.php';
    $mapa = new MapaController();
    $mapa->index();
    break;
    case 'perfil':
    require_once '../app/Controllers/PerfilController.php';
    $perfil = new PerfilController();
    $perfil->index();
    break;

case 'guardar-favorito':
    require_once '../app/Controllers/PerfilController.php';
    $perfil = new PerfilController();
    $perfil->guardarFavorito();
    break;

case 'quitar-favorito':
    require_once '../app/Controllers/PerfilController.php';
    $perfil = new PerfilController();
    $perfil->quitarFavorito();
    break;
    case 'bot':
    require_once '../app/Controllers/BotController.php';
    $bot = new BotController();
    $bot->index();
    break;

case 'bot-responder':
    require_once '../app/Controllers/BotController.php';
    $bot = new BotController();
    $bot->responder();
    break;
    case 'guardar-resena':
    require_once '../app/Controllers/LocalController.php';
    $controlador = new LocalController();
    $controlador->guardarResena();
    break;
    case 'cambiar-visibilidad-resena':
    require_once '../app/Controllers/AdminController.php';
    $admin = new AdminController();
    $admin->cambiarVisibilidadResena();
    break;
    default:
        header("Location: index.php?url=home");
        break;
}
?>