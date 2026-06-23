<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Home extends BaseController
{
public function index()
    {
        $productModel = new \App\Models\ProductModel();
        $categoryModel = new \App\Models\CategoryModel();

        $buscar      = $this->request->getGet('buscar');
        $categoriaId = $this->request->getGet('categoria');

        if ($buscar) {
            $productModel->like('nombre', $buscar);
        }

        if ($categoriaId) {
            $productModel->where('categoria_id', $categoriaId);
        }

        $data['productos'] = $productModel->paginate(12);
        $data['pager']     = $productModel->pager;
        $data['categorias'] = $categoryModel->findAll();

        $data['buscar'] = $buscar;

        return view('catalogo_publico', $data);
    }

    public function acercaDe()
    {
        return view('acerca_de');
    }
}

