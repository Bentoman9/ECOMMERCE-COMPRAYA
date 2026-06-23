<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Home::index');

// Rutas de Registro
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/storeRegister', 'Auth::storeRegister');

//Rutas del carrito
$routes->get('carrito', 'Carrito::index');
$routes->post('carrito/procesar', 'Carrito::procesar');

//Rutas pedidos
$routes->get('mis-pedidos', 'MisPedidos::index');

// Rutas de Login y Logout
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/loginProcess', 'Auth::loginProcess');
$routes->get('auth/logout', 'Auth::logout');

// Rutas del Gestor de Inventario
$routes->get('inventario', 'Inventario::index');
$routes->get('inventario/crear', 'Inventario::create');
$routes->post('inventario/store', 'Inventario::store');
$routes->get('inventario/editar/(:num)', 'Inventario::edit/$1');
$routes->post('inventario/update/(:num)', 'Inventario::update/$1');
$routes->get('inventario/eliminar/(:num)', 'Inventario::delete/$1');

// Rutas del Gestor de Logística (Repartidor)
$routes->get('logistica', 'Logistica::index');
$routes->get('logistica/cambiarEstado/(:num)/(:segment)', 'Logistica::cambiarEstado/$1/$2');

// Rutas para el Perfil de Usuario
$routes->get('perfil', 'Perfil::index');
$routes->post('perfil/update', 'Perfil::update');

//Acerca de ruta
$routes->get('acerca-de', 'Home::acercaDe');

// Rutas del CRUD de Categorías para el Gestor de Inventario
$routes->get('inventario/categorias', 'CategoriasInventario::index');
$routes->get('inventario/categorias/crear', 'CategoriasInventario::crear');
$routes->post('inventario/categorias/store', 'CategoriasInventario::store');
$routes->get('inventario/categorias/editar/(:num)', 'CategoriasInventario::editar/$1');
$routes->post('inventario/categorias/update/(:num)', 'CategoriasInventario::update/$1');
$routes->get('inventario/categorias/eliminar/(:num)', 'CategoriasInventario::delete/$1');

// Ruta del Reporte de Ventas Globales
$routes->get('inventario/reportes', 'ReportesInventario::index');

//Rutas globales del admin
$routes->get('admin/usuarios', 'AdminUsuarios::index');
$routes->post('admin/usuarios/store', 'AdminUsuarios::store');
$routes->post('admin/usuarios/update/(:num)', 'AdminUsuarios::update/$1');
$routes->get('admin/usuarios/eliminar/(:num)', 'AdminUsuarios::delete/$1');

//Ruta para el panel de inicio wasa
$routes->get('panel', 'Panel::index');