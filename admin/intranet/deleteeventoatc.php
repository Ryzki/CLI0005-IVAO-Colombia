




<?php
	
		
		$id = $_GET['id'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
			
		
			$sql1 = "delete from eventosatc where id=$id";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql12 = "delete from eventosatcaeropuertos where ideventoatc=$id";  

		if (!$result12 = $db->query($sql12)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql123 = "delete from solicitudeseventosatc where idevento=$id";  

		if (!$result123 = $db->query($sql123)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		$sql1234 = "delete from aprobacioneventoatc where idevento=$id";  

		if (!$result1234 = $db->query($sql1234)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
	
?>


<script>
alert('Información eliminada satisfactoriamente.');
window.location = './?page=eventatcs';
</script>

