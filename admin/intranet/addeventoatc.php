<?php	include('./db_login.php');		$nombresa = $_POST['nombre'];	$horauno = $_POST['horauno'];	$horados = $_POST['horados'];	$horaunoU = $_POST['horaunoU'];	$horadosU = $_POST['horadosU'];	$fecha = $_POST['fecha'];	$info = $_POST['info'];									
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into eventosatc (titulo,horario_inicio,horario_fin,fecha,informacion,staff,inicioutc,finutc)                    values ('$nombresa','$horauno','$horados','$fecha','$info','$id','$horaunoU','$horadosU');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
<script>alert('Información agregada satisfactoriamente.');window.location = './?page=eventatcs';</script>