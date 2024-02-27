<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once 'application/third_party/Autoloader.php';
require_once 'application/third_party/psr/Autoloader.php';
class Usuarios extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->validatoken()) {
        //     $this->iffalse('Acceso denegado');
        //     $this->json();
        //     die();

        $this->load->model('Usuario_model');
    }
    public function index()
    {
        $user_data = $this->session->userdata('user_data');

        // Verificar si el usuario está logeado
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->ID_usuario, 'Administrador')) {
                $data['user_data'] = $user_data;
                $this->load->view('layouts/header', $data);
                $this->view('admin/usuarios', $data);
            } else {
                // Si el usuario no es administrador, podrías redirigirlo a otra vista o mostrar un mensaje de error
                redirect('Home');
            }
        } else {
            // Si el usuario no está logeado, redirigir al formulario de inicio de sesión
            redirect('login');
        }

    }
    public function detalle_usuarios()
    {
        $user_data = $this->session->userdata('user_data');

        // Verificar si el usuario está logeado
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->ID_usuario, 'Administrador')) {

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

}




