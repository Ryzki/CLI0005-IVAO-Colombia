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
                            Tipos de Staff Grupal
                        </div>
                        <div class="panel-body">
                            <div class="row">
<<<<<<< HEAD
                                <div class="col-md-6">
=======
                                
>>>>>>> 4f8c7e758ee2498710c616ea0d5a7be0de78850e
                                    <h3>IVAO AERO</h3>
                                    <form role="form" action="./tiporegister.php" method="post">
                                        <div class="form-group">
                                            <label>Nombre Grupo</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										
										
										
										
								
<<<<<<< HEAD
                                        <button type="submit" class="btn btn-default">Añadir Grupo Staff</button>
=======
                                        <button type="submit" class="btn btn-default">Submit Button</button>
>>>>>>> 4f8c7e758ee2498710c616ea0d5a7be0de78850e

                                    </form>
                                  

                                 
<<<<<<< HEAD
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Staff Grupal
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
	<td><form  action="?page=updategrupo&id=' . $identi . '"  method="post"><button class="btn btn-default"><i class="fa fa-pencil"></i> Actualizar</button></form></td>
	<td><form  action="?page=deletegrupo&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
  </tr>';


	}
	
   
						
   ?> 
					  

</tbody>
</table>
                                  

                                 
                                </div>
=======
                                
>>>>>>> 4f8c7e758ee2498710c616ea0d5a7be0de78850e
                                
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
					
					
					
					
                </div>
            </div>
                <!-- /. ROW  -->
               
=======
                     <!-- End Form Elements -->
                </div>
            </div>
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-12">
                        <h3>More Customization</h3>
                         <p>
                        For more customization for this template or its components please visit official bootstrap website i.e getbootstrap.com or <a href="http://getbootstrap.com/components/" target="_blank">click here</a> . We hope you will enjoy our template. This template is easy to use, light weight and made with love by binarycart.com 
                        </p>
                    </div>
                </div>
>>>>>>> 4f8c7e758ee2498710c616ea0d5a7be0de78850e
                <!-- /. ROW  -->
    </div>
             <!-- /. PAGE INNER  -->
 </div>        