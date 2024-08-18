<?php
defined('BASEPATH') or exit ('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Actividad extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->validatoken()) {
        //     $this->iffalse('Acceso denegado');
        //     $this->json();
        //     die();

        $this->load->model('Usuario_model');
        $this->load->model('Login_model');
        $this->load->model('Competencias_model');
        $this->load->model('Asignacion_cargo_model');
        $this->load->model('Actividad_competencia');
    }
    public function crear_actividad(){
        $nombre = $this->input->post('nombre');
        $id_competencia = $this->input->post('id_competencia');


		$data = array(
			'nombre' => $nombre,
            'id_competencia' => $id_competencia
		);

		$insert_result = $this->Actividad_competencia->crear_actividad($data);

		if ($insert_result) {
			$response = array('status' => 'success', 'message' => 'Competencia creada exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al crear la competencia');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));

    }

	public function eliminar_actividad(){

		$id_actividad = $this->input->post('id_actividad');

		$delete_result = $this->Actividad_competencia->eliminar_actividad($id_actividad);

		if ($delete_result) {
			$response = array('status' => 'success', 'message' => 'Actividad eliminada exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al eliminar la Actividad');
		}

		console($delete_result);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function actualizar_actividad(){

		$id_actividad = $this->input->post('id_actividad');
		$nombre = $this->input->post('nombre');

		$data = array(
			'nombre' => $nombre
		);

		$update_result = $this->Actividad_competencia->actualizar_actividad($id_actividad, $data);

		if ($update_result) {
			$response = array('status' => 'success', 'message' => 'Actividad actualizada exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al actualizar la Actividad');
		}

		console($this->db->last_query());

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

}




