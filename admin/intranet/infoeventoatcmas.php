	<?php 

$ida = $_GET['id'];
include('./db_login.php');

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
 <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>IVAO Colombia</h2>   
                        <h5>Bienvenido <?php echo $nombres . ' ' . $apellidos; ?> , Encantado de volverte a ver. </h5>
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Solicitudes <b><?php echo $titulos; ?></b> ATC IVAO Colombia
                        </div>
					
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                   
                                        
									
								
<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Aeropuerto</th><th>Nombre Controlador | VID</th><th>Rango ATC</th><th>Fecha y Hora</th><th>OPCIONES</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM solicitudeseventosatc where idevento='$ida'";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {
 $idss = $row2['id'];
		    $icaos = $row2['icaoairport'];
			$posicion = $row2['posicion'];
			$rango = $row2['rank'];
			$identi = $row2['vidatc'];
			$fechal = $row2['fecha'];
			$horarioinicio = $row2['horarioinicio'];
			$horariofin = $row2['horariofin'];
			
			$sql23	= "SELECT * FROM usuariosivao where vid='$identi'";

	if (!$result23 = $db->query($sql23)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row23 = $result23->fetch_assoc()) {
		$nombresa = $row23['nombres'];
		$apellidosa = $row23['apellidos'];
	}

			
			
			echo' <tr>
	<td>' . $icaos. '_' . $posicion . '</td>
	<td>' . $nombresa. ' ' . $apellidosa . ' (' . $identi . ')</td>
	
	<td><img src="https://www.ivao.aero/data/images/ratings/atc/' . $rango . '.gif"></td>
	<td>' . $fechal. ' (' . $horarioinicio . ' - ' . $horariofin . ')</td>
	<td>
	<form  action="?page=deletesolicitud&id=' . $idss . '&web=' . $ida . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Rechazar</button></form><br>
	<form  action="?page=aprobarsolicitud&id=' . $idss . '&web=' . $ida . '"  method="post"><button class="btn btn-success"><i class="fa fa-pencil"></i> Aceptar</button></form>
	</td>
  </tr>';


	}
	
   
						
   ?> 
					  

</tbody>
</table>
                         
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
						
					
					
                </div>
				
				
				
				
				
			





  <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Aprobados a <b><?php echo $titulos; ?></b> ATC IVAO Colombia
                        </div>
					
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                   
                                        
									
								
<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Aeropuerto</th><th>Nombre Controlador | VID</th><th>Rango ATC</th><th>Fecha y Hora</th><th>ESTADO</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2a = "SELECT * FROM aprobacioneventoatc where idevento='$ida'";

	if (!$result2a = $db->query($sql2a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

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

			
			
			echo' <tr>
	<td>' . $icaosa. '_' . $posiciona . '</td>
	<td>' . $nombresaa. ' ' . $apellidosaa . ' (' . $identia . ')</td>
	<td><img src="https://www.ivao.aero/data/images/ratings/atc/' . $rangoa . '.gif"></td>
	<td>' . $fechala. ' (' . $horarioinicioa . ' - ' . $horariofina . ')</td>
	<td>APROBADO</td>
  </tr>';


	}
	
   
						
   ?> 
					  

</tbody>
</table>
                         
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
					
                </div>			
				
				
				
				
				
				
				
				
				
				
				
				
            </div>
                <!-- /. ROW  -->
               
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
 </div>        