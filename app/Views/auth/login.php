<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPRAYA - Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 mt-5">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4 fw-bold text-dark">Iniciar Sesión</h3>
                        
                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="alert alert-success text-center py-2"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger text-center py-2"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/loginProcess'); ?>" method="POST">
                            
                            <div class="mb-3">
                                <label for="email" class="form-label text-secondary fw-semibold">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Ingresa tu correo" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label text-secondary fw-semibold">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2 mt-3 fw-bold">Entrar a mi cuenta</button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="small text-muted mb-1">¿No tienes una cuenta?</p>
                            <a href="<?= base_url('auth/register'); ?>" class="text-decoration-none fw-bold text-primary">Regístrate aquí</a>
                        </div>
                        <div class="text-center mt-3">
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