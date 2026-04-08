<?php 
$titulo = "Directorio - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container">
    <h1 style="font-size: 2.5rem; color: #A855F7; margin-bottom: 5px;">Locales</h1>
    <p style="color: #94A3B8; margin-bottom: 25px;">Directorio de red segura en Euskal Herria</p>

    <input type="text" class="search-bar" placeholder="Buscar por nombre o zona...">

    <div class="filters">
        <a href="#" class="filter-btn active">Todos</a>
        <a href="#" class="filter-btn">Seguros</a>
        <a href="#" class="filter-btn">Con Alertas</a>
    </div>

    <div class="cards-grid">
        <?php if(!empty($locales)): ?>
            <?php foreach($locales as $local): ?>
            <div class="card-app">
                <div class="card-header">
                    <div>
                        <h3>
                            <a href="index.php?url=local&id=<?php echo $local['id']; ?>" style="color: white; text-decoration: none;">
                                <?php echo htmlspecialchars($local['nombre']); ?>
                            </a>
                        </h3>
                        <div class="card-info">
                            <span>📍 <?php echo htmlspecialchars($local['municipio']); ?></span>
                        </div>
                    </div>
                    <span class="badge safe">⛨ Seguro</span>
                </div>
                <p style="color: #94A3B8; font-size: 0.9rem; margin-top: 15px;">
                    <?php echo htmlspecialchars($local['direccion']); ?>
                </p>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: #94A3B8;">No se han encontrado locales.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>