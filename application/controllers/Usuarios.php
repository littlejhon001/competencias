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
        $this->load->model('Usuario_model');
        $this->load->model('Rol_model');
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
                $data['roles'] = $this->Rol_model->listado();
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

    public function agregar(){
        if(!empty($this->formData)){
            $this->formData->password = hash("sha256",'aula'.$this->formData->identificacion);      //cifrado de contraseña
            if(!$this->Usuario_model->existe($this->formData->email)){
                $this->db->trans_begin();
                if($this->Usuario_model->insert($this->formData) > 0){
                    // $envio_correo = $this->enviar_credenciales($this->formData);     //Descomentar para enviar correo
                    $envio_correo = $this->emular_correo();     //Comentar esta línea y descomentar la de arriba para efectuar el envío de correo
                    if(!empty($envio_correo->error)){
                        $this->session->set_flashdata([
                            'success' => false,
                            'message' => 'Error al notificar al usuario'
                        ]);
                        $this->db->trans_rollback();
                    }else{
                        $this->session->set_flashdata([
                            'success' => true,
                            'message' => 'Usuario agregado con éxito'
                        ]);
                        $this->db->trans_commit();
                    }
                }
            }
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }
    protected function enviar_credenciales($usuario){
        $this->load->library('php_mailer');
        $correo = (object) array(
            'email' => $usuario->email,
            'subject' => 'Credenciales de acceso AULA',
            'body' => $this->view('mails/_credenciales',(object)['usuario' => $usuario], TRUE),
        );
        return $this->php_mailer->enviarcorreo($correo);
    }
    protected function emular_correo(){
        return (object)['error' => ''];
    }
}




