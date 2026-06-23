<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Categoría - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white" href="<?= base_url('panel'); ?>">⚙️ COMPRAYA | Panel</a>
            <div class="collapse navbar-collapse" id="menuPanel">
                <div class="navbar-nav me-auto">
                    <a class="nav-link text-white-50" href="<?= base_url('inventario'); ?>">Productos</a>
                    <a class="nav-link text-white fw-bold active ms-lg-3" href="<?= base_url('inventario/categorias'); ?>">Categorías</a>
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/reportes'); ?>">Reporte Pedidos</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0 fw-bold">Agregar Nueva Categoría</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?= base_url('inventario/categorias/store'); ?>" method="POST">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nombre de la Categoría</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Ej. Poleras" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="4" placeholder="Opcional..."></textarea>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= base_url('inventario/categorias'); ?>" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar Categoría</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>