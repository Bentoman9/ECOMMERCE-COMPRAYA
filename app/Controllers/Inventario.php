<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Inventario extends BaseController
{
    public function index()
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $productModel = new \App\Models\ProductModel();
        
        // 1. Capturamos lo que el usuario escriba en el buscador (por URL)
        $buscar = $this->request->getGet('buscar');

        // 2. Si hay algo escrito, le decimos al modelo que filtre por nombre
        if ($buscar) {
            $productModel->like('nombre', $buscar);
        }

        // Paginamos los resultados (filtre o no filtre, esto sigue funcionando igual)
        $data['productos'] = $productModel->paginate(10);
        $data['pager'] = $productModel->pager;
        
        // Mandamos la palabra buscada a la vista para que el input no se borre
        $data['buscar'] = $buscar;

        return view('inventario/index', $data);
    }

    // Mostrar el formulario para crear un producto
    public function create()
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $categoryModel = new \App\Models\CategoryModel();
        
        // Mandamos las categorías a la vista para armar el <select>
        $data['categorias'] = $categoryModel->findAll();

        return view('inventario/create', $data);
    }

    // Procesar los datos y la imagen
    public function store()
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $productModel = new \App\Models\ProductModel();

        // 1. Manejo de la imagen
        $archivoImagen = $this->request->getFile('imagen');
        $nombreImagen = 'default.jpg'; // Valor por defecto si no suben nada

        // Verificamos si subieron un archivo válido y si no hubo errores
        if ($archivoImagen && $archivoImagen->isValid() && !$archivoImagen->hasMoved()) {
            // Generamos un nombre aleatorio para que no choquen imágenes con el mismo nombre
            $nombreImagen = $archivoImagen->getRandomName();
            // Movemos la imagen a public/uploads/
            $archivoImagen->move(FCPATH . 'uploads', $nombreImagen);
        }

        // 2. Preparar los datos para la BD
        $datos = [
            'categoria_id' => $this->request->getPost('categoria_id'),
            'nombre'       => $this->request->getPost('nombre'),
            'descripcion'  => $this->request->getPost('descripcion'),
            'precio'       => $this->request->getPost('precio'),
            'stock'        => $this->request->getPost('stock'),
            'imagen'       => $nombreImagen
        ];

        // 3. Guardar y redirigir con mensaje de éxito
        $productModel->insert($datos);
        
        session()->setFlashdata('success', 'Producto agregado correctamente.');
        return redirect()->to('/inventario');
    }
    // Mostrar el formulario de edición con los datos cargados
    public function edit($id)
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $productModel = new \App\Models\ProductModel();
        $categoryModel = new \App\Models\CategoryModel();

        $data['producto'] = $productModel->find($id);
        $data['categorias'] = $categoryModel->findAll();

        // Si por alguna razón el producto no existe, lo regresamos al panel
        if (!$data['producto']) {
            return redirect()->to('/inventario')->with('error', 'El producto no existe.');
        }

        return view('inventario/edit', $data);
    }

    // Procesar la actualización en la base de datos
    public function update($id)
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $productModel = new \App\Models\ProductModel();
        $productoViejo = $productModel->find($id);

        $archivoImagen = $this->request->getFile('imagen');
        $nombreImagen = $productoViejo['imagen']; // Por defecto, mantenemos la imagen anterior

        // Si el usuario subió una imagen nueva, la reemplazamos
        if ($archivoImagen && $archivoImagen->isValid() && !$archivoImagen->hasMoved()) {
            $nombreImagen = $archivoImagen->getRandomName();
            $archivoImagen->move(FCPATH . 'uploads', $nombreImagen);
        }

        $datos = [
            'categoria_id' => $this->request->getPost('categoria_id'),
            'nombre'       => $this->request->getPost('nombre'),
            'descripcion'  => $this->request->getPost('descripcion'),
            'precio'       => $this->request->getPost('precio'),
            'stock'        => $this->request->getPost('stock'),
            'imagen'       => $nombreImagen
        ];

        $productModel->update($id, $datos);
        
        return redirect()->to('/inventario')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar el producto
    public function delete($id)
    {
        if (!in_array(session()->get('rol'), ['gestor_inventario', 'administrador'])) {
            return redirect()->to('/');
        }

        $productModel = new \App\Models\ProductModel();
        $productModel->delete($id);

        return redirect()->to('/inventario')->with('success', 'Producto eliminado del sistema.');
    }
}

