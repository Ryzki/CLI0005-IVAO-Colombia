<section id="recent-works" class="shortcode-item">
        <div class="container">
              <h2>EVENTOS</h2>
          <p>Proximos eventos - Inscribete y acompañanos</p>
            <div class="row">
			  <?
		  
		  include('./db_login.php');
		  
		  	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
	
	$sql2 = "SELECT * FROM eventos ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	$i=0;

	while ($row2 = $result2->fetch_assoc()) {
	
	
	
	$año = substr ($row2['fecha'], 0,4);
	$mes = substr ($row2['fecha'], 5,2);
	$dia = substr ($row2['fecha'], 8,2);
	$fechass = $año .''.$mes.''.$dia;
	$hoy = date("Ymd");  
	if($fechass >= $hoy) {
	$i++;
	?>
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="../admin/intranet/uploads/<?php echo $row2['imagen']; ?>" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h4><a href="#"><font color="white"><?php echo $row2['nombre']; ?></font></a> </h4>
                                <p><?php echo $row2['fecha']; ?></p>
                                <a class="preview" href="./?page=infoevent&id=<?php echo $row2['id']; ?>" ><i class="fa fa-eye"></i> Ver Más</a>
                            </div> 
                        </div>
                    </div>
                </div>   

           <?
	
	} 
	}
	
	
	if ($i==0)
	{
	echo '<div class="alert alert-danger" role="alert">No hay Eventos disponibles aún.</div>';
	
	 
	} 
		  
		  
		  ?>     
               
            </div>
        </div>
    </section><!--/#portfolio-->







	
	
	<section id="recent-works" class="shortcode-item">
        <div class="container">
              <h2>NOTICIAS</h2>
          <p>Ultimas noticias de la Division.</p>
            <div class="row">
			<?
		 
		 include('./db_login.php');
		  
		  	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
		  
	$sql23 = "SELECT * FROM noticias ";

	if (!$result23 = $db->query($sql23)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	$ipp=0;

	while ($row23 = $result23->fetch_assoc()) {
	
	
	$año = substr ($row23['fecha'], 0,4);
	$mes = substr ($row23['fecha'], 5,2);
	$dia = substr ($row23['fecha'], 8,2);
	$fechass = $año .''.$mes.''.$dia;
	$hoy = date("Ymd");  
	if($fechass >= $hoy) {
	$ipp++;
	
	?>
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="recent-work-wrap">
                        <img class="img-responsive" src="../admin/intranet/uploadsnoticias/<?php echo $row23['imagen']; ?>" alt="">
                        <div class="overlay">
                            <div class="recent-work-inner">
                                <h4><a href="#"><font color="white"><?php echo $row23['nombre_examen']; ?></font></a> </h4>
                                <p>Fecha: <?php echo $row23['fecha']; ?> - Lugar: <?php echo $row23['lugar']; ?></p>
                                <p>Acompañalo!</p>
                                <a class="preview" href="./?page=infoexamen&id=<?php echo $row23['id']; ?>" ><i class="fa fa-eye"></i> Ver Más</a>
                            </div> 
                        </div>
                    </div>
                </div>   

          	  
	<?php  
	
	}
	}
	
	
	if ($ipp==0)
	{
	echo '<div class="alert alert-danger" role="alert">No hay Noticias o Examenes disponibles aún.</div>';
	
	 
	} 
		  
		  
		  ?>   
               
            </div>
        </div>
    </section><!--/#portfolio-->








	
	
	
	
