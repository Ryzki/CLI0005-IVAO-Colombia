
<?php
	
		
		

	
	
	        $ides = $_POST['id'];
			$nombregrupo = $_POST['nombre'];
			
			
			$ids = $_POST['ids'];
			
			
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
			$sql11 = "UPDATE typestaff set nombre='$nombregrupo' where id='$ides'";

		if (!$result11 = $db->query($sql11)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=cargos_staff';
</script>


