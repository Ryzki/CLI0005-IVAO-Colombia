
<?php
			include('./db_login.php');
			
		
		
		

	        $ides = "1";
			$members = $_POST['members'];
			$pca = $_POST['pca'];
			$atc = $_POST['atc'];
			$spot = $_POST['spot'];
	
			
				

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		

$sql112 = "UPDATE infodivision set members='$members', pilots='$pca', atc='$atc', puesto='$spot' where id='$ides'";

		if (!$result112 = $db->query($sql112)) {
			die('There was an error running the query [' . $db->error . ']');
		}


		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './';
</script>


