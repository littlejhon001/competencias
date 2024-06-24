<?php
class Asignaciones_grupos_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "asignaciones_grupos";
    public $table_id = "";

    public function index()
    {

    }

    public function listado_por_usuario($id_usuario){
        $this->join('grupo_asignado grupo',"$this->table.id_grupo = grupo.id");
        return $this->findAll(["$this->table.id_usuario" => $id_usuario],'grupo.id, grupo.nombre');
    }

    public function asignar_grupos($grupos){
        return $this->db->insert_batch($this->table,$grupos);
    }

}