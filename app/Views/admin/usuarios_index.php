<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios - COMPRAYA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white" href="<?= base_url('panel'); ?>">⚙️ COMPRAYA | Panel</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuAdmin">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="menuAdmin">
                <div class="navbar-nav me-auto">
                    <a class="nav-link text-white-50" href="<?= base_url('inventario'); ?>"> Productos</a>
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/categorias'); ?>"> Categorías</a>
                    <a class="nav-link text-white-50" href="<?= base_url('inventario/reportes'); ?>"> Reporte Pedidos</a>
                    
                    <?php if(session()->get('rol') == 'administrador'): ?>
                        <a class="nav-link text-white fw-bold active ms-lg-3" href="<?= base_url('admin/usuarios'); ?>"> Gestión de Usuarios</a>
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
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <h3 class="fw-bold text-dark mb-0">Control de Usuarios y Roles</h3>
            <button class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm w-100 w-md-auto py-2" data-bs-toggle="modal" data-bs-target="#modalCrearUsuario">+ Nuevo Usuario</button>
        </div>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success border-0 shadow-sm"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger border-0 shadow-sm"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                        <thead class="table-dark">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="py-3">Nombre</th>
                                <th class="py-3">Correo Electrónico</th>
                                <th class="py-3">Rol del Sistema</th>
                                <th class="text-center py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($usuarios)): ?>
                                <?php foreach($usuarios as $u): ?>
                                    <tr>
                                        <td class="px-4 fw-bold">#<?= $u['id']; ?></td>
                                        <td class="fw-semibold text-dark"><?= esc($u['nombre']); ?></td>
                                        <td class="text-muted"><?= esc($u['email']); ?></td>
                                        <td>
                                            <?php 
                                                $badge = 'bg-secondary';
                                                if($u['rol'] == 'administrador') $badge = 'bg-danger';
                                                if($u['rol'] == 'gestor_inventario') $badge = 'bg-primary';
                                                if($u['rol'] == 'gestor_logistica') $badge = 'bg-info text-dark';
                                                if($u['rol'] == 'cliente') $badge = 'bg-success';
                                            ?>
                                            <span class="badge <?= $badge; ?> rounded-pill px-3 py-1 text-uppercase" style="font-size: 0.75rem;">
                                                <?= str_replace('_', ' ', $u['rol']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <button class="btn btn-sm btn-warning rounded-pill px-3 me-1" data-bs-toggle="modal" data-bs-target="#modalEditar<?= $u['id']; ?>">Editar</button>
                                            <a href="<?= base_url('admin/usuarios/eliminar/' . $u['id']); ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('¿Eliminar definitivamente a este usuario?');">Eliminar</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modalEditar<?= $u['id']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title fw-bold">Editar Perfil y Rol</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="<?= base_url('admin/usuarios/update/' . $u['id']); ?>" method="POST">
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Nombre Completo</label>
                                                            <input type="text" name="nombre" class="form-control" value="<?= esc($u['nombre']); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Correo Electrónico</label>
                                                            <input type="email" name="email" class="form-control" value="<?= esc($u['email']); ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold">Asignar Rol</label>
                                                            <select name="rol" class="form-select" required>
                                                                <option value="cliente" <?= ($u['rol'] == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                                                                <option value="gestor_inventario" <?= ($u['rol'] == 'gestor_inventario') ? 'selected' : ''; ?>>Gestor de Inventario</option>
                                                                <option value="gestor_logistica" <?= ($u['rol'] == 'gestor_logistica') ? 'selected' : ''; ?>>Repartidor / Logística</option>
                                                                <option value="administrador" <?= ($u['rol'] == 'administrador') ? 'selected' : ''; ?>>Administrador Total</option>
                                                            </select>
                                                        </div>
                                                        <hr>
                                                        <div class="mb-3">
                                                            <label class="form-label fw-semibold text-danger">Cambiar Contraseña (Opcional)</label>
                                                            <input type="password" name="password" class="form-control" placeholder="Dejar en blanco para mantener la actual">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-warning fw-bold rounded-pill px-4">Actualizar Usuario</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">No hay usuarios registrados.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <?= $pager->links('default', 'bootstrap_pagination') ?>
        </div>
    </div>

    <div class="modal fade" id="modalCrearUsuario" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold">Registrar Nuevo Usuario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/usuarios/store'); ?>" method="POST">
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre Completo</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contraseña Inicial</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rol del Sistema</label>
                            <select name="rol" class="form-select" required>
                                <option value="cliente">Cliente (Usuario Base)</option>
                                <option value="gestor_inventario">Gestor de Inventario</option>
                                <option value="repartidor">Repartidor (Logística)</option>
                                <option value="administrador">Administrador (Control Total)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary fw-bold rounded-pill px-4">Crear Cuenta</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>