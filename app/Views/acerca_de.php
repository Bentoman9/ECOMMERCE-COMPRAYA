<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acerca de - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Consistencia total con la identidad corporativa de COMPRAYA */
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
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
        }
        .text-brand {
            color: #d97706 !important;
        }
        .accent-bar {
            width: 40px;
            height: 4px;
            background-color: #f59e0b;
            border-radius: 2px;
            margin: 0 auto;
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
            <div class="col-12 col-md-10 col-lg-8 text-center">
                
                <div class="display-4 mb-2">🛍️</div>
                <h2 class="fw-bold text-dark tracking-tight mb-3">Sobre COMPRAYA</h2>
                <div class="accent-bar mb-4"></div>
                
                <p class="lead text-secondary px-lg-4 mb-5" style="line-height: 1.7; font-size: 1.15rem;">
                    COMPRAYA es una plataforma web moderna de comercio electrónico diseñada especialmente para la gestión y venta de prendas de vestir de forma rápida, eficiente y totalmente adaptada a dispositivos móviles.
                </p>
                
                <div class="card card-custom text-start mb-5">
                    <div class="card-body p-4 p-md-5">
                        <div class="d-flex align-items-center mb-4">
                            <span class="fs-4 me-2">🎯</span>
                            <h4 class="fw-bold text-dark mb-0 tracking-tight">Objetivos del Sistema</h4>
                        </div>
                        
                        <div class="d-flex flex-column gap-3">
                            <div class="p-3 bg-light bg-opacity-50 rounded-3 border-start border-4 border-warning">
                                <p class="mb-0 text-dark"><strong class="text-dark">Para el Cliente:</strong> Brindar una interfaz intuitiva con carrito de compras dinámico y seguimiento de pedidos en tiempo real.</p>
                            </div>
                            
                            <div class="p-3 bg-light bg-opacity-50 rounded-3 border-start border-4 border-secondary">
                                <p class="mb-0 text-dark"><strong class="text-dark">Para el Almacén:</strong> Ofrecer un control estricto de inventarios con alertas de stock crítico y buscador optimizado.</p>
                            </div>
                            
                            <div class="p-3 bg-light bg-opacity-50 rounded-3 border-start border-4 border-dark">
                                <p class="mb-0 text-dark"><strong class="text-dark">Para la Distribución:</strong> Facilitar al repartidor una lista de entregas responsiva ideal para el teléfono celular.</p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="text-muted small mt-5 pt-4 border-top border-light-subtle">
                    <p class="mb-1 text-secondary">Desarrollado profesionalmente por <strong class="text-dark">Bentoman9</strong></p>
                    <p class="text-muted-50">&copy; <?= date('Y'); ?> COMPRAYA. Todos los derechos reservados.</p>
                </div>
                
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>