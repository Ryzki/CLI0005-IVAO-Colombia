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
                            Módulo Piloto IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form enctype="multipart/form-data"  action="./?page=addmodulopca" method="post" >
                                        <div class="form-group">
                                            <label>Título del Módulo</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										<div class="form-group">
                                            <label>Rango Piloto para este módulo</label>
                                            <select name="pst">
										<?php
										
										include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sql = "SELECT * FROM ranksPCA";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		
  echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
  
	}
  
  ?>
</select>
                                        </div>
											<div class="form-group">
                                            <label>Documento PDF o Word del módulo</label>
                                           
<input name="image_file"  type="file">

<br>
<hr>

										
                                        </div>
										
										 
								
                                        <button type="submit" class="btn btn-default">Añadir Módulo</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de Módulos
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Titulo Módulo</th><th>Ver Módulo</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM modulosPCA ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		   $identi = $row2['id'];
		   
		$cosos = $row2['rankPCA'];


	$sql27 = "SELECT * FROM ranksPCA where id='$cosos'";

	if (!$result27 = $db->query($sql27)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row27 = $result27->fetch_assoc()) {

		   $infos = $row27['abreviacion'];


	}
	
   
						
 
   
	
			echo' <tr>
	<td>' . $row2['titulo'] . ' ('  . $infos . ') </td>
	<td><a href="?page=muestrapcamodulos&id=' . $identi . '">Ver</a></td>
	<td><form  action="?page=deletemodulopca&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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