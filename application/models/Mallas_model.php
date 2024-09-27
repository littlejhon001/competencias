<?php
class Mallas_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table = "mallas";
    public $table_id = "id";

    public function get_mallas()
    {
        $this->db->select('
            mallas.*,
            cargos.nombre AS nombre_cargo,
            areas.nombre AS nombre_area,
            cursos.categoria AS categoria_curso,
            cursos.nombre AS nombre_curso,
            cursos.id AS curso_id,
            cargos.id AS cargos_id
        ');
        $this->db->from('mallas');
        $this->db->join('areas', 'mallas.id_area = areas.id');
        $this->db->join('cursos', 'mallas.id_curso = cursos.id');
        $this->db->join('cargos', 'mallas.id_cargo = cargos.id');

        $query = $this->db->get()->result();

        $respuesta = [];

        foreach ($query as $row) {
            // Verificar si el área ya existe en la respuesta
            if (!isset($respuesta[$row->id_area])) {
                $respuesta[$row->id_area] = (object) [
                    'id' => $row->id_area,
                    'nombre' => $row->nombre_area,
                    'cargos' => []
                ];
            }

            // Verificar si el cargo ya existe en el área
            if (!isset($respuesta[$row->id_area]->cargos[$row->id_cargo])) {
                $respuesta[$row->id_area]->cargos[$row->id_cargo] = (object) [
                    'id' => $row->id_cargo,
                    'nombre' => $row->nombre_cargo,
                    'cursos' => []
                ];
            }

            // Agregar el curso al cargo
            $respuesta[$row->id_area]->cargos[$row->id_cargo]->cursos[] = (object) [
                'id' => $row->id_curso,
                'nombre' => $row->nombre_curso,
                'categoria' => $row->categoria_curso
            ];
        }

        // Convertir los cargos de cada área a un array indexado
        foreach ($respuesta as $id_area => $area) {
            $area->cargos = array_values($area->cargos);
        }

        return array_values($respuesta);
    }

    public function get_cursos($id_cargo)
    {
        $this->db->select('
            mallas.*,
            cursos.nombre AS nombre_curso,
            cursos.categoria AS categoria_curso,
            cursos.url_curso
        ');
        $this->db->from('mallas');
        $this->db->join('cursos', 'mallas.id_curso = cursos.id');
        $this->db->where('mallas.id_cargo', $id_cargo);

        return $this->db->get()->result();
    }

    public function get_cargos($id_area){
        $this->db->select('
            mallas.*,
            cargos.nombre AS nombre_cargo,
            cargos.id AS id_cargo
        ');
        $this->db->from('mallas');
        $this->db->join('cargos', 'mallas.id_cargo = cargos.id');
        $this->db->where('mallas.id_area', $id_area);
        $this->db->group_by('cargos.id'); // Agrupar por id_cargo

        return $this->db->get()->result();
    }

    public function get_cursos_por_cargo($id_cargo) {
        $this->db->select('
            mallas.*,
            cursos.nombre AS nombre_curso,
            cursos.categoria AS categoria_curso,
            cursos.categoria AS categoria_curso,
            cursos.url_curso
        ');
        $this->db->from('mallas');
        $this->db->join('cursos', 'mallas.id_curso = cursos.id');
        $this->db->where('mallas.id_cargo', 421);

        return $this->db->get()->result();
    }
}
