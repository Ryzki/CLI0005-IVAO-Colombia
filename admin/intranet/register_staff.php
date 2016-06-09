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
	$callsign = $_POST['callsign'];
	$email = $_POST['email'];
	$optionsRadios = $_POST['optionsRadios'];
	$pst = $_POST['pst'];
	
	

	
	include('./db_login.php');
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
				$sql1 = "insert into ranks (email,callsign,posicion,typestaff)
                    values ('$email','$callsign','$optionsRadios','$pst');";
				if (!$result = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				?>
			
<script>
alert('Agregado sactisfactoriamente.');
window.location = './';
</script>
			

