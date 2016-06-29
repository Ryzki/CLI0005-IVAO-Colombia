<?php	$fecha = date('Y-m-d H:i:s');	$vids = $user_array->vid;	$namese = utf8_decode($user_array->firstname) . ' ' . utf8_decode($user_array->lastname);	$division = $user_array->division;	$departamento = $_POST['departamento'];	$titulos = $_POST['titulos'];	$urls = $_POST['urls'];	$comment = $_POST['comment'];		$ip = $_SERVER['REMOTE_ADDR']; 			include('./db_login.php');	// Estado// 0 = Nuevo// 1 = Leido// 2 = Respondido// 3 = Nuevo mensaje// 4 = Eliminado								
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into buzonmensajes (titulo,vidusuario,nombreusuario,departamento,mensaje,urlfoto,ip,fecha,estado,division)                    values ('$titulos','$vids','$namese','$departamento','$comment','$urls','$ip','$fecha',0,'$division');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
<script>alert('Información agregada satisfactoriamente.');window.location = './?page=sugerencias';</script>