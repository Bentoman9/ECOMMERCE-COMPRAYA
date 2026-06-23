<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Inicio - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar Unificado -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white" href="<?= base_url('panel'); ?>">⚙️ COMPRAYA | Panel</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPanel">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="menuPanel">
                <div class="navbar-nav me-auto">
                    <a class="nav-link text-white-50" href="<?= base_url('inventario'); ?>"> Productos</a>
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/categorias'); ?>"> Categorías</a>
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/reportes'); ?>"> Reporte Pedidos</a>
                    
                    <?php if(session()->get('rol') == 'administrador'): ?>
                        <a class="nav-link text-white-50 ms-lg-3" href="<?= base_url('admin/usuarios'); ?>"> Gestión de Usuarios</a>
                    <?php endif; ?>
                </div>
                
                <div class="dropdown mt-2 mt-lg-0 me-lg-2">
                    <button class="btn btn-primary dropdown-toggle btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm border-0 w-100 w-lg-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= session()->get('nombre'); ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end shadow border-0 mt-2">
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
        
        <!-- Mensaje de Bienvenida Personalizado según el Rol -->
        <div class="p-4 bg-white shadow-sm rounded-3 mb-4 border-start border-5 <?= (session()->get('rol') == 'administrador') ? 'border-danger' : 'border-primary'; ?>">
            <h2 class="fw-bold mb-1">Bienvenido al Sistema, <?= explode(' ', session()->get('nombre'))[0]; ?> </h2>
            <p class="text-muted mb-0">
                Estás en el 
                <strong><?= (session()->get('rol') == 'administrador') ? 'Panel de Administración Global' : 'Panel de Gestión de Inventario'; ?></strong>. 
                Aquí tienes un resumen del estado actual de tu tienda.
            </p>
        </div>

        <!-- Tarjetas de Resumen (Widgets) -->
        <div class="row g-4">
            
            <!-- Tarjeta: Productos (La ven ambos) -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 bg-primary text-white h-100">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase fw-bold mb-1">Productos en Catálogo</h6>
                            <h2 class="display-5 fw-bold mb-0"><?= $totalProductos; ?></h2>
                        </div>
                        <span class="fs-1 opacity-50">📦</span>
                    </div>
                    <a href="<?= base_url('inventario'); ?>" class="card-footer bg-dark bg-opacity-25 text-white text-decoration-none text-center border-0 py-2">
                        Ver inventario ➔
                    </a>
                </div>
            </div>

            <!-- Tarjeta: Categorías (La ven ambos) -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 bg-warning text-dark h-100">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-dark text-uppercase opacity-75 fw-bold mb-1">Categorías Activas</h6>
                            <h2 class="display-5 fw-bold mb-0"><?= $totalCategorias; ?></h2>
                        </div>
                        <span class="fs-1 opacity-50">📂</span>
                    </div>
                    <a href="<?= base_url('inventario/categorias'); ?>" class="card-footer bg-dark bg-opacity-10 text-dark text-decoration-none text-center border-0 py-2 fw-semibold">
                        Gestionar categorías ➔
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3 bg-success text-white h-100">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 text-uppercase fw-bold mb-1">Órdenes Procesadas</h6>
                            <h2 class="display-5 fw-bold mb-0"><?= $totalPedidos; ?></h2>
                        </div>
                        <span class="fs-1 opacity-50">📊</span>
                    </div>
                    <a href="<?= base_url('inventario/reportes'); ?>" class="card-footer bg-dark bg-opacity-25 text-white text-decoration-none text-center border-0 py-2">
                        Ver reportes ➔
                    </a>
                </div>
            </div>

            <!-- Tarjeta: Usuarios (SÓLO LA VE EL ADMINISTRADOR) -->
            <?php if(session()->get('rol') == 'administrador'): ?>
                <div class="col-md-12 mt-4">
                    <div class="card border-0 shadow-sm rounded-3 bg-dark text-white">
                        <div class="card-body p-4 d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-white-50 text-uppercase fw-bold mb-1">Usuarios Registrados en el Sistema</h6>
                                <h2 class="display-5 fw-bold mb-0 text-danger"><?= $totalUsuarios; ?></h2>
                                <p class="small text-muted mt-2 mb-0">Incluye clientes, gestores, repartidores y administradores.</p>
                            </div>
                            <span class="fs-1 opacity-50">👥</span>
                        </div>
                        <a href="<?= base_url('admin/usuarios'); ?>" class="card-footer bg-black bg-opacity-25 text-white text-decoration-none text-center border-0 py-2">
                            Administrar personal y clientes ➔
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>