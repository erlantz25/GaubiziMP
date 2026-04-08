<?php 
$titulo = "Iniciar Sesión - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container auth-wrapper">
    <div class="auth-card">
        <h2 style="font-size: 2rem; color: #F8FAFC; margin-bottom: 10px; text-align: center;">Acceso Seguro</h2>
        <p style="color: #94A3B8; text-align: center; margin-bottom: 30px;">Inicia sesión para entrar en la red Gaubizi</p>

        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'registro_ok'): ?>
            <div class="alert-success">¡Registro completado! Ya puedes iniciar sesión.</div>
        <?php endif; ?>

        <form action="index.php?url=procesar-login" method="POST">
            <div class="input-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" class="input-neon" required placeholder="tu@email.com">
            </div>
            
            <div class="input-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="input-neon" required placeholder="••••••••">
            </div>
            
            <button type="submit" class="btn-primary btn-block" style="margin-top: 10px;">
                Iniciar Sesión
            </button>
        </form>
        
        <p style="text-align: center; margin-top: 25px; color: #94A3B8; font-size: 0.9rem;">
            ¿No tienes cuenta? <a href="index.php?url=registro" style="color: #A855F7; text-decoration: none; font-weight: 600;">Regístrate aquí</a>
        </p>
    </div>
</div>

</body>
</html>