<?php	include('./db_login.php');		$target_path = "./imagenair/";$target_path = $target_path . basename($_FILES['image_file']['name']); if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) { echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";$nombresss = $_FILES['image_file']['name'];} else{echo "Ha ocurrido un error, trate de nuevo!";}	$nombresa = $_POST['nombre'];	$tipe = $_POST['tipe'];	$sistema = $_POST['sistema'];	$icao = $_POST['icao'];	$iata = $_POST['iata'];	$radiol = $_POST['radio'];	$ceo = $_POST['ceo'];	$url = $_POST['url'];	$pca = $_POST['pca'];	$stat = $_POST['stat'];	$vuelo = $_POST['vuelo'];	$info = $_POST['info'];	$numeros = $_POST['numeros'];									
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into airlines (numeros,imagen_va,nombre_aerolinea,icao_aerolinea,iata_aerolinea,ceo,informacion,url_pilotos,url_estadistica,url_horas_mes,sistema,web,tipo_aerolinea,radio)                    values ('$numeros','$nombresss','$nombresa','$icao','$iata','$ceo','$info','$pca','$stat','$vuelo','$sistema','$url','$tipe','$radiol');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
<script>alert('Información agregada satisfactoriamente.');window.location = './?page=airlines';</script>