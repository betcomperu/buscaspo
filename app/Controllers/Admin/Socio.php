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
        $this->TipoSocio = new \App\Models\TipoSocio();
        $this->SocioModel = new \App\Models\SocioModel();
        $this->codUbigeoModel = new \App\Models\CodUbigeoModel();
        $this->EspecialidadModel = new \App\Models\EspecialidadModel();
        $this->Sede = new \App\Models\SedeModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }

    public function index($condicion = 1)
    {
        //

        //  $socios = $this->SocioModel->select('*')->where('condicion', $condicion)->findAll();
        $tiposocio = $this->TipoSocio->getTipoSocios();
        $especialidad = $this->EspecialidadModel->getEspecialidades();
        $especialidadesArray = [];
        foreach ($especialidad as $especial) {
            $especialidadesArray[$especial['idEspecialidad']] = $especial['descripcion'];
        } //dd($especialidadesArray);
        $sedes = $this->Sede->getSedes();
        $sedesArray = [];
        foreach ($sedes as $sede) {
            $sedesArray[$sede['idSede']] = $sede['sede']; // Ajusta según la estructura de tus datos
        }
        $sociotipo = [];
        foreach ($tiposocio as $socio) {
            $sociotipo[$socio['idTipoSocio']] = $socio['descripcion'];
        }
        //  
        $data = [
            'titulo' => "Socios SPO",
            'sociotipo' => $sociotipo,
            'especialidadesArray' => $especialidadesArray,
            'socios' => $this->SocioModel->select('*')->where('condicion', $condicion)->findAll(),
            'tiposocio' => $tiposocio,
            'espe' => $especialidad,
            'sedes' => $sedesArray
        ];
        //dd($data);
        return view('Admin/Socio/index', $data);
    }
    public function eliminados($condicion = 2)
    {

        $socio = $this->SocioModel->select('*')->where('condicion', $condicion)->findAll();
        //   $especialidad = $this->EspecialidadModel->findAll();
        $data = [
            'titulo' => "Socios Eliminados SPO",

            'socios' => $socio
        ];
        return view('Admin/Socio/index', $data);
    }
    public function ingresar()
    {
        //
        $socio = $this->SocioModel->findAll();
        $tiposocio = $this->TipoSocio->getTipoSocios();
        $especialidad = $this->EspecialidadModel->getEspecialidades();
        $sede = $this->Sede->getSedes();

        $data = [

            'titulo' => 'Ingreso de Socio',
            'tiposocio' => $tiposocio,
            'espe' => $especialidad,
            'sede' => $sede,
            'socio' => $socio
        ];
        //       dd($data);
        return view('Admin/Socio/ingresar', $data);
    }
    public function grabaingreso()
    {
        $validation = service('validation');
        // Validar los campos del formulario
        $validation->setRules([
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
                'rules' => 'required',
                'errors' => [
                    'required' => 'La Sede es Obligatorio',
                    // 'in_list' => 'Debe de elegir un Tipo de Socio ',
                ],
            ],
            'tipoSocio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El Tipo de Socio es Obligatorio',
                    // 'in_list' => 'Debe de elegir un Tipo de Socio ',
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
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // dd($validation->getErrors());
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $img = $this->request->getFile('foto');
        //dd($img);
        if ($img->getError() === 4) {
            if ($imageName = 'dafault.png');
        } else {
            $imageName = $img->getRandomName();
            $img->move('uploads/', $imageName);
        }


        $data = [
            'dni' => $this->request->getPost('dni'),
            'nombre' => $this->request->getPost('nombre'),
            'apPaterno' => $this->request->getPost('apPaterno'),
            'apMaterno' => $this->request->getPost('apMaterno'),
            'CMP' => $this->request->getPost('CMP'),
            'RNE' => $this->request->getPost('RNE'),
            'especialidad' => implode(',', $this->request->getPost('especialidad')),
            'fecNac' => $this->request->getPost('fecNac'),
            'foto' => $imageName,
            'tipoSocio' => $this->request->getPost('tipoSocio'),
            'domicilio' => $this->request->getPost('domicilio'),
            'sede' => $this->request->getPost('sede'),
            'email' => $this->request->getPost('email'),
            'telef' => $this->request->getPost('telef'),
            'condicion' => $this->request->getPost('condicion')
        ];
            //  dd($data);

        ;
        if (!$this->SocioModel->insert($data)) {
            $errors = $this->SocioModel->errors();
            echo $errors;
        } else {
            $this->session->setflashdata('registrado', "A registrado un Inmueble correctamente");
            //    $sql = $this->SocioModel->getLastQuery(); // Obtener la última consulta ejecutada
            //  dd($sql);
            return redirect()->to(base_url() . '/panel/socio');
        }
    }

    //---------------------------------------------------------------




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
