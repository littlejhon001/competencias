<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Competencias_model extends MY_Model
{


    public $table = "competencia";
    public $table_id = "id";



    public function __construct()
    {
        parent::__construct();
    }

    // public function competencias_usuario($id)
    // {
    //     return $this->db->select("{$this->table}.nombre,{$this->table}.descripcion")
    //         ->join('usuarios', "usuarios.id_competencia = {$this->table}.id", "inner")
    //         ->where("usuarios.id", $id)->get($this->table)
    //         ->row();
    // }

}
