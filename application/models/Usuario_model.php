<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends MY_Model
{


    public $table = "usuarios";
    public $table_id = "id";



    public function __construct()
    {
        parent::__construct();
    }

    public function obtener_rol($user_id)
    {
        return $this->find($user_id, 'Rol_ID')->Rol_ID;
    }

    public function has_role($user_id, $role_name)
    {
        $rol_usuario = $this->obtener_rol($user_id);
        $rol_consultado = $this->db->get_where('roles', array('nombre' => $role_name))->row()->id;
        return($rol_usuario == $rol_consultado);
    }

    public function datos_evaluadores()
    {
        // Aquí colocarías la lógica para obtener los datos de los evaluadores
        $query = $this->db->get_where('usuarios', array('Rol_id' => 3));
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
        return !empty($this->findName('email', $email, 'email'));
    }

    public function obtener_usuarios_por_evaluador($id_evaluador)
    {
        return $this->findAll(['id_evaluador' => $id_evaluador],'id,nombre,apellido,cargo,identificacion,email');
    }
}
