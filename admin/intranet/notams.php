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
                            NOTAMS IVAO Colombia
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form enctype="multipart/form-data"  action="./?page=addnotam" method="post" >
                                        <div class="form-group">
                                            <label>Titulo NOTAM</label>
                                            <input class="form-control" name="nombre" />
                                        </div>
										 <div class="form-group">
                                            <label>Información NOTAM</label>
											<textarea class="form-control"  name="persona"></textarea>
                                        </div>
										
											<div class="form-group">
                                            <label>Imagen NOTAM</label>
                                           
<input name="image_file"  type="file">

<br>
<hr>

										
                                        </div>
										 <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>"/>
								
                                        <button type="submit" class="btn btn-default">Añadir NOTAM</button>

                                    </form>
                                  

                                 
                                </div>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
					 
					  <div class="panel panel-default">
                        <div class="panel-heading">
                            Administración de NOTAMS
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>IVAO AERO</h3>
                                
								<table class="table table-striped" width="100%">
								
<thead>
  <tr>
    <th>Titulo NOTAM</th><th>Información NOTAM</th><th>Staff</th><th>Actualizar</th><th>Eliminar</th>
  </tr>
</thead>
<tbody>
<?php


	$sql2 = "SELECT * FROM notams ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row2 = $result2->fetch_assoc()) {

		    $identi = $row2['id'];
$identis = $row2['staff'];
			
				$sql28 = "SELECT * FROM staff where id='$identis'";

	if (!$result28 = $db->query($sql28)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row28 = $result28->fetch_assoc()) {
	$namess = $row28["nombres"] . ' ' . $row28["apellidos"];
	}
	
	if($row2['foto']!="") {
		$les = '<img src="./uploadsnotam/' . $row2['foto'] . '"  width="60%" height="20%">';
	} else {
		$les="";
	}
	
			echo' <tr>
	<td width="30%">'  . $les . '<br>' . $row2['titulo'] . '</td>
	
	<td>' . utf8_decode($row2['informacion']) . '</td>
	<td>' . $namess . '</td>
	<td><form  action="?page=updatenotam&id=' . $identi . '"  method="post"><button class="btn btn-default"><i class="fa fa-refresh"></i> Actualizar</button></form></td>
	<td><form  action="?page=deletenotam&id=' . $identi . '"  method="post"><button class="btn btn-danger"><i class="fa fa-pencil"></i> Borrar</button></form></td>
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