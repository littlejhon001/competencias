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


    public function get_competencias_by_year($año)
    {
        $this->db->select('*');
        $this->db->from('competencia');
        $this->db->where('YEAR(`año`)', $año);
        $query = $this->db->get();
        return $query->result_array();
    }
}
