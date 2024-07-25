<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Usuario_model extends MY_Model
{


    public $table = "usuarios";
    public $table_id = "id";



    public function __construct()
    {
        parent::__construct();
    }

    public function listado_general(){
        $this->db->join('roles rol',"$this->table.Rol_ID = rol.id",'left');
        $this->db->join('cargos cargo',"$this->table.id_cargo = cargo.id",'left');
        $this->db->join('asignaciones_grupos asignacion',"$this->table.id = asignacion.id_usuario",'left');
        $this->db->join('grupo_asignado grupo',"asignacion.id_grupo = grupo.id",'left');
        $data = $this->findAll('',"$this->table.id, $this->table.nombre, $this->table.apellido, $this->table.email, $this->table.identificacion, $this->table.id_cargo, $this->table.id_evaluador, grupo.id AS id_grupo, $this->table.Rol_ID, rol.nombre AS rol, cargo.nombre AS cargo");
        $this->load->helper('array');
        $data = group_by(['id_grupo'],'',$data,'id');
        return $data;
    }

    public function obtener_rol($user_id)
    {
        return $this->find($user_id, 'Rol_ID')->Rol_ID;
    }

    public function has_role($user_id, $role_name)
    {
        $rol_usuario = $this->obtener_rol($user_id);
        $rol_consultado = $this->db->get_where('roles', array('nombre' => $role_name))->row()->id;
        return ($rol_usuario == $rol_consultado);
    }

    public function datos_evaluadores($id_grupo)
    {
        // Realizar la consulta
        $query = $this->db->select('usuarios.*, cargos.nombre AS nombre_cargo')
            ->from('usuarios')
            ->join('cargos', 'usuarios.id_cargo = cargos.id','left')
            ->join('asignaciones_grupos asignacion', 'asignacion.id_usuario = usuarios.id')
            ->where('asignacion.id_grupo', $id_grupo)
            ->where('usuarios.Rol_ID', 3)
            ->get();
        return $query->result();
    }

    public function guardar_datos_evaluador($evaluador, $usuarios_seleccionados)
    {
        // Aquí deberías escribir la lógica para guardar los datos en la base de datos
        // Ejemplo:
        foreach ($usuarios_seleccionados as $usuario_id) {
            // Verificar si ya existe una asignación para este usuario
            $this->db->where('id', $usuario_id);
            $query = $this->db->get('usuarios');
            if ($query->num_rows() > 0) {
                // Si ya existe, actualizar el campo de id_evaluador
                $data = array(
                    'id_evaluador' => $evaluador
                    // Otros campos que desees actualizar en la tabla de usuarios
                );
                $this->db->where('id', $usuario_id);
                $this->db->update('usuarios', $data);
            } else {
                // Si no existe, insertar un nuevo registro
                $data = array(
                    'id_evaluador' => $evaluador,
                    'id' => $usuario_id
                    // Otros campos que desees guardar en la tabla de usuarios
                );
                $this->db->insert('usuarios', $data);
            }
        }
    }

    public function existe($email)
    {
        return !empty ($this->findName('email', $email, 'email'));
    }

    public function usuario_por_correo($email){
        return $this->find(['email' => $email],'id');
    }

    public function obtener_usuarios_por_evaluador($id_evaluador)
    {
        return $this->findAll(['id_evaluador' => $id_evaluador], 'id,nombre,apellido,identificacion,email');
    }

    public function usuarios_asignar($id_grupo)
    {
        // Realizar la consulta
        $query = $this->db->select('usuario.*, cargos.nombre AS nombre_cargo, CONCAT(evaluador.nombre," ",evaluador.apellido) as nombre_evaluador')
            ->from('usuarios usuario')
            ->join('usuarios evaluador', 'usuario.id_evaluador = evaluador.id','left')
            ->join('cargos', 'usuario.id_cargo = cargos.id','left')
            ->join('asignaciones_grupos asignacion', 'asignacion.id_usuario = usuario.id')
            ->where('asignacion.id_grupo', $id_grupo)
            ->where('usuario.Rol_ID', 4)
            ->get();
        return $query->result();
    }

    public function insert_masivo($data){
        return $this->db->insert_batch($this->table,$data);
    }

}
