﻿ <div id="page-wrapper" >
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
                            Eventos IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form role="form" action="./addevento.php" method="post">
                                        <div class="form-group">
                                            <label>Nombre Evento</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio</label>
                                            <input class="form-control" name="horauno" />:<input class="form-control" name="minutouno" />
                                        </div>
										<div class="form-group">
                                            <label>Hora Finalización</label>
                                            <input class="form-control" name="horados" />:<input class="form-control" name="minutodos" />
                                        </div>
                                          <div class="form-group">
                                            <label>Fecha Evento</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										<div class="form-group">
                                            <label>Imagen Evento</label>
                                           <a href="./?page=pilot_upload_image" ><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;Upload</a>
										
                                        </div>
										
										 <input type="hidden" class="form-control" name="id" />
								
                                        <button type="submit" class="btn btn-default">Añadir Evento</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Eventos
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Nombre Grupo</th><th>Actualizar</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM typestaff ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['id'];

			$nombrestaff = $row2['nombre'];
			
			echo' <tr>
	<td>' . $nombrestaff . '</td>
	<td><form  action="?page=updategrupo&id=' . $identi . '"  method="post"><button class="btn btn-default"><i class="fa fa-refresh"></i> Actualizar</button></form></td>
	<td><form  action="?page=deletegrupo&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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