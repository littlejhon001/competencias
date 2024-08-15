<?php
defined('BASEPATH') or exit ('No direct script access allowed');

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
        return $this->findAll(['id_actividad' => $id_actividad], 'id, nombre');
    }

    public function obtener_criterios($actividad_id)
    {
        // Consultar la base de datos para obtener los criterios asociados a la actividad clave
        $this->db->select('*');
        $this->db->from('criterios');
        $this->db->where('id_actividad', $actividad_id);
        $query = $this->db->get();

        // Verificar si hay resultados
        if ($query->num_rows() > 0) {
            // Devolver los criterios como un array de objetos
            return $query->result();
        } else {
            // Si no hay resultados, devolver un array vacío
            return array();
        }
    }
    public function asignados_por_cargo($id_cargo,$id_actividad="",$id_usuario=""){
        $this->db->select('criterio.nombre, criterio.id')
        ->join('asignacion_cargo_competencia asignacion','asignacion.id_criterio = criterio.id','INNER')
        ->where('asignacion.id_cargo',$id_cargo);
        if(!empty($id_actividad)){
            $this->db->where('criterio.id_actividad',$id_actividad);
        }
        if(!empty($id_usuario)){
            $this->db->select("evaluacion.resultado")
            ->join("evaluacion_usuario evaluacion", "evaluacion.id_criterio_competencia = criterio.id AND evaluacion.id_usuario = $id_usuario", "LEFT");
       }
        return $this->db->get("$this->table criterio")->result();
    }

    public function crear_criterio($data)
    {
        return $this->insert($data);
    }

    public function eliminar_criterio($id_criterio)
    {
        return $this->delete($id_criterio);
    }
}
