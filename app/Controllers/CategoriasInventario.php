<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class CategoriasInventario extends BaseController
{
    // Listar categorías
    public function index()
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $categoryModel = new CategoryModel();
        $buscar = $this->request->getGet('buscar');

        if ($buscar) {
            $categoryModel->like('nombre', $buscar);
        }
        
        $data['categorias'] = $categoryModel->paginate(5);
        $data['pager'] = $categoryModel->pager;
        $data['buscar'] = $buscar;

        return view('inventario/categorias_index', $data);
    }

    // NUEVA: Renderizar vista para crear categoría
    public function crear()
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }
        return view('inventario/categorias_crear');
    }

    // Procesar la creación de una nueva categoría
    public function store()
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $categoryModel = new CategoryModel();
        $categoryModel->save([
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);

        return redirect()->to('/inventario/categorias')->with('success', 'Categoría creada con éxito.');
    }

    // NUEVA: Renderizar vista para editar categoría
    public function editar($id)
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $categoryModel = new CategoryModel();
        $data['categoria'] = $categoryModel->find($id);

        if (!$data['categoria']) {
            return redirect()->to('/inventario/categorias')->with('error', 'La categoría no existe.');
        }

        return view('inventario/categorias_editar', $data);
    }

    // Procesar la edición
    public function update($id)
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $categoryModel = new CategoryModel();
        $categoryModel->update($id, [
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion')
        ]);

        return redirect()->to('/inventario/categorias')->with('success', 'Categoría actualizada correctamente.');
    }

    // Eliminar categoría
    public function delete($id)
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $categoryModel = new CategoryModel();
        
        try {
            $categoryModel->delete($id);
            return redirect()->to('/inventario/categorias')->with('success', 'Categoría eliminada del sistema.');
        } catch (\Exception $e) {
            return redirect()->to('/inventario/categorias')->with('error', 'No se puede eliminar la categoría porque tiene productos asociados.');
        }
    }
}