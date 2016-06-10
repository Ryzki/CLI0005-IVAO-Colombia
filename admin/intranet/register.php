
<?php
header('Content-Type: text/html; charset=ISO-8859-1');


	$nombresa = $_POST['nombres'];
	$apellidosa = $_POST['apellidos'];
	$emailss = $_POST['email'];
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
			 <div id="page-wrapper" >
				
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
                    values ('$nombresa','$apellidosa','$ivao','$emailss','$posicion','$encryptpassword');";
				if (!$result = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
			}
			// Send mail to the pilot
			











$para      = $emailss;
$titulo    = 'Registro Staff Sistema IVAO Colombia';



$mensaje = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>IVAO Colombia</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="http://www.aeroclubdelatlantico.com.co/wp-content/uploads/2015/04/hagase-piloto.png" alt="Pilot" width="300" height="230" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Saludos ' . $nombresa . ' ' . $apellidosa . ' desde IVAO Colombia!</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										En este Email, encontrará consignada la información de ingreso al sistema.<br>
										<b>www.ivaocol.com.co/admin/</b>
									</td>
								</tr>
								<tr>
									<td>
										<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<tr>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<img src="http://www.datadviser.com/www/imagenes/seguridad.png" alt="" width="100%" height="140" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																Su usuario es: <b>' . $email . '</b><br>
																Su clave es: <b>' . $pass . '</b>
															</td>
														</tr>
													</table>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">
													&nbsp;
												</td>
												<td width="260" valign="top">
													<table border="0" cellpadding="0" cellspacing="0" width="100%">
														<tr>
															<td>
																<img src="http://www.ivaocol.com.co/img/ivaoco.png" alt="" width="100%" height="140" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																Esperamos que disfrutes de nuestros servicios IVAO Co, no olvidar cambiar su contraseña.
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
										&reg; IVAO Colombia<br/>
										<a href="#" style="color: #ffffff;"><font color="#ffffff">Compartiendo</font></a> la misma pasión!
									</td>
									<td align="right" width="25%">
										<table border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="https://www.ivao.aero" style="color: #ffffff;">
														<img src="https://www.ivao.aero/assets//img/logo1-default.png" alt="Twitter" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
												<td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
												<td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold;">
													<a href="http://www.ivaocol.com.co/" style="color: #ffffff;">
														<img src="http://www.ivaocol.com.co/img/ivaoco.png" alt="Facebook" width="38" height="38" style="display: block;" border="0" />
													</a>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';




$cabeceras = 'From: co-staff@ivao.aero' . "\r\n" .
    'Reply-To: co-staff@ivao.aero' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
	$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

mail($para, $titulo, utf8_decode($mensaje), $cabeceras);
?>
			 <div id="page-wrapper" >
						<h1>Registro Satisfactorio</h1>
						<hr>
						<br>
						<div class="alert alert-success" role="alert">Nosotros hemos enviado el mensaje de registro efectivamente.</div>
					
			</div>
<?php
		}
		$db->close();

							
?>
			


