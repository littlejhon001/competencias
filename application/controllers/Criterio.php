<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Criterio extends CI_Controller
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
        $this->load->model('Criterios_model');

    }
    public function index()
    {
    }
    public function crear_criterio(){
        $criterio = $this->input->post('criterio');
        $id_actividad = $this->input->post('id_actividad_criterio');


		$data = array(
			'nombre' => $criterio,
            'id_actividad' => $id_actividad
		);


		$insert_result = $this->Criterios_model->crear_criterio($data);

		if ($insert_result) {
			$response = array('status' => 'success', 'message' => 'criterio creado exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al crear el criterio');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));

    }

    public function eliminar_criterio(){

		$id_criterio = $this->input->post('id_criterio');

		$delete_result = $this->Criterios_model->eliminar_criterio($id_criterio);

		if ($delete_result) {
			$response = array('status' => 'success', 'message' => 'Criterio eliminado exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al eliminar el criterio');
		}



		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function actualizar_criterio(){

		$id_criterio = $this->input->post('id_criterio');
		$nombre = $this->input->post('criterio');

		$data = array(
			'nombre' => $nombre
		);

		$update_result = $this->Criterios_model->actualizar_criterio($id_criterio, $data);

		if ($update_result) {
			$response = array('status' => 'success', 'message' => 'Criterio actualizado exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al actualizar el Criterio');
		}



		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}
}




