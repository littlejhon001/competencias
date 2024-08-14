<?php
class Actividad_competencia extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table = "actividad_competencia";
    public $table_id = "id";

    public function index()
    {

    }

    public function listado_por_competencia($id_competencia, $id_usuario = "")
    {
        if (!empty ($id_usuario)) {
            return $this->db->select("$this->table.nombre, $this->table.id, (count(evaluacion.id) > 0) evaluada, count(criterios.id) as criterios")
                ->join("criterios", "criterios.id_actividad = $this->table.id", "LEFT")
                ->join("evaluacion_usuario evaluacion", "evaluacion.id_criterio_competencia = criterios.id AND evaluacion.id_usuario = $id_usuario", "LEFT")
                ->where(["$this->table.id_competencia" => $id_competencia])
                ->group_by("$this->table.id")
                ->order_by("$this->table.nombre")->get($this->table)->result();
        } else {
            return $this->findAll(['id_competencia' => $id_competencia], 'id, nombre');
        }
    }

    public function obtener_actividades($competencia_id)
    {
        // Consultar la base de datos para obtener las actividades clave asociadas a la competencia
        $this->db->select('*');
        $this->db->from('actividad_competencia');
        $this->db->where('id_competencia', $competencia_id);
        $query = $this->db->get();

        // Verificar si hay resultados
        if ($query->num_rows() > 0) {
            // Devolver las actividades como un array de objetos
            return $query->result();
        } else {
            // Si no hay resultados, devolver un array vacío
            return array();
        }
    }
    public function asignadas_por_cargo($id_cargo,$id_competencia="",$id_usuario=""){
        $this->db->select('actividad.nombre, actividad.id')
        ->join("criterios criterio", "criterio.id_actividad = actividad.id", "LEFT")
        ->join('asignacion_cargo_competencia asignacion','asignacion.id_criterio = criterio.id','INNER')
        ->where('asignacion.id_cargo',$id_cargo);
        if(!empty($id_competencia)){
            $this->db->where('actividad.id_competencia',$id_competencia);
        }
        if(!empty($id_usuario)){
             $this->db->select("(count(evaluacion.id) > 0) evaluada, count(criterio.id) as criterios")
             ->join("evaluacion_usuario evaluacion", "evaluacion.id_criterio_competencia = criterio.id AND evaluacion.id_usuario = $id_usuario", "LEFT");
        }
        $this->db->group_by("actividad.id");
        return $this->db->get("$this->table actividad")->result();
    }
    public function evaluada($id_actividad,$id_usuario){
        return $this->db->select("(count(evaluacion.id) > 0) evaluada")
        ->join("criterios criterio", "criterio.id_actividad = actividad.id", "LEFT")
        ->join("evaluacion_usuario evaluacion", "evaluacion.id_criterio_competencia = criterio.id AND evaluacion.id_usuario = $id_usuario", "LEFT")
        ->where('actividad.id',$id_actividad)
        ->get("$this->table actividad")->row()->evaluada;

    }

    public function crear_actividad($data)
    {
        $this->db->insert('actividad_competencia', $data);
        return $this->db->insert_id();
    }
}
