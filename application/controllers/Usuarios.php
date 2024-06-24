<?php
defined('BASEPATH') or exit ('No direct script access allowed');
require_once 'application/third_party/Autoloader.php';
require_once 'application/third_party/psr/Autoloader.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
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
        $this->load->model('Grupo_asignado_model');
        $this->load->model('Competencias_model');
        $this->load->model('Usuario_competencia');
        $this->load->model('Actividad_competencia');
        $this->load->model('Evaluacion_usuario_model');
        $this->load->model('Asignacion_cargo_model');
        $this->load->model('Cargos_model');
        if(empty($this->session->userdata('user_data'))){
            redirect('/login');
        }
    }
    public function index()
    {
        $user_data = $this->session->userdata('user_data');

        // Verificar si el usuario está logeado
        if (!empty ($user_data)) {
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
        if (!empty ($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {

                $data['usuarios'] = $this->Usuario_model->listado_general();
                $data['roles'] = $this->Rol_model->listado();
                $data['cargos'] = $this->Cargos_model->listado();
                $data['grupos'] = $this->Grupo_asignado_model->findAll();
                $data['user_data'] = $user_data;

                $this->load->view('layouts/header', $data);
                $this->view('admin/usuarios_detalle', $data);
                $this->load->view('layouts/footer');
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

        // var_dump($user_data);

        // Verificar si el usuario está logeado
        if (!empty ($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {

                $data['usuarios'] = $this->Usuario_model->usuarios_asignar();
                $data['competencia_cargo'] = $this->Asignacion_cargo_model->findAll();

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
            // $competencia = $this->input->post('competencia');



            $usuarios_seleccionados = $this->input->post('usuarios_seleccionados');

            $this->Usuario_model->guardar_datos_evaluador($evaluador, $usuarios_seleccionados);

            // $this->Usuario_competencia->guardar_datos_evaluador($competencia $usuarios_seleccionados);

            // Redirigir a alguna página de éxito
            redirect('Usuarios/asignar');
        }
    }

    public function agregar()
    {
        if (!empty ($this->formData)) {
            if(empty($this->formData->id_usuario)){
                $this->formData->password = hash("sha256", 'aula' . $this->formData->identificacion);      //cifrado de contraseña
                if (!$this->Usuario_model->existe($this->formData->email)) {
                    $this->db->trans_begin();
                    if ($this->Usuario_model->insert($this->formData) > 0) {
                        if($this->asignar_grupos($id_usuario, $grupos)){
                            // $envio_correo = $this->enviar_credenciales($this->formData);     //Descomentar para enviar correo
                            $envio_correo = $this->emular_correo();     //Comentar esta línea y descomentar la de arriba para efectuar el envío de correo
                            if (!empty ($envio_correo->error)) {
                                $this->session->set_flashdata([
                                    'success' => false,
                                    'message' => 'Error al notificar al usuario'
                                ]);
                                $this->db->trans_rollback();
                            } else {
                                $this->session->set_flashdata([
                                    'success' => true,
                                    'message' => 'Usuario agregado con éxito'
                                ]);
                                $this->db->trans_commit();
                            }
                        }else{
                            $this->session->set_flashdata([
                                'success' => false,
                                'message' => 'Error al asignar grupos'
                            ]);
                            $this->db->trans_rollback();
                        }
                    }
                }
            }else{
                // Si llega un id de usuario, se actualiza el registro
                $this->db->trans_begin();
                $usuario_encontrado = $this->Usuario_model->usuario_por_correo($this->formData->email);
                if (empty($usuario_encontrado) ||(!empty($usuario_encontrado) && $usuario_encontrado->id == $this->formData->id_usuario)) {
                    $id_usuario = $this->formData->id_usuario;
                    unset($this->formData->id_usuario);
                    if($this->asignar_grupos($id_usuario, $this->formData->id_grupo)){
                        unset($this->formData->id_grupo);
                        $this->Usuario_model->update($id_usuario, $this->formData);
                        $this->session->set_flashdata([
                            'success' => true,
                            'message' => 'Usuario actualizado con éxito'
                        ]);
                        $this->db->trans_commit();
                    }else{
                        $this->session->set_flashdata([
                            'success' => false,
                            'message' => 'Error al asignar grupos'
                        ]);
                        $this->db->trans_rollback();
                    }
                }else{
                    $this->session->set_flashdata([
                        'success' => false,
                        'message' => 'Ya existe un usuario con ese correo'
                    ]);
                    $this->db->trans_rollback();
                }
            }
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }

    protected function asignar_grupos($id_usuario,$grupos){
        $asignaciones=[];
        if(is_array($grupos)){
            foreach($grupos as $grupo){
                $asignaciones[] = (object)[
                    'id_usuario' => $id_usuario,
                    'id_grupo' => $grupo
                ];
            }
        }else{
            $asignaciones = [
                (object)[
                    'id_usuario' => $id_usuario,
                    'id_grupo' => $grupos
                ]
            ];
        }
        $this->load->model('Asignaciones_grupos_model');
        $this->Asignaciones_grupos_model->delete(['id_usuario' => $id_usuario]);   // elimina los registros del usuario para sobreescribirlos
        return $this->Asignaciones_grupos_model->asignar_grupos($asignaciones);
    }
    protected function enviar_credenciales($usuario)
    {
        $this->load->library('php_mailer');
        $correo = (object) array(
            'email' => $usuario->email,
            'subject' => 'Credenciales de acceso AULA',
            'body' => $this->view('mails/_credenciales', (object) ['usuario' => $usuario], TRUE),
        );
        return $this->php_mailer->enviarcorreo($correo);
    }
    protected function emular_correo()
    {
        return (object) ['error' => ''];
    }


    public function evaluacion_usuario($id)
    {
        $user_data = $this->session->userdata('user_data');


        $data['usuario'] = $this->Usuario_model->find($id);

        // Obtener todas las entradas de usuarios_competencias para el usuario dado
        $data['competencias_cargo'] = $this->Competencias_model->asignadas_por_cargo($data['usuario']->id_cargo);
        // $data['competencias'] = $this->Competencias_model->competencias_por_usuario($id);

   // $data['area'] = $this->Area_model->find(['id' => $user_data->id_area], 'nombre')->nombre;

        // var_dump( $data['area']);
        // die;

        // $this->load->view('layouts/header');
        $this->vista('evaluador/evaluacion_usuario', $data);
    }

    public function evaluacion($id, $id_competencia)
    {
        $user_data = $this->session->userdata('user_data');
        $data['usuarios'] = $this->Usuario_model->find($id);

        // $data['area'] = $this->Area_model->find(['id' => $user_data->id_area], 'nombre')->nombre;

        $data['competencia'] = $this->Competencias_model->find(['id' => $id_competencia]);
        // $data['resultado'] = $this->Evaluacion_usuario_model->find(['id_usuario' => $id],'resultado')->resultado;
        $data['actividades_clave'] = $this->Actividad_competencia->asignadas_por_cargo($data['usuarios']->id_cargo, $id_competencia, $id);

        $this->load->view('layouts/header');
        $this->load->view('evaluador/evaluacion', $data);
        $this->load->view('layouts/footer');

    }

    public function importar_masivo(){
        if(!empty($_FILES)){
            try{
                $spreadsheet = IOFactory::load($_FILES['usuarios']['tmp_name']);
                // leer la hoja 1 del excel cargado
                $worksheet = $spreadsheet->getSheetByName('usuarios'); // lectura por indice
                $rows = $worksheet->toArray(null, true, true, true);
                $usuarios = [];
                foreach($rows as $row => $columns){
                    if ($row >= 2) {
                        $this->load->model('Rol_model');
                        $this->load->model('Cargos_model');
                        $usuarios[] = (object)[
                            'nombre' => $columns['A'],
                            'apellido' => $columns['B'],
                            'email' => $columns['C'],
                            'password' => hash("sha256", 'aula' . $columns['D']),
                            'identificacion' => $columns['D'],
                            'Rol_ID' => $this->Rol_model->buscarExacto($columns['E']),
                            'id_cargo' => $this->Cargos_model->buscarExacto($columns['F']),
                            'id_grupo' => $columns['G'],
                        ];
                    }
                }
                $this->db->trans_begin();
                if($this->Usuario_model->insert_masivo($usuarios)){
                    $this->db->trans_commit();
                    $this->reques->message = "Se registraron ".count($usuarios)." usuarios";
                    $this->session->set_flashdata([
                        'message' => $this->reques->message,
                        'success' => true,
                    ]);
                }else{
                    $this->db->trans_rollback();
                    $this->iffalse('Ocurrió un error al insertar los usuarios');
                }
            }catch(Exception $e){
                $this->iffalse('Error al abrir el archivo');
            }
        }else{
            $this->iffalse('Cargue un archivo');
        }
        $this->json();
    }

    public function criterios_por_cargo($id_cargo, $id_actividad = "", $id_usuario = "")
    {
        if (!empty ($id_actividad) && intval($id_actividad) > 0) {
            $this->load->model('Criterios_model', 'criterios');
            $this->reques->criterios = $this->criterios->asignados_por_cargo($id_cargo, $id_actividad, $id_usuario);
            if (!empty ($this->reques->criterios)) {
                $this->reques->success = true;
            }
        } else {
            $this->iffalse('Actividad no válida para consultar');
        }
        $this->json();
    }

    public function guardar_evaluacion($id_actividad)
    {
        if (!empty ($this->formData)) {
            $this->load->model('Evaluacion_usuario_model', 'evaluacion_usuario');
            if($this->Actividad_competencia->evaluada($id_actividad,$this->formData->id_usuario)){ //VALIDAR SI YA SE EVALUÓ LA ACTIVIDAD
                $this->iffalse('Esta actividad clave ya ha sido evaluada');
            }else{
                foreach ($this->formData->id_criterio_competencia as $indice => $id_criterio_competencia) {
                    $data[] = (object) [
                        'id_criterio_competencia' => $id_criterio_competencia,
                        'id_usuario' => $this->formData->id_usuario,
                        'resultado' => $this->formData->resultado[$indice]
                    ];
                }
                if ($this->evaluacion_usuario->insertar_evaluacion($data)) {
                    $this->session->set_flashdata([
                        'success' => true,
                        'message' => 'El usuario ha sido evaluado con éxito'
                    ]);
                    $this->reques = (object) [
                        'success' => true,
                        'message' => 'El usuario ha sido evaluado con éxito'
                    ];
                    // redirect('usuarios/evaluacion_usuario/' . $this->formData->id_usuario);
                }
            }
        } else {
            $this->iffalse('No ingresó ningún valor');
        }
        $this->json();
    }
}




