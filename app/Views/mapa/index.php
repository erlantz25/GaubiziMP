<?php 
$titulo = "Mapa - Gaubizi";
require_once '../app/Views/layout/header.php';

$favoritosIds = [];
if (isset($_SESSION['usuario_id'])) {
    require_once '../app/Models/Favorito.php';
    $modeloFav = new Favorito();
    $favs = $modeloFav->obtenerPorUsuario($_SESSION['usuario_id']);
    $favoritosIds = array_column($favs, 'id');
}
?>

<div class="app-container" style="max-width: 100%; padding: 0;">

    <div style="padding: 20px; max-width: 900px; margin: 0 auto;">
        <p style="color: #A855F7; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
            Red Segura
        </p>
        <h1 style="font-size: 2rem; font-weight: 800; margin: 6px 0;">Mapa de Locales</h1>
        <p style="color: #94A3B8;">Explora los espacios seguros verificados en Euskal Herria.</p>

        <?php if(isset($_SESSION['usuario_id'])): ?>
        <div style="display: flex; gap: 16px; margin-top: 12px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #94A3B8;">
                <div style="width: 14px; height: 14px; background: linear-gradient(135deg, #A855F7, #7C3AED); border-radius: 50%;"></div>
                Local verificado
            </div>
            <div style="display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #94A3B8;">
                <div style="width: 14px; height: 14px; background: linear-gradient(135deg, #F59E0B, #D97706); border-radius: 50%;"></div>
                En tus favoritos
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div id="mapa-gaubizi" style="width: 100%; height: 600px; z-index: 1;"></div>

</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const mapa = L.map('mapa-gaubizi').setView([43.0, -2.0], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(mapa);

    const iconoNormal = L.divIcon({
        className: '',
        html: `<div style="width:36px;height:36px;background:linear-gradient(135deg,#A855F7,#7C3AED);border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 0 15px rgba(168,85,247,0.6);"></div>`,
        iconSize: [36, 36], iconAnchor: [18, 36], popupAnchor: [0, -36]
    });

    const iconoFavorito = L.divIcon({
        className: '',
        html: `<div style="width:36px;height:36px;background:linear-gradient(135deg,#F59E0B,#D97706);border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid white;box-shadow:0 0 15px rgba(245,158,11,0.6);"></div>`,
        iconSize: [36, 36], iconAnchor: [18, 36], popupAnchor: [0, -36]
    });

    const locales = <?php echo json_encode($locales); ?>;
    const favoritosIds = <?php echo json_encode($favoritosIds); ?>;

    locales.forEach(local => {
        if (local.latitud && local.longitud) {
            const esFav = favoritosIds.includes(parseInt(local.id));
            const icono = esFav ? iconoFavorito : iconoNormal;
            const marker = L.marker([local.latitud, local.longitud], { icon: icono }).addTo(mapa);

            marker.bindPopup(`
                <div style="font-family:Inter,sans-serif;min-width:180px;">
                    <p style="color:#A855F7;font-size:0.75rem;font-weight:600;text-transform:uppercase;margin:0 0 4px 0;">
                        ${local.provincia} · ${local.municipio}
                        ${esFav ? '<span style="color:#F59E0B;margin-left:6px;">★ Favorito</span>' : ''}
                    </p>
                    <h3 style="margin:0 0 8px 0;font-size:1rem;">${local.nombre}</h3>
                    <p style="margin:0 0 10px 0;font-size:0.85rem;color:#6B7280;">📍 ${local.direccion}</p>
                    <a href="index.php?url=local&id=${local.id}" 
                       style="display:block;background:linear-gradient(135deg,#A855F7,#7C3AED);color:white;text-align:center;padding:8px;border-radius:6px;text-decoration:none;font-size:0.85rem;font-weight:600;">
                        Ver local →
                    </a>
                </div>
            `);
        }
    });
</script>

</body>
</html>