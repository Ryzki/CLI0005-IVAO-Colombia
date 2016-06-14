
<?php
header('Content-Type: text/html; charset=ISO-8859-1');


	$emailss = $_POST['email'];
	$pass = $_POST['pass'];
	
	

	
	
	include('./db_login.php');
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		if ($pass!="") {
				$encryptpassword = md5($pass);
				
			$sql11 = "UPDATE staff set email='$emailss', password='$encryptpassword' where id='$id'";

		if (!$result11 = $db->query($sql11)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		
		} else {
			
			$sql115 = "UPDATE staff set email='$emailss' where id='$id'";

		if (!$result115 = $db->query($sql115)) {
			die('There was an error running the query [' . $db->error . ']');
		}
			
			
		}
		
		
		
			?>


<script>
alert('Información actualizada satisfactoriamente.');
window.location = './?page=myprofile';
</script>

