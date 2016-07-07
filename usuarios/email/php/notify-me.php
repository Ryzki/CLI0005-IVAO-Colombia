<?php

include('./db_login.php');
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}

	$email = $_POST["email"];
	$infos = $_POST["vid"];                          
	
	$sql1157 = "UPDATE usuariosivao set email='$email'  where vid='$infos'";

		if (!$result1157 = $db->query($sql1157)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		echo"<script>
alert('Disfruta de nuestros beneficios!.');
window.location = '../../';
</script>";

?>
