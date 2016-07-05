
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
                            Evento ATC IVAO Colombia
                        </div>
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
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                   
                                        <div class="form-group">
                                            <label>Nombre Evento</label>
                                            <input class="form-control" name="nombre" value="<?php echo $titulos; ?>" readonly="readonly"/>
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio</label>
											<input class="form-control" type="time" name="horauno" value="<?php echo $horario_inicio; ?>" readonly="readonly">
                                        </div>
										<div class="form-group">
                                            <label>Hora Finalización</label>
											<input class="form-control" type="time" name="horados" value="<?php echo $horario_fin; ?>" readonly="readonly">
                                        </div>
                                          <div class="form-group">
                                            <label>Fecha Evento</label>
											<input class="form-control" type="date" name="fecha" value="<?php echo $fechas; ?>" readonly="readonly">
                                        </div>
										 <div class="form-group">
                                            <label>Información Evento (Aeropuertos)</label>
											<textarea class="form-control" name="info" readonly="readonly"><?php echo $informacions; ?></textarea>
                                        </div>
									
								

                         
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
					
					
					
					
					
					
					
					
					
					
					    <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Eventos ATC
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
							 <form enctype="multipart/form-data"  action="./?page=addaeropuertoeventoatc" method="post" >
                                        <div class="form-group">
                                            <label>ICAO Aeropuerto</label>
											<input  type="hidden" name="idsa" value="<?php echo $ida; ?>">
                                           	<select name="icaos" class="form-control">
											 <option value="SKED">SKED</option>
											 <option value="SKEC">SKEC</option>
											 <option value="SKMI">SKMI</option>
											<?php


	$sql25 = "SELECT DISTINCT * FROM airports where iso_country='CO' order by ident asc";

	if (!$result25 = $db->query($sql25)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row25 = $result25->fetch_assoc()) {
		$primeras = substr($row25['ident'],0,3);
		if(($primeras<>"SK-") && ($primeras<>"AGI") && ($primeras<>"CO-") && ($primeras<>"LMC")){
		?>
		
		 <option value="<?php echo $row25['ident']; ?>"><?php echo $row25['ident']; ?></option>
		
		<?
		}
	}?>
	</select>
                                        </div>
										
                                           <div class="form-group">
										 <label>Dependencia: GND</label>
                                           	<select name="gnd" class="form-control">
											 <option value="1">Si</option>
											 <option value="0">No</option>
                                       </select>
                                        </div>
										
										<div class="form-group">
										 <label>Dependencia: DEL</label>
                                           	<select name="del" class="form-control">
											 <option value="1">Si</option>
											 <option value="0">No</option>
                                       </select>
                                        </div>
										
									<div class="form-group">
										 <label>Dependencia: TWR</label>
                                           	<select name="twr" class="form-control">
											 <option value="1">Si</option>
											 <option value="0">No</option>
                                       </select>
                                        </div>
										
										<div class="form-group">
										 <label>Dependencia: APP </label>
                                           	<select name="app" class="form-control">
											 <option value="1">Si</option>
											 <option value="0">No</option>
                                       </select>
                                        </div>
										
										<div class="form-group">
										 <label>Dependencia: CTR </label>
                                           	<select name="ctr" class="form-control">
											 <option value="1">Si</option>
											 <option value="0">No</option>
                                       </select>
                                        </div>
										
										<div class="form-group">
										 <label>Dependencia: DEP </label>
                                           	<select name="dep" class="form-control">
											 <option value="1">Si</option>
											 <option value="0">No</option>
                                       </select>
                                        </div>
								
								
                                        <button type="submit" class="btn btn-default">Añadir Aeropuerto a Evento ATC</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
					
					
					
					
					
					
					    <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Aeropuertos Agregados Eventos ATC
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Aeropuerto</th><th>GND</th><th>APP</th><th>TWR</th><th>CTR</th><th>DEL</th><th>DEP</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM eventosatcaeropuertos where ideventoatc='$ida'";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['icao'];
			$identia = $row2['id'];
			
			
			$sql23	= "SELECT * FROM airports where ident='$identi'";

	if (!$result23 = $db->query($sql23)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row23 = $result23->fetch_assoc()) {
		$nombre = $row23['name'];
	}

		if($row2['dep']==1){
$dep= '&checkmark;&nbsp;';
		} else {
		$dep=  '&nbsp;';
		}
		
		if($row2['app']==1){
$app= '&checkmark;&nbsp;';
		} else {
		$app=  '&nbsp;';
		}
		
		if($row2['del']==1){
$del= '&checkmark;&nbsp;';
		} else {
		$del=  '&nbsp;';
		}
		
		if($row2['twr']==1){
$twr= '&checkmark;&nbsp;';
		} else {
		$twr=  '&nbsp;';
		}
		
		if($row2['ctr']==1){
$ctr= '&checkmark;&nbsp;';
		} else {
		$ctr=  '&nbsp;';
		}
		
		if($row2['gnd']==1){
$gnd= '&checkmark;&nbsp;';
		} else {
		$gnd=  '&nbsp;';
		}
			
			echo' <tr>
	<td>' . $identi . '  ' . $nombre . '</td>
	
	<td>' . $gnd . '</td>
	<td>' . $app . '</td>
	<td>' . $twr . '</td>
	<td>' . $ctr . '</td>
	<td>' . $del . '</td>
	<td>' . $dep . '</td>
	
	<td><form  action="?page=deleteeventoatcaeropuerto&id=' . $identia . '&web=' . $ida . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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