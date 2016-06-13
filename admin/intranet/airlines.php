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
                            Examenes IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form enctype="multipart/form-data"  action="./?page=addnoticia" method="post" >
                                        <div class="form-group">
                                            <label>Nombre Examen</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										 <div class="form-group">
                                            <label>Persona a ser evaludada</label>
                                            <input class="form-control" name="persona" />
                                        </div>
										 <div class="form-group">
                                            <label>Fecha Examen</label>
											<input type="date" name="fecha">
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio Local</label>
											<input type="time" name="horauno">
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio UTC</label>
											<input type="time" name="horados">
                                        </div>
										<div class="form-group">
                                            <label>Lugar</label>
                                            <input class="form-control" name="lugar" />
                                        </div>
										 <div class="form-group">
                                            <label>Información Examen</label>
											<textarea name="info"></textarea>
                                        </div>
										<div class="form-group">
                                            <label>Imagen Examen</label>
                                           
<input name="image_file"  type="file">

<br>
<hr>

										
                                        </div>
										
										 <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"/>
								
                                        <button type="submit" class="btn btn-default">Añadir Examen</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Examenes
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Nombre Examen</th><th>Usuario</th><th>Lugar</th><th>Fecha</th><th>Horario</th><th>Información</th><th>Imagen</th><th>Actualizar</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM noticias ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['id'];

			
			
			echo' <tr>
	<td>' . $row2['nombre_examen'] . '</td>
	<td>' . $row2['usuario'] . '</td>
	<td>' . $row2['lugar'] . '</td>
	<td>' . $row2['fecha'] . '</td>
	<td>' . $row2['hora_inicio'] . ' HLC<br>' . $row2['hora_utcinicio'] . ' UTC</td>
	<td>' . $row2['informacion'] . '</td>
	<td><img src="./uploadsnoticias/' . $row2['imagen'] . '"  width="60%" height="20%"></td>
	<td><form  action="?page=updatenoticia&id=' . $identi . '"  method="post"><button class="btn btn-default"><i class="fa fa-refresh"></i> Actualizar</button></form></td>
	<td><form  action="?page=deletenoticia&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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