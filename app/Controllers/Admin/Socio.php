<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SocioModel;
use App\Models\UsuarioModel;

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
        $todasespecialidades = $this->EspecialidadModel->todasEspecialidades();
        $especialidad = $this->EspecialidadModel->getEspecialidades();
        $especialidadesArray = [];
        foreach ($especialidad as $especial) {
            $especialidadesArray[$especial['idEspecialidad']] = $especial['descripcion'];
        }
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
        $getCantSocios = $this->SocioModel->getCantSocios();
        $dato['especialidades'] = $especialidadesArray;
        // Obtener la fecha de nacimiento y formatearla
        // Verificar si la clave 'fecNac' existe en el array $socio
        if (array_key_exists('fecNac', $socio)) {
            // Obtener la fecha de nacimiento y formatearla
            $socio['fecNacFormatted'] = date('d-m-Y', strtotime($socio['fecNac']));
        } else {
            // Si la clave 'fecNac' no existe, asignar un valor predeterminado o manejar de otra manera
            $socio['fecNacFormatted'] = 'Fecha no disponible';
        }


        $data = [
            'titulo' => "Socios SPO",
            'sociotipo' => $sociotipo,
            'especialidadesArray' => $especialidadesArray,
            'socios' => $this->SocioModel->select('*')->where('condicion', $condicion)->findAll(),
            'tiposocio' => $tiposocio,
            'espe' => $especialidad,
            'sedes' => $sedesArray,
            'todasEspecialidades' => $todasespecialidades,
            'getCantSocios' => $getCantSocios
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




    public function ver($id = null)
    {
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
        $getCantSocios = $this->SocioModel->getCantSocios();

        $socio = $this->SocioModel->select('*')->where('idSocio', $id)->first($id);
        // Obtener la fecha de nacimiento y formatearla
        // Verificar si la clave 'fecNac' existe en el array $socio
        if (array_key_exists('fecNac', $socio)) {
            // Obtener la fecha de nacimiento y formatearla
            $socio['fecNacFormatted'] = date('d-m-Y', strtotime($socio['fecNac']));
        } else {
            // Si la clave 'fecNac' no existe, asignar un valor predeterminado o manejar de otra manera
            $socio['fecNacFormatted'] = 'Fecha no disponible';
        }
        //   dd($socio);
        $data = [
            'titulo' => "Perfil de socio",
            'socio' => $socio,
            'sociotipo' => $sociotipo,
            'especialidadesArray' => $especialidadesArray,
            'tiposocio' => $tiposocio,
            'espe' => $especialidad,
            'sedes' => $sedesArray,
            'getCantSocios' => $getCantSocios
        ];
        return view('Admin/Socio/ver2', $data);
    }

    public function editar($id = null)
    {
        //
        $socio = $this->SocioModel->find($id);
        $tiposocio = $this->TipoSocio->getTipoSocios();
        $especialidad = $this->EspecialidadModel->getEspecialidades();
        $sede = $this->Sede->getSedes();
        $file = $this->request->getPost('foto');
        $seleccionSede = $this->request->getPost('sede');
        // Antes de la actualización
        $especialidades = $this->request->getPost('especialidad');
        $data['especialidad'] = is_array($especialidades) ? implode(',', $especialidades) : $especialidades;


        $data = [

            'titulo' => 'Editar Socio',
            'tiposocio' => $tiposocio,
            'espe' => $especialidad,
            'sede' => $sede,
            'socio' => $socio,
            'foto' => $file,
            'seleccionSede' => $seleccionSede
        ];
        //        dd($data);
        return view('Admin/Socio/editar2', $data);
    }
    public function actualizar($id = null)
    {
        $validation = service('validation');
        // Validar los campos del formulario
        $validation->setRules([
            'dni' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El DNI es un campo Obligatorio.'
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
            ]
        ]);

        // Validate the request data
        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, redirect back with errors and input data
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Find the 'foto' item with the given ID
        $foto_item = $this->SocioModel->find($id);

        // If no item is found, redirect to the 'socio' panel
        if (!$foto_item) {
            return redirect()->to(base_url() . '/panel/socio');
        }

        // Store the value of the 'foto' field before any changes
        $old_foto = $foto_item['foto'];

        // Get the uploaded image file
        $img = $this->request->getFile('foto');

        // Initialize $imageName with the existing foto or default value
        $imageName = $old_foto;

        // Check if an image file was uploaded
        if ($img->getError() !== 4) {
            // Delete the previous photo if it's not the default photo and it exists
            // Delete the previous photo if it's not the default photo and it exists
            if ($old_foto != 'dafault.png' && is_file('uploads/' . $old_foto)) {
                unlink('uploads/' . $old_foto);
            }


            // Generate a random name for the uploaded image
            $imageName = $img->getRandomName();

            // Move the uploaded image to the 'uploads/' directory with the generated name
            $img->move('uploads/', $imageName);
        }

        // Antes de la actualización
        $especialidades = $this->request->getPost('especialidad');
        $condicion = $this->request->getPost('condicion');
        // Obtener la condición y la especialidad actual del socio
        $socioActual = $this->SocioModel->find($id);
        // Conservar la condición del socio si no se ha proporcionado una nueva
        $data['condicion'] = $condicion ?: $socioActual['condicion'];
        $data['especialidad'] = is_array($especialidades) ? implode(',', $especialidades) : $especialidades;
        // Conservar la condición del socio si no se ha proporcionado una nueva
        $data['condicion'] = $condicion ?: $socioActual['condicion'];
        $especialidades = $this->request->getPost('especialidad');
        $condicion = $this->request->getPost('condicion');

        // Prepare the data to be updated in the database
        $data = [
            'dni' => $this->request->getPost('dni'),
            'CMP' => $this->request->getPost('CMP'),
            'RNE' => $this->request->getPost('RNE'),
            'especialidad' => $data['especialidad'],
            'fecNac' => $this->request->getPost('fecNac'),
            'foto' => $imageName,
            'tipoSocio' => $this->request->getPost('tipoSocio'),
            'domicilio' => $this->request->getPost('domicilio'),
            'sede' => $this->request->getPost('sede'),
            'email' => $this->request->getPost('email'),
            'telef' => $this->request->getPost('telef'),
            'condicion' => $data['condicion']
        ];

        $this->SocioModel->update($id, $data);

        $this->session->setflashdata('registrado', "A registrado un Inmueble correctamente");

        return redirect()->to(base_url() . '/panel/socio');
    }


    public function eliminar($id = null)
    {
        // Verificar si se proporciona un ID válido
        if ($id === null) {
            // Redireccionar a alguna página de manejo de errores o a la lista de socios
            return redirect()->to(base_url() . '/panel/socio');
        }

        // Cambiar la condición a "0" (deshabilitar)
        $this->SocioModel->update($id, ['condicion' => 0]);

        // Redireccionar a la lista de socios o a donde desees después de deshabilitar al socio
        return redirect()->to(base_url() . '/panel/socio');
    }
    public function eliminados($condicion = 0)
    {
        //

        //  $socios = $this->SocioModel->select('*')->where('condicion', $condicion)->findAll();
        $tiposocio = $this->TipoSocio->getTipoSocios();
        $todasespecialidades = $this->EspecialidadModel->todasEspecialidades();
        $especialidad = $this->EspecialidadModel->getEspecialidades();
        $especialidadesArray = [];
        foreach ($especialidad as $especial) {
            $especialidadesArray[$especial['idEspecialidad']] = $especial['descripcion'];
        }
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
        $getCantSocios = $this->SocioModel->getCantSocios();
        $dato['especialidades'] = $especialidadesArray;
        // Obtener la fecha de nacimiento y formatearla
        // Verificar si la clave 'fecNac' existe en el array $socio
        if (array_key_exists('fecNac', $socio)) {
            // Obtener la fecha de nacimiento y formatearla
            $socio['fecNacFormatted'] = date('d-m-Y', strtotime($socio['fecNac']));
        } else {
            // Si la clave 'fecNac' no existe, asignar un valor predeterminado o manejar de otra manera
            $socio['fecNacFormatted'] = 'Fecha no disponible';
        }


        $data = [
            'titulo' => "Socios SPO",
            'sociotipo' => $sociotipo,
            'especialidadesArray' => $especialidadesArray,
            'socios' => $this->SocioModel->select('*')->where('condicion', $condicion)->findAll(),
            'tiposocio' => $tiposocio,
            'espe' => $especialidad,
            'sedes' => $sedesArray,
            'todasEspecialidades' => $todasespecialidades,
            'getCantSocios' => $getCantSocios
        ];

        return view('Admin/Socio/eliminados', $data);
    }
    public function restaurar($id = null)
    {
        // Verificar si se proporciona un ID válido
        if ($id === null) {
            // Redireccionar a alguna página de manejo de errores o a la lista de socios
            return redirect()->to(base_url() . '/panel/socio');
        }

        // Cambiar la condición a "0" (deshabilitar)
        $this->SocioModel->update($id, ['condicion' => 1]);

        // Redireccionar a la lista de socios o a donde desees después de deshabilitar al socio
        return redirect()->to(base_url() . '/panel/socio');
    }
}
