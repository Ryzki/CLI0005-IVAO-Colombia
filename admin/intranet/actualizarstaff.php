
<?php
include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from staff where id=$idaa";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$idgrupo= $row3["id"];
        $callsign= $row3["nombres"];
		 $callsigna= $row3["apellidos"];
		$vid_ivaoa= $row3["vid_ivao"];
	$emailaa= $row3["email"];
	$staff_ivaoa= $row3["staff_ivao"];
		
	
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
                            Actualización de un Staff
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form  enctype="multipart/form-data" action="?page=staffactualziandose" method="post">
                                        
										
						
										 <div class="form-group">
                                            <label>Nombres</label>
                                            <input class="form-control" name="nombrea" value="<?php echo $callsign; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Apellidos</label>
											<input class="form-control" name="apellidos" value="<?php echo $callsigna; ?>">
                                        </div>
										<div class="form-group">
                                            <label>VID IVAO</label>
											<input class="form-control" name="vides" value="<?php echo $vid_ivaoa; ?>">
                                        </div>
                                          <div class="form-group">
                                            <label>Email</label>
											<input class="form-control" name="correos" value="<?php echo $emailaa; ?>">
                                        </div>
										 <div class="form-group">
                                            <label>Posición del Staff</label>
											<div class="form-group">
										<select name="pst">
										<?php
										
										include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sql = "SELECT * FROM ranks where id=$staff_ivaoa";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		
  echo '<option value="' . $row["id"] . '">' . $row["callsign"] . '</option>';
  
	}
	
	$sqla = "SELECT * FROM ranks where id<>$staff_ivaoa";

	if (!$resulta = $db->query($sqla)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($rowa = $resulta->fetch_assoc()) {
		
  echo '<option value="' . $rowa["id"] . '">' . $rowa["callsign"] . '</option>';
  
	}
  
  ?>
</select>
	</div>						
                                        </div>
										
									
										
										 <input type="hidden" class="form-control" name="id" value="<?php echo $idgrupo; ?>"/>
								
									
								
                                        <button type="submit" class="btn btn-default">Actualizar Staff</button>

                                    </form>
									<br>
									<hr>
									
									<h1>Otras Opciones</h1>
									<br>
                      <form  enctype="multipart/form-data" action="?page=staffactualziandosee" method="post">    
 <input type="hidden" class="form-control" name="idas" value="<?php echo $idgrupo; ?>"/>					  
<button type="submit" class="btn btn-info">Borrar el primero y último IP y Fecha de Conexión Para Un NUEVO STAFF.</button>
             </form>        
	<br>
                      <form  enctype="multipart/form-data" action="?page=staffactualziandoseee" method="post">    
 <input type="hidden" class="form-control" name="idase" value="<?php echo $idgrupo; ?>"/>					  
 <input type="hidden" class="form-control" name="correos" value="<?php echo $emailaa; ?>"> 
<button type="submit" class="btn btn-warning">Cambiar contraseña sin enviar EMAIL, CUANDO SE SACA UN STAFF Y AÚN NO SE ENVÍA LA CONTRASEÑA Y DATOS AL NUEVO STAFF.</button>
             </form> 

<br>
                      <form  enctype="multipart/form-data" action="?page=staffactualziandoseeee" method="post">    
 <input type="hidden" class="form-control" name="idasee" value="<?php echo $idgrupo; ?>"/>					 
<input type="hidden" class="form-control" name="correos" value="<?php echo $emailaa; ?>"> 
<button type="submit" class="btn btn-danger">Cambiar contraseña y enviar Contraseña NUEVO O VIEJO STAFF.</button>
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