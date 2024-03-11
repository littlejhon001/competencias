<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Evaluacion_usuario_model extends MY_Model
{
    public $table = "evaluacion_usuario";
    public $table_id = "id";

    public function __construct()
    {
        parent::__construct();
    }
    public function insertar_evaluacion($data)
    {
        return $this->db->insert_batch($this->table,$data);
    }
}
