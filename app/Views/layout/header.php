<?php 
// Averiguamos en qué página estamos para pintar el botón del menú de color morado
$rutaActual = isset($_GET['url']) ? $_GET['url'] : 'home'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($titulo) ? $titulo : 'Gaubizi'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<nav class="navbar">
    <a href="index.php?url=home" class="logo">Gau<span>bizi</span></a>
    <div class="nav-links">
        <a href="index.php?url=home" class="<?php echo ($rutaActual == 'home') ? 'active' : ''; ?>">Inicio</a>
        <a href="index.php?url=locales" class="<?php echo ($rutaActual == 'locales' || $rutaActual == 'local') ? 'active' : ''; ?>">Locales</a>
        <a href="index.php?url=mapa" class="<?php echo ($rutaActual == 'mapa') ? 'active' : ''; ?>">Mapa</a>
        <a href="index.php?url=bot" class="<?php echo ($rutaActual == 'bot') ? 'active' : ''; ?>">GauAuxiliar</a>
        
        <?php if(isset($_SESSION['nickname'])): ?>
            <a href="index.php?url=perfil" style="color: #A855F7;">Mi Perfil (<?php echo htmlspecialchars($_SESSION['nickname']); ?>)</a>
            <a href="index.php?url=logout" style="color: #EF4444;">Salir</a>
        <?php else: ?>
            <a href="index.php?url=login">Iniciar Sesión</a>
            <a href="index.php?url=registro" class="btn-primary" style="padding: 8px 20px; margin-left: 10px;">Registrarse</a>
        <?php endif; ?>
    </div>
</nav>