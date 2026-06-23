<?php

namespace App\Controllers;

use App\Models\PedidoModel;
use App\Models\DetallePedidoModel;

class Logistica extends BaseController
{
    public function index()
    {
        // Candado: Solo entra el repartidor o el administrador
        if (!in_array(session()->get('rol'), ['repartidor', 'gestor_logistica', 'administrador'])) {
            return redirect()->to('/');
        }

        $pedidoModel = new PedidoModel();
        $detalleModel = new DetallePedidoModel();

        // Traemos los pedidos con el nombre del cliente, ordenados para que los "entregados" se vayan al fondo
        $pedidos = $pedidoModel->select('pedidos.*, usuarios.nombre as cliente, usuarios.email as contacto')
                               ->join('usuarios', 'usuarios.id = pedidos.usuario_id')
                               ->orderBy("FIELD(estado, 'en preparacion', 'pendiente', 'en camino', 'entregado')")
                               ->orderBy('fecha_pedido', 'DESC')
                               ->findAll();

        // Adjuntamos el detalle de productos a cada pedido
        foreach ($pedidos as &$pedido) {
            $pedido['items'] = $detalleModel->select('detalle_pedidos.*, productos.nombre as producto_nombre')
                                            ->join('productos', 'productos.id = detalle_pedidos.producto_id')
                                            ->where('pedido_id', $pedido['id'])
                                            ->findAll();
        }

        $data['pedidos'] = $pedidos;

        return view('logistica/logistica_index', $data);
    }

    // Función para que el repartidor actualice el estado del pedido
    public function cambiarEstado($id, $nuevoEstado)
    {
        if (!in_array(session()->get('rol'), ['repartidor', 'gestor_logistica', 'administrador'])) {
            return redirect()->to('/');
        }

        $pedidoModel = new PedidoModel();
        
        // Verificamos que el estado sea válido por seguridad
        $estadosValidos = ['pendiente', 'en preparacion', 'en camino', 'entregado'];
        if (in_array($nuevoEstado, $estadosValidos)) {
            $pedidoModel->update($id, ['estado' => $nuevoEstado]);
        }

        return redirect()->to('/logistica')->with('success', 'Estado del pedido #' . $id . ' actualizado a: ' . strtoupper($nuevoEstado));
    }
}