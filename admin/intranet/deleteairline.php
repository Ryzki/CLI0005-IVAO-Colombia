




<?php
	
		
		$id = $_GET['id'];
		include('./db_login.php');
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		
			$sql2 = "SELECT * FROM  airlines where id=$id ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {
		
		$imagenos = $row2["imagen_va"];
	}
		
		
		unlink('./imagenair/' . $imagenos);
		
		
			$sql1 = "delete from airlines where id=$id";  

		if (!$result1 = $db->query($sql1)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Información eliminada satisfactoriamente.');
window.location = './?page=airlines';
</script>

