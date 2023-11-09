<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Socio extends BaseController
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
    
    public function index($condicion= null)
    {
        //
        $socio = $this->SocioModel->findAll();
     //   $especialidad = $this->EspecialidadModel->findAll();
        $data = ['titulo' => "Socios SPO",
                   
                'socios' => $this->SocioModel->getSocioEspecialidad()];
       
        return view('Admin/Socio/index', $data);
      
    }
       public function ingresar()
    {
        //
        $socio = $this->SocioModel->findAll();
        $tiposocio = $this->TipoSocio->findAll();
        $especialidad = $this->EspecialidadModel->findAll();
        $sede = $this->Sede->findAll();
        $data=[
             
            'titulo'=> 'Ingreso de Socio',
            'tiposocio'=>$tiposocio,
            'espe'=>$especialidad,   
            'sede'=>$sede 
        ];
        return view('Admin/Socio/ingresar', $data);
    }
    public function grabaingreso()
    {
        //
        return view('Admin/Socio/index');
    }
    public function editar()
    {
        //
        return view('Admin/Socio/index');
    }
    public function grabaeditar()
    {
        //
        return view('Admin/Socio/index');
    }
    public function eliminar()
    {
        //
        return view('Admin/Socio/index');
    }
}
