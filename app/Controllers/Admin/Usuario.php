<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Usuario extends BaseController

{
    public function index()
    {
     // Establecer la conexión a la base de datos
     $db = \Config\Database::connect();
        
     // Realizar la consulta a la tabla 'usuario'

    
     $usuarios = $db->query("SELECT * FROM usuario");
     $users = $usuarios->getResult(); // Obtener los resultados de la consulta
     
     // Enviar los datos a la vista 'admin/usuario'
     return view('admin/usuario/usuario', [
         'titulo' => 'Listado de Usuarios',
         'users' => $users
     ]);
 }
}