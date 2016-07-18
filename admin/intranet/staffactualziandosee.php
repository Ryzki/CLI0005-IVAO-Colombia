
<?php
			include('./db_login.php');
			
		
		
		

	        $ides = $_POST['idas'];
	
			
				

		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		


$sql112 = "UPDATE staff set ip_first='', last_ip='', last_visit_date='' where id='$ides'";

		if (!$result112 = $db->query($sql112)) {
			die('There was an error running the query [' . $db->error . ']');
		}


		
	
?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=actualizarstaff&id=<?php echo $ides; ?>';
</script>


