<div class="container">
<?php
include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from eventos where id='$idaa'";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		
        $callsign= $row3["id"];
		$titulo= utf8_decode($row3["nombre"]);
		$horaunos= $row3["hora_inicio"];
		$horadoses= $row3["hora_fin"];
		$horaunosa= $row3["horainicioutc"];
		$horadosesa= $row3["horafinutc"];
		$staffa= $row3["staff"];
		$fecha= $row3["fecha"];
	    $informacion= utf8_decode($row3["informacion"]);
		$imagen= $row3["imagen"];
		
		
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
	
                            <h1><font color="red">Information Event</font></h1>
                    
                            <div class="row">
							
								
								<center><img src="../admin/intranet/uploads/<?php echo $imagen; ?>" width="60%" /></center>
								<hr>
                                <div class="col-md-6">
								<br>
                                   
								<hr>
								
                                        <div class="form-group">
                                            <label>Event Title</label>
                                            <input class="form-control" name="nombre" value="<?php echo $titulo; ?>" readonly="readonly"/>
										
                                        </div>
										 <div class="form-group">
                                            <label>Event Date</label>
											<input class="form-control" type="date" name="fecha" value="<?php echo $fecha; ?>" readonly="readonly"/>
                                        </div>
										<div class="form-group">
                                            <label>Start Time LOCAL</label>
											<input class="form-control"  name="horauno" value="<?php echo $horaunos; ?>" readonly="readonly"/>
                                        </div>
										<div class="form-group">
                                            <label>End Time LOCAL</label>
											<input class="form-control"  name="horados" value="<?php echo $horadoses; ?>" readonly="readonly"/>
                                        </div>
										<div class="form-group">
                                            <label>Start Time UTC</label>
											<input class="form-control"  name="horaunoU" value="<?php echo $horaunosa; ?>" readonly="readonly"/>
                                        </div>
										<div class="form-group">
                                            <label>End Time UTC</label>
											<input class="form-control"  name="horadosU" value="<?php echo $horadosesa; ?>" readonly="readonly"/>
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
                       