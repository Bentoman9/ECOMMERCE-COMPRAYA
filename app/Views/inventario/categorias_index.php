<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías - COMPRAYA</title>
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
                    <a class="nav-link text-white-50" href="<?= base_url('inventario'); ?>">Productos</a>
                    <a class="nav-link text-white fw-bold active ms-lg-3" href="<?= base_url('inventario/categorias'); ?>">Categorías</a>
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/reportes'); ?>">Reporte Pedidos</a>
                    
                    <?php if(session()->get('rol') == 'administrador'): ?>
                        <a class="nav-link text-white-50 ms-lg-3" href="<?= base_url('admin/usuarios'); ?>"> Gestión de Usuarios</a>
                    <?php endif; ?>
                </div>
                
                <div class="dropdown mt-2 mt-lg-0 me-lg-2">
                    <button class="btn btn-primary dropdown-toggle btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm border-0 w-100 w-lg-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                         <?= session()->get('nombre'); ?>
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
            <h2 class="mb-0">Gestión de Categorías</h2>
            
            <form action="<?= base_url('inventario/categorias'); ?>" method="GET" class="d-flex flex-column flex-sm-row w-100 w-lg-50 mx-lg-4 gap-2">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar categoría..." value="<?= esc($buscar ?? ''); ?>">
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-secondary w-100 w-sm-auto">Buscar</button>
                    <?php if(!empty($buscar)): ?>
                        <a href="<?= base_url('inventario/categorias'); ?>" class="btn btn-link text-danger text-decoration-none w-100 w-sm-auto text-center">Limpiar</a>
                    <?php endif; ?>
                </div>
            </form>
            
            <a href="<?= base_url('inventario/categorias/crear'); ?>" class="btn btn-primary w-100 w-lg-auto">+ Nueva Categoría</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div id="mensaje-exito" class="alert alert-success">✅ <?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    
                    <table class="table table-hover align-middle" style="min-width: 800px;">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre de la Categoría</th>
                                <th>Descripción</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($categorias)): ?>
                                <?php foreach($categorias as $c): ?>
                                    <tr>
                                        <td><?= $c['id']; ?></td>
                                        <td class="fw-bold text-dark"><?= esc($c['nombre']); ?></td>
                                        <td class="text-muted"><?= esc($c['descripcion'] ?: 'Sin descripción asignada.'); ?></td>
                                        <td class="text-center text-nowrap">
                                            <a href="<?= base_url('inventario/categorias/editar/' . $c['id']); ?>" class="btn btn-sm btn-warning">Editar</a>
                                            <a href="<?= base_url('inventario/categorias/eliminar/' . $c['id']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de eliminar esta categoría? Esto podría afectar a los productos asociados.');">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4">No hay categorías registradas en el sistema.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div> 
                
                <div class="card-footer bg-white d-flex justify-content-end py-3 border-top-0">
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