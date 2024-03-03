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
		$this->load->model('Login_model');
	}
	public function index()
	{
		// Obtener toda la información de sesión del usuario actual
		$user_data = $this->session->userdata('user_data');
		// Verificar si el usuario está logeado
		if (!empty($user_data)) {
			if ($this->Usuario_model->has_role($user_data->id, 'Administrador')) {
				// Si el usuario es administrador, cargar el header y la vista de dashboard
				$this->load->view('layouts/header');
				$this->load->view('dashboard');
			} elseif ($this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
				$this->load->view('layouts/header');
				$this->load->view('dashboard');
			} else {
				// Si no es administrador, cargar solo la vista de dashboard
				$this->load->view('layouts/header');
				$this->load->view('dashboard');
			}
		} else {
			// Si el usuario no está logeado, redirigir al formulario de inicio de sesión
			redirect('login');
		}
	}

}




