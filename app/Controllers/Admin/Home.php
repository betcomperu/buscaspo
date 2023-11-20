<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\BaseConnection;


class Home extends BaseController
{
    protected $SocioModel;
    protected $codUbigeoModel;
    protected $EspecialidadModel;
    protected $session;
    protected $validation;
    protected $TipoSocio;
    protected $Sede;

    public function __construct()
    {
      //  $this->validation = \Config\Services::validation();
      //  $this->TipoSocio = new \App\Models\TipoSocio();
        $this->SocioModel = new \App\Models\SocioModel();
      //  $this->codUbigeoModel = new \App\Models\CodUbigeoModel();
     //   $this->EspecialidadModel = new \App\Models\EspecialidadModel();
      //  $this->Sede = new \App\Models\SedeModel();
     //   $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        //Para Mostrar Cantidad de Socios
        $getCantSocios = $this->SocioModel->getCantSocios();
        $data = [
            'titulo' => 'Home' ,
            'CantSocios' =>$getCantSocios     
        ]   ;
        return view('Admin/Home/index',$data);
    }
   
}
