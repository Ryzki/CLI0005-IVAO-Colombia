
<?php
	
			
		
		
		

	        $ides = $_POST['id'];
			$callsign = $_POST['nombre'];
			$horauno = $_POST['horauno'];
			$horados = $_POST['horados'];
			$fecha = $_POST['fecha'];
			$info = $_POST['info'];
	
			
				
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	
	
			$sql11 = "UPDATE eventos set nombre='$callsign', hora_inicio='$horauno', hora_fin='$horados', fecha='$fecha', informacion='$info' where id='$ides'";

		if (!$result11 = $db->query($sql11)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
	
		
		
		
		
		
		
		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=eventos';
</script>


