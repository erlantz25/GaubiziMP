<?php 
$titulo = "Panel de Moderación - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container" style="max-width: 900px;">

    <div style="margin-bottom: 24px;">
        <p style="color: #A855F7; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
            Panel de Control
        </p>
        <h1 style="font-size: 2rem; font-weight: 800; margin: 6px 0;">Moderación</h1>
        <p style="color: #94A3B8;">Gestiona los reportes enviados por la comunidad.</p>
    </div>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'ok'): ?>
        <div style="background-color: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3); 
                    color: #10B981; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
            ✅ Estado actualizado correctamente.
        </div>
    <?php endif; ?>

    <?php
        $pendientes = count(array_filter($denuncias, fn($d) => $d['estado'] == 'pendiente'));
        $validados  = count(array_filter($denuncias, fn($d) => $d['estado'] == 'validado'));
        $rechazados = count(array_filter($denuncias, fn($d) => $d['estado'] == 'rechazado'));
    ?>
    <div style="display: flex; gap: 16px; margin-bottom: 32px; flex-wrap: wrap;">
        <div class="card-app" style="flex: 1; text-align: center; padding: 20px; min-width: 150px;">
            <p style="font-size: 2rem; font-weight: 800; color: #F59E0B;"><?php echo $pendientes; ?></p>
            <p style="color: #94A3B8; font-size: 0.85rem;">Pendientes</p>
        </div>
        <div class="card-app" style="flex: 1; text-align: center; padding: 20px; min-width: 150px;">
            <p style="font-size: 2rem; font-weight: 800; color: #10B981;"><?php echo $validados; ?></p>
            <p style="color: #94A3B8; font-size: 0.85rem;">Validados</p>
        </div>
        <div class="card-app" style="flex: 1; text-align: center; padding: 20px; min-width: 150px;">
            <p style="font-size: 2rem; font-weight: 800; color: #EF4444;"><?php echo $rechazados; ?></p>
            <p style="color: #94A3B8; font-size: 0.85rem;">Rechazados</p>
        </div>
    </div>

<?php $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'pendiente'; ?>
<div style="display: flex; gap: 10px; margin-bottom: 24px;">
    <a href="index.php?url=admin&filtro=pendiente" 
       style="padding: 8px 20px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 0.9rem;
              <?php echo $filtro == 'pendiente' ? 'background-color: rgba(245,158,11,0.15); color: #F59E0B; border: 1px solid #F59E0B;' : 'background-color: #151A23; color: #94A3B8; border: 1px solid #2A2E39;'; ?>">
        Pendientes (<?php echo $pendientes; ?>)
    </a>
    <a href="index.php?url=admin&filtro=validado"
       style="padding: 8px 20px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 0.9rem;
              <?php echo $filtro == 'validado' ? 'background-color: rgba(16,185,129,0.15); color: #10B981; border: 1px solid #10B981;' : 'background-color: #151A23; color: #94A3B8; border: 1px solid #2A2E39;'; ?>">
        Validados (<?php echo $validados; ?>)
    </a>
    <a href="index.php?url=admin&filtro=rechazado"
       style="padding: 8px 20px; border-radius: 50px; text-decoration: none; font-weight: 600; font-size: 0.9rem;
              <?php echo $filtro == 'rechazado' ? 'background-color: rgba(239,68,68,0.15); color: #EF4444; border: 1px solid #EF4444;' : 'background-color: #151A23; color: #94A3B8; border: 1px solid #2A2E39;'; ?>">
        Rechazados (<?php echo $rechazados; ?>)
    </a>
</div>

<?php $denunciasFiltradas = array_filter($denuncias, fn($d) => $d['estado'] == $filtro); ?>    <?php if(empty($denunciasFiltradas)): ?>

        <div class="card-app" style="text-align: center; padding: 40px;">
            <p style="color: #94A3B8;">No hay reportes todavía.</p>
        </div>
    <?php else: ?>
<?php foreach($denunciasFiltradas as $d): ?>           
     <div class="card-app" style="margin-bottom: 16px; padding: 20px;">
                
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h3 style="font-size: 1rem; margin-bottom: 4px;">
                            <?php echo htmlspecialchars($d['tipo_incidente']); ?>
                        </h3>
                        <p style="color: #94A3B8; font-size: 0.85rem;">
                            📍 <?php echo htmlspecialchars($d['nombre_local']); ?> · <?php echo htmlspecialchars($d['municipio']); ?>
                            &nbsp;|&nbsp;
                            👤 <?php echo $d['nickname_usuario'] ? htmlspecialchars($d['nickname_usuario']) : 'Anónimo'; ?>
                            &nbsp;|&nbsp;
                            🕐 <?php echo date('d/m/Y H:i', strtotime($d['fecha_hora'])); ?>
                        </p>
                    </div>
                    <?php
                        $badgeColor = match($d['estado']) {
                            'pendiente' => '#F59E0B',
                            'validado'  => '#10B981',
                            'rechazado' => '#EF4444',
                            default     => '#94A3B8'
                        };
                        $badgeBg = match($d['estado']) {
                            'pendiente' => 'rgba(245,158,11,0.15)',
                            'validado'  => 'rgba(16,185,129,0.15)',
                            'rechazado' => 'rgba(239,68,68,0.15)',
                            default     => 'rgba(148,163,184,0.15)'
                        };
                    ?>
                    <span style="background-color: <?php echo $badgeBg; ?>; color: <?php echo $badgeColor; ?>; 
                                 border: 1px solid <?php echo $badgeColor; ?>; padding: 4px 12px; 
                                 border-radius: 50px; font-size: 0.75rem; font-weight: 600;">
                        <?php echo ucfirst($d['estado']); ?>
                    </span>
                </div>

                <p style="color: #94A3B8; font-size: 0.9rem; margin-bottom: 16px; 
                           background-color: #0B0F19; padding: 12px; border-radius: 8px;">
                    "<?php echo htmlspecialchars($d['descripcion_privada']); ?>"
                </p>

                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <?php if($d['estado'] !== 'validado'): ?>
                        <form action="index.php?url=cambiar-estado" method="POST" style="margin: 0;">
                            <input type="hidden" name="id_denuncia" value="<?php echo $d['id']; ?>">
                            <input type="hidden" name="nuevo_estado" value="validado">
                            <button type="submit" style="background-color: rgba(16,185,129,0.15); color: #10B981; 
                                    border: 1px solid #10B981; padding: 8px 16px; border-radius: 8px; 
                                    cursor: pointer; font-size: 0.85rem; font-weight: 600;">
                                ✅ Validar
                            </button>
                        </form>
                    <?php endif; ?>

                    <?php if($d['estado'] !== 'rechazado'): ?>
                        <form action="index.php?url=cambiar-estado" method="POST" style="margin: 0;">
                            <input type="hidden" name="id_denuncia" value="<?php echo $d['id']; ?>">
                            <input type="hidden" name="nuevo_estado" value="rechazado">
                            <button type="submit" style="background-color: rgba(239,68,68,0.15); color: #EF4444; 
                                    border: 1px solid #EF4444; padding: 8px 16px; border-radius: 8px; 
                                    cursor: pointer; font-size: 0.85rem; font-weight: 600;">
                                ❌ Rechazar
                            </button>
                        </form>
                    <?php endif; ?>

                    <?php if($d['estado'] !== 'pendiente'): ?>
                        <form action="index.php?url=cambiar-estado" method="POST" style="margin: 0;">
                            <input type="hidden" name="id_denuncia" value="<?php echo $d['id']; ?>">
                            <input type="hidden" name="nuevo_estado" value="pendiente">
                            <button type="submit" style="background-color: rgba(245,158,11,0.15); color: #F59E0B; 
                                    border: 1px solid #F59E0B; padding: 8px 16px; border-radius: 8px; 
                                    cursor: pointer; font-size: 0.85rem; font-weight: 600;">
                                🔄 Pendiente
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>

<h2 style="font-size: 1.2rem; font-weight: 700; margin: 40px 0 16px; color: #A855F7;">
    💬 Reseñas (<?php echo count($resenas); ?>)
</h2>
<?php foreach($resenas as $r): ?>
<div style="background: rgba(168,85,247,0.05); border: 1px solid rgba(168,85,247,0.15);
            border-radius: 8px; padding: 14px 16px; margin-bottom: 10px;
            display: flex; justify-content: space-between; align-items: flex-start; gap: 16px;">
    <div style="flex: 1;">
        <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 4px;">
            <span style="font-weight: 700; color: #E2E8F0;"><?php echo htmlspecialchars($r['nickname']); ?></span>
            <span style="color: #F59E0B;"><?php for($i=1;$i<=5;$i++) echo $i<=$r['estrellas']?'★':'☆'; ?></span>
            <span style="color: #94A3B8; font-size: 0.8rem;">→ <?php echo htmlspecialchars($r['nombre_local']); ?></span>
            <span style="padding: 2px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600;
                         background: <?php echo $r['visible'] ? 'rgba(16,185,129,0.15)' : 'rgba(245,158,11,0.15)'; ?>;
                         color: <?php echo $r['visible'] ? '#10B981' : '#F59E0B'; ?>;">
                <?php echo $r['visible'] ? 'Visible' : 'Pendiente'; ?>
            </span>
        </div>
        <p style="color: #CBD5E1; font-size: 0.9rem; margin: 0;"><?php echo htmlspecialchars($r['comentario_publico']); ?></p>
        <span style="color: #94A3B8; font-size: 0.75rem;"><?php echo date('d/m/Y H:i', strtotime($r['fecha'])); ?></span>
    </div>
    <div style="display: flex; flex-direction: column; gap: 6px; min-width: 120px;">
        <?php if(!$r['visible']): ?>
        <form action="index.php?url=cambiar-visibilidad-resena" method="POST">
            <input type="hidden" name="id_resena" value="<?php echo $r['id']; ?>">
            <input type="hidden" name="visible" value="1">
            <button type="submit" style="width: 100%; background: rgba(16,185,129,0.15); color: #10B981;
                    border: 1px solid rgba(16,185,129,0.4); padding: 6px; border-radius: 6px; cursor: pointer; font-size: 0.8rem;">
                ✓ Aprobar
            </button>
        </form>
        <?php else: ?>
        <form action="index.php?url=cambiar-visibilidad-resena" method="POST">
            <input type="hidden" name="id_resena" value="<?php echo $r['id']; ?>">
            <input type="hidden" name="visible" value="0">
            <button type="submit" style="width: 100%; background: rgba(239,68,68,0.1); color: #EF4444;
                    border: 1px solid rgba(239,68,68,0.3); padding: 6px; border-radius: 6px; cursor: pointer; font-size: 0.8rem;">
                ✕ Ocultar
            </button>
        </form>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>

</div>

</body>
</html>