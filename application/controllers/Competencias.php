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
	}
	public function index()
	{
		// Obtener toda la información de sesión del usuario actual
		$user_data = $this->session->userdata('user_data');
		// Verificar si el usuario está logeado
		if (!empty($user_data)) {
			if ($this->Usuario_model->has_role($user_data->id, 'Administrador')) {
				// Si el usuario es administrador, cargar el header y la vista de dashboard
                $data['competencias'] = $this->Competencias_model->findAll();
				$data['user_data'] = $user_data;
				$this->vista('admin/competencias', $data);
			} elseif ($this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
				$data['user_data'] = $user_data;
				$this->vista('competencias', $data);
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
    public function listado_actividades($id_competencia){
        if(!empty($id_competencia) && intval($id_competencia) > 0){
            $this->load->model('Actividad_competencia');
            if($this->Usuario_model->has_role($this->session->userdata('user_data')->id, 'Usuario')){
                $this->reques->actividades = $this->Actividad_competencia->listado_por_competencia($id_competencia, $this->session->userdata('user_data')->id);
            }else{
                $this->reques->actividades = $this->Actividad_competencia->listado_por_competencia($id_competencia);
            }
        }else{
            $this->iffalse('No ingresó una competencia válida');
        }
        $this->json();
    }

}




