<?php

namespace App\Models;

use CodeIgniter\Model;

class EspecialidadModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'especialidad';
    protected $primaryKey       = 'idEspecialidad';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['descripcion', 'sitReg'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $reglas    = [
        'descripcion' => 'required',
        'sitReg' => 'required|in_list[0,1]'
    ];
    protected $reglasmensajes   = [
        'descripcion' => ['required' => 'El campo Especialidad es obligatorio'],
        'sitReg' => [
            'required' => 'Debe hacer una selección',
            'in_list'  => 'La opción seleccionada para la especialidad no es válida.',
        ]
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = false;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getEspecialidades()
    {
        return $this->db->table('especialidad')->get()->getResultArray();
    }
}
