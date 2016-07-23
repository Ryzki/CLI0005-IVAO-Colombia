
<?php
include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from noticias where id=$idaa";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$idgrupo= $row3["id"];
        $callsign= $row3["nombre_examen"];
		$hora_inicio= $row3["hora_inicio"];
		$hora_fin= $row3["hora_utcinicio"];
		$lugar= $row3["lugar"];
		$informacion= utf8_decode($row3["informacion"]);
	    
		$staff= $row3["staff"];
		$imagen= $row3["imagen"];
	   $usuario= $row3["usuario"];
	$fecha= $row3["fecha"];
	
		
	
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
                            Actualización de un Examen
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                    <form  enctype="multipart/form-data" action="?page=noticiaactualizado" method="post">
                                        
										
						
										 <div class="form-group">
                                            <label>Nombre Examen</label>
                                            <input class="form-control" name="nombre" value="<?php echo $callsign; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Usuario de Examen</label>
                                            <input class="form-control" name="usuario" value="<?php echo $usuario; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Lugar Examen</label>
                                            <input class="form-control" name="lugar" value="<?php echo $lugar; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio HLC</label>
											<input class="form-control" type="time" name="horauno" value="<?php echo $hora_inicio; ?>">
                                        </div>
										<div class="form-group">
                                            <label>Hora Inicio UTC</label>
											<input class="form-control" type="text" name="horados" value="<?php echo $hora_fin; ?>">
                                        </div>
                                          <div class="form-group">
                                            <label>Fecha Examen</label>
											<input class="form-control" type="date" name="fecha" value="<?php echo $fecha; ?>">
                                        </div>
										 <div class="form-group">
                                            <label>Información Examen</label>
											<textarea class="form-control" name="info"><?php echo $informacion; ?></textarea>
                                        </div>
										
										<div class="form-group">
                                            <label>Imagen Examen</label>
                                           
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