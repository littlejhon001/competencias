<?php
class Asignacion_cargo_model     extends MY_Model
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
}