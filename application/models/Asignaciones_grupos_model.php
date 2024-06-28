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

    public function listado_GE($id_usuario){
        return $this->db->select('asignacion.id_grupo, COUNT(usuario.id)')
        ->from("$this->table as asignacion")
        ->join("usuarios as usuario", "usuario.id = asignacion.id_usuario AND usuario.Rol_ID = 4", 'inner' )
        ->where("usuario.id", $id_usuario)
        ->group_by('asignacion.id_grupo')
        ->get()
        ->result();
    }

}