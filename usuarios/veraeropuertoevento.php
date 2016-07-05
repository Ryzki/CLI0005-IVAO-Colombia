
			<?php
	$idaa = $_GET['id'];
	$webs = $_GET['web'];
	
	
	include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql25a = "SELECT * FROM eventosatc where id='$webs'";

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
								
						   	 <div class="content"> 
							
            <div class="container-fluid">
                
				  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Solicitud de Posición para <b><?php echo $idaa; ?></b></h4>
                            </div>
                            <div class="content">
							<div class="table-full-width">
							<table class="table">
							<tr><td>	
							
							
				<form   action="./?page=enviarsolicitudatc" method="post">		
 <div class="form-group">
            <label>Aeropuerto</label>
			<input type="text" name="aeropuertoa" class="form-control"  placeholder="aeropuertoa" value="<?php echo $idaa; ?>" readonly="readonly"/>		
</div>

 <div class="form-group">
            <label>Dependencia</label>
	<select name="posicion" class="form-control">
	
<?php

$sql2 = "SELECT * FROM eventosatcaeropuertos where icao='$idaa'";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

if($row2['dep']==1){
echo ' <option value="DEP">DEP</option>';
		} 
		
		if($row2['app']==1){
echo '<option value="APP">APP</option>';
		} 
		
		if($row2['del']==1){
echo  '<option value="DEL">DEL</option>';
		} 
		
		if($row2['twr']==1){
echo ' <option value="TWR">TWR</option>';
		} 
		
		if($row2['ctr']==1){
echo   '<option value="CTR">CTR</option>';
		} 
		
		if($row2['gnd']==1){
echo '<option value="GND">GND</option>';
		}
		
	}
		?>
  
 
 
  

 
 
</select>
</div>
<div class="form-group">
                                            <label>Hora Inicio</label>
											<input type="time" class="form-control" name="horauno" min="<?php echo $horario_inicio; ?>" max="<?php echo $horario_fin; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Hora Finalización</label>
											<input type="time" class="form-control" name="horados" min="<?php echo $horario_inicio; ?>" max="<?php echo $horario_fin; ?>"/> 
                                        </div>
                                          <div class="form-group">
                                            <label>Fecha Evento</label>
											<input type="date" class="form-control" placeholder="fecha" name="fecha" value="<?php echo $fechas; ?>" readonly="readonly"/>
                                        </div>
										<input type="hidden" class="form-control"  name="id" value="<?php echo $webs; ?>"/>
<button type="submit" class="btn btn-info btn-fill pull-right">Enviar Solicitud</button>
</form> </div>	
</td></tr></table>
                                       		

                                 
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
      