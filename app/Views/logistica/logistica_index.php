<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logística y Entregas - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .card-entrega { 
            border-radius: 15px; 
            border: none; 
            transition: all 0.2s ease; 
            position: relative;
            z-index: 1;
        }
        .card-entrega:hover, 
        .card-entrega:focus-within { 
            transform: translateY(-2px); 
            z-index: 10; 
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white fs-6 fs-md-5" href="<?= base_url('logistica'); ?>">🚚 COMPRAYA | Rutas</a>
            
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm border-0" type="button" data-bs-toggle="dropdown">
                    <span class="me-1">👤</span> <?= explode(' ', session()->get('nombre'))[0]; ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li>
                        <h6 class="dropdown-header text-primary fw-bold text-uppercase" style="font-size: 0.7rem;">
                            Rol: <?= str_replace('_', ' ', session()->get('rol')); ?>
                        </h6>
                    </li>
                    <li><a class="dropdown-item py-2" href="<?= base_url('perfil'); ?>">⚙️ Editar mi Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger fw-bold py-2" href="<?= base_url('auth/logout'); ?>">Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3 mb-5">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0 text-dark"> Hoja de Ruta</h5>
            <a href="<?= base_url('logistica'); ?>" class="btn btn-outline-secondary btn-sm rounded-pill px-3 shadow-sm">Actualizar</a>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success border-0 shadow-sm rounded-3 fw-semibold small py-2">
                ✅ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="row g-3">
            <?php if(!empty($pedidos)): ?>
                <?php foreach($pedidos as $pedido): ?>
                    
                    <?php 
                        $borderClass = 'border-secondary';
                        $badgeClass = 'bg-secondary';
                        $btnClass = 'btn-outline-secondary';

                        if($pedido['estado'] == 'pendiente') { 
                            $borderClass = 'border-warning'; $badgeClass = 'bg-warning text-dark'; $btnClass = 'btn-warning text-dark';
                        }
                        if($pedido['estado'] == 'en preparacion') { 
                            $borderClass = 'border-info'; $badgeClass = 'bg-info text-dark'; $btnClass = 'btn-info text-dark';
                        }
                        if($pedido['estado'] == 'en camino') { 
                            $borderClass = 'border-primary'; $badgeClass = 'bg-primary text-white'; $btnClass = 'btn-primary';
                        }
                        if($pedido['estado'] == 'entregado') { 
                            $borderClass = 'border-success'; $badgeClass = 'bg-success text-white'; $btnClass = 'btn-success';
                        }
                    ?>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card card-entrega shadow-sm border-start border-4 <?= $borderClass; ?>">
                            <div class="card-body p-3 p-md-4">
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="fw-bold mb-0">Orden #<?= $pedido['id']; ?></h6>
                                    <span class="badge <?= $badgeClass; ?> rounded-pill text-uppercase px-2 py-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">
                                        <?= esc($pedido['estado']); ?>
                                    </span>
                                </div>

                                <p class="mb-1 text-dark small"> <strong><?= esc($pedido['cliente']); ?></strong></p>
                                <p class="mb-2 text-muted small" style="font-size: 0.8rem;">✉️ <?= esc($pedido['contacto']); ?></p>
                                <p class="mb-3 fs-5 fw-bold text-success">Bs. <?= number_format($pedido['total'], 2); ?></p>

                                <div class="accordion accordion-flush border rounded mb-3" id="accordion<?= $pedido['id']; ?>">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed py-2 text-secondary fw-semibold bg-light" style="font-size: 0.85rem;" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $pedido['id']; ?>">
                                                📦 Ver paquete...
                                            </button>
                                        </h2>
                                        <div id="flush-collapse<?= $pedido['id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordion<?= $pedido['id']; ?>">
                                            <div class="accordion-body p-2 bg-white">
                                                <ul class="list-unstyled mb-0" style="font-size: 0.8rem;">
                                                    <?php foreach($pedido['items'] as $item): ?>
                                                        <li class="border-bottom border-light py-1 text-muted">
                                                            <strong><?= $item['cantidad']; ?>x</strong> <?= esc($item['producto_nombre']); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown d-grid">
                                    <button class="btn <?= $btnClass; ?> dropdown-toggle fw-bold py-2 rounded-3 shadow-sm text-uppercase" style="font-size: 0.8rem;" type="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="window">
                                        ⚙️ <?= esc($pedido['estado']); ?>
                                    </button>
                                    <ul class="dropdown-menu w-100 shadow-lg border-0 mt-1">
                                        <li>
                                            <h6 class="dropdown-header text-muted" style="font-size: 0.75rem;">Asignar nuevo estado:</h6>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 fw-semibold text-warning small" href="<?= base_url('logistica/cambiarEstado/' . $pedido['id'] . '/pendiente'); ?>">
                                                 Marcar "Pendiente"
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 fw-semibold text-info small" href="<?= base_url('logistica/cambiarEstado/' . $pedido['id'] . '/en preparacion'); ?>">
                                                 Marcar "En Preparación"
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item py-2 fw-semibold text-primary small" href="<?= base_url('logistica/cambiarEstado/' . $pedido['id'] . '/en camino'); ?>">
                                                 Marcar "En Camino"
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item py-2 fw-bold text-success bg-success bg-opacity-10 small" href="<?= base_url('logistica/cambiarEstado/' . $pedido['id'] . '/entregado'); ?>" onclick="return confirm('¿Confirmar entrega?');">
                                                 ¡Entregado con Éxito!
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info border-0 shadow-sm text-center py-4 rounded-3 small">
                        🏖️ No hay pedidos registrados.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>