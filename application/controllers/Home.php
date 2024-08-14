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
        $this->load->model('Competencias_model');
    }
    public function index()
    {
        $user_data = $this->session->userdata('user_data');

        // Verificar si el usuario está logeado
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
                $this->vista('dashboard');
            } else if ($this->Usuario_model->has_role($user_data->id, 'Evaluador')) {

                $data['usuarios_asignados'] = $this->Usuario_model->obtener_usuarios_por_evaluador($user_data->id);

                $this->vista('evaluador/usuarios_asignados', $data);

            } else if ($this->Usuario_model->has_role($user_data->id, 'Usuario')) {
                $data['competencias_asignadas'] = $this->Competencias_model->asignadas_por_cargo($user_data->id_cargo);
                $this->vista('usuario/dashboard_usuario', $data);
            } else {
                // Si el usuario no es administrador, podrías redirigirlo a otra vista o mostrar un mensaje de error
                redirect('Home');
            }
        } else {

            redirect('Login');

        }

    }

    public function ver_competencia($id_competencia)
    {
        var_dump('Hola');
        die;
    }

    public function get_all_users()
    {
        $users = $this->Usuario_model->leer();
        $this->json($users);
    }
}




