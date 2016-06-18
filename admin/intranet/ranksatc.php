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
                            Rangos ATC IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form enctype="multipart/form-data"  action="./?page=addrankatc" method="post" >
                                        <div class="form-group">
                                            <label>Nombre Rango</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										<div class="form-group">
                                            <label>Abreviación del Rango</label>
                                            <input class="form-control" name="abreviacion" />
                                        </div>
										<div class="form-group">
                                            <label>URL Imagen del Rango</label>
                                            <input class="form-control" name="imagenes" />
                                        </div>
										
										 
								
                                        <button type="submit" class="btn btn-default">Añadir Rango</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Rangos
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Nombre Rango</th><th>Imagen Rango</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM ranksATC ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		   $identi = $row2['id'];
	
			echo' <tr>
	<td>' . $row2['nombre'] . ' ('  . $row2['abreviacion'] . ') </td>
	<td><img src="' . $row2['badge'] . '"></td>
	
	<td><form  action="?page=deleterankatc&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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