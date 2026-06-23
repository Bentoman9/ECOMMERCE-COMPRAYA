<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\PedidoModel;
use App\Models\UserModel;

class Panel extends BaseController
{
    public function index()
    {
        $rol = session()->get('rol');

        // Solo permitimos el ingreso al Admin y al Gestor
        if (!in_array($rol, ['administrador', 'gestor_inventario'])) {
            return redirect()->to('/');
        }

        $productModel  = new ProductModel();
        $categoryModel = new CategoryModel();
        $pedidoModel   = new PedidoModel();
        $userModel     = new UserModel();

        // Contamos los totales para mostrarlos en las tarjetas
        $data['totalProductos']  = $productModel->countAllResults();
        $data['totalCategorias'] = $categoryModel->countAllResults();
        $data['totalPedidos']    = $pedidoModel->countAllResults();
        
        // Si es administrador, contamos los usuarios. Si no, mandamos 0.
        $data['totalUsuarios']   = ($rol === 'administrador') ? $userModel->countAllResults() : 0;

        return view('panel_inicio', $data);
    }
}