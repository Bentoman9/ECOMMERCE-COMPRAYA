<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPRAYA - Registro de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 mt-5">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4 fw-bold text-dark">Crear Cuenta</h3>
                        <p class="text-muted text-center small mb-4">Regístrate para poder añadir productos al carrito y comprar.</p>
                        
                        <form action="<?= base_url('auth/storeRegister'); ?>" method="POST">
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label text-secondary fw-semibold">Nombre Completo</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej. Juan Pérez" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label text-secondary fw-semibold">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="juan@correo.com" required>
                                <?php if(session()->has('error')): ?>
                                <small class="text-danger" style="color: red; font-size: 85%;">
                                    <?= session('error') ?>
                                </small>
                            <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label text-secondary fw-semibold">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Mínimo 6 caracteres" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 mt-3 fw-bold">Registrarse</button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="<?= base_url('/'); ?>" class="text-decoration-none small text-muted">← Volver al catálogo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>