	<div class="container">
	
	

	<section id="team">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>EVENTOS</h2>
          <p>Proximos eventos - Inscribete y acompañanos</p>
        </div>
      </div>
      <div class="team-members">
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
	
	
	
	 <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="member-image">
                <img class="img-responsive" src="../admin/intranet/uploads/<?php echo $row2['imagen']; ?>" alt="">
              </div>
              <div class="member-info">
                <h3><?php echo $row2['nombre']; ?></h3>
                <h4>Hora: <?php echo $row2['hora_inicio']; ?> Z - <?php echo $row2['hora_fin']; ?> Z</h4>
                <p>Fecha: <?php echo $row2['fecha']; ?></p>
                <p>Acompañanos</p>
              </div>
              <div class="social-icons">
                <ul>
                  <li><a class="facebook" href="?page=infoevent&id=<?php echo $row2['id']; ?>"><i class="fa fa-chevron-right"></i></a></li>
                  <!--
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                  -->
                </ul>
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
    </div>
  </section><!--/#team-->
  
  <!-- ----------------------- EVENTOS ---------------------------- -->
  
  
  
  <!-- ----------------------- NOTICIAS ---------------------------- -->

  <section id="team">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>NOTICIAS</h2>
          <p>Ultimas noticias de la Division.</p>
        </div>
      </div>
      <div class="team-members">
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
          
          
          
          
          <div class="col-sm-3">
            <div class="team-member wow flipInY" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="member-image">
                <img class="img-responsive" src="../admin/intranet/uploadsnoticias/<?php echo $row23['imagen']; ?>" alt="">
              </div>
              <div class="member-info">
                <h3><?php echo $row23['nombre_examen']; ?></h3>
                <h4>Examinado: <?php echo $row23['usuario']; ?></h4>
                <p>Fecha: <?php echo $row23['fecha']; ?></p>
                <p>Hora: <?php echo $row23['hora_inicio']; ?> HLC - <?php echo $row23['hora_utcinicio']; ?> UTC</p>
                <p>Lugar: <?php echo $row23['lugar']; ?></p>
                <p>Acompañalo</p>
              </div>
              <div class="social-icons">
                <ul>
                  <li><a class="facebook" href="?page=infoexamen&id=<?php echo $row23['id']; ?>"><i class="fa fa-chevron-right"></i></a></li>
                  <!--
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                  -->
                </ul>
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
    </div>
  </section><!--/#team-->
  
  <!-- ----------------------- NOTICIAS ---------------------------- -->

	
	
	
	
	
	</div>