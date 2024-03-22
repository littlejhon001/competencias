<?php
class Login_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "usuarios";
    public $table_id = "id";


    public function get_user($email, $password)
    {
        $query = $this->db->select('id,Rol_ID,nombre,apellido,email,cargo,identificacion,id_cargo,id_grupo')
            ->where('email', $email)
            ->where('password', $password)
            ->get('usuarios');

        return $query->row();
    }


}
