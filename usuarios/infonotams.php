
<?php
include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from notams where id='$idaa'";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		
        $callsign= $row3["id"];
		$titulo= $row3["titulo"];
		$staffa= $row3["staff"];
		$fecha= $row3["fecha"];
	    $informacion= utf8_decode($row3["informacion"]);
		$foto= $row3["foto"];
		
		$sql33 ="select * from staff where id='$staffa'";

	if (!$result33 = $db->query($sql33)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row33 = $result33->fetch_assoc()) {
		$nombrese= $row33["nombres"] . ' ' . $row33["apellidos"];
		
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
	 <div class="content">
            <div class="container-fluid">
                
				  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Información de Notam</h4>
                            </div>
                            <div class="content">
							
							
							<?php if($foto!="") { ?>
							<br><center>
							<img src="../admin/intranet/uploadsnotam/<?php echo $foto; ?>"  width="60%" height="20%">
							</center>
							<br>
							<?php } ?>
							
							<div class="table-full-width">
							<table class="table">
							<tr><td>	
								
                                        <div class="form-group">
										<img src="./images/ivaoco.png" class="iconlarge activityicon" alt=" " role="presentation" width="3%"/>
                                            <label>Titulo Notam</label>
                                            <input class="form-control" name="nombre" value="<?php echo $titulo; ?>" readonly="readonly"/>
										
                                        </div>
										 <div class="form-group">
										 <img src="./images/ivaoco.png" class="iconlarge activityicon" alt=" " role="presentation" width="3%"/>
                                            <label>Fecha de Creación</label>
											<input class="form-control" type="text" name="fecha" value="<?php echo $fecha; ?>" readonly="readonly"/>
                                        </div>
							
										 <div class="form-group">
										 <img src="./images/ivaoco.png" class="iconlarge activityicon" alt=" " role="presentation" width="3%"/>
                                            <label>Información Notam</label>
											<textarea class="form-control" name="info" readonly="readonly" rows="14" ><?php echo $informacion; ?></textarea>
                                        </div>
										
										<br>
										<hr>
										
										<p>
										<span style="color: #2a4982; font-family: Arial; font-size: 11pt;"><strong><?php echo $nombrese; ?></strong></span><br />
										<span style="color: #666666; font-size: 10pt;"><strong><?php echo $cargose; ?> - Colombia</strong></span><br />
										<span style="color: #666666; font-size: 8pt;">International Virtual Aviation Organisation<br />
										<a href="http://co.ivao.aero/"><font color="blue">http://co.ivao.aero</font></a></span></p>

									</td></tr>
	</table>
	
</div>
                                
                            </div>
                        </div>
                    </div>
					</div>
                        </div>
                    </div>