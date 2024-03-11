<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Criterios_model extends MY_Model
{
    public $table = "criterios";
    public $table_id = "id";

    public function __construct()
    {
        parent::__construct();
    }
    public function listado_por_actividad($id_actividad)
    {
        return $this->findAll(['id_actividad' => $id_actividad],'id, nombre');
    }
}
