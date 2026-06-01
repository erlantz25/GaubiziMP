<?php 
$titulo = "Mi Perfil - Gaubizi";
require_once '../app/Views/layout/header.php'; 
?>

<div class="app-container">

    <div style="margin-bottom: 32px;">
        <p style="color: #A855F7; font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
            Mi Cuenta
        </p>
        <h1 style="font-size: 2rem; font-weight: 800; margin: 6px 0;">
            <?php echo htmlspecialchars($usuario['nickname']); ?>
        </h1>
        <p style="color: #94A3B8;"><?php echo htmlspecialchars($usuario['email']); ?></p>
    </div>

    <?php if(isset($_GET['msg']) && $_GET['msg'] == 'favorito_quitado'): ?>
        <div style="background-color: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.4); 
                    color: #EF4444; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
            Local eliminado de favoritos.
        </div>
    <?php endif; ?>

    <div class="card-app" style="margin-bottom: 24px; padding: 24px;">
        <h2 style="font-size: 1rem; font-weight: 700; margin-bottom: 16px; color: #94A3B8; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
            Información
        </h2>
        <div style="display: flex; flex-direction: column; gap: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="color: #94A3B8; font-size: 0.9rem;">Rol</span>
                <?php
                    $rolColor = match($usuario['rol']) {
                        'admin' => '#EF4444',
                        'mod'   => '#A855F7',
                        'user'  => '#10B981',
                        default => '#94A3B8'
                    };
                ?>
                <span style="color: <?php echo $rolColor; ?>; font-weight: 600; font-size: 0.9rem; text-transform: capitalize;">
                    <?php echo htmlspecialchars($usuario['rol']); ?>
                </span>
    </div>
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span style="color: #94A3B8; font-size: 0.9rem;">Miembro desde</span>
                <span style="color: #F8FAFC; font-weight: 600; font-size: 0.9rem;">
                    <?php echo date('d/m/Y', strtotime($usuario['fecha_registro'])); ?>
                </span>
            </div>
        </div>
    </div>

    <div>
        <h2 style="font-size: 1rem; font-weight: 700; margin-bottom: 16px; color: #94A3B8; 
                   text-transform: uppercase; font-size: 0.8rem; letter-spacing: 1px;">
            Locales Guardados (<?php echo count($favoritos); ?>)
        </h2>

        <?php if(empty($favoritos)): ?>
            <div class="card-app" style="text-align: center; padding: 40px;">
                <p style="color: #94A3B8; margin-bottom: 16px;">No tienes locales guardados todavía.</p>
                <a href="index.php?url=locales" 
                   style="color: #A855F7; text-decoration: none; font-weight: 600;">
                    Explorar locales →
                </a>
            </div>
        <?php else: ?>
            <?php foreach($favoritos as $fav): ?>
                <div class="card-app" style="margin-bottom: 16px; padding: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <h3 style="font-size: 1rem; margin-bottom: 4px;">
                                <a href="index.php?url=local&id=<?php echo $fav['id']; ?>" 
                                   style="color: white; text-decoration: none;">
                                    <?php echo htmlspecialchars($fav['nombre']); ?>
                                </a>
                            </h3>
                            <p style="color: #94A3B8; font-size: 0.85rem;">
                                📍 <?php echo htmlspecialchars($fav['municipio']); ?> · <?php echo htmlspecialchars($fav['provincia']); ?>
                            </p>
                        </div>
                        <form action="index.php?url=quitar-favorito" method="POST" style="margin: 0;">
                            <input type="hidden" name="id_local" value="<?php echo $fav['id']; ?>">
                            <input type="hidden" name="origen" value="perfil">
                            <button type="submit" 
                                style="background: none; border: 1px solid rgba(239,68,68,0.4); 
                                       color: #EF4444; padding: 6px 12px; border-radius: 8px; 
                                       cursor: pointer; font-size: 0.8rem;">
                                ✕ Quitar
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if(isset($_SESSION['rol']) && ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'mod')): ?>
        <div style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #2A2E39;">
            <a href="index.php?url=admin" 
               style="display: block; background-color: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.3);
                      color: #A855F7; padding: 14px; border-radius: 8px; text-align: center; 
                      text-decoration: none; font-weight: 600;">
                🛡️ Ir al Panel de Moderación
            </a>
        </div>
    <?php endif; ?>

</div>

</body>
</html>