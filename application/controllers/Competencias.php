<?php
defined('BASEPATH') or exit ('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Competencias extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// if (!$this->validatoken()) {
		//     $this->iffalse('Acceso denegado');
		//     $this->json();
		//     die();

		$this->load->model('Usuario_model');
		$this->load->model('Competencias_model');
		$this->load->model('Cargos_model');
		$this->load->model('Actividad_competencia');
		$this->load->model('Criterios_model');
		$this->load->model('Asignacion_cargo_model');

	}
	public function index()
	{
		// Obtener toda la información de sesión del usuario actual
		$user_data = $this->session->userdata('user_data');
		// Verificar si el usuario está logeado
		if (!empty ($user_data)) {
			if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
				// Si el usuario es administrador, cargar el header y la vista de dashboard
				// $data['competencias'] = $this->Competencias_model->findAll();
				$data['user_data'] = $user_data;
				$data['cargos'] = $this->Cargos_model->findAll();

				$this->vista('admin/competencias', $data);



			} else {
				// Si no es administrador, cargar solo la vista de dashboard
				$data['user_data'] = $user_data;
				$this->vista('dashboard', $data);
			}
		} else {
			// Si el usuario no está logeado, redirigir al formulario de inicio de sesión
			redirect('login');
		}
	}

	public function asignar_competencia($id)
	{
		$data['cargo'] = $this->Cargos_model->find($id);
		$data['competencias'] = $this->Competencias_model->findAll();
		$data['competencias_asignadas'] = $this->Asignacion_cargo_model->obtener_asignaciones_con_actividad_y_competencia($id);
		// var_dump($data['competencias_asignadas']);
		// die;
		$this->vista('admin/asignar_competencia_cargo', $data);
	}

	public function obtener_actividades()
	{
		$competencia_id = $this->input->post('competencia_id');
		$actividades = $this->Actividad_competencia->obtener_actividades($competencia_id);
		echo json_encode($actividades);
	}
	public function obtener_criterios()
	{
		$actividad_id = $this->input->post('actividad_id');
		$criterios = $this->Criterios_model->obtener_criterios($actividad_id);
		echo json_encode($criterios);
	}
	public function competencia_personalizada($id_cargo)
	{
		// Recibe los datos enviados por AJAX
		// $competencia_id = $this->input->post('competencia_id');
		// $actividad_id = $this->input->post('actividad_id');
		$criterios_seleccionados = $this->input->post('criterio_id');

		$criterios_ids = implode(',', $criterios_seleccionados);

		$data = array();
		foreach ($criterios_seleccionados as $criterio_id) {
			$data[] = array(
				// 'id_competencia' => $competencia_id,
				'id_cargo' => $id_cargo,
				// 'id_actividad' => $actividad_id,
				'id_criterio' => $criterio_id
			);
		}



		$this->Asignacion_cargo_model->guardar_seleccion($data);
		echo json_encode(array('success' => 1));
	}

	// juan hizo lo de abajo


	public function listado_actividades($id_competencia)
	{
		if (!empty ($id_competencia) && intval($id_competencia) > 0) {
			$this->load->model('Actividad_competencia');
			if ($this->Usuario_model->has_role($this->session->userdata('user_data')->id, 'Usuario')) {
				$this->reques->actividades = $this->Actividad_competencia->asignadas_por_cargo($this->session->userdata('user_data')->id_cargo, $id_competencia, $this->session->userdata('user_data')->id);
			} else {
				$this->reques->actividades = $this->Actividad_competencia->listado_por_competencia($id_competencia);
			}
		} else {
			$this->iffalse('No ingresó una competencia válida');
		}
		$this->json();
	}

}




