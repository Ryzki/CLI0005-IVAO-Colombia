


         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>IVAO Colombia</h2>   
                        <h5>Bienvenido <?php echo $nombres . ' ' . $apellidos; ?> , Encantado de volverte a ver. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Mis Reclamos, Opiniones y Sugerencias.
                        </div>
                        <div class="panel-body">
                            <div class="row">
							
                                        <div class="col-md-12">
<?php
			include('./db_login.php');
			
		
		
		$correosa = $_POST['correos'];

	        $ides = $_POST['idasee'];
	
			
				

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		

$sql = 'select * from staff where id="' . $ides . '"';
	if (!$result = $db->query($sql)) {
	die('There was an error running the query [' . $db->error . ']');
}
	else
	{
	$number_of_rows = $result->num_rows;
	if ($number_of_rows > 0)
	{
	$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

	for ($i = 0 ; $i < 12 ; $i++) {
		$cad .= substr($str , rand(0 , 62) , 1);
	}
	$clave = $cad;
	$con_encriptada = md5($clave);
	
	// update the password
	$sql = 'UPDATE staff SET password="' . $con_encriptada . '" where id="' . $ides . '"';

	if (!$result = $db->query($sql)) {
		die('There was an error running the query [' . $db->error . ']');
	}


	





















	$para      = $correosa;
$titulo    = 'IVAO Colombia Sistema - Nueva Contraseña';



$mensaje = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ColStar VA | Password</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">	
		<tr>
			<td style="padding: 10px 0 30px 0;">
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
					<tr>
						<td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="https://www.ivao.aero/images/svg_logos/CO.svg" alt="Pilot" width="300" height="300" style="display: block;" />
						</td>
					</tr>
					<tr>
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
										<b>Saludos staff desde IVAO Colombia!</b>
									</td>
								</tr>
								<tr>
									<td style="padding: 20px 0 30px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
										En este Email, encontrará consignado su nueva contraseña, gracias por utilizar nuestros servicios.
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
																
																Su email es : <b>' . $correosa . '</b><br>
																Su nueva contraseña es: <b>' . $clave . '</b>
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
																<img src="http://www.avjobs.com/images/v_png_v5/v_collection_png/256x256/shadow/pilot.png" alt="" width="100%" height="140" style="display: block;" />
															</td>
														</tr>
														<tr>
															<td style="padding: 25px 0 0 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
																Hoy es un grandía para volar!
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




$cabeceras = 'From: co-hq@ivao.aero' . "\r\n" .
    'Reply-To: co-hq@ivao.aero' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	
	$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=ISO-8859-1' . "\r\n";

mail($para, utf8_decode($titulo), utf8_decode($mensaje), $cabeceras);








echo '<hr>';

echo '<h1>La nueva Clave es: </h1><b>' . $clave . '</b><h2>Registrada para el correo: </h2><b>' . $correosa . '</b>';















							}
							else
							{
						
						
				
echo '<hr>';

echo '<h1>Hubo un error en el proceso</h1>';


		
						
						
							}
						}
						?>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>