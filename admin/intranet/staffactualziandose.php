
<?php
			include('./db_login.php');
			
		
		
		

	        $ides = $_POST['id'];
			$callsigne = utf8_decode($_POST['nombrea']);
			$callsignee = utf8_decode($_POST['apellidos']);
			$vides = $_POST['vides'];
			$correosa = $_POST['correos'];
			$psta = $_POST['pst'];
	
			
				

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
			$sql2 = "SELECT * FROM staff where id='$ides'";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {
		$nombresuno = $row2['nombres'];
		$nombresdos = $row2['apellidos'];
		$videssa = $row2['vid_ivao'];
		$emailaa = $row2['email'];
	}
		
		
		


if (($nombresuno == $callsigne) || ($nombresdos == $callsignee) || ($videssa == $vides) || ($correosa == $emailaa)) {
	


$sql112 = "UPDATE staff set nombres='$callsigne', apellidos='$callsignee', vid_ivao='$vides', email='$correosa', staff_ivao='$psta' where id='$ides'";

		if (!$result112 = $db->query($sql112)) {
			die('There was an error running the query [' . $db->error . ']');
		}


	
	
} else if (($nombresuno <> $callsigne) || ($nombresdos <> $callsignee) || ($videssa <> $vides) || ($correosa <> $emailaa)) {
	
	

	$sql1122 = "UPDATE staff set nombres='$callsigne', apellidos='$callsignee', vid_ivao='$vides', email='$correosa', staff_ivao='$psta' where id='$ides'";

		if (!$result1122 = $db->query($sql1122)) {
			die('There was an error running the query [' . $db->error . ']');
		}

			
			
			
			
			



$para      = $correosa;
$titulo    = 'Actualización Staff Sistema IVAO Colombia';



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
										<b>Saludos ' . $callsigne . ' ' . $callsignee . ' desde IVAO Colombia!</b>
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
																Su usuario es: <b>' . $correosa . '</b><br>
																Su clave sigue siendo la misma (de ser primera vez), de no ser así espere que prontamente le llegará una nueva clave generada por el sistema.
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

mail($para, utf8_decode($titulo), utf8_decode($mensaje), $cabeceras);
			
			
			
			
			
			
			
		}
	
		
	
		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=actualizarstaff&id=<?php echo $ides; ?>';
</script>


