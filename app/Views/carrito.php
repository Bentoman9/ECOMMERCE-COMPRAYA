<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito - COMPRAYA</title>
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
        .card-custom {
            border: none;
            border-radius: 16px;
            background-color: #ffffff;
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
        .btn-brand:disabled {
            background-color: #fca5a5 !important;
            color: #ffffff !important;
            opacity: 0.7;
        }

        .table-custom thead {
            background-color: #f3f4f6;
        }
        .table-custom th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #4b5563;
            border-bottom-width: 1px;
            padding: 16px 12px;
        }
        .table-custom td {
            padding: 20px 12px;
            border-bottom: 1px solid #f3f4f6;
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 tracking-tight text-white" href="<?= base_url('/'); ?>">COMPRAYA</a>
            <a href="<?= base_url('/'); ?>" class="btn btn-outline-light rounded-pill btn-sm px-4 py-2 fw-semibold shadow-sm">
                ← Seguir Comprando
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex align-items-center mb-4">
            <div class="rounded-pill me-3" style="width: 6px; height: 32px; background-color: #f59e0b;"></div>
            <h3 class="mb-0 fw-bold tracking-tight text-dark">Mi Carrito de Compras</h3>
        </div>
        
        <div class="card card-custom shadow-sm">
            <div class="card-body p-4 p-md-5">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 40%;">Producto</th>
                                <th>Precio Unitario</th>
                                <th class="text-center" style="width: 15%;">Cantidad</th>
                                <th>Subtotal</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="cart-body">
                            </tbody>
                    </table>
                </div>
                
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-5 gap-4 pt-4 border-top border-light-subtle">
                    <div>
                        <button class="btn btn-outline-danger rounded-pill px-4 fw-semibold transition-all btn-sm shadow-sm" onclick="vaciarCarrito()">
                            🗑️ Vaciar Carrito
                        </button>
                    </div>
                    <div class="text-start text-md-end">
                        <p class="text-muted small mb-1 text-uppercase tracking-wider" style="font-size: 0.75rem; font-weight: 600;">Total a pagar</p>
                        <h2 class="fw-bold text-dark mb-4">Bs. <span id="cart-total" class="text-dark">0.00</span></h2>
                        
                        <button class="btn btn-brand btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm w-100 w-md-auto text-uppercase" id="btn-procesar" style="font-size: 0.9rem; letter-spacing: 0.5px;">
                            Procesar Pedido
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function renderCart() {
        let cart = JSON.parse(localStorage.getItem('compraya_carrito')) || [];
        const tbody = document.getElementById('cart-body');
        const totalElement = document.getElementById('cart-total');
        
        tbody.innerHTML = '';
        let total = 0;

        if (cart.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center py-5 text-muted fw-semibold">🛒 Tu carrito está vacío actualmente.</td></tr>';
            totalElement.innerText = '0.00';
            return;
        }

        cart.forEach((item, index) => {
            let subtotal = item.precio * item.cantidad;
            total += subtotal;

            /* Se refinaron las clases y elementos internos del renglón para emparejar el diseño moderno */
            tbody.innerHTML += `
                <tr>
                    <td>
                        <div class="fw-bold text-dark">${item.nombre}</div>
                    </td>
                    <td class="text-secondary fw-semibold">Bs. ${item.precio.toFixed(2)}</td>
                    <td>
                        <input type="number" class="form-control form-control-sm text-center mx-auto shadow-sm border-light-subtle rounded-3" 
                               style="width: 75px; font-weight: 600;" value="${item.cantidad}" min="1" 
                               onchange="actualizarCantidad(${index}, this.value)">
                    </td>
                    <td class="fw-bold text-dark">Bs. ${subtotal.toFixed(2)}</td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-link text-danger text-decoration-none fw-bold p-0 fs-5 lh-1" onclick="eliminarItem(${index})" title="Remover artículo">
                            ✕
                        </button>
                    </td>
                </tr>
            `;
        });

        totalElement.innerText = total.toFixed(2);
    }

    function actualizarCantidad(index, nuevaCantidad) {
        let cart = JSON.parse(localStorage.getItem('compraya_carrito')) || [];
        let cant = parseInt(nuevaCantidad);
        
        if (cant >= 1) {
            cart[index].cantidad = cant;
            localStorage.setItem('compraya_carrito', JSON.stringify(cart));
            renderCart(); 
        }
    }

    function eliminarItem(index) {
        let cart = JSON.parse(localStorage.getItem('compraya_carrito')) || [];
        cart.splice(index, 1);
        localStorage.setItem('compraya_carrito', JSON.stringify(cart));
        renderCart();
    }

    function vaciarCarrito() {
        if(confirm('¿Seguro que quieres vaciar el carrito?')) {
            localStorage.removeItem('compraya_carrito');
            renderCart();
        }
    }

    document.addEventListener('DOMContentLoaded', renderCart);

    document.getElementById('btn-procesar').addEventListener('click', function() {
        let cart = JSON.parse(localStorage.getItem('compraya_carrito')) || [];

        if (cart.length === 0) {
            alert('Tu carrito está vacío. Agrega productos antes de comprar.');
            return;
        }

        let btn = this;
        btn.innerText = 'Procesando...';
        btn.disabled = true;

        fetch('<?= base_url('carrito/procesar') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(cart)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('¡Genial! ' + data.mensaje);
                localStorage.removeItem('compraya_carrito');
                window.location.href = '<?= base_url('mis-pedidos') ?>'; 
            } else {
                alert('Error: ' + data.mensaje);
                btn.innerText = 'Procesar Pedido';
                btn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Falló la conexión con el servidor.');
            btn.innerText = 'Procesar Pedido';
            btn.disabled = false;
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>