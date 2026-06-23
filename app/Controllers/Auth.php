<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function storeRegister()
    {
        $nombre   = $this->request->getPost('nombre');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $passwordEncriptado = password_hash($password, PASSWORD_BCRYPT);

        $userModel = new UserModel();

        $usuarioExistente = $userModel->where('email', $email)->first();

        if ($usuarioExistente) {
            return redirect()->back()->with('error', 'El correo electrónico ya está registrado.');
        }

        $datosUsuario = [
            'nombre'   => $nombre,
            'email'    => $email,
            'password' => $passwordEncriptado,
            'rol'      => 'cliente' 
        ];

        
        if ($userModel->insert($datosUsuario)) {
            return redirect()->to('/auth/login');
        } else {
            return "Hubo un error al registrar al usuario.";
        }
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $session = session();
        $userModel = new UserModel();

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $usuario = $userModel->where('email', $email)->first();

        if ($usuario) {
            if (password_verify($password, $usuario['password'])) {
                
                $sesionData = [
                    'id'         => $usuario['id'],
                    'nombre'     => $usuario['nombre'],
                    'email'      => $usuario['email'],
                    'rol'        => $usuario['rol'],
                    'isLoggedIn' => true
                ];
                $session->set($sesionData);


                if ((session()->get('rol') == 'administrador') || (session()->get('rol') == 'gestor_inventario')) {
                    return redirect()->to('panel');
                }
                elseif (session()->get('rol') == 'gestor_logistica')
                {
                    return redirect()->to('logistica'); 
                }
                else {
                    return redirect()->to('/');
                }
                
            } else {
                // Contraseña incorrecta
                $session->setFlashdata('error', 'Contraseña incorrecta. Inténtalo de nuevo.');
                return redirect()->to('/auth/login');
            }
        } else {
            // El correo no existe
            $session->setFlashdata('error', 'El correo electrónico no está registrado.');
            return redirect()->to('/auth/login');
        }
    }
    // Destruir la sesión (Cerrar sesión)
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
