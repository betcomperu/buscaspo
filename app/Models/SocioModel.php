<?php

namespace App\Models;

use CodeIgniter\Model;

class SocioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'socio';
    protected $primaryKey       = 'idSocio';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['dni','CMP','apPaterno','apMaterno','nombre','fecNac','domicilio','RNE','telf','email','codUbigeo','tipoSocio',
                                    'foto','condicion','fecha_creacion','fecha_edicion'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

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

    //Crear una función donde pueda obtener la tabla usuario incluyendo su especialidad


    public function getSocioEspecialidad() {
        return $this->select('socio.*, especialidad.descripcion AS especialidad')
            ->join('especialidad', 'socio.especialidad = especialidad.idEspecialidad', 'left') // Asumiendo que 'especialidad' es la tabla.
            ->where('socio.condicion', 1) // Agregar la tabla a la condición.
            ->findAll();
    }
    
}
