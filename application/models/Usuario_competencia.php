<?php
class Usuario_competencia extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table = "Usuario_competencia";
    public $table_id = "id";

    public function guardar_datos_evaluador($competencia, $usuarios_seleccionados)
    {
        // Iterar sobre los usuarios seleccionados
        foreach ($usuarios_seleccionados as $usuario_id) {
            // Verificar si ya existe una asignación para este usuario y competencia
            $this->db->where('id_usuario', $usuario_id);
            $this->db->where('id_competencia', $competencia);
            $query = $this->db->get('usuario_competencia');
            if ($query->num_rows() > 0) {
                // Si ya existe, no hacemos nada o podemos actualizar si es necesario
                // Esto depende de la lógica de tu aplicación
            } else {
                // Si no existe, insertar un nuevo registro
                $data = array(
                    'id_usuario' => $usuario_id,
                    'id_competencia' => $competencia
                    // Otros campos que desees guardar en la tabla de usuario_competencias
                );
                $this->db->insert('usuario_competencia', $data);
            }
        }
    }

}
