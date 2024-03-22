<?php
class Asignacion_cargo_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table = "asignacion_cargo_competencia";
    public $table_id = "id";

    public function index()
    {

    }
    public function guardar_seleccion($data)
    {
        // Inserta los datos en la tabla asignacion_cargo_competencia
        $this->db->insert_batch('asignacion_cargo_competencia', $data);
        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // Se insertaron los datos correctamente
        } else {
            return false; // Hubo un error al insertar los datos
        }
    }


    // En el modelo Asignacion_cargo_model

    public function findAllWithCompetencia($conditions)
    {
        $this->db->select('asignacion_cargo_competencia.*, competencia.nombre AS nombre_competencia');
        $this->db->from('asignacion_cargo_competencia');
        $this->db->join('competencia', 'asignacion_cargo_competencia.id_competencia = competencia.id', 'inner');
        $this->db->where('asignacion_cargo_competencia.id_cargo', $conditions['id_cargo']); // Calificar el campo id_cargo
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); // Opcional: Devolver un array vacío si no hay resultados
        }
    }

}