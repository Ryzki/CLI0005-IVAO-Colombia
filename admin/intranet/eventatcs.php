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
                            Eventos ATC IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form enctype="multipart/form-data"  action="./?page=addeventoatc" method="post" >
                                        <div class="form-group">
                                            <label>Nombre Evento</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio LOCAL</label>
											<input class="form-control" type="time" name="horauno">
                                        </div>
										<div class="form-group">
                                            <label>Hora Finalización LOCAL</label>
											<input class="form-control" type="time" name="horados">
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio UTC</label>
											<input class="form-control" type="text" placeholder="HH:mm" name="horaunoU">
                                        </div>
										<div class="form-group">
                                            <label>Hora Finalización UTC</label>
											<input class="form-control" type="text" placeholder="HH:mm" name="horadosU">
                                        </div>
                                          <div class="form-group">
                                            <label>Fecha Evento</label>
											<input class="form-control" type="date" name="fecha">
                                        </div>
										 <div class="form-group">
                                            <label>Información Evento (Aeropuertos)</label>
											<textarea class="form-control" name="info"></textarea>
                                        </div>
									
								
                                        <button type="submit" class="btn btn-default">Añadir Evento ATC</button>

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
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Nombre Evento</th><th>Fecha</th><th>Horario</th><th>Información</th><th>Aeropuertos Eventos</th><th>Solicitudes | Aprobaciones</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM eventosatc ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['id'];

			
			
			echo' <tr>
	<td>' . $row2['titulo'] . '</td>
	<td>' . $row2['fecha'] . '</td>
	<td>' . $row2['horario_inicio'] . ' a ' . $row2['horario_fin'] . ' HLC <br>' . $row2['inicioutc'] . ' a ' . $row2['finutc'] . ' UTC</td>
	<td>' . utf8_decode($row2['informacion']) . '</td>
	<td><form  action="?page=infoeventoatc&id=' . $identi . '"  method="post"><button class="btn btn-default"><i class="fa fa-refresh"></i> Ver</button></form></td>
	<td><form  action="?page=infoeventoatcmas&id=' . $identi . '"  method="post"><button class="btn btn-default"><i class="fa fa-refresh"></i> Solicitudes & Aprobaciones</button></form></td>
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