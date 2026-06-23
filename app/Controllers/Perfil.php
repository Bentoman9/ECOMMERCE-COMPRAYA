<?php

namespace App\Controllers;

use App\Models\UserModel;

class Perfil extends BaseController
{
    // Mostrar el formulario con los datos actuales
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $userModel = new UserModel();
        // Buscamos al usuario por el ID que está guardado en la sesión
        $data['usuario'] = $userModel->find(session()->get('id'));

        return view('editar_perfil', $data);
    }

    // Procesar la actualización de los datos
    public function update()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('/auth/login');

        $userModel = new UserModel();
        $idUsuario = session()->get('id');

        $datosActualizados = [
            'nombre' => $this->request->getPost('nombre'),
            'email'  => $this->request->getPost('email')
        ];

        // Actualizamos en la base de datos
        $userModel->update($idUsuario, $datosActualizados);

        // MUY IMPORTANTE: Actualizamos también los datos de la sesión 
        // para que el Navbar muestre el nuevo nombre de inmediato sin tener que revivir el login
        session()->set('nombre', $datosActualizados['nombre']);
        session()->set('email', $datosActualizados['email']);

        return redirect()->to('/perfil')->with('success', 'Perfil actualizado correctamente.');
    }
}