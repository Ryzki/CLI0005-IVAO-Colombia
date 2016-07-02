
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
                                      <form   method="post" >
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
									
								

                                </form>
                                  

                                 
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
                                           	<select name="icaos">
											 <option value="SKED">SKED</option>
											 <option value="SKEC">SKEC</option>
											 <option value="SKMI">SKMI</option>
											<?php


	$sql25 = "SELECT * FROM airports where iso_country='CO' order by ident asc";

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
    <th>Aeropuerto</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM eventosatcaeropuertos where ideventoatc='$ida'";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['id'];
			
			
			
			$sql23	= "SELECT * FROM airports where ident='$ida'";

	if (!$result23 = $db->query($sql23)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row23 = $result23->fetch_assoc()) {
		$nombre = $row23['name'];
	}

			
			
			echo' <tr>
	<td>' . $identi . ' - ' . $nombre . '</td>
	
	<td><form  action="?page=deleteeventoatc&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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