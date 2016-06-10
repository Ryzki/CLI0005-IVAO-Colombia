
<?php
include('./db_login.php');
	$id = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from ranks where id=$id";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$idgrupo= $row3["id"];
        $nombregrupo= $row3["nombre"];
		
		
		
	
	}
	

		

	?>
	
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
                            Actualización de un Tipo de Staff
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form role="form" action="?page=grupoactualizado" method="post">
                                        <div class="form-group">
                                            <label>Nombre Tipo Staff</label>
                                            <input class="form-control" name="nombre" value="<?php echo $nombregrupo; ?>"/>
                                        </div>
										
										 <div class="form-group">
                                            <label>Email Staff</label>
                                            <input class="form-control" name="nombre" value="<?php echo $nombregrupo; ?>"/>
                                        </div>

										 <div class="form-group">
                                            <label>Posición Staff</label>
                                            <input class="form-control" name="nombre" value="<?php echo $nombregrupo; ?>"/>
                                        </div>
										
											<div class="form-group">
                                            <label>Tipo Staff: </label>
										<select name="pst">
										<?php
										
										include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sql = "SELECT * FROM typestaff";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		
  echo '<option value="' . $row["id"] . '">' . $row["nombre"] . '</option>';
  
	}
  
  ?>
</select>
	</div>	
	
										
										<input type="hidden" class="form-control" name="id" value="<?php echo $idgrupo; ?>"/>
									
								
                                        <button type="submit" class="btn btn-default">Actualizar Grupo Staff</button>

                                    </form>
                                  

                                 
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
             <!-- /. PAGE INNER  -->
 </div>        