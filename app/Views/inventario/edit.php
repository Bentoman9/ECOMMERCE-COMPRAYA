<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark fw-bold">
                        <h4 class="mb-0">Editar Producto: <?= $producto['nombre']; ?></h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('inventario/update/' . $producto['id']); ?>" method="POST" enctype="multipart/form-data">
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre del Producto</label>
                                    <input type="text" name="nombre" class="form-control" value="<?= $producto['nombre']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Categoría</label>
                                    <select name="categoria_id" class="form-select" required>
                                        <?php foreach($categorias as $cat): ?>
                                            <option value="<?= $cat['id']; ?>" <?= ($producto['categoria_id'] == $cat['id']) ? 'selected' : ''; ?>>
                                                <?= $cat['nombre']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3"><?= $producto['descripcion']; ?></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Precio (Bs)</label>
                                    <input type="number" step="0.01" name="precio" class="form-control" value="<?= $producto['precio']; ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Stock Físico</label>
                                    <input type="number" name="stock" class="form-control" value="<?= $producto['stock']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label d-block">Imagen Actual</label>
                                <img src="<?= base_url('uploads/' . $producto['imagen']); ?>" alt="img" width="80" class="rounded mb-2 shadow-sm" onerror="this.onerror=null; this.src='<?= base_url('uploads/default.jpg'); ?>'">
                                <input type="file" name="imagen" class="form-control" accept="image/*">
                                <small class="text-muted">Sube una imagen solo si deseas reemplazar la actual.</small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="<?= base_url('inventario'); ?>" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-warning fw-bold">Actualizar Producto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>