<?php 
$titulo = "Inicio - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container hero">
    <h1>Tu red de seguridad en el<br><span>Ocio Nocturno</span></h1>
    <p>Gaubizi conecta locales comprometidos, usuarios y protocolos de seguridad en tiempo real para garantizar espacios libres de acoso en Euskal Herria.</p>
    
    <div style="margin-top: 30px;">
        <a href="index.php?url=locales" class="btn-primary">Explorar Locales Seguros</a>
        <?php if(!isset($_SESSION['nickname'])): ?>
            <a href="index.php?url=registro" class="filter-btn" style="margin-left: 15px; padding: 12px 24px;">Crear cuenta</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>