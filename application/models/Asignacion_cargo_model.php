<?php
class Asignacion_cargo_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table = "asignacion_cargo_competencia";
    public $table_id = "id";

    public function index()
    {

    }
    public function guardar_seleccion($data)
    {
        // Inserta los datos en la tabla asignacion_cargo_competencia
        $this->db->insert_batch('asignacion_cargo_competencia', $data);
        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // Se insertaron los datos correctamente
        } else {
            return false; // Hubo un error al insertar los datos
        }
    }

    public function guardar_seleccion_varios_cargos($data)
    {
        // Recorre los IDs seleccionados y los criterios correspondientes
        foreach ($data['idsSeleccionados'] as $id) {
            foreach ($data['criterio_id'] as $criterio_id) {
                // Crea un registro para cada cargo seleccionado y cada criterio
                $insertData[] = array(
                    'id_cargo' => $id,
                    'id_criterio' => $criterio_id,
                    // Aquí puedes agregar más columnas si es necesario
                );
            }
        }

        // Inserta los datos en la base de datos
        $this->db->insert_batch('asignacion_cargo_competencia', $insertData);
    }


    // En el modelo Asignacion_cargo_model

    public function findAllWithCompetencia($conditions)
    {
        $this->db->select('asignacion_cargo_competencia.*, competencia.nombre AS nombre_competencia, competencia.descripcion AS descripcion_competencia');
        $this->db->from('asignacion_cargo_competencia');
        $this->db->join('competencia', 'asignacion_cargo_competencia.id_competencia = competencia.id', 'inner');
        $this->db->group_by('competencia.id');
        $this->db->where('asignacion_cargo_competencia.id_cargo', $conditions['id_cargo']); // Calificar el campo id_cargo
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); // Opcional: Devolver un array vacío si no hay resultados
        }
    }

    public function findActividadesCargoCompetencia($id_cargo, $id_competencia)
    {
        return $this->db->select('asignacion.id_actividad, actividad.nombre nombre_actividad, asignacion.id_criterio, criterio.nombre nombre_criterio')
            ->join('actividad_competencia actividad', 'actividad.id = asignacion.id_actividad', 'INNER')
            ->join('criterios criterio', 'criterio.id = asignacion.id_criterio', 'INNER')
            ->where(['asignacion.id_cargo' => $id_cargo, 'asignacion.id_competencia' => $id_competencia])
            ->get("$this->table asignacion")->result();
    }

    public function obtener_asignaciones_con_actividad_y_competencia($id_cargo)
    {
        $this->db->select('asignacion.id_cargo, GROUP_CONCAT(asignacion.id_criterio) as id_criterios, GROUP_CONCAT(DISTINCT actividad_competencia.nombre) as nombre_actividades, competencia.nombre AS nombre_competencia');
        $this->db->from('asignacion_cargo_competencia as asignacion');
        $this->db->join('criterios', 'asignacion.id_criterio = criterios.id');
        $this->db->join('actividad_competencia', 'criterios.id_actividad = actividad_competencia.id');
        $this->db->join('competencia', 'actividad_competencia.id_competencia = competencia.id');
        $this->db->where('asignacion.id_cargo', $id_cargo); // Filtrar por el cargo especificado
        //$this->db->group_by('competencia.id'); // Eliminar la agrupación por ID de competencia
        $query = $this->db->get();

        $resultados = $query->result();

        // Obtener los nombres de los criterios
        foreach ($resultados as $resultado) {
            $id_criterios = explode(',', $resultado->id_criterios);
            $this->db->select('nombre');
            $this->db->from('criterios');
            $this->db->where_in('id', $id_criterios);
            $query = $this->db->get();
            $criterios = $query->result_array();

            // Agregar los nombres de los criterios al resultado
            $resultado->nombres_criterios = array_column($criterios, 'nombre');
        }

        return $resultados;
    }

    public function obtener_asignacion_completa($id_cargo)
    {
        $this->db->select('competencia.id id_competencia,competencia.nombre nombre_competencia, competencia.descripcion descripcion_competencia, competencia.codigo codigo, actividad.id id_actividad,actividad.nombre nombre_actividad,criterio.id id_criterio,criterio.nombre nombre_criterio');
        $this->db->join('criterios criterio', 'asignacion.id_criterio = criterio.id');
        $this->db->join('actividad_competencia actividad', 'criterio.id_actividad = actividad.id');
        $this->db->join('competencia', 'actividad.id_competencia = competencia.id');
        $this->db->where('asignacion.id_cargo', $id_cargo); // Filtrar por el cargo especificado
        $resultados = $this->db->get("$this->table asignacion")->result();
        $respuesta = [];
        foreach ($resultados as $asignacion) {
            if (empty($respuesta[$asignacion->id_competencia])) {
                $competencia = $respuesta[$asignacion->id_competencia] = (object) [
                    'id' => $asignacion->id_competencia,
                    'nombre' => $asignacion->nombre_competencia,
                    'descripcion' => $asignacion->descripcion_competencia,
                    'codigo' => $asignacion->codigo,
                    'actividades' => []
                ];
            }
            if (empty($competencia->actividades[$asignacion->id_actividad])) {
                $actividad = $competencia->actividades[$asignacion->id_actividad] = (object) [
                    'id' => $asignacion->id_actividad,
                    'nombre' => $asignacion->nombre_actividad,
                    'criterios' => []
                ];
            }
            if (empty($actividad->criterios[$asignacion->id_criterio])) {
                $actividad->criterios[$asignacion->id_criterio] = (object) [
                    'id' => $asignacion->id_criterio,
                    'nombre' => $asignacion->nombre_criterio
                ];
            }
        }
        return $respuesta;
    }


    public function eliminar_asignacion($id_cargo, $id_criterio)
    {
        // Eliminar la asignación de la tabla asignacion_cargo_competencia
        $this->db->where('id_cargo', $id_cargo);
        $this->db->where('id_criterio', $id_criterio);
        $this->db->delete('asignacion_cargo_competencia');

        // Verificar si se eliminó correctamente
        return $this->db->affected_rows() > 0;
    }
    public function eliminar_actividad($id_cargo, $id_actividad)
    {
        $this->db->query(
            "DELETE asignacion_cargo_competencia
                FROM
                    asignacion_cargo_competencia
                    INNER JOIN
                    criterios
                    ON
                        asignacion_cargo_competencia.id_criterio = criterios.id
                    INNER JOIN
                    actividad_competencia
                    ON
                        criterios.id_actividad = actividad_competencia.id
                    WHERE
                    actividad_competencia.id = $id_actividad AND
                    asignacion_cargo_competencia.id_cargo = $id_cargo"
        );

        // Verificar si se eliminó correctamente
        return $this->db->affected_rows() > 0;
    }
    public function eliminar_competencia($id_cargo, $id_competencia)
    {
        $this->db->query(
            "DELETE asignacion_cargo_competencia
                FROM
                    asignacion_cargo_competencia
                    INNER JOIN
                    criterios
                    ON
                        asignacion_cargo_competencia.id_criterio = criterios.id
                    INNER JOIN
                    actividad_competencia
                    ON
                        criterios.id_actividad = actividad_competencia.id
                    INNER JOIN
                    competencia
                    ON
                    actividad_competencia.id_competencia = competencia.id
                    WHERE
                    competencia.id = $id_competencia AND
                    asignacion_cargo_competencia.id_cargo = $id_cargo"
        );
        return $this->db->affected_rows() > 0;
    }

}