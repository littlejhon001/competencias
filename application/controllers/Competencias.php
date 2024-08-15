<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
		if (!empty($user_data)) {
			if ($this->Usuario_model->has_role($user_data->id, 'Administrador')) {
				// Si el usuario es administrador, cargar el header y la vista de dashboard
				// $data['competencias'] = $this->Competencias_model->findAll();
				$data['user_data'] = $user_data;
				$data['cargos'] = $this->Cargos_model->findAll();

				$data['competencias'] = $this->Competencias_model->competencia_estado();
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


	public function competencias_detalle()
	{
		$user_data = $this->session->userdata('user_data');
		if (!empty($user_data)) {
			if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
				// $data['competencias'] = $this->Competencias_model->findAll();
				$data['user_data'] = $user_data;
				$data['competencias_nuevas'] = $this->Competencias_model->obtener_asignacion_completa();

				$this->vista('admin/competencias_detalle', $data);
			} else {
				$data['user_data'] = $user_data;
				$this->vista('dashboard', $data);
			}
		} else {
			redirect('login');
		}
	}

	public function competencias_year()
	{
		$user_data = $this->session->userdata('user_data');
		if (!empty($user_data)) {
			if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
				$data['user_data'] = $user_data; // Asegurar que user_data siempre esté disponible en la vista
				$año = $this->input->post('year');
				$data['año'] =  $año; // Cambio de POST a post
				$data['competencias_nuevas'] = $this->Competencias_model->obtener_asignacion_completa();
				$data['competencias'] = $this->Competencias_model->get_competencias_by_year($año);

				$this->vista('admin/competencias_detalle', $data);
			} else {
				$data['user_data'] = $user_data;
				$this->vista('dashboard', $data);
			}
		} else {
			redirect('login');
		}
	}



	public function asignar_competencia($id)
	{
		$data['cargo'] = $this->Cargos_model->find($id);

		$data['competencias'] = $this->Competencias_model->findAll();
		$data['competencias_asignadas'] = $this->Asignacion_cargo_model->obtener_asignacion_completa($id);
		// echo '<pre>';
		// var_dump($data['competencias_asignadas']);
		// echo '</pre>';
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
		if (!empty($id_competencia) && intval($id_competencia) > 0) {
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

	public function competencia_personalizada_cargos()
	{
		// Accede a los datos enviados por AJAX
		$data = $this->input->post();

		// Verifica si hay datos recibidos
		if (!empty($data)) {
			// Accede a los IDs de los cargos seleccionados
			$idsSeleccionados = $data['idsSeleccionados'];

			// Puedes hacer cualquier otro procesamiento necesario con los IDs seleccionados

			// Para propósitos de demostración, puedes devolver una respuesta JSON
			$response = array(
				'success' => true,
				'message' => 'La competencia personalizada fue correctamente creada y asignada para los cargos seleccionados',
				'idsSeleccionados' => $idsSeleccionados
			);
			echo json_encode($response);

		} else {
			// Si no se reciben datos, devuelve un mensaje de error
			$response = array(
				'success' => false,
				'message' => 'No se recibieron datos'
			);
			echo json_encode($response);
		}
		$this->Asignacion_cargo_model->guardar_seleccion_varios_cargos($data);
	}


	public function actualizar_estado()
	{
		$estado = $this->input->post('estado');
		$competencia_id = $this->input->post('competencia_id');
		// Llamar al modelo para actualizar el proveedor
		$update_result = $this->Competencias_model->actualizar_estado($competencia_id, $estado);

		if ($update_result) {
			// Respuesta exitosa
			$response = array(
				'success' => true,
				'message' => 'El proveedor fue actualizado correctamente'
			);
		} else {
			// Respuesta de error
			$response = array(
				'success' => false,
				'message' => 'Error al actualizar el proveedor'
			);
		}

		echo json_encode($response);
	}


	public function crear_competencia()
	{
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$año = $this->input->post('año');
		$create_at = $this->input->post('fecha_creacion');
		$codigo = $this->input->post('codigo');
		$estado = $this->input->post('estado');

		$data = array(
			'nombre' => $nombre,
			'descripcion' => $descripcion,
			'año' => $año,
			'codigo' => $codigo,
			'create_at' => $create_at,
			'estado' => $estado
		);

		$insert_result = $this->Competencias_model->crear_competencia($data);

		if ($insert_result) {
			$response = array('status' => 'success', 'message' => 'Competencia creada exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al crear la competencia');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function eliminar_competencia(){

		$competencia_id = $this->input->post('competencia_id');

		$delete_result = $this->Competencias_model->eliminar_competencia($competencia_id);

		if ($delete_result) {
			$response = array('status' => 'success', 'message' => 'Competencia eliminada exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al eliminar la competencia');
		}



		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

	public function actualizar_competencia(){

		$competencia_id = $this->input->post('competencia_id');
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$año = $this->input->post('año');
		$create_at = $this->input->post('fecha_creacion');
		$codigo = $this->input->post('codigo');
		$estado = $this->input->post('estado');

		$data = array(
			'nombre' => $nombre,
			'descripcion' => $descripcion,
			'año' => $año,
			'codigo' => $codigo,
			'estado' => $estado
		);

		$update_result = $this->Competencias_model->actualizar_competencia($competencia_id, $data);

		if ($update_result) {
			$response = array('status' => 'success', 'message' => 'Competencia actualizada exitosamente');
		} else {
			$response = array('status' => 'error', 'message' => 'Error al actualizar la competencia');
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($response));
	}

}




