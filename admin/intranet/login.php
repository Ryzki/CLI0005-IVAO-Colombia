<?php
	/**
	 * @Project: Virtual Airlines Manager (VAM)
	 * @Author: Alejandro Garcia
	 * @Web http://virtualairlinesmanager.net
	 * Copyright (c) 2013 - 2015 Alejandro Garcia
	 * VAM is licenced under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */

?>
<?php
	include('classes/security.php');
	$secure = new SECURITY();
	$secure->parse_incoming();
	session_start();
	include('./db_login.php');
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	


	$IP = $_SERVER["REMOTE_ADDR"]; 
	
	
	
	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$exists = 0;

	$_SESSION["access"] = false;

	if (isset($_POST['user']) and isset($_POST['password'])) {

		$user = mysqli_real_escape_string($db , $_POST['user']);

		$Encrypt_Pass = md5(mysqli_real_escape_string($db , $_POST["password"]));

		$query = "SELECT * FROM staff where email='" . $user . "' and password='" . $Encrypt_Pass . "'";

		if (!$result = $db->query($query)) {

			die('There was an error running the query [' . $db->error . ']');

		}

		while ($row = $result->fetch_assoc()) {
			
			
			$exists = 1;

			$staff_ivao = $row['staff_ivao'];

			$nombres = $row['nombres'];

			$apellidos = $row['apellidos'];

			$vid_ivao = $row['vid_ivao'];

			$ip_first = $row['ip_first'];

			$last_ip = $row['last_ip'];

			$email = $row['email'];
			
			$id = $row['id'];
			
            $last_visit_date = $row['last_visit_date'];

		}
		

		if ($exists != 0) {

			$_SESSION["access"] = true;

			$lifetime = 3600;

			session_set_cookie_params($lifetime);
			
			
	
			

			$_SESSION["staff_ivao"] = $staff_ivao;

			$_SESSION["nombres"] = $nombres;

			$_SESSION["apellidos"] = $apellidos;

			$_SESSION["password"] = $Encrypt_Pass;

			$_SESSION["vid_ivao"] = $vid_ivao;

			$_SESSION["ip_first"] = $ip_first;

			$_SESSION["id"] = $id;

			$_SESSION["email"] = $email;

			$_SESSION["last_ip"] = $last_ip;
			
			$_SESSION["last_visit_date"] = $last_visit_date;
			
			
			
			

			// update last visit

			$query = "UPDATE staff set last_visit_date=now(), last_ip='$IP' where id=$id";

			if (!$result = $db->query($query)) {

				die('There was an error running the query [' . $db->error . ']');

			
			
			}
			
			if ($ip_first ==''){
				
				
			
			$query = "UPDATE staff set ip_first='$IP' where id=$id";

			if (!$result = $db->query($query)) {

				die('There was an error running the query [' . $db->error . ']');

			
			
			}
				
			}

			
			header("Location:index.php");

		} else {

			$db->close();

			

			$mensaje = "Nick or password wrong.";
echo "<script>";
echo "alert('$mensaje');";  
echo "window.location = '../';";
echo "</script>";  

		}

	}
?>