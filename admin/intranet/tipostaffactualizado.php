
<?php
	
		
		

	
	
	        $ides = $_POST['id'];
			$callsign = $_POST['callsign'];
			$emailee = $_POST['emailee'];
			$posicione = $_POST['posicione'];
			$pst = $_POST['pst'];
			
			
			$ids = $_POST['ids'];
			
			
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
		
		
			$sql11 = "UPDATE ranks set callsign='$callsign', email='$emailee', posicion='$posicione', typestaff='$pst' where id='$ides'";

		if (!$result11 = $db->query($sql11)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=tipos_staff';
</script>


