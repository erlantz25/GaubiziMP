<?php 
$titulo = "Reportar Incidente - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container">

    <div style="margin-bottom: 24px;">
        <a href="index.php?url=local&id=<?php echo $local['id']; ?>" 
           style="color: #94A3B8; font-size: 0.85rem; text-decoration: none;">
            ← Volver a <?php echo htmlspecialchars($local['nombre']); ?>
        </a>
        <h1 style="font-size: 1.8rem; font-weight: 800; margin-top: 16px;">
            🚨 Reportar Incidente
        </h1>
        <p style="color: #94A3B8; margin-top: 6px;">
            En <strong style="color: #F8FAFC;"><?php echo htmlspecialchars($local['nombre']); ?></strong> 
            · <?php echo htmlspecialchars($local['municipio']); ?>
        </p>
    </div>

    <div style="background-color: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.3); 
                border-radius: 8px; padding: 14px 16px; margin-bottom: 24px;">
        <p style="color: #A855F7; font-size: 0.9rem; margin: 0;">
            🔒 Tu reporte es completamente confidencial. Solo el equipo moderador de Gaubizi tendrá acceso a esta información.
        </p>
    </div>

    <?php if(isset($_GET['error'])): ?>
        <div style="background-color: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.4); 
                    color: #EF4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
            Por favor, rellena todos los campos antes de enviar.
        </div>
    <?php endif; ?>

    <div class="card-app" style="padding: 24px;">
        <form action="index.php?url=enviar-reporte" method="POST">
            <input type="hidden" name="id_local" value="<?php echo $local['id']; ?>">

            <div class="input-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">
                    Tipo de incidente
                </label>
                <select name="id_tipo_incidente" required
                    style="width: 100%; background-color: #0B0F19; border: 1px solid #2A2E39; 
                           border-radius: 8px; padding: 14px 16px; color: #F8FAFC; 
                           font-size: 0.95rem; outline: none;">
                    <option value="">Selecciona el tipo...</option>
                    <?php foreach($tipos as $tipo): ?>
                        <option value="<?php echo $tipo['id']; ?>">
                            <?php echo htmlspecialchars($tipo['nombre']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group" style="margin-bottom: 24px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; font-size: 0.9rem;">
                    Descripción del incidente
                </label>
                <textarea name="descripcion_privada" required rows="5"
                    placeholder="Describe con el mayor detalle posible lo que ha ocurrido. Esta información es privada y solo la verá el equipo moderador."
                    style="width: 100%; background-color: #0B0F19; border: 1px solid #2A2E39; 
                           border-radius: 8px; padding: 14px 16px; color: #F8FAFC; 
                           font-size: 0.95rem; outline: none; resize: vertical; font-family: inherit;"></textarea>
            </div>

            <button type="submit"
                style="width: 100%; background-color: #EF4444; color: white; border: none; 
                       padding: 15px; font-size: 1rem; font-weight: 700; border-radius: 8px; 
                       cursor: pointer; box-shadow: 0 4px 20px rgba(239,68,68,0.3);">
                Enviar Reporte
            </button>

            <p style="text-align: center; margin-top: 16px; font-size: 0.8rem; color: #94A3B8;">
                Al enviar confirmas que la información es veraz.
            </p>
        </form>
    </div>

</div>

</body>
</html>