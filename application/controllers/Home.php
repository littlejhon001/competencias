<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// if (!$this->validatoken()) {
		//     $this->iffalse('Acceso denegado');
		//     $this->json();
		//     die();

		$this->load->model('Usuario_model');
		$this->load->helper('url');
		$this->load->model('Login_model');
		$this->load->library('session');
	}
	public function index()
	{
		// Obtener toda la información de sesión del usuario actual
		$user_data = $this->session->userdata('user_data');
		// Verificar si el usuario está logeado
		if (!empty($user_data)) {
			if ($this->Usuario_model->has_role($user_data->id, 'Administrador')) {
				// Si el usuario es administrador, cargar el header y la vista de dashboard
				$data['user_data'] = $user_data;
				$this->load->view('layouts/header', $data);
				$this->load->view('dashboard', $data);
			} elseif ($this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
				$data['user_data'] = $user_data;
				$this->load->view('layouts/header', $data);
				$this->load->view('dashboard', $data);
			} else {
				// Si no es administrador, cargar solo la vista de dashboard
				$data['user_data'] = $user_data;
				$this->load->view('layouts/header', $data);
				$this->load->view('dashboard', $data);
			}
		} else {
			// Si el usuario no está logeado, redirigir al formulario de inicio de sesión
			redirect('login');
		}
	}

}




