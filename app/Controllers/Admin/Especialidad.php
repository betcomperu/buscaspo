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
    
    public function index($condicion=1)
    {
     
       
           $data = ['titulo' => "Especialidades SPO",
                   'especialidades'=>$this->EspecialidadModel->select('*')->where('sitReg', $condicion)->findAll(),
                  ];
          
           return view('Admin/Especialidad/index', $data);
    }
    public function nuevo()
    {
        $data = ['titulo' => "Agregar Especialidad SPO",
        
       ];
        return view('Admin/Especialidad/nuevo', $data);
    }
  public function grabar()
  {
   // Obtén los datos del formulario
   $descripcion = $this->request->getPost('descripcion');
   $sitReg = $this->request->getPost('sitReg');

   // Validación de datos
   $validation = \Config\Services::validation();
   $validation->setRules($this->EspecialidadModel->reglas);
   $validation->run($this->request->getPost());

   if ($validation->hasError('descripcion') || $validation->hasError('sitReg')) {
       // Almacena los errores y los mensajes de error del modelo en la sesión
       session()->setFlashdata('errors', $validation->getErrors());
       session()->setFlashdata('modelErrors', $this->EspecialidadModel->reglasmensajes);

       // Redirige de vuelta al formulario con los errores y los datos del formulario
       return redirect()->to('panel/especialidades/nuevo')->withInput();
   }

   // Crear una instancia del modelo
   $especialidadModel = new $this->EspecialidadModel();

   // Insertar en la base de datos
   $data = [
       'descripcion' => $descripcion,
       'sitReg' => $sitReg,
   ];

   $especialidadModel->insert($data);

   // Redirigir a una página de éxito o a donde sea necesario
   return redirect()->to('panel/especialidades/nuevo');
}
public function eliminados($condicion=0)
{
    $data = ['titulo' => "Especialidades SPO Eliminadas",
    'especialidades'=>$this->EspecialidadModel->select('*')->where('sitReg', $condicion)->findAll(),
   ];

return view('Admin/Especialidad/index', $data);   
}
public function eliminar($id)
{
   // $id = $this->request->getPost('idEspecialidad');
    $this->EspecialidadModel->update($id, ['sitReg' => 0]);
    return redirect()->to('panel/especialidades/eliminados');
}
public function activar($id){
    $this->EspecialidadModel->update($id, ['sitReg' => 1]);
    return redirect()->to('panel/especialidades');
  }
  public function editar($id=null){
    $data = ['titulo' => "Editar Especialidad SPO",
    'especialidad'=>$this->EspecialidadModel->select('*')->where('idEspecialidad', $id)->first($id),
   ];
   return view('Admin/Especialidad/editar', $data);
      
  }
  public function actualizar(){
    // Obtener los valores del formulario
    $id = $this->request->getPost('idEspecialidad');
    $descripcion = $this->request->getPost('descripcion');
    $sitReg = $this->request->getPost('sitReg');
    // Validar que el nombre no esté repetido
    $validation = \Config\Services::validation();
    $validation->setRules($this->EspecialidadModel->reglas);
    $validation->run($this->request->getPost());
    if ($validation->hasError('descripcion') || $validation->hasError('sitReg')) {
        // Almacena los errores y los mensajes de error del modelo en la sesión
        session()->setFlashdata('errors', $validation->getErrors());
        session()->setFlashdata('modelErrors', $this->EspecialidadModel->reglasmensajes);
        // Redirige de vuelta al formulario con los errores y los datos del formulario
        return redirect()->to('panel/especialidades/editar/'.$id)->withInput();
        } else {
        // Crear una instancia del modelo
        $especialidadModel = new $this->EspecialidadModel();
        // Insertar en la base de datos
        $data = [
            'idEspecialidad' => $id,
            'descripcion' => $descripcion,
            'sitReg' => $sitReg,
        ];
        $especialidadModel->update($id, $data);
        // Redirigir a una página de búsqueda o a donde sea necesario
        return redirect()->to('panel/especialidades');
    }
}

}


