<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Especialidad extends BaseController
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
        $this->validation = \Config\Services::validation();
        $this->TipoSocio= new \App\Models\TipoSocio();
        $this->SocioModel = new \App\Models\SocioModel();
        $this->codUbigeoModel = new \App\Models\CodUbigeoModel();
        $this->EspecialidadModel = new \App\Models\EspecialidadModel();
        $this->Sede = new \App\Models\SedeModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }
    
    public function index()
    {
     
       
           $data = ['titulo' => "Especialidades SPO",
                   'especialidades'=>$this->EspecialidadModel->findAll(),
                  ];
          
           return view('Admin/Especialidad/index', $data);
    }
}
