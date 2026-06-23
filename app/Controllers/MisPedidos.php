<?php

namespace App\Controllers;

use App\Models\PedidoModel;
use App\Models\DetallePedidoModel;

class MisPedidos extends BaseController
{
    public function index()
    {
        if (session()->get('rol') !== 'cliente') return redirect()->to('/');

        $pedidoModel = new PedidoModel();
        $detalleModel = new DetallePedidoModel();
        
        $pedidos = $pedidoModel->where('usuario_id', session()->get('id'))
                               ->orderBy('fecha_pedido', 'DESC')
                               ->findAll();

        foreach ($pedidos as &$pedido) {
            // Hacemos JOIN para traer el nombre del producto real de la BD
            $pedido['detalles'] = $detalleModel->select('detalle_pedidos.*, productos.nombre as producto_nombre')
                                               ->join('productos', 'productos.id = detalle_pedidos.producto_id')
                                               ->where('pedido_id', $pedido['id'])
                                               ->findAll();
        }

        $data['pedidos'] = $pedidos;

        return view('mis_pedidos', $data);
    }
}