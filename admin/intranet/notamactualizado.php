
<?php
	
		
		

	
	
	        $ides = $_POST['id'];
			$titulo = $_POST['titulo'];
			$informacion = $_POST['informacion'];
			
			
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
			$sql11 = "UPDATE notams set titulo='$titulo', informacion='$informacion' where id='$ides'";

		if (!$result11 = $db->query($sql11)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=notams';
</script>


