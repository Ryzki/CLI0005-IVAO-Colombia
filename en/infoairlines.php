
<?php
include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from airlines where id=$idaa";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$nombre_aerolinea= $row3["nombre_aerolinea"];
        $callsign= $row3["id"];
		$icao_aerolinea= $row3["icao_aerolinea"];
		$iata_aerolinea= $row3["iata_aerolinea"];
		$ceo= $row3["ceo"];
		$informacion= $row3["informacion"];
	    $url_pilotos= $row3["url_pilotos"];
		$url_estadistica= $row3["url_estadistica"];
		$url_hora_mes= $row3["url_horas_mes"];
		$sistema= $row3["sistema"];
	    $web= $row3["web"];
	    $tipo_aerolinea= $row3["tipo_aerolinea"];
	    $numeros= $row3["numeros"];
	    $radio= $row3["radio"];
		 $vas= $row3["imagen_va"];
	}
	
	
	$ruta_img = "https://www.ivao.aero/data/images/airline/" . $numeros . ".jpg"; // 
	$ruta_imgs = "https://www.ivao.aero/data/images/airline/" . $numeros . ".png"; // 
	$ruta_imgss = "https://www.ivao.aero/data/images/airline/" . $numeros . ".gif"; // 
	
	
	

    if(getimagesize($ruta_img)){
    $iaa = ".jpg";
 
    }

    if(getimagesize($ruta_imgs)){
    $iaa = ".png";
 
    }
	
	    if(getimagesize($ruta_imgss)){
    $iaa = ".gif";
 
    }


  
	
	

	
	

		

	?>
	<div class="container">
	 <div id="page-wrapper" >
            <div id="page-inner">
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Airline Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
							
								<center><img src="https://www.ivao.aero/data/images/airline/<?php echo $numeros; ?><?php echo $iaa; ?>"/></center>
								<hr>
								<center><img src="../admin/intranet/imagenair/<?php echo $vas; ?>" width="700" height="400"/></center>
								<hr>
                                <div class="col-md-6">
								<br>
                                   
								<hr>
								
                                        <div class="form-group">
                                            <label>Airline Name</label>
                                            <input class="form-control" name="nombre" value="<?php echo $nombre_aerolinea; ?>" readonly="readonly"/>
										
                                        </div>
										 <div class="form-group">
                                            <label>Type of Airline</label>
                                           <input class="form-control" name="icaossa" value="<?php echo $tipo_aerolinea; ?>" readonly="readonly" />
											
                                        </div>
										<div class="form-group">
                                            <label>Airline System</label>
                                            <input class="form-control" name="icaoss" value="<?php echo $sistema; ?>"/ readonly="readonly" >
											
                                        </div>
										 <div class="form-group">
                                            <label>ICAO Airline</label>
											<input class="form-control" name="icao" value="<?php echo $icao_aerolinea; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>IATA Airline</label>
											<input class="form-control" name="iata" value="<?php echo $iata_aerolinea; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>Radio Airline</label>
											<input class="form-control" name="radio" value="<?php echo $radio; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>CEO Airline</label>
											<input class="form-control" name="ceo" value="<?php echo $ceo; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>URL Web <a href="<?php echo $web; ?>">See.</a></label>
                                            <input class="form-control" name="url" value="<?php echo $web; ?>" readonly="readonly" />
                                        </div>
										 <div class="form-group">
                                            <label>Airline Information</label>
											<textarea class="form-control" name="info" readonly="readonly" ><?php echo $informacion; ?></textarea>
                                        </div>
										

                                 
                                </div>
								
								
								
								 <div class="col-md-12">
								<br>
								<br>
								<hr>
								<h1><?php echo $nombre_aerolinea; ?>'s Pilots</h1>
								
								
										<?php 
								
							if	($sistema=="VAM") {
								
$filecontentsa = file_get_contents($url_pilotos);
//$filecontents = file_get_contents('whazzup.txt'); //Testing file
$rows = split(PHP_EOL, $filecontentsa);


echo '<table id="table_list"  class="table table-hover" width="100%">
																	
                                        <thead>
                                            <tr>
												<th><b>Callsign</b></th>
												<th><b>Name</b></th>
												<th><b>Hours</b></th>
												<th><b>IVAO</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>';
				  
foreach ($rows as $row) {


	$fieldsa = split(":", $row);
	
if($fieldsa[0]!=""){
$horariosa = $fieldsa[2];

$sumasa= round($horariosa  , 2);
$segundosa = $sumasa*3600;




$horasa = floor($segundosa/3600);
$minutosa = floor(($segundosa-($horasa*3600))/60);
$segundosa = $segundosa-($horasa*3600)-($minutosa*60);
$totalaa= $horasa.' h '.$minutosa.' m ';

				  
				  echo '<tr>';
				   echo '<td>' . $fieldsa[1]  . '</td>';
				    echo '<td>' . utf8_encode($fieldsa[0])  . '</td>';
				  echo '<td>' . $totalaa  . '</td>';
				  echo '<td><a href="http://www.ivao.aero/members/person/details.asp?ID=' . $fieldsa[3]  . '"><font color="red">' . $fieldsa[3]  . '</font></a></td>';
				  
				  echo '</tr>';
}

}


				echo '</tbody>
				</table>';
							} else {
								
								    echo '<div class="alert alert-danger" role="alert">There is not information available.</div>';      
							}

?>	
								
								
								
								
								
								
								<br>
								<h1><?php echo $nombre_aerolinea; ?>'s Statistics</h1>
								
								
								<?php 
								
							if	($sistema=="VAM") {
								
$filecontents = file_get_contents($url_estadistica);



	$fields = split(":", $filecontents);
	

$horarios = $fields[2];

$sumas= round($horarios  , 2);
$segundos = $sumas*3600;




$horas = floor($segundos/3600);
$minutos = floor(($segundos-($horas*3600))/60);
$segundos = $segundos-($horas*3600)-($minutos*60);
$total= $horas.' h '.$minutos.' m ';

				  
				  echo '<table class="table table-striped" width="100%">
				  <tbody><tr>
					<td valign="top" width="20%"><strong>Pilots:</strong></td>
					<td valign="top" width="30%">' . $fields[0] . '</td>
					<td valign="top" width="20%"><strong>Passengers:</strong></td>
					<td valign="top" width="30%" >' . $fields[1] . '</td>
				  </tr>
				  <tr>
					<td><strong>Hours:</strong></td>
					<td>' . $total . '</td>
					<td><strong>Fuel Burned:</strong></td>
					<td>' . $fields[3] . '</td>
				  </tr>
				  <tr>
					<td><strong>Flights:</strong></td>
					<td>' . $fields[4] . '</td>
					<td><strong>Routes:</strong></td>
					<td>' . $fields[7] . '</td>
				  </tr>
				  <tr>
					<td><strong>Distance:</strong></td>
					 <td>' . $fields[5] . '</td>
					<td><strong>Aircrafts:</strong></td>
					<td>+' . $fields[6] . '</td>   
				  </tr>
				</tbody>
				</table>';


} else {
								
								    echo '<div class="alert alert-danger" role="alert">There is not information available.</div>';      
							}




?>
								
								
								<br>
								<h1>Vuelos de <?php echo $nombre_aerolinea; ?></h1>
								
								
								<?php 
								
							if	($sistema=="VAM") {
								
$filecontentsas = file_get_contents($url_hora_mes);
//$filecontents = file_get_contents('whazzup.txt'); //Testing file
$rowse = split(PHP_EOL, $filecontentsas);


echo '<table id="table_list"  class="table table-hover" width="100%">
																	
                                        <thead>
                                            <tr>
												<th><b>Callsign</b></th>
												<th><b>Name</b></th>
												<th><b>Departure</b></th>
												<th><b>Arrival</b></th>
												<th><b>Date</b></th>
												<th><b>Duration</b></th>
                                            </tr>
											
                                        </thead>
										<thead>
										<tr>
										</tr>
										</thead>
										 <tbody>';
				  $sumares = 0;
foreach ($rowse as $rowe) {


	$fieldsae = split(":", $rowe);
	
if($fieldsae[0]!=""){

$horariosp = substr($fieldsae[7],0);

$sumasp= round($horariosp  , 2);
$segundosp = $sumasp*3600;




$horasp = floor($segundosp/3600);
$minutosp = floor(($segundosp-($horasp*3600))/60);
$segundosp = $segundosp-($horasp*3600)-($minutosp*60);
$totalp= $horasp.' h '.$minutosp.' m ';
				  
				  echo '<tr>';
				   echo '<td>' . $fieldsae[1]  . '</td>';
				    echo '<td>' . utf8_encode($fieldsae[0])  . '</td>';
					echo '<td>' . $fieldsae[2]  . '</td>';
					echo '<td>' . $fieldsae[3]  . '</td>';
					echo '<td>' . $fieldsae[4]  . ':' . $fieldsae[5] . ':' . $fieldsae[6] . '' . substr($fieldsae[7],0,0) . '</td>';
				  echo '<td>' .  $totalp  . '</td>';
				  
				  echo '</tr>';
				  
				  $sumares = $sumares+substr($fieldsae[7],0);
}

}


$sumaspe= round($sumares  , 2);
$segundospe = $sumaspe*3600;




$horaspe = floor($segundospe/3600);
$minutospe = floor(($segundospe-($horaspe*3600))/60);
$segundospe = $segundospe-($horaspe*3600)-($minutospe*60);
$totalpe= $horaspe.' h '.$minutospe.' m ';

 echo '<div class="alert alert-success" role="alert">There are ' . $totalpe . ' hours made in this month by this airline.</div>';
 
				echo '</tbody>
				</table>';
							} else {
								
								    echo '<div class="alert alert-danger" role="alert">There is not information available.</div>';      
							}

?>	
					
					
                               
 </div>							   
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
				
					
					
					
					
                </div>
            </div>
                <!-- /. ROW  -->
               
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
 </div>     
 </div>        