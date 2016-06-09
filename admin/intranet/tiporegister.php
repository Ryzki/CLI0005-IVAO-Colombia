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
	$nombre = $_POST['nombre'];
	
	

	
	include('./db_login.php');
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
				$sql1 = "insert into typestaff (nombre)
                    values ('$nombre');";
				if (!$result = $db->query($sql1)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				?>
			
<script>
alert('Agregado sactisfactoriamente.');
window.location = '?page=cargos_staff';
</script>
			

