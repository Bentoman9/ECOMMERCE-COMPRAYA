<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminUsuarios extends BaseController
{
    public function index()
    {
        if (session()->get('rol') !== 'administrador') return redirect()->to('/');

        $userModel = new UserModel();

        $data['usuarios'] = $userModel->paginate(10);
        $data['pager'] = $userModel->pager;

        return view('admin/usuarios_index', $data);
    }

    public function store()
    {
        if (session()->get('rol') !== 'administrador') return redirect()->to('/');

        $userModel = new UserModel();
        
        $datosUsuario = [
            'nombre'   => $this->request->getPost('nombre'),
            'email'    => $this->request->getPost('email'),
            // Encriptamos la contraseña por seguridad
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'rol'      => $this->request->getPost('rol')
        ];

        $userModel->save($datosUsuario);
        return redirect()->to('/admin/usuarios')->with('success', 'Usuario registrado con éxito.');
    }

    public function update($id)
    {
        if (session()->get('rol') !== 'administrador') return redirect()->to('/');

        $userModel = new UserModel();
        
        $datosUsuario = [
            'nombre' => $this->request->getPost('nombre'),
            'email'  => $this->request->getPost('email'),
            'rol'    => $this->request->getPost('rol')
        ];

        $nuevaPassword = $this->request->getPost('password');
        if (!empty($nuevaPassword)) {
            $datosUsuario['password'] = password_hash($nuevaPassword, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $datosUsuario);
        return redirect()->to('/admin/usuarios')->with('success', 'Datos del usuario actualizados.');
    }

    public function delete($id)
    {
        if (session()->get('rol') !== 'administrador') return redirect()->to('/');

        if ($id == session()->get('id')) {
            return redirect()->to('/admin/usuarios')->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $userModel = new UserModel();
        $userModel->delete($id);
        
        return redirect()->to('/admin/usuarios')->with('success', 'Usuario eliminado correctamente.');
    }
}