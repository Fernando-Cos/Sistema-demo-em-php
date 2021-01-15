<?php 

session_start();

//Envio para redefinição de senhas...
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);


require_once 'auth.php';
$user = new Auth();

//Handle Register Ajax Resquest.
if (isset($_POST['action']) && $_POST['action'] == 'register') {
	$name = $user->test_input($_POST['name']);
	$email = $user->test_input($_POST['email']);
	$pass = $user->test_input($_POST['password']);

	$hpass = password_hash($pass, PASSWORD_DEFAULT);

	if ($user->user_exist($email)) {
		echo $user->showMessage('warning', 'Este E-mail Ja estar registrado!!!');
	}
	else {
		if ($user->register($name, $email, $hpass)) {
			echo 'register';

			$_SESSION['user'] = $email;
		}
		else {
			echo $user->showMessage('danger','Someyhing went wron!!! try again later');
		}
	}
}

//Handle Login Ajax Resquest.
if (isset($_POST['action']) && $_POST['action'] == 'login') {
	$email = $user->test_input($_POST['email']);
	$pass = $user->test_input($_POST['password']);

	$loggedInUser = $user->login($email);

	if ($loggedInUser != null) {
		if (password_verify($pass, $loggedInUser['password'])) {
			if(!empty($_POST['rem'])) {
				setcookie("email", $email, time()+(30*24*60*60), '/');
				setcookie("password", $pass, time()+(30*24*60*60), '/');
			}
			else {
				setcookie("email","",1, '/');
				setcookie("password","",1, '/');
			}

			echo 'login';
			$_SESSION['user'] = $email;
		}
		else {
			echo $user->showMessage('danger', 'A senha digitada não estar correta!!!');
		}
	}
	else {
		echo $user->showMessage('danger', 'Usuario não cadastrado!!!');
   }
}


//Handle Forgot Password Ajax...
if (isset($_POST['action']) && $_POST['action'] == 'forgot' ) {
	$email = $user->test_input($_POST['email']);

	$user_found = $user->currentUser($email);

	if($user_found != null) {
		$token = uniqid();
		$token = str_shuffle($token);

		$user->forgot_password($token,$email);

	try {
		$mail->IsSMTP(); 
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = Database::USERNAME;
		$mail->Password = Database::PASSWORD;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = 587;

		//estar servindo para o debug
		// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

		$mail->setFrom(Database::USERNAME,'DC');
		$mail->addAddress($email);
		

		$mail->IsHTML(true);
		$mail->Subject = 'Redefinição de Novas Senhas';
		$mail->Body = '<h3>Click no link para redefinir sua senha.<br>
			<a href="http://localhost/user-system/reset-pass.php?email='.$email.'&token='.$token.'">http://localhost/user-system/reset-pass.php?email='.$email.'&token='.$token.'</a><br>Enviado por TECNO&CIA</h3>';

		$body = $mail->Body;
		
		$mail->send();
		echo $user->showMessage('success', 'Foi enviado um email com as seguintes definições para a redefinização da senha');

		} catch (Exception $e) {
			// Utilizar esse comando em baixo caso o fawaill da maquina liberar o envio de e-mail.
			// echo $user->showMessage('danger', 'Algo deu errado tente novamente mas tarde!!!');
			print_r($body);

		}
	}
	else {
		echo $user->showMessage('info', 'O E-mail não estar cadastrado! Tente outro.');
	}
}
