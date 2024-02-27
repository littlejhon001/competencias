<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends MY_Model {


    public $table = "usuarios";
    public $table_id = "id";



    public function __construct() {
        parent::__construct();
    }

    public function obtener_rol($user_id) {
        $user_data = $this->db->get_where('usuarios', array('ID_usuario' => $user_id))->row_array();
        return $user_data['Rol_ID'];
    }

    public function has_role($user_id, $role_name) {
        $rol_usuario = $this->obtener_rol($user_id);
        $role_data = $this->db->get_where('roles', array('Nombre_rol' => $role_name))->row_array();
        return ($rol_usuario == $role_data['ID_rol']);
    }

}
