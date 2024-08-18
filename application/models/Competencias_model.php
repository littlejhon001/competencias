<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Competencias_model extends MY_Model
{


    public $table = "competencia";
    public $table_id = "id";

    public function __construct()
    {
        parent::__construct();
    }
    // public function competencias_por_area()
    // {
    //     return $this->findAll(['id_area' => $this->session->userdata('user_data')->id_area]);
    // }
    public function competencias_por_usuario($id_usuario)
    {
        return $this->db->select("$this->table.id, $this->table.nombre, $this->table.descripcion")
            ->join('usuario_competencia', "$this->table.id = usuario_competencia.id_competencia", "INNER")
            ->where('usuario_competencia.id_usuario', $id_usuario)
            ->get($this->table)->result();
    }

    public function asignadas_por_cargo($id_cargo)
    {
        $this->db->select('competencia.id,competencia.nombre,competencia.descripcion,competencia.codigo')
            ->join("actividad_competencia actividad", "actividad.id_competencia = competencia.id", "LEFT")
            ->join("criterios criterio", "criterio.id_actividad = actividad.id", "LEFT")
            ->join('asignacion_cargo_competencia asignacion', 'asignacion.id_criterio = criterio.id', 'INNER')
            ->where('asignacion.id_cargo', $id_cargo);
        $this->db->group_by("competencia.id");
        return $this->db->get("$this->table competencia")->result();
    }


    public function competencia_completa()
    {
        $query = $this->db->query("
            SELECT
                c.id AS competencia_id,
                c.nombre AS competencia_nombre,
                c.descripcion AS competencia_descripcion,
                c.codigo AS competencia_codigo,
                c.año AS competencia_año,
                c.estado AS competencia_estado,
                ac.id AS actividad_competencia_id,
                ac.id_competencia AS actividad_competencia_id_competencia,
                ac.nombre AS actividad_competencia_nombre,
                cr.id AS criterio_id,
                cr.id_actividad AS criterio_id_actividad,
                cr.nombre AS criterio_nombre,
                cr.descripcion AS criterio_descripcion
            FROM
                competencia c
            INNER JOIN
                actividad_competencia ac ON c.id = ac.id_competencia
            INNER JOIN
                criterios cr ON ac.id = cr.id_actividad
            ORDER BY
                c.id, ac.id, cr.id
        ");
        return $query->result();
    }


    public function actualizar_estado($competencia_id, $estado)
    {
        $this->db->where('id', $competencia_id);
        return $this->db->update('competencia', ['estado' => $estado]);
    }

    public function competencia_estado()
    {
        // Ejecutar la consulta SQL
        $this->db->select('id, nombre, codigo, estado');
        $this->db->from('competencia');
        $this->db->where('estado', 1);

        $query = $this->db->get();

        // Retornar los resultados como un array
        return $query->result_array();
    }
    public function competencia_nueva()
    {

        $query = $this->db->query("
        SELECT
            competencia.*,
            actividad_competencia.nombre AS nombre_actividad,
            criterios.nombre AS nombre_criterio,
            actividad_competencia.id AS id_actividad,
            criterios.id AS id_criterios
        FROM
            competencia
        INNER JOIN
            actividad_competencia
        ON
            competencia.id = actividad_competencia.id_competencia
        INNER JOIN
            criterios
        ON
            actividad_competencia.id = criterios.id_actividad
        WHERE
            competencia.estado = '2'
    ");
        return $query->result(); // O cualquier otro procesamiento que necesites


        // // Ejecutar la consulta SQL
        // $this->db->select('*');
        // $this->db->from('competencia');
        // $this->db->where('estado', 2);
        // // $this->db->get("$this->table competencia")->result();

        // $query = $this->db->get();

        // // Retornar los resultados como un array
        // return $query->result();
    }


    public function obtener_asignacion_completa($año = "")
    {
        $this->db->select('competencia.id id_competencia,competencia.nombre nombre_competencia, competencia.descripcion descripcion_competencia, competencia.codigo codigo, actividad.id id_actividad,actividad.nombre nombre_actividad,criterio.id id_criterio,criterio.nombre nombre_criterio, año');
        $this->db->join('actividad_competencia actividad', 'actividad.id_competencia = competencia.id', 'LEFT');
        $this->db->join('criterios criterio', 'criterio.id_actividad = actividad.id', 'LEFT');
        $this->db->where('competencia.estado', "2");
        if ($año != "") {
            $this->db->where('competencia.año', $año);
        }
        $resultados = $this->db->get("$this->table competencia")->result();
        $respuesta = [];

        foreach ($resultados as $row) {
            if (empty($respuesta[$row->id_competencia])) {
                if (!empty($row->id_competencia)) {
                    $competencia = $respuesta[$row->id_competencia] = (object) [
                        'id' => $row->id_competencia,
                        'nombre' => $row->nombre_competencia,
                        'descripcion' => $row->descripcion_competencia,
                        'codigo' => $row->codigo,
                        'año' => $row->año,
                        'actividades' => []
                    ];
                }
            }
            if (empty($competencia->actividades[$row->id_actividad])) {
                if (!empty($row->id_actividad)) {
                    $actividad = $competencia->actividades[$row->id_actividad] = (object) [
                        'id' => $row->id_actividad,
                        'nombre' => $row->nombre_actividad,
                        'criterios' => []
                    ];
                }
            }
            if (empty($actividad->criterios[$row->id_criterio])) {
                if (!empty($row->id_criterio)) {
                    $actividad->criterios[$row->id_criterio] = (object) [
                        'id' => $row->id_criterio,
                        'nombre' => $row->nombre_criterio
                    ];
                }
            }
        }
        return $respuesta;
    }



    public function get_competencias_by_year($año)
    {
        $this->db->select('*');
        $this->db->from('competencia');
        $this->db->where('YEAR(`año`)', $año);
        $query = $this->db->get();
        return $query->result();
    }


    public function crear_competencia($data)
    {
        return $this->insert($data);
    }

    public function eliminar_competencia($competencia_id)
    {
        return $this->delete($competencia_id);
    }

    public function actualizar_competencia($competencia_id, $data) {
        return $this->update($competencia_id, $data);
    }
    public function guardar_nueva_competencia($competencia_id,$estado)
    {
        $this->db->where('id', $competencia_id);
        return $this->db->update('competencia', ['estado' => $estado]);
    }

    public function contar_usuarios_por_anio($year) {
        $this->db->select('COUNT(ec.id_usuario) AS total_usuarios');
        $this->db->from('evaluacion_completada ec');
        $this->db->join('competencia c', 'ec.id_competencia = c.id');
        $this->db->where('c.año', $year); // Filtrar por el año en la tabla competencias
        
        $query = $this->db->get();
        $result = $query->row();
        
        return $result->total_usuarios;
    }
}
