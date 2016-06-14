
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
		$url_hora_mes= $row3["url_hora_mes"];
		$sistema= $row3["sistema"];
	    $web= $row3["web"];
	    $tipo_aerolinea= $row3["tipo_aerolinea"];
	    $numeros= $row3["numeros"];
	    $radio= $row3["radio"];
		 $vas= $row3["imagen_va"];
	}
	
	
	$ruta_img = "https://www.ivao.aero/data/images/airline/" . $numeros . ".jpg"; // 
	$ruta_imgs = "https://www.ivao.aero/data/images/airline/" . $numeros . ".png"; // 
	$ruta_imgss = "https://www.ivao.aero/data/images/airline/" . $numeros . ".gif"; // 
	
	
	

    if(getimagesize($ruta_img)){
    $iaa = ".jpg";
 
    }

    if(getimagesize($ruta_imgs)){
    $iaa = ".png";
 
    }
	
	    if(getimagesize($ruta_imgss)){
    $iaa = ".gif";
 
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
                            Información Aerolínea
                        </div>
                        <div class="panel-body">
                            <div class="row">
							
								<center><img src="https://www.ivao.aero/data/images/airline/<?php echo $numeros; ?><?php echo $iaa; ?>"/></center>
								<hr>
								<center><img src="./imagenair/<?php echo $vas; ?>" width="700" height="300"/></center>
								<hr>
                                <div class="col-md-6">
								<br>
                                   
								<hr>
								
                                        <div class="form-group">
                                            <label>Nombre Aerolínea</label>
                                            <input class="form-control" name="nombre" value="<?php echo $nombre_aerolinea; ?>" readonly="readonly"/>
										
                                        </div>
										 <div class="form-group">
                                            <label>Tipo Aerolínea</label>
                                           <input class="form-control" name="icaossa" value="<?php echo $tipo_aerolinea; ?>" readonly="readonly" />
											
                                        </div>
										<div class="form-group">
                                            <label>Sistema Aerolínea</label>
                                            <input class="form-control" name="icaoss" value="<?php echo $sistema; ?>"/ readonly="readonly" >
											
                                        </div>
										 <div class="form-group">
                                            <label>ICAO Aerolínea</label>
											<input class="form-control" name="icao" value="<?php echo $icao_aerolinea; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>IATA Aerolínea</label>
											<input class="form-control" name="iata" value="<?php echo $iata_aerolinea; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>Radio Aerolínea</label>
											<input class="form-control" name="radio" value="<?php echo $radio; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>CEO Aerolínea</label>
											<input class="form-control" name="ceo" value="<?php echo $ceo; ?>" readonly="readonly" />
                                        </div>
										<div class="form-group">
                                            <label>URL Web <a href="<?php echo $web; ?>">Ver.</a></label>
                                            <input class="form-control" name="url" value="<?php echo $web; ?>" readonly="readonly" />
                                        </div>
										 <div class="form-group">
                                            <label>Información Aerolínea</label>
											<textarea name="info" readonly="readonly" ><?php echo $informacion; ?></textarea>
                                        </div>
										

                                 
                                </div>
								
								
								
								 <div class="col-md-10">
								<br>
								<br>
								<hr>
								<h1>Pilotos de <?php echo $nombre_aerolinea; ?></h1>
								
								
								
								
								
								
								
								
								
								<br>
								<h1>Estadísticas de <?php echo $nombre_aerolinea; ?></h1>
								
								
								
								
								
								<br>
								<h1>Vuelos de <?php echo $nombre_aerolinea; ?></h1>
                               
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