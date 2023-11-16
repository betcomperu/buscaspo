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
        // Validar los campos del formulario
  $reglas = [
      'dni' => [
          'rules' => 'required|is_natural|exact_length[8]|is_unique[socio.dni]',
          'errors' => [
              'required' => 'El DNI es un campo Obligatorio.',
              'is_natural' => 'El DNI debe contener sólo numeros.',
              'exact_length' => 'El DNI debe tener 8 digitos exactamente.',
              'is_unique' => 'El DNI ingresado esta registrado.',
          ],
      ],
      'nombre' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'El Nombre es un campo Obligatorio.',
              'custom_alpha_space' => 'El Nombre debe contener letras no numeros.',
          ],
      ],
      'apPaterno' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'El apellido paterno es un campo Obligatorio.',
              'custom_alpha_space' => 'El Nombre debe contener letras no numeros.',
          ],
      ],
      'apMaterno' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'El apellido materno es un campo Obligatorio.',
              'custom_alpha_space' => 'El Nombre debe contener letras no numeros.',
          ],
      ],
      'CMP' => [
          'rules' => 'required|is_natural',
          'errors' => [
              'required' => 'El numero CMP es un campo Obligatorio.',
              'is_natural' => 'El CMP debe contener sólo numeros.',
          ],
      ],
      'RNE' => [
          'rules' => 'required|is_natural',
          'errors' => [
            'required' => 'El numero RNE es un campo Obligatorio.',
            'is_natural' => 'El RNE debe contener sólo numeros.',
          ],
      ],
      'especialidad' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'Seleccione al menos una Especialidad.',
          ],
      ],
      'fecNac' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'La fecha de nacimiento es Obligatorio',
          ],
      ],
      'sede' => [
        'rules' => 'in_list[1,2,3,4]',
        'errors' => [
            'required' => 'La Sede es Obligatorio',
            'in_list' => 'Debe de elegir un Tipo de Socio ',
        ],
    ],
      'tiposocio' => [
          'rules' => 'required|in_list[1,2,3,4]',
          'errors' => [
              'required' => 'El Tipo de Socio es Obligatorio',
              'in_list' => 'Debe de elegir un Tipo de Socio ',
          ],
      ],
      'domicilio' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'El domicilio es Obligatorio',
          ],
      ],
      'email' => [
          'rules' => 'required|valid_email',
          'errors' => [
              'required' => 'El Email es un campo Obligatorio',
              'valid_email' => 'El Email debe ser un email válido',
          ],
      ],
      'telef' => [
          'rules' => 'required',
          'errors' => [
              'required' => 'El numero telefono es Obligatorio',
          ],
      ],
      'condicion' => [
          'rules' => 'required|in_list[1,2]',
          'errors' => [
              'required' => 'La condición del Socio es Obligatorio.',
              'in_list' => 'Debe de elegir entre Habilitado e Inhabilitado ',
          ],
      ],
  ];
    

//---------------------------------------------------------------

        if ($this->validate($reglas)) {
            // Los campos son válidos, puedes guardar los datos en la base de datos
            $data = [
                'dni' => $this->request->getPost('dni'),
                'nombre' => $this->request->getPost('nombre'),
                'apPaterno' => $this->request->getPost('apPaterno'),
                'apMaterno' => $this->request->getPost('apMaterno'),
                'CMP' => $this->request->getPost('CMP'),
                'RNE' => $this->request->getPost('RNE'),
                'especialidad' => $this->request->getPost('especialidad'),
                'fecNac' => $this->request->getPost('fecNac'),
            //    'foto' => $this->request->getPost('foto'),
                'tiposocio' => $this->request->getPost('tiposocio'),
                'domicilio' => $this->request->getPost('domicilio'),
                'sede' => $this->request->getPost('sede'),
                'email' => $this->request->getPost('email'),
                'telef' => $this->request->getPost('telef'),
                'condicion' => $this->request->getPost('condicion')
            ];

            // Guardar los datos en la base de datos
            // Redireccionar a la página de éxito
            return redirect()->to('success');
        } else {
            // Los campos no son válidos, redireccionar de vuelta al formulario con los errores de validación
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }


    public function ver()
    {
        
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
