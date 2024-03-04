<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->library('form_validation');

	}

	public function index()
	{

		$this->view('login');

	}

	// public function procesar()
	// {
	// 	// Procesar el formulario de inicio de sesión
	// 	$email = $this->input->post('email');
	// 	$password = $this->input->post('contrasena');

	// 	// Obtener el usuario autenticado desde el modelo de inicio de sesión
	// 	$user = $this->Login_model->get_user($email, hash('sha256', $password));     //Se compara con la contraseña hasheada

	// 	$this->form_validation->set_rules(
	// 		'email',
	// 		'correo del usuario',
	// 		'required',
	// 		array(
	// 			'required' => 'Por favor ingrese un %s',
	// 		)
	// 	);

	// 	$this->form_validation->set_rules(
	// 		'contrasena',
	// 		'contraseña',
	// 		'required',
	// 		array(
	// 			'required' => '<br> Por favor ingrese una %s',
	// 		)
	// 	);



	// 	if ($user) {
	// 		// Usuario autenticado, guardar toda la información del usuario en la sesión
	// 		if ($this->form_validation->run()) {
	// 			// Validación exitosa
	// 			if (!empty($datos->data) && $datos->success == 1) {

	// 				$this->session->set_userdata('user_data', $user);
	// 				$this->json(array('success' => 1, 'msg' => 'Bienvenido'));
	// 			} else {

	// 				$this->session->set_flashdata('mensaje', 'Datos Erróneos');
	// 				$this->json(array('success' => 0, 'msg' => 'Usuario o contraseña incorrectos'));
	// 			}
	// 		} else {
	// 			// Validación fallida
	// 			$this->json(array('success' => 0, 'msg' => $this->form_validation->error_array()));
	// 		}

	// 		redirect('Home');
	// 	} else {
	// 		// Usuario no autenticado, mostrar mensaje de error o redirigir al formulario de inicio de sesión
	// 		$this->session->set_flashdata('error', 'Usuario o contraseña incorrectos.');
	// 		redirect('login'); // Redirigir de vuelta al formulario de inicio de sesión
	// 	}
	// }

	public function procesar()
	{

		// Procesar el formulario de inicio de sesión
		$email = $this->input->post('email');
		$password = $this->input->post('contrasena');
		// Obtener el usuario autenticado desde el modelo de inicio de sesión
		$user = $this->Login_model->get_user($email, hash('sha256', $password)); //Se compara con la contraseña hasheada

		if ($user) {
			// Usuario autenticado
			$this->session->set_userdata('user_data', $user);
			$this->json(array('success' => 1, 'msg' => 'Bienvenido'));
		} else {
			// Usuario no autenticado
			$this->session->set_flashdata('error', 'Usuario o contraseña incorrectos.');
			$this->json(array('success' => 0, 'msg' => 'Usuario o contraseña incorrectos'));
			// Redirigir de vuelta al formulario de inicio de sesión
		}
	}


	public function logout()
	{
		// Limpiar la sesión y redirigir al formulario de inicio de sesión
		$this->session->sess_destroy(); // Elimina todos los datos de la sesión
		redirect('login'); // Redirige al formulario de inicio de sesión
	}



	// public function ingresar() {
	// 	if (!empty($this->formData->username) && !empty($this->formData->password)) {
	// 		// validar en http://ssologin
	// 		$this->load->library('ssologin');
	// 		$data = $this->ssologin->ingresar($this->formData->username, $this->formData->password);

	// 		if (!empty($data['data']) && $data['success'] && empty($data['errores'])) {
	// 			$datos = (object) $data['data'];
	// 			if ($datos->usuario == $this->formData->username && $datos->mail && $datos->tiempo) {
	// 				$datos->token = hash('sha256', $datos->token);
	// 				$data = array(
	// 					'mail' => $datos->mail,
	// 					'token' => $datos->token,
	// 					'roles' => !empty($datos->roles) ? implode(',', $datos->roles) : '',
	// 					'tiempo' => $datos->tiempo,
	// 					'nombre' => $datos->displayname
	// 				);
	// 				// consultar si existe
	// 				$user = $this->lg->findName(['usuario' => $this->formData->username]);
	// 				if (!empty($user->id) && $user->usuario) {
	// 					$data['update_at'] = date('Y-m-d H:i:s');
	// 					$this->updateuser($this->formData->username, $data);
	// 					$data['id'] = $user->id;
	// 				} else {
	// 					$data['created_at'] = date('Y-m-d H:i:s');
	// 					$data['usuario'] = $this->formData->username;
	// 					$data['id'] = $this->lg->insert($data);
	// 				}
	// 				$data['usuario'] = $this->formData->username;
	// 				$this->session->datosusuario = (object) $data;
	// 				$this->reques->url = 'home';
	// 			} else {
	// 				$this->updateuser($this->formData->username);
	// 				$this->iffalse('Error 39');
	// 			}
	// 		} else {
	// 			$this->updateuser($this->formData->username);
	// 			$this->errores($data);
	// 		}
	// 	} else $this->iffalse('Datos invalidos');
	// 	$this->json();
	// }
	public function salir()
	{
		$this->session->datosusuario = null;
		redirect(IP_SERVER . 'login');
	}
	// public function logout()
	// {
	// 	if (!empty($this->formData->usuario)) {
	// 		$this->updateuser($this->formData->usuario);
	// 		$this->reques->data = 'Logout';
	// 		$this->deletefiles();
	// 	} else {
	// 		$this->iffalse('no token');
	// 	}
	// 	unset($this->session->datosusuario);
	// 	$this->json();
	// }


}
