<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Mallas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->validatoken()) {
        //     $this->iffalse('Acceso denegado');
        //     $this->json();

        if (empty($this->session->userdata('user_data'))) {
            redirect('Login');
        } else {
            $this->load->model('Usuario_model');
            $this->load->model('Rol_model');
            $this->load->model('Grupo_asignado_model');
            $this->load->model('Competencias_model');
            $this->load->model('Usuario_competencia');
            $this->load->model('Actividad_competencia');
            $this->load->model('Evaluacion_usuario_model');
            $this->load->model('Asignacion_cargo_model');
            $this->load->model('Cargos_model');
            $this->load->model('Asignaciones_grupos_model');
            $this->load->model('Mallas_model');
        }

    }
    public function index()
    {
        $user_data = $this->session->userdata('user_data');
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador')) {
                $data['mallas'] = $this->Mallas_model->get_mallas();

                $this->load->view('layouts/header');
                $this->load->view('admin/mallas', $data);
            } elseif ($this->Usuario_model->has_role($user_data->id, 'Usuario')) {
                // Si el usuario es usuario, cargar el header y la vista de usuario
                $data['mallas'] = $this->Mallas_model->get_mallas();
                $this->load->view('layouts/header');
                $this->load->view('usuario/mallas_usuario',$data );
            }
        } else {

            redirect('Login');

        }
    }


    public function cargo_cursos($id_cargo)
    {
        $data['cargo'] = $this->Cargos_model->find($id_cargo, 'nombre');
        $data['cursos'] = $this->Mallas_model->get_cursos($id_cargo);
        $this->load->view('layouts/header');
        $this->load->view('admin/cargo_cursos', $data);
    }

    public function editar_curso()
    {
        $id_curso = $this->input->post('id');
        $nombre_curso = $this->input->post('nombre');
        $categoria_curso = $this->input->post('categoria');
        $url_curso = $this->input->post('url');

        $data = array(
            'nombre' => $nombre_curso,
            'categoria' => $categoria_curso,
            'url_curso' => $url_curso
        );
        $this->load->model('Cursos_model');
        $repsuesta = $this->Cursos_model->update($id_curso, $data);

        if (empty($respuesta)) {
            $response = (object) ['status' => '1', 'message' => 'Curso actualizado correctamente'];
            echo json_encode($response);
        } else {
            $response = (object) ['status' => '2', 'message' => 'Error al actualizar'];
            echo json_encode($response);
        }
    }
    public function eliminar_curso()
    {
        $id_curso = $this->input->post('id');
        $this->load->model('Cursos_model');
        $respuesta = $this->Cursos_model->delete($id_curso);
        if (empty($respuesta)) {
            $response = (object) ['status' => '1', 'message' => 'Curso eliminado correctamente'];
            echo json_encode($response);
        } else {
            $response = (object) ['status' => '2', 'message' => 'Error al eliminar'];
            echo json_encode($response);
        }
    }


    public function get_cargos(){
        $id_area = $this->input->post('id_area');
        $cargos = $this->Mallas_model->get_cargos($id_area);
        echo json_encode($cargos);
    }
    public function get_cursos_usuario() {
        $id_cargo = $this->input->post('id_cargo');
        $id_area = $this->input->post('id_area');
        $cursos = $this->Mallas_model->get_cursos_por_cargo($id_cargo);
        // Verificar los datos obtenidos
        echo json_encode($cursos);
    }
}