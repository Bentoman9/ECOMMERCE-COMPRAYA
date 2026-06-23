<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Consistencia absoluta con el ecosistema de diseño COMPRAYA */
        body {
            background-color: #f9fafb;
            color: #1f2937;
            letter-spacing: -0.01em;
        }
        .navbar-custom {
            background-color: #111827 !important;
        }
        .card-custom {
            border: none;
            border-radius: 16px;
            background-color: #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04), 0 4px 6px -4px rgba(0, 0, 0, 0.04) !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 tracking-tight text-white" href="<?= base_url('/'); ?>">COMPRAYA</a>
            <a href="<?= base_url('/'); ?>" class="btn btn-outline-light rounded-pill btn-sm px-4 py-2 fw-semibold shadow-sm">
                Volver al Catálogo
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-9">
                
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-pill me-3" style="width: 6px; height: 32px; background-color: #f59e0b;"></div>
                    <h3 class="mb-0 fw-bold tracking-tight text-dark">Historial de Mis Pedidos</h3>
                </div>

                <?php if(!empty($pedidos)): ?>
                    <?php foreach($pedidos as $pedido): ?>
                        
                        <?php 
                            // Asignación de bordes dinámicos sutiles según el estado para guiar el ojo del usuario
                            $borderStyle = 'border-secondary';
                            if($pedido['estado'] == 'pendiente') $borderStyle = 'border-warning';
                            if($pedido['estado'] == 'en preparacion') $borderStyle = 'border-info';
                            if($pedido['estado'] == 'en camino') $borderStyle = 'border-primary';
                            if($pedido['estado'] == 'entregado') $borderStyle = 'border-success';
                        ?>
                        
                        <div class="card card-custom shadow-sm mb-4 border-0 border-start border-4 <?= $borderStyle; ?>">
                            <div class="card-body p-4 p-md-5">
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title fw-bold mb-0 text-dark tracking-tight">
                                        Pedido #<?= $pedido['id'] ?? ''; ?>
                                    </h5>
                                    
                                    <?php 
                                        $color = 'bg-secondary text-white';
                                        if($pedido['estado'] == 'pendiente') $color = 'bg-warning text-dark';
                                        if($pedido['estado'] == 'en preparacion') $color = 'bg-info text-dark';
                                        if($pedido['estado'] == 'en camino') $color = 'bg-primary text-white';
                                        if($pedido['estado'] == 'entregado') $color = 'bg-success text-white';
                                    ?>
                                    <span class="badge <?= $color; ?> px-3 py-2 rounded-pill fw-bold text-uppercase tracking-wider" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                        <?= esc($pedido['estado']); ?>
                                    </span>
                                </div>
                                
                                <p class="text-muted small mb-4">📅 Realizado el <?= date('d/m/Y H:i', strtotime($pedido['fecha_pedido'])); ?></p>
                                
                                <div class="bg-light bg-opacity-50 p-4 rounded-3 border border-light-subtle mb-4">
                                    <h6 class="fw-bold text-secondary small text-uppercase tracking-wider mb-3" style="font-size: 0.7rem;">Artículos incluidos:</h6>
                                    <ul class="list-unstyled mb-0">
                                        <?php if(!empty($pedido['detalles'])): ?>
                                            <?php foreach($pedido['detalles'] as $item): ?>
                                                <li class="d-flex justify-content-between align-items-center border-bottom border-light py-2">
                                                    <span class="text-dark fw-medium">• <?= $item['cantidad']; ?>x <?= esc($item['producto_nombre']); ?></span>
                                                    <span class="text-secondary small text-nowrap ms-2">Bs. <?= number_format($item['precio_unitario'] * $item['cantidad'], 2); ?></span>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-2">
                                    <span class="text-muted small text-uppercase tracking-wider fw-semibold" style="font-size: 0.7rem;">Monto liquidado</span>
                                    <span class="fs-4 fw-bold text-dark">Bs. <?= number_format($pedido['total'], 2); ?></span>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info text-center rounded-3 shadow-sm border-0 py-5">
                        <span class="fs-3 d-block mb-2">📦</span>
                        <p class="mb-0 fw-semibold text-secondary">Todavía no has realizado ninguna compra en nuestra tienda.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>