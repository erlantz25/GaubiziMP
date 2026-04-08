<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($local['nombre']); ?> - Gaubizi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

<header>
    <p class="provincia" style="color: #8B5CF6; font-weight: bold; text-transform: uppercase;">
        <?php echo htmlspecialchars($local['provincia']); ?> - <?php echo htmlspecialchars($local['municipio']); ?>
    </p>
    <h1><?php echo htmlspecialchars($local['nombre']); ?></h1>
    <p><?php echo htmlspecialchars($local['direccion']); ?></p>
</header>

<main style="max-width: 600px; margin: 0 auto;">
    
    <div class="card" style="text-align: center; padding: 30px;">
        <h2>Protocolo de Seguridad</h2>
        <p style="margin-bottom: 20px;">Este espacio forma parte de la red de locales seguros de Gaubizi.</p>

        <?php if(isset($_SESSION['usuario_id'])): ?>
            <button style="background-color: #EF4444; color: white; border: none; padding: 15px 30px; font-size: 1.2rem; font-weight: bold; border-radius: 8px; cursor: pointer; width: 100%; box-shadow: 0 4px 6px rgba(239, 68, 68, 0.3);">
                🚨 REPORTAR INCIDENTE
            </button>
            <p style="margin-top: 15px; font-size: 0.9em; color: #6B7280;">Este reporte es confidencial y activa el protocolo del local.</p>
        <?php else: ?>
            <div style="background-color: #F3F4F6; padding: 15px; border-radius: 8px; border: 1px solid #ddd;">
                <p style="margin-bottom: 10px;">Debes iniciar sesión para poder reportar un incidente o añadir a favoritos.</p>
                <a href="index.php?url=login" style="display: inline-block; background-color: #059669; color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold;">Iniciar Sesión</a>
            </div>
        <?php endif; ?>
    </div>

    <p style="text-align: center; margin-top: 20px;">
        <a href="index.php?url=locales">← Volver al directorio</a>
    </p>

</main>

</body>
</html>