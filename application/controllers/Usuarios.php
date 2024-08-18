<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
        $this->load->model('Asignaciones_grupos_model');
        $this->load->model('Evaluacion_completada_model');

        if (empty($this->session->userdata('user_data'))) {
            redirect('/login');
        }
    }
    public function index()
    {
        $user_data = $this->session->userdata('user_data');

        // Verificar si el usuario está logeado
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
                $data['user_data'] = $user_data;

                $data['grupos'] = $this->Asignaciones_grupos_model->listado_GE($user_data->id);
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

                $data['usuarios'] = $this->Usuario_model->listado_general();
                // var_dump($data['usuarios']);
                // die;
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
    public function asignar($id_grupo)
    {
        $user_data = $this->session->userdata('user_data');

        // var_dump($user_data);

        // Verificar si el usuario está logeado
        if (!empty($user_data)) {
            // Si el usuario es administrador, cargar el header y la vista de usuarios
            if ($this->Usuario_model->has_role($user_data->id, 'Administrador') || $this->Usuario_model->has_role($user_data->id, 'Gestor de Evaluadores')) {
                $data['id_grupo'] = decrypt($id_grupo);
                $data['usuarios'] = $this->Usuario_model->usuarios_asignar($data['id_grupo']);
                $data['competencia_cargo'] = $this->Asignacion_cargo_model->findAll();

                $data['evaluadores'] = $this->Usuario_model->datos_evaluadores($data['id_grupo']);

                $data['user_data'] = $user_data;
                $this->load->view('layouts/header', $data);
                $this->view('admin/asignar_evaluador', $data);
                $this->view('layouts/footer', $data);
            } else {
                // Si el usuario no es administrador, podrías redirigirlo a otra vista o mostrar un mensaje de error
                redirect('Home');
            }
        } else {
            // Si el usuario no está logeado, redirigir al formulario de inicio de sesión
            redirect('login');
        }

    }


    public function asignar_evaluador($id_grupo)
    {
        // Verificar si se ha enviado el formulario
        if ($this->input->is_ajax_request()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Recuperar los datos del formulario
                if (!empty($this->input->post())) {
                    if (!empty($this->input->post('evaluador')) && !empty($this->input->post('usuarios_seleccionados'))) {
                        $this->Usuario_model->guardar_datos_evaluador($this->input->post('evaluador'), $this->input->post('usuarios_seleccionados'));
                        $this->if_success('Evaluador asignado con éxito');
                    } else {
                        $this->iffalse('Evaluador o usuarios no especificados');
                    }
                } else {
                    $this->iffalse('Sin datos enviados');
                }
            } else {
                $this->iffalse('Método HTTP no válido');
            }
        } else {
            $this->iffalse('Petición no válida');
        }
        $this->json();
    }

    public function agregar()
    {
        if (!empty($this->formData)) {
            if (empty($this->formData->id_usuario)) {
                $this->formData->password = hash("sha256", 'aula' . $this->formData->identificacion);      //cifrado de contraseña
                if (!$this->Usuario_model->existe($this->formData->email)) {
                    $this->db->trans_begin();
                    if ($this->Usuario_model->insert($this->formData) > 0) {
                        if ($this->asignar_grupos($id_usuario, $grupos)) {
                            // $envio_correo = $this->enviar_credenciales($this->formData);     //Descomentar para enviar correo
                            $envio_correo = $this->emular_correo();     //Comentar esta línea y descomentar la de arriba para efectuar el envío de correo
                            if (!empty($envio_correo->error)) {
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
                        } else {
                            $this->session->set_flashdata([
                                'success' => false,
                                'message' => 'Error al asignar grupos'
                            ]);
                            $this->db->trans_rollback();
                        }
                    }
                }
            } else {
                // Si llega un id de usuario, se actualiza el registro
                $this->db->trans_begin();
                $usuario_encontrado = $this->Usuario_model->usuario_por_correo($this->formData->email);
                if (empty($usuario_encontrado) || (!empty($usuario_encontrado) && $usuario_encontrado->id == $this->formData->id_usuario)) {
                    $id_usuario = $this->formData->id_usuario;
                    unset($this->formData->id_usuario);
                    if ($this->asignar_grupos($id_usuario, $this->formData->id_grupo)) {
                        unset($this->formData->id_grupo);
                        $this->Usuario_model->update($id_usuario, $this->formData);
                        $this->session->set_flashdata([
                            'success' => true,
                            'message' => 'Usuario actualizado con éxito'
                        ]);
                        $this->db->trans_commit();
                    } else {
                        $this->session->set_flashdata([
                            'success' => false,
                            'message' => 'Error al asignar grupos'
                        ]);
                        $this->db->trans_rollback();
                    }
                } else {
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

    protected function asignar_grupos($id_usuario, $grupos)
    {
        $asignaciones = [];
        if (is_array($grupos)) {
            foreach ($grupos as $grupo) {
                $asignaciones[] = (object) [
                    'id_usuario' => $id_usuario,
                    'id_grupo' => $grupo
                ];
            }
        } else {
            $asignaciones = [
                (object) [
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
        $data['usuario_info'] = $this->Usuario_model->obtener_usuarios_estudiantes($id);


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
        $data['estado_competencia'] = $this->Evaluacion_completada_model->find(['id_usuario' => $id, 'id_competencia' => $id_competencia]);


        $data['competencia'] = $this->Competencias_model->find(['id' => $id_competencia]);
        // $data['resultado'] = $this->Evaluacion_usuario_model->find(['id_usuario' => $id],'resultado')->resultado;
        $data['actividades_clave'] = $this->Actividad_competencia->asignadas_por_cargo($data['usuarios']->id_cargo, $id_competencia, $id);

        $this->load->view('layouts/header');
        $this->load->view('evaluador/evaluacion', $data);
        $this->load->view('layouts/footer');

    }

    public function descargar_plantilla()
    {
        $this->load->library('Excel');
        $this->excel->plantilla_masivo('Plantilla_usuarios.xlsx');
    }

    public function importar_masivo()
    {
        if (!empty($_FILES)) {
            $this->load->library('Excel');
            $usuarios = $this->excel->obtener_clientes($_FILES['usuarios']['tmp_name']);
            if (!empty($usuarios)) {
                foreach ($usuarios as $usuario) {
                    $this->db->trans_begin();
                    if (empty($usuario->id_grupo) || is_numeric(str_replace(';', '', $usuario->id_grupo))) {
                        $usuario->password = hash("sha256", 'aula' . $usuario->identificacion);
                        $usuario->Rol_ID = $this->Rol_model->buscarExacto($usuario->Rol_ID);
                        $usuario->id_cargo = $this->Cargos_model->buscarExacto($usuario->id_cargo);
                        $grupos = explode(';', $usuario->id_grupo);
                        unset($usuario->id_grupo);

                        //buscar identificación del usuario, si existe lo actualiza
                        $usuario_registrado = $this->Usuario_model->find(['identificacion' => $usuario->identificacion]);
                        if (empty($usuario_registrado)) {
                            $id_usuario = $this->Usuario_model->insert($usuario);
                        } else {
                            $this->Usuario_model->update($usuario_registrado->id, $usuario);
                            $id_usuario = $usuario_registrado->id;
                        }

                        if (!empty($id_usuario)) {
                            $this->db->trans_commit();
                            $this->if_success("Usuario $usuario->nombre $usuario->apellido creado con éxito");
                            if ($grupos) {
                                foreach ($grupos as $grupo) {
                                    if (empty($this->Grupo_asignado_model->find($grupo))) {
                                        if (!$this->Grupo_asignado_model->insert(['id' => $grupo])) {
                                            $this->iffalse("Error al crear el grupo $grupo");
                                        }
                                    }
                                }
                                if ($this->asignar_grupos($id_usuario, $grupos)) {
                                    $this->if_success("Grupos para $usuario->nombre $usuario->apellido asignados con éxito");
                                } else {
                                    $this->iffalse("Error al asignar grupos a $usuario->nombre $usuario->apellido");
                                }
                            }
                        } else {
                            $this->iffalse("Error al crear el usuario $usuario->nombre $usuario->apellido");
                        }
                    } else {
                        $this->iffalse("El grupo $usuario->id_grupo de $usuario->nombre $usuario->apellido no es válido");
                    }
                }
            } else {
                $this->iffalse('No se identificaron datos de usuarios');
            }
        } else {
            $this->iffalse('Cargue un archivo');
        }
        if (empty($this->reques->error)) {
            $this->if_success('Usuarios creados correctamente', true);
        } else {
            $this->iffalse(count($this->reques->error) . " errores al cargar usuarios.");
        }
        $this->json();
    }

    public function criterios_por_cargo($id_cargo, $id_actividad = "", $id_usuario = "")
    {
        if (!empty($id_actividad) && intval($id_actividad) > 0) {
            $this->load->model('Criterios_model', 'criterios');
            $this->reques->criterios = $this->criterios->asignados_por_cargo($id_cargo, $id_actividad, $id_usuario);
            if (!empty($this->reques->criterios)) {
                $this->reques->success = true;
            }
        } else {
            $this->iffalse('Actividad no válida para consultar');
        }
        $this->json();
    }

    public function guardar_evaluacion($id_actividad)
    {
        if (!empty($this->formData)) {
            $this->load->model('Evaluacion_usuario_model', 'evaluacion_usuario');
            if ($this->Actividad_competencia->evaluada($id_actividad, $this->formData->id_usuario)) { //VALIDAR SI YA SE EVALUÓ LA ACTIVIDAD
                $this->iffalse('Esta actividad clave ya ha sido evaluada');
            } else {
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
    private function if_success($msj = '', $clear = false)
    {
        $this->reques->success = true;
        if (empty($this->reques->message) || $clear) {
            $this->reques->message = $msj;
        } else {
            $this->reques->message .= "\n" . $msj;
        }
        // unset($this->reques->error);
        $this->session->set_flashdata((array) $this->reques);
    }

    public function terminar_evaluacion()
    {
        $id_usuario = $this->input->post('id_usuario');
        $id_competencia = $this->input->post('id_competencia');
        $estado_evaluacion = 1;
        $create_at = date('Y-m-d H:i:s');

        $respuesta = $this->Evaluacion_completada_model->insert(['id_usuario' => $id_usuario, 'id_competencia' => $id_competencia, 'create_at' => $create_at]);

        $estado_evaluacion = $this->Usuario_model->update($id_usuario, ['estado_evaluacion' => $estado_evaluacion]);

        if ($respuesta) {
            // Respuesta exitosa
            $response = array(
                'success' => true,
                'message' => 'Competencia completada para el usuario'
            );
        } else {
            // Respuesta de error
            $response = array(
                'success' => false,
                'message' => 'Error al actualizar el estado'
            );
        }

        echo json_encode($response);
    }
}




