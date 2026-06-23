<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidoModel extends Model
{
    protected $table            = 'pedidos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // Solo permitimos editar el estado (el total y el usuario no se tocan)
    protected $allowedFields    = ['usuario_id', 'total', 'estado', 'fecha_pedido'];
    protected $useTimestamps    = false;
}