<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->validatoken()) {
        //     $this->iffalse('Acceso denegado');
        //     $this->json();
        //     die();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Usuario_model');
    }
    public function index()
    {
        $user_data = $this->session->userdata('user_data');

        // Verificar si el usuario está logeado
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
                $data['user_data'] = $user_data;
                $this->load->view('layouts/header', $data);
                $this->view('admin/usuarios', $data);
            } else {
                // Si el usuario no es administrador, podrías redirigirlo a otra vista o mostrar un mensaje de error
                redirect('Home');
            }
        } else {

            redirect('login');

        }

    }
    public function detalle_usuarios()
    {
        $user_data = $this->session->userdata('user_data');

        // Verificar si el usuario está logeado
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {

                $data['usuarios'] = $this->Usuario_model->findAll();
                // var_dump($data['usuarios']);
                // die;
                $data['user_data'] = $user_data;
                $this->load->view('layouts/header', $data);
                $this->view('admin/usuarios_detalle', $data);
            } else {
                // Si el usuario no es administrador, podrías redirigirlo a otra vista o mostrar un mensaje de error
                redirect('Home');
            }
        } else {
            // Si el usuario no está logeado, redirigir al formulario de inicio de sesión
            redirect('login');
        }

    }
    public function asignar()
    {
        $user_data = $this->session->userdata('user_data');

        // Verificar si el usuario está logeado
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {

                $data['usuarios'] = $this->Usuario_model->findAll();
                $data['evaluadores'] = $this->Usuario_model->datos_evaluadores();
                $data['user_data'] = $user_data;
                $this->load->view('layouts/header', $data);
                $this->view('admin/asignar_evaluador', $data);
            } else {
                // Si el usuario no es administrador, podrías redirigirlo a otra vista o mostrar un mensaje de error
                redirect('Home');
            }
        } else {
            // Si el usuario no está logeado, redirigir al formulario de inicio de sesión
            redirect('login');
        }

    }


    public function asignar_evaluador()
    {
        // Verificar si se ha enviado el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recuperar los datos del formulario
            $evaluador = $this->input->post('evaluador');
            $usuarios_seleccionados = $this->input->post('usuarios_seleccionados');
            $this->Usuario_model->guardar_datos_evaluador($evaluador, $usuarios_seleccionados);

            // Redirigir a alguna página de éxito
            redirect('Usuarios/asignar');
        }
    }

}




