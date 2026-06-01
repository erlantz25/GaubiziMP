<?php 
$titulo = "Inicio - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container hero" style="text-align: center; padding-top: 60px; padding-bottom: 40px;">
    <div style="display: inline-block; background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.3); 
                border-radius: 50px; padding: 6px 18px; font-size: 0.8rem; color: #A855F7; 
                font-weight: 600; letter-spacing: 1px; margin-bottom: 24px;">
        🛡️ RED DE SEGURIDAD CIUDADANA · EUSKAL HERRIA
    </div>
    <h1 style="font-size: 3rem; font-weight: 900; line-height: 1.1; margin-bottom: 20px;">
        Tu red de seguridad en el<br><span style="color: #A855F7;">Ocio Nocturno</span>
    </h1>
    <p style="color: #94A3B8; font-size: 1.1rem; max-width: 600px; margin: 0 auto 36px;">
        Gaubizi conecta locales comprometidos, usuarios y protocolos de seguridad en tiempo real para garantizar espacios libres de acoso en Euskal Herria.
    </p>
    <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
        <a href="index.php?url=locales" class="btn-primary" style="padding: 14px 32px; font-size: 1rem;">
            🗺️ Explorar Locales Seguros
        </a>
        <?php if(!isset($_SESSION['nickname'])): ?>
            <a href="index.php?url=registro" class="filter-btn" style="padding: 14px 28px; font-size: 1rem;">
                Crear cuenta gratis
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="app-container" style="padding-top: 0; padding-bottom: 40px;">
    <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; margin-bottom: 60px;">
        <div class="card-app" style="flex: 1; min-width: 140px; max-width: 200px; text-align: center; padding: 24px 16px;">
          <p style="font-size: 2.2rem; font-weight: 900; color: #A855F7; margin: 0;"><?php echo $totalLocales; ?></p>
<p style="color: #94A3B8; font-size: 0.85rem; margin: 4px 0 0;">Locales Seguros</p>
        </div>
        <div class="card-app" style="flex: 1; min-width: 140px; max-width: 200px; text-align: center; padding: 24px 16px;">
            <p style="font-size: 2.2rem; font-weight: 900; color: #10B981; margin: 0;">7</p>
            <p style="color: #94A3B8; font-size: 0.85rem; margin: 4px 0 0;">Provincias</p>
        </div>
        <div class="card-app" style="flex: 1; min-width: 140px; max-width: 200px; text-align: center; padding: 24px 16px;">
            <p style="font-size: 2.2rem; font-weight: 900; color: #EF4444; margin: 0;">24/7</p>
            <p style="color: #94A3B8; font-size: 0.85rem; margin: 4px 0 0;">Disponible</p>
        </div>
        <div class="card-app" style="flex: 1; min-width: 140px; max-width: 200px; text-align: center; padding: 24px 16px;">
            <p style="font-size: 2.2rem; font-weight: 900; color: #F59E0B; margin: 0;">100%</p>
            <p style="color: #94A3B8; font-size: 0.85rem; margin: 4px 0 0;">Confidencial</p>
        </div>
    </div>

    <div style="text-align: center; margin-bottom: 40px;">
        <p style="color: #A855F7; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">Cómo funciona</p>
        <h2 style="font-size: 1.8rem; font-weight: 800; margin: 8px 0 40px;">Simple. Seguro. Efectivo.</h2>
    </div>

    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 60px;">
        <div class="card-app" style="flex: 1; min-width: 220px; padding: 28px;">
            <div style="font-size: 2rem; margin-bottom: 12px;">📍</div>
            <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 8px;">Encuentra un local</h3>
            <p style="color: #94A3B8; font-size: 0.9rem; line-height: 1.6;">Consulta el directorio de locales verificados como espacios seguros en Euskal Herria.</p>
        </div>
        <div class="card-app" style="flex: 1; min-width: 220px; padding: 28px;">
            <div style="font-size: 2rem; margin-bottom: 12px;">🚨</div>
            <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 8px;">Reporta un incidente</h3>
            <p style="color: #94A3B8; font-size: 0.9rem; line-height: 1.6;">Envía un reporte confidencial si presencias o sufres una situación de riesgo.</p>
        </div>
        <div class="card-app" style="flex: 1; min-width: 220px; padding: 28px;">
            <div style="font-size: 2rem; margin-bottom: 12px;">🤖</div>
            <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 8px;">Consulta a GauAuxiliar</h3>
            <p style="color: #94A3B8; font-size: 0.9rem; line-height: 1.6;">Nuestro asistente con IA te orienta sobre protocolos de seguridad y números de emergencia.</p>
        </div>
    </div>

    <?php if(!isset($_SESSION['nickname'])): ?>
    <div class="card-app" style="text-align: center; padding: 40px; background: linear-gradient(135deg, rgba(168,85,247,0.1), rgba(124,58,237,0.05)); border: 1px solid rgba(168,85,247,0.3);">
        <h2 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 12px;">Únete a la comunidad</h2>
        <p style="color: #94A3B8; margin-bottom: 24px;">Crea tu cuenta gratuita y contribuye a hacer el ocio nocturno más seguro para todos.</p>
        <a href="index.php?url=registro" class="btn-primary" style="padding: 14px 36px; font-size: 1rem;">
            Empezar ahora →
        </a>
    </div>
    <?php endif; ?>

</div>

</body>
</html>