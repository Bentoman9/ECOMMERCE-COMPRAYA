<?php
    // Lógica dinámica para saber a dónde debe volver el usuario
    $rol = session()->get('rol');
    
    if (in_array($rol, ['administrador', 'gestor_inventario'])) {
        $url_volver = base_url('panel');
        $texto_volver = "Volver al Panel";
    } elseif ($rol === 'repartidor' || $rol === 'gestor_logistica') {
        $url_volver = base_url('logistica');
        $texto_volver = "Volver a Logística";
    } else {
        $url_volver = base_url('/');
        $texto_volver = "Volver al Catálogo";
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= $url_volver; ?>">COMPRAYA</a>
            <a href="<?= $url_volver; ?>" class="btn btn-outline-light btn-sm"><?= $texto_volver; ?></a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <?php if(session()->getFlashdata('success')): ?>
                    <div id="alerta-perfil" class="alert alert-success shadow-sm">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-primary text-white py-3">
                        <h5 class="card-title mb-0 fw-bold">⚙️ Configuración de mi Perfil</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= base_url('perfil/update'); ?>" method="POST">
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label text-secondary fw-semibold">Nombre Completo</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="<?= esc($usuario['nombre']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-secondary fw-semibold">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= esc($usuario['email']); ?>" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-secondary fw-semibold">Rol asignado</label>
                                <input type="text" class="form-control bg-light" value="<?= ucfirst(str_replace('_', ' ', session()->get('rol'))); ?>" readonly disabled>
                                <small class="text-muted">Por seguridad tu rol no puede ser modificado por ti.</small>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?= $url_volver; ?>" class="text-decoration-none text-muted small">Cancelar</a>
                                <button type="submit" class="btn btn-primary px-4 fw-bold rounded-pill">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alerta = document.getElementById('alerta-perfil');
            if (alerta) {
                setTimeout(() => {
                    alerta.style.transition = "opacity 0.5s ease";
                    alerta.style.opacity = "0";
                    setTimeout(() => alerta.remove(), 500);
                }, 3000);
            }
        });
    </script>
</body>
</html>