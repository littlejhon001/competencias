<?php
defined('BASEPATH') or exit ('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class AsignacionCargoCompetencia extends CI_Controller
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
        $this->load->model('Asignacion_cargo_model');

    }

    public function eliminar_asignacion()
    {
        // Obtener los IDs del cargo y el criterio desde la solicitud POST
        $id_cargo = $this->input->post('id_cargo');
        $id_criterio = $this->input->post('id_criterio');

        // Verificar si se proporcionaron los IDs del cargo y el criterio
        if (!empty ($id_cargo) && !empty ($id_criterio)) {
            // Intentar eliminar la asignación
            $eliminado = $this->Asignacion_cargo_model->eliminar_asignacion($id_cargo, $id_criterio);

            // Comprobar si se eliminó correctamente
            if ($eliminado) {
                // Enviar una respuesta JSON de éxito
                $response = array('success' => true, 'message' => 'Competencia personalizada eliminada correctamente.');
                echo json_encode($response);
            } else {
                // Enviar una respuesta JSON de error
                $response = array('success' => false, 'message' => 'Error al eliminar la asignación.');
                echo json_encode($response);
            }
        } else {
            // Enviar una respuesta JSON de error si falta algún ID
            $response = array('success' => false, 'message' => 'Faltan los IDs del cargo y/o el criterio.');
            echo json_encode($response);
        }
    }
    public function eliminar_actividad()
    {
        // Obtener los IDs del cargo y el criterio desde la solicitud POST
        $id_cargo = $this->input->post('id_cargo');
        $id_actividad = $this->input->post('id_actividad');

        // Verificar si se proporcionaron los IDs del cargo y el criterio
        if (!empty ($id_cargo) && !empty ($id_actividad)) {
            // Intentar eliminar la asignación
            $eliminado = $this->Asignacion_cargo_model->eliminar_actividad($id_cargo, $id_actividad);

            // Comprobar si se eliminó correctamente
            if ($eliminado) {
                // Enviar una respuesta JSON de éxito
                $response = array('success' => true, 'message' => 'Actividad  eliminada correctamente.');
                $this->json($response);
            } else {
                // Enviar una respuesta JSON de error
                $response = array('success' => false, 'message' => 'Error al eliminar la actividad.');
                echo json_encode($response);
            }
        } else {
            // Enviar una respuesta JSON de error si falta algún ID
            $response = array('success' => false, 'message' => 'Faltan los IDs del cargo y/o la actividad.');
            echo json_encode($response);
        }
    }
    public function eliminar_competencia()
    {
        // Obtener los IDs del cargo y el criterio desde la solicitud POST
        $id_cargo = $this->input->post('id_cargo');
        $id_competencia = $this->input->post('id_competencia');

        // Verificar si se proporcionaron los IDs del cargo y el criterio
        if (!empty ($id_cargo) && !empty ($id_competencia)) {
            // Intentar eliminar la asignación
            $eliminado = $this->Asignacion_cargo_model->eliminar_competencia($id_cargo, $id_competencia );

            // Comprobar si se eliminó correctamente
            if ($eliminado) {
                // Enviar una respuesta JSON de éxito
                $response = array('success' => true, 'message' => 'Competencia eliminada correctamente.');
                $this->json($response);
            } else {
                // Enviar una respuesta JSON de error
                $response = array('success' => false, 'message' => 'Error al eliminar la Competencia.');
                echo json_encode($response);
            }
        } else {
            // Enviar una respuesta JSON de error si falta algún ID
            $response = array('success' => false, 'message' => 'Faltan los IDs del cargo y/o la Competencia.');
            echo json_encode($response);
        }
    }
}




