<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use Config\Services\session;

class Login extends BaseController
{
    private $users;
    private $session;
    public function __construct()
    {

        $this->users = new UsuarioModel(); // Usar $this->users
        $this->session = \Config\Services::session();
        helper(['form', 'url']); // Ajuste en la carga de helpers
    }
    public function index()
    {
        //
        $data = ['titulo' => "Login Adminstrador"];
        return view('admin/login/login', $data);
    }

    public function logearse()
    {
        // Verificar si el usuario ya ha iniciado sesión
        if (session()->get('isLoggedIn')) {
            return redirect()->to(site_url('panel/')); // Redirigir al panel de administración u otra página
        }
        $usuario = $this->request->getVar('usuario');
        $clave = (string) $this->request->getVar('clave');

        $usuariosConPerfil = $this->users->obtenerUsuariosConPerfil();

        $usuarioEncontrado = null;

        foreach ($usuariosConPerfil as $user) {
            if ($user->usuario === $usuario) {
                $usuarioEncontrado = $user;
                break;
            }
        }

        if ($usuarioEncontrado === null) {
            $sessError = ['errUsuario' => 'Este usuario no es válido'];
            session()->setFlashdata($sessError);
            return redirect()->to(site_url('/'));
        }

        $claveEncriptada = $usuarioEncontrado->clave;

        if (!password_verify($clave, $claveEncriptada)) {
            $sessPassword = ['errPassword' => 'La contraseña no es válida'];
            session()->setFlashdata($sessPassword);
            return redirect()->to(site_url('/'));
        }

        // Usuario autenticado correctamente
        $data = [
            'idUsuario' => $usuarioEncontrado->idUsuario,
            'nombre' => $usuarioEncontrado->nombre,
            'email' => $usuarioEncontrado->email,
            'usuario' => $usuarioEncontrado->usuario,
            'idPerfil' => $usuarioEncontrado->idPerfil,
            'Perfil' => $usuarioEncontrado->descripcion, // Asumiendo que 'descripcion' es el nombre del perfil
            'isLoggedIn' => true,
        ];

        session()->set($data);
     //   dd($_SESSION);
        return redirect()->to(site_url('panel/'));
    }

    public function salir()
    {

        $session = session();
        $session->destroy();
        return redirect()->to(base_url() . '');
    }
}
