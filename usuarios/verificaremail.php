<?php						include('./db_login.php');$db = new mysqli($db_host , $db_username , $db_password , $db_database);			$db->set_charset("utf8");			if ($db->connect_errno > 0) {				die('Unable to connect to database [' . $db->connect_error . ']');			}	$sql25a = "SELECT * FROM usuariosivao where vid='$infos'";	if (!$result25a = $db->query($sql25a)) {		die('There was an error running the query  [' . $db->error . ']');	}	while ($row25a = $result25a->fetch_assoc()) {		$email = $row25a['email'];		if($email!=""){			} else {				header('Location: ./email/');	}			}				?>		