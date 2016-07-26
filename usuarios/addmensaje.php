<?php		date_default_timezone_set('America/Bogota');		include('./db_login.php');					$ids = $_POST['id'];	$fecha = date('Y-m-d H:i:s');	$vids = $user_array->vid;	$comment = $_POST['infos'];					// Estado// 0 = Nuevo// 1 = Leido// 2 = Respondido// 3 = Nuevo mensaje// 4 = Eliminado
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into respuestasdelbuzon (mensaje,vid,idmensaje,fecha)                    values ('$comment','$vids','$ids','$fecha');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
<script>alert('Información agregada satisfactoriamente.');window.location = './?page=versugerencias&id=<?php echo $ids; ?>';</script>