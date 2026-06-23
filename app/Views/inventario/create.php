<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Añadir Nuevo Producto</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('inventario/store'); ?>" method="POST" enctype="multipart/form-data">
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre del Producto</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Categoría</label>
                                    <select name="categoria_id" class="form-select" required>
                                        <option value="" disabled selected>Selecciona una categoría</option>
                                        <?php foreach($categorias as $cat): ?>
                                            <option value="<?= $cat['id']; ?>"><?= $cat['nombre']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Precio (Bs)</label>
                                    <input type="number" step="0.01" name="precio" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Stock Físico</label>
                                    <input type="number" name="stock" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Imagen del Producto</label>
                                <input type="file" name="imagen" class="form-control" accept="image/*">
                                <small class="text-muted">Si no subes una imagen, se asignará una por defecto.</small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('inventario'); ?>" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>