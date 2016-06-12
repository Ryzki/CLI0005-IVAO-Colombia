<?php	include('./db_login.php');		$nombresa = $_POST['nombre'];	$info = $_POST['persona'];	$staffs = $_POST['id'];								
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into notams (titulo,informacion,staff)                    values ('$nombresa','$info','$id');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
<script>alert('Información agregada satisfactoriamente.');window.location = './?page=notams';</script>