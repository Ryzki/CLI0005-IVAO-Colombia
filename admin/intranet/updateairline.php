
<?php
include('./db_login.php');
	$idaa = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from airlines where id=$idaa";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$nombre_aerolinea= $row3["nombre_aerolinea"];
        $callsign= $row3["id"];
		$icao_aerolinea= $row3["icao_aerolinea"];
		$iata_aerolinea= $row3["iata_aerolinea"];
		$ceo= $row3["ceo"];
		$informacion= $row3["informacion"];
	    $url_pilotos= $row3["url_pilotos"];
		$url_estadistica= $row3["url_estadistica"];
		$url_horas_mes= $row3["url_horas_mes"];
		$sistema= $row3["sistema"];
	    $web= $row3["web"];
	    $tipo_aerolinea= $row3["tipo_aerolinea"];
	    $numeros= $row3["numeros"];
	    $radio= $row3["radio"];
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
                            Actualización de Aerolinea
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>IVAO AERO</h3>
                                
									
									
									
									
									  <form enctype="multipart/form-data"  action="./?page=airlineactualizada" method="post" >
                                        <div class="form-group">
                                            <label>Nombre Aerolínea</label>
                                            <input class="form-control" name="nombre" value="<?php echo $nombre_aerolinea; ?>"/>
											<input type="hidden" name="id" value="<?php echo $callsign; ?>"/>
                                        </div>
										 <div class="form-group">
                                            <label>Tipo Aerolínea: <?php echo $tipo_aerolinea; ?></label>
                                            <select name="tipe">
											<option value="Aerolinea Virtual">Aerolínea Virtual</option>
											<option value="Escuela Militar">Escuela Militar</option>
											</select>
                                        </div>
										<div class="form-group">
                                            <label>Sistema Aerolínea: <?php echo $sistema; ?></label>
                                            <select name="sistema">
											<option value="VAM">VAM</option>
											<option value="PHPVMS">PHPVMS</option>
											<option value="FSAIRLINES">FSAIRLINES</option>
											<option value="VAFS">VAFS</option>
											<option value="OTRO">OTRO</option>
											</select>
                                        </div>
										 <div class="form-group">
                                            <label>ICAO Aerolínea</label>
											<input type="form-control" name="icao" value="<?php echo $icao_aerolinea; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>IATA Aerolínea</label>
											<input type="form-control" name="iata" value="<?php echo $iata_aerolinea; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Radio Aerolínea</label>
											<input type="form-control" name="radio" value="<?php echo $radio; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>CEO Aerolínea</label>
											<input type="form-control" name="ceo" value="<?php echo $ceo; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>URL Web</label>
                                            <input class="form-control" name="url" value="<?php echo $web; ?>"/>
                                        </div>
										
										<div class="form-group">
                                            <label>URL Pilotos</label>
                                            <input class="form-control" name="pca" value="<?php echo $url_pilotos; ?>"/>
                                        </div>
										
										<div class="form-group">
                                            <label>URL Estadisticas</label>
                                            <input class="form-control" name="stat" value="<?php echo $url_estadistica; ?>"/>
                                        </div>
										
										<div class="form-group">
                                            <label>URL Vuelos</label>
                                            <input class="form-control" name="vueloa" value="<?php echo $url_horas_mes; ?>"/>
                                        </div>
										 <div class="form-group">
                                            <label>Información Aerolínea</label>
											<textarea name="info"><?php echo $informacion; ?></textarea>
                                        </div>
										 <div class="form-group">
                                            <label>ID Aerolínea</label>
											<input type="form-control" name="numeros" value="<?php echo $numeros; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Imagen Aerolínea</label>
                                           
<input name="image_file"  type="file" >

										
                                        </div>
										
									
								
                                        <button type="submit" class="btn btn-default">Aerolínea Actualizada</button>

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