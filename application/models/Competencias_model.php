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



    // public function competencias_por_area()
    // {
    //     return $this->findAll(['id_area' => $this->session->userdata('user_data')->id_area]);
    // }
    public function competencias_por_usuario($id_usuario){
        return $this->db->select("$this->table.id, $this->table.nombre, $this->table.descripcion")
        ->join('usuario_competencia',"$this->table.id = usuario_competencia.id_competencia","INNER")
        ->where('usuario_competencia.id_usuario',$id_usuario)
        ->get($this->table)->result();
    }

    public function asignadas_por_cargo($id_cargo){
        $this->db->select('competencia.id,competencia.nombre,competencia.descripcion,competencia.codigo')
        ->join("actividad_competencia actividad", "actividad.id_competencia = competencia.id", "LEFT")
        ->join("criterios criterio", "criterio.id_actividad = actividad.id", "LEFT")
        ->join('asignacion_cargo_competencia asignacion','asignacion.id_criterio = criterio.id','INNER')
        ->where('asignacion.id_cargo',$id_cargo);
        $this->db->group_by("competencia.id");
        return $this->db->get("$this->table competencia")->result();
    }

}
