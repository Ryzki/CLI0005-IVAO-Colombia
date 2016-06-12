<?php	include('./db_login.php');		$target_path = "./uploadsnoticias/";$target_path = $target_path . basename($_FILES['image_file']['name']); if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) { echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";$nombresss = $_FILES['image_file']['name'];} else{echo "Ha ocurrido un error, trate de nuevo!";}	$nombresa = $_POST['nombre'];	$persona = $_POST['persona'];	$lugar = $_POST['lugar'];	$horauno = $_POST['horauno'];	$horados = $_POST['horados'];	$fecha = $_POST['fecha'];	$info = $_POST['info'];									
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into noticias (nombre_examen,hora_inicio,hora_utcinicio,lugar,usuario,fecha,informacion,imagen,staff)                    values ('$nombresa','$horauno','$horados','$lugar','$persona','$fecha','$info','$nombresss','$id');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
<script>alert('Información agregada satisfactoriamente.');window.location = './?page=noticias';</script>