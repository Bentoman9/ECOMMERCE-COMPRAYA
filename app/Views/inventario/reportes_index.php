<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Pedidos - COMPRAYA</title>
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
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/categorias'); ?>">Categorías</a>
                    <a class="nav-link text-white fw-bold active ms-lg-3" href="<?= base_url('inventario/reportes'); ?>">Reporte Pedidos</a>  
                    
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

    <div class="container mt-4 mb-5">
        
        <div class="row align-items-center mb-4 g-3">
            <div class="col-12 col-md-6 text-center text-md-start">
                <h3 class="fw-bold mb-1">📊 Historial y Reporte de Ventas</h3>
                <p class="text-muted mb-0 small">Control global de órdenes procesadas en la tienda.</p>
            </div>
            <div class="col-12 col-md-6 text-center text-md-end">
                <div class="card bg-success text-white d-inline-block border-0 shadow-sm rounded-3 px-4 py-3 w-100 w-md-auto">
                    <span class="small text-white-50 d-block fw-semibold text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;">Ingresos Totales Brutos</span>
                    <span class="fs-3 fw-bold">Bs. <?= number_format($totalGeneral, 2); ?></span>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-4 rounded-3">
            <div class="card-body p-3">
                <form action="" method="GET" class="d-flex flex-column flex-md-row gap-2 align-items-md-center">
                    <label class="fw-semibold text-secondary me-md-2 mb-0" style="font-size: 0.9rem;"> Filtrar por estado:</label>
                    <select name="estado" class="form-select w-100 w-md-auto flex-grow-1">
                        <option value=""> Mostrar todos los pedidos</option>
                        <option value="pendiente" <?= (isset($_GET['estado']) && $_GET['estado'] == 'pendiente') ? 'selected' : ''; ?>> Pendiente</option>
                        <option value="en preparacion" <?= (isset($_GET['estado']) && $_GET['estado'] == 'en preparacion') ? 'selected' : ''; ?>> En Preparación</option>
                        <option value="en camino" <?= (isset($_GET['estado']) && $_GET['estado'] == 'en camino') ? 'selected' : ''; ?>> En Camino</option>
                        <option value="entregado" <?= (isset($_GET['estado']) && $_GET['estado'] == 'entregado') ? 'selected' : ''; ?>> Entregado</option>
                    </select>
                    <div class="d-flex gap-2 w-100 w-md-auto">
                        <button type="submit" class="btn btn-dark w-100 w-md-auto px-4">Filtrar</button>
                        <?php if(!empty($_GET['estado'])): ?>
                            <a href="<?= base_url('inventario/reportes'); ?>" class="btn btn-outline-danger w-100 w-md-auto text-nowrap">Limpiar</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <?php if(!empty($pedidos)): ?>
            <?php foreach($pedidos as $pedido): ?>
                
                <?php 
                    // El borde de la tarjeta cambia según el estado del pedido de manera elegante
                    $borderStyle = 'border-secondary';
                    if($pedido['estado'] == 'pendiente') $borderStyle = 'border-warning';
                    if($pedido['estado'] == 'en preparacion') $borderStyle = 'border-info';
                    if($pedido['estado'] == 'en camino') $borderStyle = 'border-primary';
                    if($pedido['estado'] == 'entregado') $borderStyle = 'border-success';
                ?>

                <div class="card shadow-sm border-0 border-start border-4 <?= $borderStyle; ?> mb-3 rounded-3">
                    <div class="card-body p-3 p-md-4">
                        <div class="row align-items-center g-3">
                            
                            <div class="col-12 col-md-4">
                                <div class="d-flex align-items-center mb-2 justify-content-between justify-content-md-start">
                                    <h5 class="fw-bold text-dark mb-0 me-3">Orden #<?= $pedido['id']; ?></h5>
                                    
                                    <?php 
                                        $color = 'bg-secondary';
                                        if($pedido['estado'] == 'pendiente') $color = 'bg-warning text-dark';
                                        if($pedido['estado'] == 'en preparacion') $color = 'bg-info text-dark';
                                        if($pedido['estado'] == 'en camino') $color = 'bg-primary';
                                        if($pedido['estado'] == 'entregado') $color = 'bg-success';
                                    ?>
                                    <span class="badge <?= $color; ?> rounded-pill px-3 py-1 text-uppercase" style="font-size: 0.7rem; letter-spacing: 0.5px;"><?= esc($pedido['estado']); ?></span>
                                </div>
                                <p class="mb-1 text-dark small"> <strong>Cliente:</strong> <?= esc($pedido['cliente']); ?></p>
                                <p class="mb-0 text-muted small">📅 <?= date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])); ?></p>
                            </div>

                            <div class="col-12 col-md-5">
                                <span class="text-secondary small fw-bold d-block mb-1 text-uppercase" style="font-size: 0.65rem; letter-spacing: 0.5px;">Artículos Solicitados:</span>
                                <div class="bg-white p-3 rounded border border-light shadow-sm">
                                    <ul class="list-unstyled mb-0 small">
                                        <?php if(!empty($pedido['items'])): ?>
                                            <?php foreach($pedido['items'] as $item): ?>
                                                <li class="d-flex justify-content-between border-bottom border-light py-1">
                                                    <span class="text-dark">• <?= $item['cantidad']; ?>x <?= esc($item['producto_nombre']); ?></span>
                                                    <span class="text-muted text-nowrap ms-2">Bs. <?= number_format($item['precio_unitario'] * $item['cantidad'], 2); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <li class="text-muted small">Sin artículos registrados.</li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 text-start text-md-end">
                                <span class="small text-muted d-block" style="font-size: 0.8rem;">Monto de la Orden</span>
                                <span class="fs-4 fw-bold text-success text-nowrap">Bs. <?= number_format($pedido['total'], 2); ?></span>
                            </div>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center rounded-3 shadow-sm py-4 border-0">
                🏖️ No existen registros de órdenes de compras bajo los criterios seleccionados.
            </div>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>