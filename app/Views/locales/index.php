<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio de Locales - Gaubizi</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Montserrat:wght@700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

    <header>
        <h1>Directorio de Locales</h1>
        <p>Espacios de ocio registrados en la red Gaubizi.</p>
    </header>

    <main>
        <?php if (!empty($listaLocales)): ?>
            
            <?php foreach ($listaLocales as $local): ?>
                <div class="card">
                    <div class="provincia"><?php echo htmlspecialchars($local['provincia']); ?> - <?php echo htmlspecialchars($local['municipio']); ?></div>
                    <h3><?php echo htmlspecialchars($local['nombre']); ?></h3>
                    <p><?php echo htmlspecialchars($local['direccion']); ?></p>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p>No hay locales registrados en este momento.</p>
        <?php endif; ?>
    </main>

    <br>
    <a href="index.php?url=home" style="color: #8a2be2;">Volver al inicio</a>

</body>
</html>