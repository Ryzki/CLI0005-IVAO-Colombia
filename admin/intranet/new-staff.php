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
                           Nuevo Staff
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<div class="col-md-6">
                                
                                    <h3>IVAO AERO</h3>
                                    <form role="form" action="./?page=register" method="post">
                                        <div class="form-group">
                                            <label>Nombres</label>
                                            <input class="form-control" name="nombres" />
                                        </div>
										
										 <div class="form-group">
                                            <label>Apellidos</label>
                                            <input class="form-control" name="apellidos" />
                                        </div>
										
										 <div class="form-group">
                                            <label>Id IVAO</label>
                                            <input class="form-control" name="ivao" />
                                        </div>
										<?php
										
										$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";

	for ($i = 0 ; $i < 12 ; $i++) {
		$cad .= substr($str , rand(0 , 62) , 1);
	}
	$clave = $cad;
	//<label>Password</label>
	?>
										<div class="form-group">
                                            
                                            <input type="hidden" class="form-control" name="password" value="<?php echo $clave; ?>"/>
                                        </div>
										
										<div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" />
                                        </div>
										
										<div class="form-group">
                                            <label>Tipo Staff</label>
										<select name="pst">
										<?php
										
										include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sql = "SELECT * FROM ranks";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {
		
  echo '<option value="' . $row["id"] . '">' . $row["callsign"] . '</option>';
  
	}
  
  ?>
</select>
	</div>									
										
										
										
								
                                        <button type="submit" class="btn btn-default">Registrar Staff</button>

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