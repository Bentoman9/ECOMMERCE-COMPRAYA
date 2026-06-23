<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Inventario - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white" href="<?= base_url('panel'); ?>">⚙️ COMPRAYA | Panel</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPanel">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="menuPanel">
                <div class="navbar-nav me-auto">
                    <a class="nav-link text-white fw-bold active ms-lg-3" href="<?= base_url('inventario'); ?>">Productos</a>
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/categorias'); ?>">Categorías</a>
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/reportes'); ?>">Reporte Pedidos</a>
                    
                    <?php if(session()->get('rol') == 'administrador'): ?>
                        <a class="nav-link text-white-50 ms-lg-3" href="<?= base_url('admin/usuarios'); ?>"> Gestión de Usuarios</a>
                    <?php endif; ?>
                </div>
                
                <div class="dropdown mt-2 mt-lg-0 me-lg-2">
                    <button class="btn btn-primary dropdown-toggle btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm border-0 w-100 w-lg-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-1">👤</span> <?= session()->get('nombre'); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end shadow border-0 mt-2 animate fadeIn">
                        <li>
                            <h6 class="dropdown-header text-primary fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                Role: <?= str_replace('_', ' ', session()->get('rol')); ?>
                            </h6>
                        </li>
                        <li><a class="dropdown-item py-2" href="<?= base_url('perfil'); ?>">⚙️ Editar mi Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger fw-bold py-2" href="<?= base_url('auth/logout'); ?>">Cerrar Sesión</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>

    <div class="container mt-4">
        
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4 gap-3">
            <h2 class="mb-0">Gestión de Productos</h2>
            
            <form action="<?= base_url('inventario'); ?>" method="GET" class="d-flex flex-column flex-sm-row w-100 w-lg-50 mx-lg-4 gap-2">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre (ej. Polera)..." value="<?= esc($buscar ?? ''); ?>">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-secondary w-100 w-sm-auto">Buscar</button>
                    <?php if(!empty($buscar)): ?>
                        <a href="<?= base_url('inventario'); ?>" class="btn btn-link text-danger text-decoration-none w-100 w-sm-auto text-center">Limpiar</a>
                    <?php endif; ?>
                </div>
            </form>
            
            <a href="<?= base_url('inventario/crear'); ?>" class="btn btn-primary w-100 w-lg-auto">+ Nuevo Producto</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div id="mensaje-exito" class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    
                    <table class="table table-hover align-middle" style="min-width: 800px;">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Precio (Bs)</th>
                                <th>Stock Físico</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($productos)): ?>
                                <?php foreach($productos as $p): ?>
                                    <tr>
                                        <td><?= $p['id']; ?></td>
                                        <td>
                                            <img src="<?= base_url('uploads/' . $p['imagen']); ?>" alt="img" width="50" height="50" class="rounded object-fit-cover" onerror="this.onerror=null; this.src='<?= base_url('uploads/default.jpg'); ?>'">
                                        </td>
                                        <td class="fw-bold"><?= $p['nombre']; ?></td>
                                        <td class="text-nowrap">Bs. <?= number_format($p['precio'], 2); ?></td>
                                        <td>
                                            <?php if($p['stock'] <= 5): ?>
                                                <span class="badge bg-danger fs-6"><?= $p['stock']; ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-success fs-6"><?= $p['stock']; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="<?= base_url('inventario/editar/' . $p['id']); ?>" class="btn btn-sm btn-warning">Editar</a>
                                            <a href="<?= base_url('inventario/eliminar/' . $p['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto de forma permanente?');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">No hay productos en el inventario.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white d-flex justify-content-end py-3">
                    <?= $pager->links('default', 'bootstrap_pagination') ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const alerta = document.getElementById('mensaje-exito');
        if (alerta) {
            setTimeout(() => {
                alerta.style.transition = "opacity 0.5s ease";
                alerta.style.opacity = "0";
                setTimeout(() => alerta.remove(), 500);
            }, 4000);
        }
    });
    </script>
</body>
</html>