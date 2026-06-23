<?php

namespace App\Controllers;

class Carrito extends BaseController
{
    public function index()
    {
        // Seguridad: Si no es cliente, lo botamos al inicio
        if (session()->get('rol') !== 'cliente') {
            return redirect()->to('/');
        }
        
        return view('carrito');
    }

    public function procesar()
    {
        if (session()->get('rol') !== 'cliente') {
            return $this->response->setJSON(['status' => 'error', 'mensaje' => 'No autorizado']);
        }

        $cart = $this->request->getJSON();

        if (empty($cart)) {
            return $this->response->setJSON(['status' => 'error', 'mensaje' => 'El carrito está vacío']);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += ($item->precio * $item->cantidad);
        }

        $pedidoModel = new \App\Models\PedidoModel();
        
        $datosPedido = [
            'usuario_id'   => session()->get('id'),
            'total'        => $total,
            'estado'       => 'pendiente',
            'fecha_pedido' => date('Y-m-d H:i:s')
        ];

        $pedidoId = $pedidoModel->insert($datosPedido, true);

        if ($pedidoId) {
            $detalleModel = new \App\Models\DetallePedidoModel();
            $productModel = new \App\Models\ProductModel(); // <-- Instanciamos el modelo de productos
            
            // Recorremos el carrito para guardar el detalle y reducir el stock
            foreach ($cart as $item) {
                
                // 1. Guardamos el detalle del pedido
                $detalleModel->insert([
                    'pedido_id'       => $pedidoId,
                    'producto_id'     => $item->id, 
                    'cantidad'        => $item->cantidad,
                    'precio_unitario' => $item->precio
                ]);

                // 2. REDUCIR EL STOCK DEL PRODUCTO
                $productoDB = $productModel->find($item->id); // Buscamos el producto en la BD
                
                if ($productoDB) {
                    $nuevoStock = $productoDB['stock'] - $item->cantidad;
                    
                    // Actualizamos el producto en la base de datos
                    $productModel->update($item->id, ['stock' => $nuevoStock]);
                }
            }

            return $this->response->setJSON(['status' => 'success', 'mensaje' => 'Pedido procesado con éxito']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'mensaje' => 'Hubo un error al guardar el pedido']);
        }
    }
}
