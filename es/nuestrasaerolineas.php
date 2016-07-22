<!-- -------------------------- AEROLINEAS & ESCUELAS VIRTUALES ---------------------------- -->
  
  <section id="blog">
    <div class="container">
         <?
		 
		 include('./db_login.php');
		  
		  	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
		  
	$sql237 = "SELECT * FROM airlines order by nombre_aerolinea asc";

	if (!$result237 = $db->query($sql237)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	$ippii=0;

	while ($row237 = $result237->fetch_assoc()) {
	
	
	$ippii++;
	
	}
	?>
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2>Aerolíneas Virtuales de Colombia</h2>
          <p>Has parte de alguna de las <?php echo $ippii; ?> Aerolíneas Virtuales que tiene la división de IVAO Colombia.</p>
        </div>
      </div>
      
      <div class="blog-posts">
        <div class="row">
          
          <?
		 
		 include('./db_login.php');
		  
		  	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
		  
	$sql2377 = "SELECT * FROM airlines order by id asc";

	if (!$result2377 = $db->query($sql2377)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	


	while ($row2377 = $result2377->fetch_assoc()) {
	
	$nombre_aerolinea= $row2377["nombre_aerolinea"];
        $callsign= $row2377["id"];
		$icao_aerolinea= $row2377["icao_aerolinea"];
		$iata_aerolinea= $row2377["iata_aerolinea"];
		$ceo= $row2377["ceo"];
		$informacion= $row2377["informacion"];
	    $url_pilotos= $row2377["url_pilotos"];
		$url_estadistica= $row2377["url_estadistica"];
		$url_hora_mes= $row2377["url_hora_mes"];
		$sistema= $row2377["sistema"];
	    $web= $row2377["web"];
	    $tipo_aerolinea= $row2377["tipo_aerolinea"];
	    $numeros= $row2377["numeros"];
	    $radio= $row2377["radio"];
		 $vas= $row2377["imagen_va"];
		 
		 
		 
		 	$ruta_img = "https://www.ivao.aero/data/images/airline/" . $numeros . ".jpg"; // 
	$ruta_imgs = "https://www.ivao.aero/data/images/airline/" . $numeros . ".png"; // 
	$ruta_imgss = "https://www.ivao.aero/data/images/airline/" . $numeros . ".gif"; // 
	
	
	$i=0;

    if(getimagesize($ruta_img)){
    $iaa = ".jpg";
$i++;
    } 

    if(getimagesize($ruta_imgs)){
    $iaa = ".png";
 $i++;
    }
	
	    if(getimagesize($ruta_imgss)){
    $iaa = ".gif";
$i++;
    }


  

	
	?>
          
          
         <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="post-thumb">
              <div id="post-carousel"  class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#post-carousel" data-slide-to="0" class="active"></li>
                  <li data-target="#post-carousel" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
				<?php if ($i>0) { ?>
                  <div class="item active">
                    <img class="img-responsive" src="https://www.ivao.aero/data/images/airline/<?php echo $numeros; ?><?php echo $iaa; ?>" alt="">
                  </div>
				  <div class="item">
                    <img class="img-responsive" src="../admin/intranet/imagenair/<?php echo $vas; ?>" alt="" width="398" height="224">
                  </div>
				<?php } else {?>
				<div class="item active">
                     <img class="img-responsive" src="../admin/intranet/imagenair/<?php echo $vas; ?>" alt="" width="398" height="224">
                  </div>
				
				<?php } ?>
                  
                
                </div>                               
                <!--
                <a class="blog-left-control" href="#post-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="blog-right-control" href="#post-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                -->
              </div> 
              <br>  
              <div class="post-meta">
              </div>
            
            </div>
            <div class="entry-header">
              <span><i class="fa fa-home"></i> <?php echo $nombre_aerolinea; ?></span>
              <br>
              <span><i class="fa fa-plane"></i> <?php echo $tipo_aerolinea; ?></span> 
            </div>
            <div class="entry-content">
              <span><i class="fa fa-globe"></i> Web: <a target="_blanck" href="<?php echo $web; ?>">Ver Web</a></span>
            </div>
			 <div class="social-icons">
                <ul>
               <center>
                    <a class="facebook" href="?page=infoairlines&id=<?php echo  $callsign; ?>"><i class="fa fa-chevron-right"></i> VER INFORMACIÓN</a></center>
                </ul>
              </div>
          </div>
          
		  
		  <?php
		  }
	?>
          
        
          
       
        
        </div>
        
        <!--
        <div class="load-more wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="500ms">
          <a href="#" class="btn-loadmore"><i class="fa fa-repeat"></i> Load More</a>
        </div>
        -->  
        
      </div>
    </div>
  </section><!--/#blog-->