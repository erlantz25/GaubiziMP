<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Gaubizi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<header>
    <h1>Iniciar Sesión</h1>
    <p>Ongi etorri! Bienvenido de nuevo a Gaubizi.</p>
</header>

<main style="max-width: 400px; margin: 0 auto;">
    
    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'registro_ok'): ?>
        <div style="background-color: #D1FAE5; color: #065F46; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-weight:600;">
            ¡Registro completado! Ahora puedes iniciar sesión.
        </div>
    <?php endif; ?>

    <div class="card" style="border-left-color: #8B5CF6;"> 
        <form action="index.php?url=procesar-login" method="POST">
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600;">Email</label>
                <input type="email" name="email" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd; font-family:inherit;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:5px; font-weight:600;">Contraseña</label>
                <input type="password" name="password" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd; font-family:inherit;">
            </div>

            <button type="submit" style="background-color: #059669; color:white; border:none; padding:12px; width:100%; border-radius:8px; cursor:pointer; font-weight:bold; font-size:1rem;">
                Entrar
            </button>
        </form>
    </div>
    <p style="text-align:center;"><a href="index.php?url=registro">¿No tienes cuenta? Regístrate</a></p>
</main>

</body>
</html>