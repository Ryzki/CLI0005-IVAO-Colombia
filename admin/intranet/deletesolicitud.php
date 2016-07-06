
<?

$idss = $_GET['id'];
$web = $_GET['web'];			
	include('./db_login.php');
	
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
	
		
		
		
		$sql1 = "UPDATE solicitudeseventosatc set estado='2' where id='$idss'";
		
			

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
	
		
		$aeropuerto = $_GET['aeropuerto'];
$posicion = $_GET['posicion'];
$mix=$_GET['mix'];
$horauno = $_GET['horauno'];
$horados = $_GET['horados'];	
$fecha = $_GET['fecha'];	
$evento = $web;	
$vidse = $_GET['vidse'];	
$ranks2= $_GET['ranks2'];		


			
			
			
			
	
		
		
		
	
	
	
	
			

			
$sql2e = "SELECT * FROM usuariosivao where  vid='$vidse'";

	if (!$result2e = $db->query($sql2e)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2e = $result2e->fetch_assoc()) {
		
		$emaile = $row2e['email'];
		$nameaa = $row2e['nombres'] . ' ' . $row2e['apellidos'];
	}
	
	
	
		
	
	if($emaile!="") {
		
		
		
		
		
		

$para      = $emaile;
$titulo    = 'Rechazo ATC Sistema IVAO Colombia';



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
							<img src="http://www.oposiciones.de/img/destacado_foto/microsite-controlador.png" alt="Pilot" width="300" height="230" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Saludos Señor ' .$nameaa . ' desde IVAO Colombia!</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										Muchas gracias por su solicitud para participar en el evento como ATC, lastimosamente no ha pasado el filtro de elección, como este es un mensaje automático no mostrará el porqué.
									<br>Brevemente pudo haber sido por la demanda de personal con rangos, entrenamiento, entre otros, si desea saber, puede contactar por Buzón de Mensajes en el sistema.
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
																<img src="http://www.datadviser.com/www/imagenes/seguridad.png" alt="" width="100%" height="180" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																Su VID es: <b>' . $vidse . '</b><br>
																Fecha de Evento es: <b>' . $fecha . '</b><br>
																Horario de Evento es: <b>' . $horauno . ' hasta ' . $horados . '</b><br>
																Aeropuerto de Evento es: <b>' . $aeropuerto . ' - ' . $posicion . '</b><br>
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
																<img src="http://pacopartearroyo.net/img/prj/tcbarajasalzsolo.png" alt="" width="100%" height="180" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																Esperamos que disfrutes de nuestros servicios IVAO Co, gracias por ser parte de nosotros.
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
alert('Información eliminada satisfactoriamente.');
window.location = './?page=infoeventoatcmas&id=<?php echo $web; ?>';
</script>

