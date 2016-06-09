<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2015 Alejandro Garcia
	 * VAM is licenced under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<?php
	$nombres = $_POST['nombres'];
	$apellidos = $_POST['apellidos'];
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$posicion = $_POST['pst'];
	$ivao = $_POST['ivao'];
	
	

	
	
	include('./db_login.php');
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		$sql = "SELECT * from staff WHERE email='$_POST[email]' ";
		if (!$result = $db->query($sql)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$existentuser = $result->num_rows;
		if ($existentuser > 0) 
		{
?>
			<div class="container">
				
						<h1>ERROR</h1>
						<hr>
						<br>
						<div class="alert alert-danger" role="alert">User already is registered.</div>
					
			</div>
<?php
		} 
		else 
		{
			if ($_POST["password"]) 
			{
				$encryptpassword = md5($pass);
				echo '<br>';
				$sql1 = "insert into staff (nombres,apellidos,vid_ivao,email,staff_ivao,password)
                    values ('$nombres','$apellidos','$ivao','$email','$posicion','$encryptpassword');";
				if (!$result = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			}
			// Send mail to the pilot
			
			$para      = $email;
$titulo    = 'Registro Staff IVAO CO';
$mensaje   = 'Buen día usted ha sido registrado exitosamente en Staff IVAO CO Admon

===============================

Sus datos son:

Username: ' . $email . '
Password: ' . $pass . '

==============================

Mensaje enviado automaticamente.

Saludos IVAO Colombia.
';
$cabeceras = 'From: co-wm@ivao.aero' . "\r\n" .
    'Reply-To: co-wm@ivao.aero' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);
?>
			<div class="container">
						<h1>Register Successful</h1>
						<hr>
						<br>
						<div class="alert alert-success" role="alert">We have sent a message to your email! Check right now!.</div>
					
			</div>
<?php
		}
		$db->close();

							
?>
			


