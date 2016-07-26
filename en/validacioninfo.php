
<?php
header('Content-Type: text/html; charset=utf-8');

include('./db_login.php');
	$vid = $_GET['vid'];
	$estado = $_GET['estado'];

$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}




			$sql11 = "UPDATE usuariosivao set estado='$estado' where vid='$vid'";

		if (!$result11 = $db->query($sql11)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		
		
		
	
?>


<script>
alert('Your validation was successful , log in right now!.');
window.location = 'http://login.ivao.aero/index.php?url=http://www.ivaocol.com.co/usuarios/login.php';
</script>