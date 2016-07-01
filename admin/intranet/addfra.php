<?php			include('./db_login.php');					    $posicion = $_POST['posicion'];	$icaos = $_POST['icaos'];	$rank = $_POST['rank'];	$ambos = $icaos . '_' . $posicion;	$lun = $_POST['lun'];	$mar = $_POST['mar'];	$mie = $_POST['mie'];	$jue = $_POST['jue'];	$vie = $_POST['vie'];	$sab = $_POST['sab'];	$dom = $_POST['dom'];	$idioma = $_POST['idioma'];$voice = $_POST['voice'];
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into fra (icao,posicion,icao_pos,rango,lun,mar,mie,jue,vie,sab,dom,language,voice)                    values ('$icaos','$posicion','$ambos','$rank','$lun','$mar','$mie','$jue','$vie','$sab','$dom','$idioma','$voice');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
<script>alert('Información agregada satisfactoriamente.');window.location = './?page=fra';</script>