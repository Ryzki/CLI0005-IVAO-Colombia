
<?php
include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from eventos where id=$idaa";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$idgrupo= $row3["id"];
        $callsign= $row3["nombre"];
		$hora_inicio= $row3["hora_inicio"];
		$hora_fin= $row3["hora_fin"];
		$fecha= $row3["fecha"];
		$informacion= $row3["informacion"];
	    $imagen= $row3["imagen"];
		$staff= $row3["staff"];
	
	
		
	
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
                            Actualización de un Evento
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form  enctype="multipart/form-data" action="?page=eventosactualizado" method="post">
                                        
										
						
										 <div class="form-group">
                                            <label>Nombre Evento</label>
                                            <input class="form-control" name="nombre" value="<?php echo $callsign; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio</label>
											<input type="time" name="horauno" value="<?php echo $hora_inicio; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Hora Finalización</label>
											<input type="time" name="horados" value="<?php echo $hora_fin; ?>">
                                        </div>
                                          <div class="form-group">
                                            <label>Fecha Evento</label>
											<input type="date" name="fecha" value="<?php echo $fecha; ?>">
                                        </div>
										 <div class="form-group">
                                            <label>Información Evento</label>
											<textarea name="info"><?php echo utf8_decode($informacion); ?></textarea>
                                        </div>
										
										<div class="form-group">
                                            <label>Imagen Evento</label>
                                           
<input name="image_file"  type="file">

<br>
<hr>

										
                                        </div>
										
										 <input type="hidden" class="form-control" name="id" value="<?php echo $idgrupo; ?>"/>
								
									
								
                                        <button type="submit" class="btn btn-default">Actualizar Evento</button>

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