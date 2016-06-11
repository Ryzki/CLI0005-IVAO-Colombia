<?php	$target_path = "./uploads/";$target_path = $target_path . basename($_FILES['image_file']['name']); if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) { echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";$nombresss = $_FILES['image_file']['name'];} else{echo "Ha ocurrido un error, trate de nuevo!";}?><?	$nombresa = $_POST['nombre'];	$horauno = $_POST['horauno'];	$horados = $_POST['horados'];	$fecha = $_POST['fecha'];	$info = $_POST['info'];			include('./db_login.php');							
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into eventos (nombre,hora_inicio,hora_fin,fecha,informacion,imagen,staff)                    values ('$nombresa','$horauno','$horados','$fecha','$info','$nombresss','$id');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
