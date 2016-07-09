
<?php
include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from noticias where id='$idaa'";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		
        $callsign= $row3["id"];
		$hora_inicio= $row3["hora_inicio"];
		$hora_utcinicio= $row3["hora_utcinicio"];
		$nombre_examen= utf8_decode($row3["nombre_examen"]);
		$lugar= $row3["lugar"];
		$informacion= utf8_decode($row3["informacion"]);
	    $imagen= $row3["imagen"];
		$usuario= $row3["usuario"];
$staffa= $row3["staff"];
$fecha= $row3["fecha"];
		
		$sql33 ="select * from staff where id='$staffa'";

	if (!$result33 = $db->query($sql33)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row33 = $result33->fetch_assoc()) {
		$nombrese= utf8_decode($row33["nombres"]) . ' ' . utf8_decode($row33["apellidos"]);
		
		$staff_ivao = $row33["staff_ivao"];
		
		$sql338 ="select * from ranks where id='$staff_ivao'";

	if (!$result338 = $db->query($sql338)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row338 = $result338->fetch_assoc()) {
		 $cargose= $row338["callsign"];
	}
		
		
	}
		
		
		
	}
	
	
	


  
	
	

	
	

		

	?>
	<div class="container">
	 <div id="page-wrapper" >
            <div id="page-inner">
                 <!-- /. ROW  -->
                 <hr />
               <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Test Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
							
								
								<center><img src="../admin/intranet/uploadsnoticias/<?php echo $imagen; ?>" width="60%" /></center>
								<hr>
                                <div class="col-md-6">
								<br>
                                   
								<hr>
								
                                        <div class="form-group">
                                            <label>Test Name</label>
                                            <input class="form-control" name="nombre" value="<?php echo $nombre_examen; ?>" readonly="readonly"/>
										
                                        </div>
										<div class="form-group">
                                            <label>User</label>
                                            <input class="form-control" name="nombre" value="<?php echo $usuario; ?>" readonly="readonly"/>
										
                                        </div>
										 <div class="form-group">
                                            <label>Test Date</label>
											<input class="form-control" type="date" name="fecha" value="<?php echo $fecha; ?>" readonly="readonly"/>
                                        </div>
										<div class="form-group">
                                            <label>Hour HLC</label>
											<input class="form-control"  name="horauno" value="<?php echo $hora_inicio; ?> HLC" readonly="readonly"/>
                                        </div>
										<div class="form-group">
                                            <label>Hour UTC</label>
											<input class="form-control"  name="horados" value="<?php echo $hora_utcinicio; ?> UTC" readonly="readonly"/>
                                        </div>
										<div class="form-group">
                                            <label>Test Location</label>
                                            <input class="form-control" name="nombre" value="<?php echo $lugar; ?>" readonly="readonly"/>
										
                                        </div>
										 <div class="form-group">
                                            <label>Event Information</label>
											<textarea class="form-control" name="info" readonly="readonly" ><?php echo $informacion; ?></textarea>
                                        </div>
										
										<br>
										<hr>
										
										<p>
										<span style="color: #2a4982; font-family: Arial; font-size: 11pt;"><strong><?php echo $nombrese; ?></strong></span><br />
										<span style="color: #666666; font-size: 10pt;"><strong><?php echo $cargose; ?> - Colombia</strong></span><br />
										<span style="color: #666666; font-size: 8pt;">International Virtual Aviation Organisation<br />
										<a href="http://co.ivao.aero/"><font color="blue">http://co.ivao.aero</font></a></span></p>

										

                                 
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
 </div>        