	<div class="container">
	<h1><font color="red">Staff de Colombia</font></h1>
	<hr>
	

<div class="team" id="team">

<?php
include('./db_login.php');
$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	

	$sql2 = "SELECT * FROM typestaff order by id asc";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		   $identi = $row2['id'];
		     $titulos = $row2['nombre'];
	
	

						
   ?> 
	  <div class="container">
			<h3 class="tittle"><?php echo  $titulos; ?></h3>
			<hr>
			
		<div class="team-grids">
		<center>
		<?php 
			$sql2a = "SELECT * FROM ranks where typestaff=$identi order by id asc";

	if (!$result2a = $db->query($sql2a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2a = $result2a->fetch_assoc()) {
		$identia = $row2a['id'];
		$nombrel = $row2a['callsign'];
		$emailsa = $row2a['email'];
		
		$sql2aa = "SELECT * FROM staff where staff_ivao=$identia order by staff_ivao asc";

	if (!$result2aa = $db->query($sql2aa)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2aa = $result2aa->fetch_assoc()) {
		
		
		$nombreses = $row2aa['nombres'] . ' ' . $row2aa['apellidos'];
		
		$ruta_img = "https://www.ivao.aero/data/images/staff/" . $row2aa['vid_ivao'] . ".jpg";
		
		
	
    if(getimagesize($ruta_img)){
     $imagenes = '<img src="https://www.ivao.aero/data/images/staff/' . $row2aa['vid_ivao'] . '.jpg" alt=""  width="45%"/>';

    } else {
		$imagenes = '<img src="https://www.ivao.aero/data/images/staff/000000.gif" alt=""  width="45%"/>';
		
	}
		?>
			<div class="col-md-4 team-grid text-center">
				<div class="team-img">
					<?php echo $imagenes; ?>
					<h3><?php echo $nombreses ; ?></h3>
					<p><b><?php echo $nombrel ; ?></b><br>
					<a href="http://www.ivao.aero/members/person/details.asp?id=<?php echo $row2aa['vid_ivao']; ?>" target="_blank"><img src="http://status.ivao.aero/R/<?php echo $row2aa['vid_ivao']; ?>.png" alt=""  width="45%"/></a>
					<br>IVAO Colombia. <br>Contacto: <a href="mailto:<?php echo $emailsa ; ?>"><font color="red">Enviar Correo</font></a><br>	
		</p>
				
				</div>
			</div>
			
			
	<?php } }?>
	<div class="clearfix"></div>
			</center>
		</div>
		
		
		<br>
		<br>
		
	
		
		
	
	</div>
	
	<?php
	

	}
	
	?>
	
	</div>
	
	</div>