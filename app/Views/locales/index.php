<?php 
$titulo = "Directorio - Gaubizi";
require_once '../app/Views/layout/header.php'; 

$provinciaActiva = isset($_GET['provincia']) ? $_GET['provincia'] : 'todas';
$localesFiltrados = $provinciaActiva === 'todas' ? $locales : array_filter($locales, fn($l) => $l['provincia'] === $provinciaActiva);

$provincias = array_unique(array_column($locales, 'provincia'));
sort($provincias);
?>

<div class="app-container">
    <h1 style="font-size: 2.5rem; color: #A855F7; margin-bottom: 5px;">Locales</h1>
    <p style="color: #94A3B8; margin-bottom: 25px;">Directorio de red segura en Euskal Herria</p>

    <input type="text" id="buscador" class="search-bar" placeholder="Buscar por nombre o zona..." 
           style="margin-bottom: 20px;">

    <div class="filters" style="flex-wrap: wrap; gap: 8px; margin-bottom: 24px;">
        <a href="index.php?url=locales" 
           class="filter-btn <?php echo $provinciaActiva === 'todas' ? 'active' : ''; ?>">
            Todas
        </a>
        <?php foreach($provincias as $prov): ?>
            <a href="index.php?url=locales&provincia=<?php echo urlencode($prov); ?>" 
               class="filter-btn <?php echo $provinciaActiva === $prov ? 'active' : ''; ?>">
                <?php echo htmlspecialchars($prov); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <p style="color: #94A3B8; font-size: 0.85rem; margin-bottom: 16px;">
        <?php echo count($localesFiltrados); ?> local<?php echo count($localesFiltrados) !== 1 ? 'es' : ''; ?> encontrado<?php echo count($localesFiltrados) !== 1 ? 's' : ''; ?>
    </p>

    <div class="cards-grid" id="cards-grid">
        <?php if(!empty($localesFiltrados)): ?>
            <?php foreach($localesFiltrados as $local): ?>
            <div class="card-app" data-nombre="<?php echo strtolower(htmlspecialchars($local['nombre'])); ?>" data-municipio="<?php echo strtolower(htmlspecialchars($local['municipio'])); ?>">
                <div class="card-header">
                    <div>
                        <h3>
                            <a href="index.php?url=local&id=<?php echo $local['id']; ?>" style="color: white; text-decoration: none;">
                                <?php echo htmlspecialchars($local['nombre']); ?>
                            </a>
                        </h3>
                        <div class="card-info">
                            <span>📍 <?php echo htmlspecialchars($local['municipio']); ?></span>
                            <span style="color: #4A5568; margin: 0 6px;">·</span>
                            <span style="color: #A855F7; font-size: 0.8rem;"><?php echo htmlspecialchars($local['provincia']); ?></span>
                        </div>
                    </div>
                </div>
                <p style="color: #94A3B8; font-size: 0.9rem; margin-top: 15px;">
                    <?php echo htmlspecialchars($local['direccion']); ?>
                </p>
                <?php if($local['total_denuncias'] > 0): ?>
    <div style="margin-top: 10px;">
        <span style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); 
                     color: #EF4444; padding: 4px 10px; border-radius: 50px; font-size: 0.78rem; font-weight: 600;">
            ⚠️ <?php echo $local['total_denuncias']; ?> alerta<?php echo $local['total_denuncias'] > 1 ? 's' : ''; ?> validada<?php echo $local['total_denuncias'] > 1 ? 's' : ''; ?>
        </span>
    </div>
<?php endif; ?>l
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: #94A3B8;">No se han encontrado locales para esta provincia.</p>
        <?php endif; ?>
    </div>
</div>

<script>
document.getElementById('buscador').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#cards-grid .card-app').forEach(card => {
        const nombre = card.dataset.nombre || '';
        const municipio = card.dataset.municipio || '';
        card.style.display = (nombre.includes(q) || municipio.includes(q)) ? '' : 'none';
    });
});
</script>

</body>
</html>