<?php 
$titulo = "Crear Cuenta - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container auth-wrapper">
    <div class="auth-card">
        <h2 style="font-size: 2rem; color: #F8FAFC; margin-bottom: 10px; text-align: center;">Únete a Gaubizi</h2>
        <p style="color: #94A3B8; text-align: center; margin-bottom: 30px;">Crea tu cuenta para apoyar un ocio nocturno más seguro.</p>

        <form action="index.php?url=procesar-registro" method="POST">
            <div class="input-group">
                <label>Nickname / Alias</label>
                <input type="text" name="nickname" class="input-neon" required placeholder="Cómo te llamarán en la app">
            </div>
            
            <div class="input-group">
                <label>Correo Electrónico</label>
                <input type="email" name="email" class="input-neon" required placeholder="tu@email.com">
            </div>
            
            <div class="input-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="input-neon" required placeholder="Crea una contraseña segura">
            </div>
            
            <button type="submit" class="btn-primary btn-block" style="margin-top: 10px;">
                Crear Cuenta
            </button>
        </form>
        
        <p style="text-align: center; margin-top: 25px; color: #94A3B8; font-size: 0.9rem;">
            ¿Ya tienes cuenta? <a href="index.php?url=login" style="color: #A855F7; text-decoration: none; font-weight: 600;">Inicia sesión</a>
        </p>
    </div>
</div>

</body>
</html>