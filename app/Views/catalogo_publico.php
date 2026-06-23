<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPRAYA - Catálogo Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
            color: #1f2937;
            letter-spacing: -0.01em;
        }
        .navbar-custom {
            background-color: #111827 !important;
        }
        .card-product {
            border: none;
            border-radius: 16px;
            background-color: #ffffff;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-product:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px -5px rgba(0, 0, 0, 0.05), 0 8px 12px -7px rgba(0, 0, 0, 0.05) !important;
        }
        .img-product {
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
            filter: brightness(0.98);
        }
        .input-search {
            background-color: #1f2937 !important;
            border: 1px solid #374151 !important;
            color: #ffffff !important;
            border-radius: 30px;
        }
        .input-search::placeholder {
            color: #9ca3af;
        }
        .input-search:focus {
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15) !important;
            border-color: #f59e0b !important;
        }
        .category-bar .nav-link {
            color: #4b5563;
            transition: color 0.2s ease;
        }
        .category-bar .nav-link:hover {
            color: #111827;
        }

        .btn-brand {
            background-color: #f59e0b !important;
            color: #111827 !important;
            border: none !important;
            transition: all 0.2s ease;
        }
        .btn-brand:hover {
            background-color: #d97706 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(217, 119, 6, 0.2);
        }
        
        .text-brand {
            color: #d97706 !important;
        }
        .bg-brand-light {
            background-color: rgba(245, 158, 11, 0.1) !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 tracking-tight text-white" href="<?= base_url('/'); ?>">COMPRAYA</a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPrincipal">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarPrincipal">
                
                <form class="d-flex mx-auto w-100 w-lg-50 my-3 my-lg-0 px-lg-3" action="<?= base_url('/'); ?>" method="GET">
                    <div class="input-group">
                        <input class="form-control input-search px-4 py-2" type="search" name="buscar" placeholder="¿Qué estás buscando hoy?" aria-label="Search" value="<?= esc($_GET['buscar'] ?? '') ?>">
                        <button class="btn btn-brand rounded-pill-end px-4 fw-semibold" type="submit">Buscar</button>
                    </div>
                </form>

                <div class="d-flex align-items-center justify-content-between justify-content-lg-end mt-2 mt-lg-0 gap-2">
                    
                    <?php if(session()->get('isLoggedIn')): ?>
                        
                        <?php if(session()->get('rol') == 'cliente'): ?>
                            <a href="<?= base_url('carrito'); ?>" class="btn btn-brand btn-sm fw-bold rounded-pill px-3 py-2 shadow-sm text-dark d-flex align-items-center">
                                <span class="me-1">🛒</span> Carrito <span class="badge bg-dark text-white rounded-pill ms-2 px-2 py-1" id="cart-count" style="font-size: 0.75rem;">0</span>
                            </a>
                        <?php endif; ?>

                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle btn-sm px-3 py-2 rounded-pill fw-semibold shadow-sm border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-1">👤</span> <?= session()->get('nombre'); ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-lg-end shadow-lg border-0 mt-2 p-2 rounded-3">
                                <li><h6 class="dropdown-header text-muted small fw-bold text-uppercase tracking-wider">Mi Cuenta</h6></li>
                                <li><a class="dropdown-item py-2 rounded-2" href="<?= base_url('mis-pedidos'); ?>">📦 Mis Pedidos</a></li>
                                <li><a class="dropdown-item py-2 rounded-2" href="<?= base_url('perfil'); ?>">⚙️ Editar Perfil</a></li>
                                <li><hr class="dropdown-divider text-light"></li>
                                <li><a class="dropdown-item text-danger fw-bold py-2 rounded-2" href="<?= base_url('auth/logout'); ?>">Cerrar Sesión</a></li>
                            </ul>
                        </div>

                    <?php else: ?>
                        <a href="<?= base_url('auth/login'); ?>" class="btn btn-brand btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm">Iniciar Sesión</a>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </nav>

    <div class="bg-white shadow-sm mb-4 border-bottom category-bar">
        <div class="container">
            <ul class="nav py-1 align-items-center">
                <li class="nav-item">
                    <a class="nav-link fw-semibold small text-dark" href="<?= base_url('/'); ?>">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link fw-semibold small dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Explorar Categorías
                    </a>
                    <ul class="dropdown-menu border-0 shadow-lg mt-1 p-2 rounded-3 overflow-y-auto" style="max-height: 350px; min-width: 240px;">
                        <?php if(!empty($categorias)): ?>
                            <?php foreach($categorias as $cat): ?>
                                <li>
                                    <a class="dropdown-item py-2 rounded-2" href="<?= base_url('/?categoria=' . $cat['id']); ?>">
                                        <span class="me-2 text-secondary">▪</span> <?= esc($cat['nombre']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-brand fw-bold py-2 rounded-2 text-center bg-brand-light" href="<?= base_url('/'); ?>">✨ Mostrar todo el catálogo</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold small" href="<?= base_url('acerca-de'); ?>">Acerca de</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container my-5">
        <div class="d-flex align-items-center mb-4">
            <div class="rounded-pill me-3" style="width: 6px; height: 32px; background-color: #f59e0b;"></div>
            <h3 class="mb-0 fw-bold tracking-tight text-dark">Nuestra Colección</h3>
        </div>

        <div class="row g-4">
            <?php if(!empty($productos) && is_array($productos)): ?>
                <?php foreach($productos as $producto): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 card-product shadow-sm">
                            <div class="position-relative">
                                <img src="<?= base_url('uploads/' . $producto['imagen']); ?>" class="card-img-top object-fit-cover img-product" height="220" alt="<?= $producto['nombre']; ?>" onerror="this.onerror=null; this.src='<?= base_url('uploads/default.jpg'); ?>'">
                            </div>
                            
                            <div class="card-body d-flex flex-column p-4">
                                <h6 class="card-title fw-bold text-dark mb-2 text-truncate" title="<?= $producto['nombre']; ?>"><?= $producto['nombre']; ?></h6>
                                <p class="card-text text-secondary small flex-grow-1 mb-3" style="line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    <?= $producto['descripcion']; ?>
                                </p>
                                
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top border-light">
                                    <div class="d-flex flex-column">
                                        <span class="text-muted small" style="font-size: 0.7rem; text-transform: uppercase;">Precio</span>
                                        <span class="fs-5 fw-bold text-dark">Bs. <?= number_format($producto['precio'], 2); ?></span>
                                    </div>
                                    
                                    <?php if(!session()->get('isLoggedIn')): ?>
                                        <a href="<?= base_url('auth/login'); ?>" class="btn btn-outline-secondary btn-sm px-3 rounded-pill fw-semibold" style="font-size: 0.75rem;">
                                            🔑 Ingresar
                                        </a>
                                    <?php elseif(session()->get('rol') == 'cliente'): ?>
                                        <button class="btn btn-brand btn-sm btn-add-cart px-3 rounded-pill fw-bold shadow-sm d-flex align-items-center gap-1" 
                                                data-id="<?= $producto['id']; ?>" 
                                                data-nombre="<?= $producto['nombre']; ?>" 
                                                data-precio="<?= $producto['precio']; ?>">
                                            <span>+</span> Añadir
                                        </button>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border px-2 py-1.5 rounded-pill" style="font-size: 0.7rem;">Solo vista</span>
                                    <?php endif; ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-3 shadow-sm border-0 py-5">
                        <span class="fs-4 d-block mb-2">🏖️</span>
                        <p class="mb-0 fw-semibold text-secondary">No hay productos disponibles en este momento bajo este criterio.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (isset($pager)): ?>
            <div class="d-flex justify-content-center mt-5">
                <?= $pager->links('default', 'bootstrap_pagination') ?>
            </div>
        <?php endif; ?>        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const cartButtons = document.querySelectorAll('.btn-add-cart');
        const cartCountElement = document.getElementById('cart-count');

        const updateCartCount = () => {
            let cart = JSON.parse(localStorage.getItem('compraya_carrito')) || [];
            let totalItems = cart.reduce((sum, item) => sum + item.cantidad, 0);
            if(cartCountElement) cartCountElement.innerText = totalItems;
        };

        cartButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                const btn = e.target.closest('.btn-add-cart');
                const id = btn.getAttribute('data-id');
                const nombre = btn.getAttribute('data-nombre');
                const precio = parseFloat(btn.getAttribute('data-precio'));

                let cart = JSON.parse(localStorage.getItem('compraya_carrito')) || [];
                let existingProduct = cart.find(item => item.id === id);

                if(existingProduct) {
                    existingProduct.cantidad += 1;
                } else {
                    cart.push({ id, nombre, precio, cantidad: 1 });
                }

                localStorage.setItem('compraya_carrito', JSON.stringify(cart));
                updateCartCount();
                alert(`¡${nombre} se añadió a tu carrito!`);
            });
        });

        updateCartCount();
    });
    </script>
</body>
</html>