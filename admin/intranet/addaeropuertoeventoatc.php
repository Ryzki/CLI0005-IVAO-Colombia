<?php			include('./db_login.php');					    $icaos = $_POST['icaos'];	$idsa = $_POST['idsa'];	$gnd = $_POST['gnd'];	$del = $_POST['del'];	$twr = $_POST['twr'];	$app = $_POST['app'];	$ctr = $_POST['ctr'];	$dep = $_POST['dep'];	
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}						$sql1 = "insert into eventosatcaeropuertos (icao,ideventoatc,dep,app,del,twr,ctr,gnd)                    values ('$icaos','$idsa','$dep','$app','$del','$twr','$ctr','$gnd');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}			
		
?>
<script>alert('Información agregada satisfactoriamente.');window.location = './?page=infoeventoatc&id=<?php echo $idsa; ?>';</script>