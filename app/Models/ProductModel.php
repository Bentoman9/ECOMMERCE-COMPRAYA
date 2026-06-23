<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'productos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['categoria_id', 'nombre', 'descripcion', 'precio', 'stock', 'imagen'];
    protected $useTimestamps    = false;
}