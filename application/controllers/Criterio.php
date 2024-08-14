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
        $id_actividad = $this->input->post('id_criterio');


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
}




