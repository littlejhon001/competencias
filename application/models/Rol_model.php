<?php
class Rol_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "";
    public $table_id = "";


    public function get_role_by_id($role_id) {
        return $this->db->get_where('roles', array('id' => $role_id))->row_array();
    }

}
