<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class PHP_Mailer {
	public function __construct() {
		log_message('Debug', 'PHPMailer class is loaded.');
	}
	public function load() {
		require_once APPPATH . "third_party/phpmailer/PHPMailerAutoload.php";
		$objMail = new PHPMailer;
		return $objMail;
	}
	/**
	 * enviarcorreo
	 * @author Juan Guevara <juanjose.guevararozo@gmail.com>
	 *
	 * @param  mixed $correo = {
	 *      subject: Tema del correo,
	 *      email: para quien es el correo,
	 *      body: contenido del correo,
	 *      addbcc: copiar, addbcc: array(copiar1=>uno, copiar2=>dos)
	 * }
	 * @return array(error,email,success)
	 */
	public function enviarcorreo($correo) {
		$return = (object) ['success' => ''];
		if (!empty($correo->email)) {
			$return->email = $correo->email;
			try {
				$mail = $this->load();
				$mail->CharSet = 'UTF-8'; // Enable verbose debug output
				$mail->isSMTP(); // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
				$mail->SMTPAuth = true; // Enable SMTP authentication
				$mail->Username = '*************'; // SMTP username (REEMPLAZAR EN LOCAL CON EL CORREO DEL SMTP - NO SUBIR)
				$mail->Password = '********'; // SMTP password   (REEMPLAZAR EN LOCAL CON LA CONTRASEÑA DEL SMTP - NO SUBIR)
				$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;
				$mail->setFrom('juanjose.guevararozo@gmail.com', 'Aula Competencias');
				$mail->Subject = empty($correo->subject) ? 'Aula Competencias' : $correo->subject;
                $mail->AddEmbeddedImage(FCPATH . "assets/img/logoAula.png", "main_logo");  //logo principal
				$mail->IsHTML(true);
				$mail->addAddress($correo->email);
				if (!empty($correo->addbcc)) {
					if (is_array($correo->addbcc)) {
						foreach ($correo->addbcc as $v) {
							$mail->addBcc($v);
						}
					} else {
						$mail->addBcc($correo->addbcc);
					}
				}
				$mail->Body = empty($correo->body) ? 'Aula Competencias' : $correo->body;
				if ($mail->send()) {
					$return->success = 1;
				} else {
					$return->error = "No se pudo enviar el mensaje. Error de envío: {$mail->ErrorInfo}";
				}
			} catch (Exception $e) {
				$return->error = print_r($e, 1);
			}
		} else {
			$return->error = 'Sin correo';
		}
		return $return;
	}
	public function verhtml($html = '') {
		echo $html;
	}
}
