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
                           Aerolíneas Virtuales IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form enctype="multipart/form-data"  action="./?page=addairline" method="post" >
                                        <div class="form-group">
                                            <label>Nombre Aerolínea</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										 <div class="form-group">
                                            <label>Tipo Aerolínea</label>
                                            <select name="tipe">
											<option value="Aerolínea Virtual">Aerolínea Virtual</option>
											<option value="Escuela Militar">Escuela Militar</option>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Sistema Aerolínea</label>
                                            <select name="sistema">
											<option value="VAM">VAM</option>
											<option value="PHPVMS">PHPVMS</option>
											<option value="FSAIRLINES">FSAIRLINES</option>
											<option value="VAFS">VAFS</option>
											<option value="OTRO">OTRO</option>
											</select>
                                        </div>
										 <div class="form-group">
                                            <label>ICAO Aerolínea</label>
											<input type="form-control" name="icao" />
                                        </div>
										<div class="form-group">
                                            <label>IATA Aerolínea</label>
											<input type="form-control" name="iata" />
                                        </div>
										<div class="form-group">
                                            <label>Radio Aerolínea</label>
											<input type="form-control" name="radio" />
                                        </div>
										<div class="form-group">
                                            <label>CEO Aerolínea</label>
											<input type="form-control" name="ceo" />
                                        </div>
										<div class="form-group">
                                            <label>URL Web</label>
                                            <input class="form-control" name="url" />
                                        </div>
										
										<div class="form-group">
                                            <label>URL Pilotos</label>
                                            <input class="form-control" name="pca" />
                                        </div>
										
										<div class="form-group">
                                            <label>URL Estadisticas</label>
                                            <input class="form-control" name="stat" />
                                        </div>
										
										<div class="form-group">
                                            <label>URL Vuelos</label>
                                            <input class="form-control" name="vuelo" />
                                        </div>
										 <div class="form-group">
                                            <label>Información Aerolínea</label>
											<textarea name="info"></textarea>
                                        </div>
										 <div class="form-group">
                                            <label>ID Aerolínea</label>
											<input type="form-control" name="numeros" />
                                        </div>
										<div class="form-group">
                                            <label>Imagen Aerolínea</label>
                                           
<input name="image_file"  type="file" >

										
                                        </div>
										
									
								
                                        <button type="submit" class="btn btn-default">Añadir Aerolínea</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Aerolíneas
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Nombre Aerolínea</th><th>CEO</th><th>Web</th><th>Ver Estadísticas</th><th>Actualizar</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM airlines ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['id'];

			
			
			echo' <tr>
	<td>' . $row2['nombre_aerolinea'] . '</td>
	<td>' . $row2['ceo'] . '</td>
	<td><a href="' . $row2['web'] . '" target="_blanck">Ver</a></td>
	<td><a href="' . $row2['web'] . '">Ver</a></td>
	<td><form  action="?page=updateairline&id=' . $identi . '"  method="post"><button class="btn btn-default"><i class="fa fa-refresh"></i> Actualizar</button></form></td>
	<td><form  action="?page=deleteairline&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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