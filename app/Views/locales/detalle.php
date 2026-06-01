<?php 
$titulo = htmlspecialchars($local['nombre']) . " - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container">

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'reporte_ok'): ?>
        <div style="background-color: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); 
                    color: #10B981; padding: 14px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
            ✅ Reporte enviado correctamente. El equipo moderador lo revisará en breve.
        </div>
    <?php endif; ?>

    <div style="margin-bottom: 24px;">
        <a href="index.php?url=locales" style="color: #94A3B8; font-size: 0.85rem; text-decoration: none;">← Volver al directorio</a>
        <p style="color: #A855F7; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; margin-top: 16px; letter-spacing: 1px;">
            <?php echo htmlspecialchars($local['provincia']); ?> · <?php echo htmlspecialchars($local['municipio']); ?>
        </p>
        <h1 style="font-size: 2rem; font-weight: 800; margin: 6px 0;"><?php echo htmlspecialchars($local['nombre']); ?></h1>
        <p style="color: #94A3B8;">📍 <?php echo htmlspecialchars($local['direccion']); ?></p>
    </div>

    <div style="margin-bottom: 24px;">
        <span class="badge safe">⛨ Espacio Seguro Verificado</span>
    </div>

    <div class="card-app" style="text-align: center; padding: 30px;">
        <?php if(isset($_SESSION['usuario_id'])): ?>
            <p style="color: #94A3B8; margin-bottom: 20px;">¿Has presenciado o sufrido un incidente en este local?<br>Tu reporte es confidencial.</p>
            <a href="index.php?url=reportar&id_local=<?php echo $local['id']; ?>" 
               style="display: block; background-color: #EF4444; color: white; padding: 15px 30px; 
                      font-size: 1.1rem; font-weight: 700; border-radius: 8px; width: 100%; 
                      box-shadow: 0 4px 20px rgba(239,68,68,0.3); text-decoration: none;">
                🚨 REPORTAR INCIDENTE
            </a>
            <p style="margin-top: 12px; font-size: 0.85rem; color: #94A3B8;">Este reporte activa el protocolo de seguridad del local.</p>

            <?php 
                require_once '../app/Models/Favorito.php';
                $modeloFav = new Favorito();
                $esFav = $modeloFav->esFavorito($_SESSION['usuario_id'], $local['id']);
            ?>
            <div id="fav-container" style="margin-top: 12px;">
                <?php if($esFav): ?>
                    <button id="btn-fav" onclick="toggleFavorito(<?php echo $local['id']; ?>, true)"
                        style="width: 100%; background-color: rgba(239,68,68,0.1); 
                               color: #EF4444; border: 1px solid rgba(239,68,68,0.4); padding: 12px; 
                               border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 1rem;">
                        ✕ Quitar de favoritos
                    </button>
                <?php else: ?>
                    <button id="btn-fav" onclick="toggleFavorito(<?php echo $local['id']; ?>, false)"
                        style="width: 100%; background-color: rgba(168,85,247,0.1); 
                               color: #A855F7; border: 1px solid rgba(168,85,247,0.4); padding: 12px; 
                               border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 1rem;">
                        ♡ Guardar en favoritos
                    </button>
                <?php endif; ?>
            </div>
            <div id="fav-msg" style="margin-top: 8px; font-size: 0.85rem; text-align: center; min-height: 20px;"></div>

        <?php else: ?>
            <p style="color: #94A3B8; margin-bottom: 20px;">Inicia sesión para reportar un incidente o guardar este local en favoritos.</p>
            <a href="index.php?url=login" 
               style="display: inline-block; background: linear-gradient(135deg, #A855F7, #7C3AED); 
                      color: white; padding: 12px 28px; border-radius: 8px; font-weight: 700; text-decoration: none;">
                Iniciar Sesión
            </a>
        <?php endif; ?>
    </div>

    <?php if(!empty($denunciasPublicas)): ?>
        <div style="margin-top: 24px;">
            <h2 style="color: #94A3B8; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; margin-bottom: 16px;">
                ⚠️ Alertas de seguridad (<?php echo count($denunciasPublicas); ?>)
            </h2>
            <?php foreach($denunciasPublicas as $denuncia): ?>
                <div style="background: rgba(239,68,68,0.05); border: 1px solid rgba(239,68,68,0.2); 
                            border-radius: 8px; padding: 12px 16px; margin-bottom: 10px;
                            display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #EF4444; font-weight: 600; font-size: 0.9rem;">
                        ⚠️ <?php echo htmlspecialchars($denuncia['tipo_incidente']); ?>
                    </span>
                    <span style="color: #94A3B8; font-size: 0.8rem;">
                        <?php echo date('d/m/Y', strtotime($denuncia['fecha_hora'])); ?>
                    </span>
                </div>
            <?php endforeach; ?>
            <p style="color: #94A3B8; font-size: 0.75rem; margin-top: 8px;">
                Solo se muestran alertas verificadas por el equipo moderador. Los detalles son confidenciales.
            </p>
        </div>
    <?php endif; ?>

<?php if($mediaResenas['total'] > 0): ?>
<div style="margin-top: 24px; display: flex; align-items: center; gap: 12px;">
    <div style="font-size: 2.5rem; font-weight: 900; color: #F59E0B;"><?php echo $mediaResenas['media']; ?></div>
    <div>
        <div style="font-size: 1.3rem; color: #F59E0B;">
            <?php
            $media = round($mediaResenas['media']);
            for($i=1;$i<=5;$i++) echo $i <= $media ? '★' : '☆';
            ?>
        </div>
        <div style="color: #94A3B8; font-size: 0.85rem;"><?php echo $mediaResenas['total']; ?> reseña<?php echo $mediaResenas['total'] > 1 ? 's' : ''; ?></div>
    </div>
</div>
<?php endif; ?>

<?php if(!empty($resenas)): ?>
<div style="margin-top: 24px;">
    <h2 style="color: #94A3B8; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px; margin-bottom: 16px;">
        💬 Reseñas (<?php echo count($resenas); ?>)
    </h2>
    <?php foreach($resenas as $r): ?>
    <div style="background: rgba(168,85,247,0.05); border: 1px solid rgba(168,85,247,0.15);
                border-radius: 8px; padding: 14px 16px; margin-bottom: 10px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
            <div>
                <span style="font-weight: 700; color: #E2E8F0; font-size: 0.9rem;">
                    <?php echo htmlspecialchars($r['nickname']); ?>
                </span>
                <span style="color: #F59E0B; margin-left: 8px; font-size: 1rem;">
                    <?php for($i=1;$i<=5;$i++) echo $i<=$r['estrellas'] ? '★' : '☆'; ?>
                </span>
            </div>
            <span style="color: #94A3B8; font-size: 0.78rem;">
                <?php echo date('d/m/Y', strtotime($r['fecha'])); ?>
            </span>
        </div>
        <p style="color: #CBD5E1; font-size: 0.9rem; margin: 0; line-height: 1.5;">
            <?php echo htmlspecialchars($r['comentario_publico']); ?>
        </p>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php if(isset($_SESSION['usuario_id'])): ?>
    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'resena_ok'): ?>
        <div style="margin-top: 16px; background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3);
                    color: #10B981; padding: 12px 16px; border-radius: 8px; font-size: 0.9rem;">
            ✅ Reseña publicada correctamente.
        </div>
    <?php elseif(isset($_GET['msg']) && $_GET['msg'] == 'resena_pendiente'): ?>
        <div style="margin-top: 16px; background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.3);
                    color: #F59E0B; padding: 12px 16px; border-radius: 8px; font-size: 0.9rem;">
            ⏳ Reseña enviada — pendiente de revisión por contenido.
        </div>
    <?php elseif(isset($_GET['msg']) && $_GET['msg'] == 'resena_duplicada'): ?>
        <div style="margin-top: 16px; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3);
                    color: #EF4444; padding: 12px 16px; border-radius: 8px; font-size: 0.9rem;">
            Ya has dejado una reseña en este local.
        </div>
    <?php endif; ?>

    <?php if(!$yaReseno): ?>
    <div style="margin-top: 24px; background: rgba(168,85,247,0.05); border: 1px solid rgba(168,85,247,0.2);
                border-radius: 12px; padding: 20px;">
        <h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 16px; color: #E2E8F0;">✍️ Escribir una reseña</h3>
        <form action="index.php?url=guardar-resena" method="POST">
            <input type="hidden" name="id_local" value="<?php echo $local['id']; ?>">

            <!-- Estrellas -->
            <div style="margin-bottom: 14px;">
                <label style="color: #94A3B8; font-size: 0.85rem; display: block; margin-bottom: 8px;">Puntuación</label>
                <div style="display: flex; gap: 6px; flex-direction: row-reverse; justify-content: flex-end;">
                    <?php for($i=5;$i>=1;$i--): ?>
                    <label style="cursor: pointer; font-size: 2rem; color: #4A5568; transition: color 0.1s;"
                           onmouseover="this.style.color='#F59E0B'"
                           onmouseout="this.style.color='#4A5568'">
                        <input type="radio" name="estrellas" value="<?php echo $i; ?>"
                               style="display:none;" required>
                        ★
                    </label>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Comentario -->
            <div style="margin-bottom: 16px;">
                <label style="color: #94A3B8; font-size: 0.85rem; display: block; margin-bottom: 8px;">Comentario</label>
                <textarea name="comentario" rows="3" required
                    placeholder="Describe tu experiencia en el local: ambiente, personal, sensación de seguridad..."
                    style="width: 100%; background: rgba(255,255,255,0.05); border: 1px solid rgba(168,85,247,0.3);
                           border-radius: 8px; padding: 10px 14px; color: #E2E8F0; font-size: 0.9rem;
                           font-family: inherit; resize: vertical; box-sizing: border-box;"></textarea>
            </div>

            <button type="submit"
                style="background: linear-gradient(135deg, #A855F7, #7C3AED); color: white;
                       border: none; padding: 10px 24px; border-radius: 8px; cursor: pointer;
                       font-weight: 600; font-size: 0.95rem;">
                Publicar reseña
            </button>
        </form>
    </div>
    <?php endif; ?>
<?php else: ?>
    <div style="margin-top: 20px; color: #94A3B8; font-size: 0.9rem; text-align: center;">
        <a href="index.php?url=login" style="color: #A855F7;">Inicia sesión</a> para dejar una reseña.
    </div>
<?php endif; ?>
</div>

<script>
function toggleFavorito(idLocal, esFavorito) {
    const url = esFavorito ? 'index.php?url=quitar-favorito' : 'index.php?url=guardar-favorito';
    const btn = document.getElementById('btn-fav');
    const msg = document.getElementById('fav-msg');

    btn.disabled = true;
    btn.style.opacity = '0.6';

    const formData = new FormData();
    formData.append('id_local', idLocal);
    formData.append('origen', 'detalle');
    formData.append('ajax', '1');

    fetch(url, { method: 'POST', body: formData })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.style.opacity = '1';
        if (esFavorito) {
            btn.textContent = '♡ Guardar en favoritos';
            btn.style.backgroundColor = 'rgba(168,85,247,0.1)';
            btn.style.color = '#A855F7';
            btn.style.border = '1px solid rgba(168,85,247,0.4)';
            btn.onclick = () => toggleFavorito(idLocal, false);
            msg.style.color = '#94A3B8';
            msg.textContent = 'Local eliminado de favoritos.';
        } else {
            btn.textContent = '✕ Quitar de favoritos';
            btn.style.backgroundColor = 'rgba(239,68,68,0.1)';
            btn.style.color = '#EF4444';
            btn.style.border = '1px solid rgba(239,68,68,0.4)';
            btn.onclick = () => toggleFavorito(idLocal, true);
            msg.style.color = '#A855F7';
            msg.textContent = '♡ Local guardado en favoritos.';
        }
        setTimeout(() => msg.textContent = '', 3000);
    })
    .catch(() => {
        btn.disabled = false;
        btn.style.opacity = '1';
        msg.style.color = '#EF4444';
        msg.textContent = 'Error al procesar. Inténtalo de nuevo.';
    });
}
</script>

</body>
</html>