	<?php 

$ida = $_GET['id'];
include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql25a = "SELECT * FROM eventosatc where id='$ida'";

	if (!$result25a = $db->query($sql25a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row25a = $result25a->fetch_assoc()) {
		$titulos = $row25a['titulo'];
		$horario_inicio = $row25a['horario_inicio'];
		$horario_fin = $row25a['horario_fin'];
		$fechas = $row25a['fecha'];
		$informacions = utf8_decode($row25a['informacion']);
		
		
	}
?>
<style>
.button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.button1 {
    background-color: #f44336;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.button2 {width: 100%;}
</style>
        <div class="content">
            <div class="container-fluid">
                
				  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="title"><font color="red">Evento <b><?php $titulos; ?></b> ATC Reserva</font></h2>
                                <p class="category">Realizado por IVAO Colombia.</p>
								<hr>
								<h4>Fecha: <?php echo $fechas; ?></h4><br>
								<h4>Hora Inicio ZULU: <?php echo $horario_inicio; ?></h4><br>
								<h4>Hora Fin ZULU: <?php echo $horario_fin; ?></h4><br>
								<h4>Información: <?php echo $informacions; ?></h4><br>
								
								<br>
								<hr>
								<h2>Aeropuertos o Dependencias del Evento:</h2>
								<br>
                            </div>
                            <div class="content">
							<div class="table-full-width">
							<table class="table">
							<tr>
							 <?php
											
								$plasa=0;			
					
	$sql3 ="select * from eventosatcaeropuertos where ideventoatc='$ida'";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$plasa++;
		$short_name= $row3["icao"];
		?>
	
                                <div class="col-md-12">
                                    <button class="button button2" onclick="location='./?page=veraeropuertoevento&id=<?php echo $row3["icao"]; ?>&web=<?php echo $ida; ?>'"><?php echo $short_name; ?></button>
                               <br><br></div>
	<? } 
	
	if($plasa==0){
		
		echo ' <div class="col-md-12"><div class="alert alert-danger" role="alert">No hay aeropuertos agregados al evento.</div></div>';
	}?>
	</tr>
	</table>
	
</div>
                    
                            </div>
				     
                        </div>
						
                    </div>
					
					
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="title"><font color="red">Solicitudes Enviadas ATC Reservas</font></h2>
								<br>
                            </div>
                            <div class="content">
							<div class="table-full-width">
														
<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Aeropuerto</th><th>Nombre Controlador | VID</th><th>Rango ATC</th><th>Fecha y Hora</th><th>ESTADO</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2aa = "SELECT * FROM solicitudeseventosatc where idevento='$ida' and estado<>1";

	if (!$result2aa = $db->query($sql2aa)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
$plasasa=0;
	while ($row2aa = $result2aa->fetch_assoc()) {
 $idssa = $row2aa['id'];
		    $icaosaa = $row2aa['icaoairport'];
			$posicionaa = $row2aa['posicion'];
			$rangoaa = $row2aa['rank'];
			$identiaa = $row2aa['vidatc'];
			$fechalaa = $row2aa['fecha'];
			$horarioinicioaa = $row2aa['horarioinicio'];
			$horariofinaa = $row2aa['horariofin'];
			$estadoa = $row2aa['estado'];
			
			$sql23aa	= "SELECT * FROM usuariosivao where vid='$identiaa'";

	if (!$result23aa = $db->query($sql23aa)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row23aa = $result23aa->fetch_assoc()) {
		$nombresaaa = $row23aa['nombres'];
		$apellidosaaa = $row23aa['apellidos'];
	}

			$plasasa++;
			
			if($estadoa==0) {
				$lase = '<span class="label label-warning">EN REVISIÓN</span>';
			} else if($estadoa==1) {
				$lase = '<span class="label label-success">APROBADO</span>';
			} if($estadoa==2) {
				$lase = '<span class="label label-danger">RECHAZADO</span>';
			} 
			
			echo' <tr>
	<td>' . $icaosaa. '_' . $posicionaa . '</td>
	<td>' . $nombresaaa. ' ' . $apellidosaaa . ' (' . $identiaa . ')</td>
	<td><img src="https://www.ivao.aero/data/images/ratings/atc/' . $rangoaa . '.gif"></td>
	<td>' . $fechalaa. ' (' . $horarioinicioaa . ' - ' . $horariofinaa . ')</td>
	<td>' . $lase . '</td>
  </tr>';


	}
	
   
						
?>
					  

</tbody>
</table>


	
</div>
                
                            </div>
				     
                        </div>
						
						<?


	
	if($plasasa==0){
		
		echo ' <div class="col-md-12"><div class="alert alert-danger" role="alert">No hay solicitudes realizadas aún.</div></div>';
	}?>    
						
                    </div>
					
					
					
					
					
					
					
					
					
					
					 <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h2 class="title"><font color="red">Información de Aprobación ATC Reservas</font></h2>
								<br>
                            </div>
                            <div class="content">
							<div class="table-full-width">
														
<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Aeropuerto</th><th>Nombre Controlador | VID</th><th>Rango ATC</th><th>Fecha y Hora</th><th>ESTADO</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2a = "SELECT * FROM solicitudeseventosatc where idevento='$ida' and estado=1";

	if (!$result2a = $db->query($sql2a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
$plasas=0;
	while ($row2a = $result2a->fetch_assoc()) {
 $idss = $row2a['id'];
		    $icaosa = $row2a['icaoairport'];
			$posiciona = $row2a['posicion'];
			$rangoa = $row2a['rank'];
			$identia = $row2a['vidatc'];
			$fechala = $row2a['fecha'];
			$horarioinicioa = $row2a['horarioinicio'];
			$horariofina = $row2a['horariofin'];
			
			$sql23a	= "SELECT * FROM usuariosivao where vid='$identia'";

	if (!$result23a = $db->query($sql23a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row23a = $result23a->fetch_assoc()) {
		$nombresaa = $row23a['nombres'];
		$apellidosaa = $row23a['apellidos'];
	}

			$plasas++;
			
			echo' <tr>
	<td>' . $icaosa. '_' . $posiciona . '</td>
	<td>' . $nombresaa. ' ' . $apellidosaa . ' (' . $identia . ')</td>
	<td><img src="https://www.ivao.aero/data/images/ratings/atc/' . $rangoa . '.gif"></td>
	<td>' . $fechala. ' (' . $horarioinicioa . ' - ' . $horariofina . ')</td>
	<td><span class="label label-success">APROBADO</span></td>
  </tr>';


	}
	
   
						
?>
					  

</tbody>
</table>


	
</div>
                
                            </div>
				     
                        </div>
						
						<?


	
	if($plasas==0){
		
		echo ' <div class="col-md-12"><div class="alert alert-danger" role="alert">No hay aprobaciones realizadas aún.</div></div>';
	}?>    
						
                    </div>
					
					
					
					
					
					
					
					 </div>
                        </div>
                    </div>