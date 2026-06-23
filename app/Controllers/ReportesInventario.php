<?php

namespace App\Controllers;

use App\Models\PedidoModel;
use App\Models\DetallePedidoModel;

class ReportesInventario extends BaseController
{
    public function index()
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $pedidoModel = new PedidoModel();
        $detalleModel = new DetallePedidoModel();

        $estado = $this->request->getGet('estado');

        $query = $pedidoModel->select('pedidos.*, usuarios.nombre as cliente')
                             ->join('usuarios', 'usuarios.id = pedidos.usuario_id');

        if (!empty($estado)) {
            $query->where('pedidos.estado', $estado);
        }

        $pedidos = $query->orderBy('pedidos.fecha_pedido', 'DESC')
                         ->findAll();

        $totalGeneral = 0;

        foreach ($pedidos as &$pedido) {
            $totalGeneral += $pedido['total'];

            $pedido['items'] = $detalleModel->select('detalle_pedidos.*, productos.nombre as producto_nombre')
                                            ->join('productos', 'productos.id = detalle_pedidos.producto_id')
                                            ->where('pedido_id', $pedido['id'])
                                            ->findAll();
        }

        $data['pedidos'] = $pedidos;
        $data['totalGeneral'] = $totalGeneral;

        return view('inventario/reportes_index', $data);
    }
}