<?php	$aeropuerto = $_POST['aeropuertoa'];$posicion = $_POST['posicion'];$mix=$aeropuerto . '_' .$posicion;$horauno = $_POST['horauno'];$horados = $_POST['horados'];	$fecha = $_POST['fecha'];	$evento = $_POST['id'];	$vidse = $user_array->vid;		$ranks2= $user_array->ratingatc;$divisatc= $user_array->division;			if($divisatc=="CO")	{		include('./db_login.php');$db = new mysqli($db_host , $db_username , $db_password , $db_database);			$db->set_charset("utf8");			if ($db->connect_errno > 0) {				die('Unable to connect to database [' . $db->connect_error . ']');			}	$sql25a = "SELECT * FROM fra where icao='$aeropuerto' and posicion='$posicion'";	if (!$result25a = $db->query($sql25a)) {		die('There was an error running the query  [' . $db->error . ']');	}$pazes=0;	while ($row25a = $result25a->fetch_assoc()) {	$pazes++;	$rangor = $row25a['rango'];			}	if($pazes<>0) {	if($ranks2>=$rangor) {					$sql1 = "insert into solicitudeseventosatc (idevento,icaoairport,posicion,icaoandairpot,vidatc,rank,fecha,horarioinicio,horariofin)                    values ('$evento','$aeropuerto','$posicion','$mix','$vidse','$ranks2','$fecha','$horauno','$horados');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}		?><script>alert('Su solicitud fue enviada, de ser aprobada aparecerá en el cuadro Información de Aprobación ATC Reservas.');window.location = './?page=modulosveratcevento&id=<?php echo $evento; ?>';</script><?							}	else {			?>			<script>alert('No se pudo proceder al ingreso de información, porque no cumple con el rango del FRA.');window.location = './?page=modulosveratcevento&id=<?php echo $evento; ?>';</script>				<?php			}						}		
			if($pazes==0) {			
$sql1 = "insert into solicitudeseventosatc (idevento,icaoairport,posicion,icaoandairpot,vidatc,rank,fecha,horarioinicio,horariofin)                    values ('$evento','$aeropuerto','$posicion','$mix','$vidse','$ranks2','$fecha','$horauno','$horados');";				if (!$result = $db->query($sql1)) {					die('There was an error running the query [' . $db->error . ']');				}?><script>alert('Su solicitud fue enviada, de ser aprobada aparecerá en el cuadro Información de Aprobación ATC Reservas.');window.location = './?page=modulosveratcevento&id=<?php echo $evento; ?>';</script><?php						}	} else {
?>
<script>alert('No se pudo proceder al ingreso de información, porque no eres de la división IVAO Colombia.');window.location = './?page=modulosveratcevento&id=<?php echo $evento; ?>';</script>	<?php } ?>