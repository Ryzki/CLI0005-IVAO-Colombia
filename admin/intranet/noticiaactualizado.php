
<?php
			include('./db_login.php');
			
		
		
		

	        $ides = $_POST['id'];
			$callsign = $_POST['nombre'];
			$horauno = $_POST['horauno'];
			$horados = $_POST['horados'];
			$fecha = $_POST['fecha'];
			$info = $_POST['info'];
	
			
				

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
			$sql2 = "SELECT * FROM eventos where id='$ides'";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {
		$imagens = $row2['imagen'];
	}
		
		
		

$nombrearch = $_FILES['image_file']['name'];
if ($nombrearch != "") {
	
	unlink('./uploads/' . $imagens);


$target_path = "./uploads/";
$target_path = $target_path . basename($_FILES['image_file']['name']); 
	if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_path)) { 
echo "El archivo ". basename($_FILES['image_file']['name']). " ha sido subido";
$nombressse = $_FILES['image_file']['name'];

$sql112 = "UPDATE eventos set nombre='$callsign', hora_inicio='$horauno', hora_fin='$horados', fecha='$fecha', informacion='$info', imagen='$nombressse' where id='$ides'";

		if (!$result112 = $db->query($sql112)) {
			die('There was an error running the query [' . $db->error . ']');
		}


		
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}
		
		
	
} else {
	
	

	$sql11 = "UPDATE eventos set nombre='$callsign', hora_inicio='$horauno', hora_fin='$horados', fecha='$fecha', informacion='$info' where id='$ides'";

		if (!$result11 = $db->query($sql11)) {
			die('There was an error running the query [' . $db->error . ']');
		}

			
		}
	
		
	
		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=eventos';
</script>


