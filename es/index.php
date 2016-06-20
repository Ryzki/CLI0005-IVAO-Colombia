<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="IVAO Colombia. Te permite volar y/o controlar en el ambiente simulado más realista posible, incluso con meteorología del mundo real. 
                Usted puede recibir entrenamiento y disfrutar de nuestra comunidad totalmente gratis. ">
  <meta name="author" content="NC">
  <meta name="keywords" content="IVAO, IVAO Colombia, Aviacion virtual, FSX, Prepar3d, Division IVAO Colombia">
  <title>IVAO Colombia</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet"> 
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/lightbox.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <link id="css-preset" href="css/presets/preset1.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link href="css/iframe.css" rel="stylesheet">  <!-- iframe CSS: Para Iframe con Responsive Desig-->

  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
  <![endif]-->
  
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="images/favicon.png">
</head><!--/head-->

<body>
  <!--.preloader-->
  <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
  <!--/.preloader-->

  <header id="home">
    <div id="home-slider" class="carousel slide carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(images/slider/1.jpg)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Bienvenido a IVAO <span>Colombia</span></h1>
            <p class="animated fadeInRightBig">La mayor red de pilotos y controladores virtuales</p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="../index.html">Atras</a>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="./#services">Continuar</a>
          </div>
        </div>
		
		
		 <?
		 
		 include('./db_login.php');
		  
		  	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
		  
	$sql2377a = "SELECT * FROM airlines order by id asc";

	if (!$result2377a = $db->query($sql2377a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
$vass = 0;

	while ($row2377a = $result2377a->fetch_assoc()) {
	

		 
		 $vass++;


  

	
	?>
	
	
	 <div class="item" style="background-image: url(../admin/intranet/imagenair/<?php echo $row2377a["imagen_va"]; ?>)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Aerolínea <span> <?php echo $row2377a["nombre_aerolinea"]; ?></span></h1>
            <p class="animated fadeInRightBig">Certificada por IVAO World</p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="./">Atras</a>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="<?php echo $row2377a["web"]; ?>">Ver</a>
          </div>
        </div>
	
	<?php } ?>
	
	
        <div class="item" style="background-image: url(images/slider/3.jpg)">
          <div class="caption">
            <h1 class="animated fadeInLeftBig">Prepararete<span> Virtualmente</span></h1>
            <p class="animated fadeInRightBig">Como Piloto - Controlador Aereo</p>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="../index.html">Atras</a>
            <a data-scroll class="btn btn-start animated fadeInUpBig" href="./#services">Continuar</a>
          </div>
        </div>
		
      </div>
      <a class="left-control" href="#home-slider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="right-control" href="#home-slider" data-slide="next"><i class="fa fa-angle-right"></i></a>

      <a id="tohash" href="#services"><i class="fa fa-angle-down"></i></a>

   
   
   <!-- ------------------------- Menu --------------------------- -->
   
   
    </div><!--/#home-slider-->
    <div class="main-nav">
      
      <div class="container">
      <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./">
            <h1><img class="img-responsive" src="images/logo.png" alt="logo"></h1>
          </a>                    
        </div>
        </div>
      
       <br>
       
      <div class="container">
        
       
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">                 
            <li class="scroll active"><a href="./#home">Inicio</a></li>
            <li class="scroll"><a href="./#services">IVAO COL</a></li> 
            <li class="scroll"><a href="./#portfolio">Pilotos</a></li>
            <li class="scroll"><a href="./#controladores">Controladores</a></li>
            <li class="scroll"><a href="./#atc-ss">ATC</a></li>
            <li class="scroll"><a href="./#team">Eventos</a></li>
            <li class="scroll"><a href="./#features">Recursos</a></li>
            <li class="scroll"><a href="./#pricing">Online</a></li>
            <li class="scroll"><a href="./#blog">Aerolineas VA</a></li>
            <li class="scroll"><a href="./#contact">Contactenos</a></li>       
          </ul>
        </div>
      </div>
    </div><!--/#main-nav-->
  </header><!--/#home-->
  
  
  <!-- ------------------------- Menu --------------------------- -->
  
  <?php
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
		?>
  <!-- ------------------------- IVAO Colombia --------------------------- -->
  
  <section id="services">
    <div class="container">
      <div class="heading wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="row">
          <div class="text-center col-sm-8 col-sm-offset-2">
            <h2>IVAO Colombia</h2>
            <p>IVAO™ les permite volar y/o controlar en el ambiente simulado más realista posible, incluso con meteorología del mundo real. 
                Usted puede recibir entrenamiento y disfrutar de nuestra comunidad gratis.</p>
          </div>
        </div> 
      </div>
      <div class="text-center our-services">
        <div class="row">
          
          
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="750ms">
            <a class="scroll" href="#about-us">
            <div class="service-icon">
              <i class="fa fa-info-circle">  </i> 
            </div>
            </a>
            <div class="service-info">
              <h3>Acerca de Nosotros</h3>
              <p>Una comunidad en línea para entusiastas de la aviación.</p>
            </div>
          </div>
          
          <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <a target="_blanck" href="https://www.ivao.aero/members/person/register.htm">
            <div class="service-icon">
              <i class="fa fa-pencil-square-o"></i>
            </div>
            </a>
            <div class="service-info">
              <h3>Registrarse</h3>
              <p>Únete a la red de pilotos y controladores virtuales más grande de simulación aérea en el país.</p>
            </div>
          </div>
          
          <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="450ms">
            <a href="#">
            <div class="service-icon">
              <i class="fa fa-question"></i>
            </div>
            </a>
            <div class="service-info">
              <h3>Preguntas frecuentes</h3>
              <p>Encuentra en esta session las respuestas a tus preguntas.</p>
            </div>
          </div>
          
          <div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="550ms">
            <a target="_blanck" href="https://www.ivao.aero/ViewDocument.aspx?Path=/rules:network">
            <div class="service-icon">
              <i class="fa fa-list-alt"></i>
            </div>
            </a>
            <div class="service-info">
              <h3>Reglas & Regulaciones</h3>
              <p>Enterate de las reglas y regulaciones de IVAO Colombia.</p>
            </div>
          </div>
          
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="650ms">
            <a class="scroll" href="#blog">
            <div class="service-icon">
              <i class="fa fa-plane"></i>
            </div>
            </a>
				
	
            <div class="service-info">
              <h3>Aerolineas Virtuales de Colombia</h3>
              <p>Actualmente IVAO Colombia cuenta con <?php echo $vass; ?> Aerolíneas Virtuales. En la que podrás complementar tu formación. </p>
            </div>
          </div>
          
          <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="850ms">
            <a class="scroll" href="#pricing">
            <div class="service-icon">
              <i class="fa fa-power-off"></i>
            </div>
            </a>
            <div class="service-info">
              <h3>Online</h3>
              <p>Colombia Online - Controladores, Pilotos, Staff, Ceos.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!--/#services-->
  
  
  <!-- ------------------------- IVAO Colombia --------------------------- -->
  
  
  
  
  <!-- ------------------------- Acerca de Nosotros --------------------------- -->
    
  <!--/#Aserca de Nosotros-->
  <section id="about-us" class="parallax">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="about-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2>Acerca de nosotros</h2>
            <p>IVAO™, International Virtual Aviation Organisation™, ofrece un servicio dedicado, independiente y libre de costo a los entusiastas que hacen parte de la comunidad de simulación de vuelo alrededor del mundo. IVAO™ fue creada para brindar servicios de alta calidad a sus usuarios. </p>
            <p>El objetivo primario de IVAO™ es brindar a la comunidad de simulación de vuelo un ambiente lo más realista posible. Esto incluye un sistema de vuelo (para pilotos), uno de control aéreo, bases de datos con información aeronáutica internacional, eventos y entrenamiento.</p>
            <p>IVAO™ les permite volar y/o controlar en el ambiente simulado más realista posible, incluso con meteorología del mundo real. 
            Usted puede recibir entrenamiento y disfrutar de nuestra comunidad gratis.</p>
            <p>Únete al grupo más grande de aviadores en Colombia. </p>
          </div>
        </div>
        <div class="col-sm-6">
          
           <?
		 
		 include('./db_login.php');
		  
		  	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
		  
	$infodivision = "SELECT * FROM infodivision";

	if (!$resultinfodivision = $db->query($infodivision)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
$vass = 0;

	while ($rowinfodivision = $resultinfodivision->fetch_assoc()) {
	
	

$membersact = $rowinfodivision['members'];
 $pcas = $rowinfodivision['pilots'];
 $atcs = $rowinfodivision['atc'];
  $posos = $rowinfodivision['puesto'];
  
  $porcentaje = round((100*$pcas)/$membersact);
  
  $porcentajedos = round((100*$atcs)/$membersact);
	}
	
	if ($posos == 1) {
		$porc = 100;
	} else if ($posos == 2) {
		$porc = 95;
	} else if ($posos == 3) {
		$porc = 90;
	} else if ($posos == 4) {
		$porc = 85;
	} else if ($posos == 5) {
		$porc = 80;
	} else if ($posos == 6) {
		$porc = 75;
	} else if ($posos == 7) {
		$porc = 70;
	} else if ($posos == 8) {
		$porc = 65;
	} else if ($posos == 9) {
		$porc = 60;
	} else if ($posos == 10) {
		$porc = 55;
	} else if ($posos == 11) {
		$porc = 50;
	} else {
		$porc = 45;
	}


	
	?>
          
          <div class="our-skills wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
              <p class="lead">Miembros Activos</p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="100"><?php echo $membersact; ?></div>
              </div>
            </div>
            
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="400ms">
              <p class="lead">Pilotos</p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="<?php echo $porcentaje; ?>"><?php echo  $pcas; ?></div>
              </div>
            </div>
            
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="500ms">
              <p class="lead">Controladores</p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="<?php echo $porcentajedos; ?>"><?php echo  $atcs; ?></div>
              </div>
            </div>
            
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
              <p class="lead">Puesto de la Division</p>
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="<?php echo $porc; ?>"><?php echo $posos; ?></div>
              </div>
            </div>
            
            <div class="our-skills wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="single-skill wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
              <p class="lead">Tablas estadisticas comparadas con las demas divisiones a nivel internacional</p>
              <!--
              <div class="progress">
                <div class="progress-bar progress-bar-primary six-sec-ease-in-out" role="progressbar"  aria-valuetransitiongoal="50">1075</div>
              </div>
              -->
            </div>
            
           </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/#about-us-->

  <!-- ----------------------- PILOTOS ---------------------------- -->
  
  <section id="portfolio">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
          <h2>PILOTOS</h2>
          <p>IVAO Colombia cuenta con mas de <?php echo  $pcas; ?> Pilotos Virtuales activos.</p>
        </div>
      </div> 
    </div>
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-sm-3">
          <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Register.png" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>Registrarse</h3>
                    <p>Nuevo Piloto Virtual</p>
                  </div>
                  <div class="folio-overview">
                      
                    <a class="facebook" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Rangos.png" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>Rangos</h3>
                    <p>Rangos Piloto IVAO</p>
                  </div>
                  <div class="folio-overview">
                      
                    <a class="facebook" target="_blanck" href="https://ivao.aero/ViewDocument.aspx?Path=/training:pilot:ratings" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Primeros Pasos.gif" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>Primeros Pasos</h3>
                    <p>Guía para iniciar</p>
                  </div>
                  <div class="folio-overview">
                      
                    <a class="facebook" target="_blanck" href="https://ivao.aero/ViewDocument.aspx?Path=training:pilot:first_steps" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
       <div class="col-sm-3">
          <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Formacion.png" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>Formación</h3>
                    <p>Inicia tu formación como piloto</p>
                  </div>
                  <div class="folio-overview">
                      
                    <a class="facebook" target="_blanck" href="https://ivao.aero/training/documentation/index.php?section=fsx" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="folio-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="400ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Entrenamiento.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>Entrenamiento</h3>
                    <p>Instrucción para pilotos</p>
                  </div>
                  <div class="folio-overview">
                    <a class="tumblr" target="_blanck" href="#" ><i class="fa fa-link"></i></a>
                    <!--  
                    <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="500ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Cartas.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>Cartas</h3>
                    <p>Aeródromos, TMA</p>
                  </div>
                  <div class="folio-overview">
                    <a class="facebook" target="_blanck" href="http://www.aerocivil.gov.co/AIS/AIP/Paginas/Inicio.aspx" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="col-sm-3">
          <div class="folio-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Software.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>IVAP Software</h3>
                    <p>Descargar IVAP</p>
                  </div>
                  <div class="folio-overview">
                    <a class="facebook" target="_blanck" href="https://www.ivao.aero/softdev/ivap.asp" ><i class="fa fa-link"></i></a>
                    <!--  
                    <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        
        <div class="col-sm-3">
          <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="700ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Registrar.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>Time Hours</h3>
                    <p>Design, Photography</p>
                  </div>
                  <div class="folio-overview">
                    <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <!--
        <div class="col-sm-3">
          <div class="folio-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="800ms">
            <div class="folio-image">
              <img class="img-responsive" src="images/P&C/P_Registrar.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="folio-info">
                    <h3>Time Hours</h3>
                    <p>Design, Photography</p>
                  </div>
                  <div class="folio-overview">
                    <span class="folio-link"><a class="folio-read-more" href="#" data-single_url="portfolio-single.html" ><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        -->
        
        
        
      </div>
    </div>
    <div id="portfolio-single-wrap">
      <div id="portfolio-single">
      </div>
    </div><!-- /#portfolio-single-wrap -->
  </section><!--/#portfolio1-->
  
  
  <!-- ----------------------- PILOTOS ---------------------------- -->
  
  
  
  <!-- ----------------------- CONTROLADORES ---------------------------- -->
  
  <section id="controladores">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
          <h2>CONTROLADORES</h2>
          <p>IVAO Colombia cuenta con mas de <?php echo  $atcs; ?> Controladores Virtuales activos.</p>
        </div>
      </div> 
    </div>
    <div class="container-fluid">
      <div class="row">
          
        <div class="col-sm-3">
          <div class="control-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/C_Register.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>Registrarse</h3>
                    <p>Nuevo Controlador Virtual</p>
                  </div>
                  <div class="control-overview">
                    <a class="facebook" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="control-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="700ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/C_Rangos.png" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>Rangos</h3>
                    <p>Rangos Controlador IVAO</p>
                  </div>
                  <div class="control-overview">
                    <a class="facebook" target="_blanck" href="https://www.ivao.aero/ViewDocument.aspx?Path=/training:atc:ratings" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="control-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="500ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/C_Primeros Pasos.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>Primeros Pasos</h3>
                    <p>Guia para iniciar</p>
                  </div>
                  <div class="control-overview">
                    <a class="facebook" target="_blanck" href="https://www.ivao.aero/ViewDocument.aspx?Path=training:atc:first_steps" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="control-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="400ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/C_Formacion.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>Formacion</h3>
                    <p>Inicia tu formacion como controlador</p>
                  </div>
                  <div class="control-overview">
                    <a class="facebook" target="_blanck" href="https://www.ivao.aero/training/documentation/index.php?section=asx" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="control-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="400ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/C_Entrenamiento.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>Entrenamiento</h3>
                    <p>Entrenamiento para controladores</p>
                  </div>
                  <div class="control-overview">
                    <a class="facebook" target="_blanck" href="#" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="control-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="500ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/C_SectorFile.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>Sector Files</h3>
                    <p>Descargar Sector Files</p>
                  </div>
                  <div class="control-overview">
                    <a class="facebook" target="_blanck" href="https://mega.nz/#F!mZYzxIAB!M5hD_lr_6tyj4_2yIaiJvg" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="col-sm-3">
          <div class="control-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/C_Software.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>IVAC Software</h3>
                    <p>Descargar IVAC</p>
                  </div>
                  <div class="control-overview">
                    <a class="facebook" target="_blanck" href="https://www.ivao.aero/softdev/ivac.asp" ><i class="fa fa-link"></i></a>
                    <!--
                    <span class="folio-link"><a class="folio-read-more" target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-single_url="portfolio-single.html"><i class="fa fa-link"></i></a></span>
                    <span class="folio-expand"><a target="_blanck" href="https://www.ivao.aero/members/person/register.htm" data-lightbox="portfolio"><i class="fa fa-search-plus"></i></a></span>
                    -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       
        
       
        
        <!--
        <div class="col-sm-3">
          <div class="control-item wow fadeInLeftBig" data-wow-duration="1000ms" data-wow-delay="800ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/P_Registrar.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>Time Hours</h3>
                    <p>Design, Photography</p>
                  </div>
                  <div class="control-overview">
                    <span class="control-link"><a class="control-read-more" href="#" data-single_url="controladores-single.html" ><i class="fa fa-link"></i></a></span>
                    <span class="control-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="controladores"><i class="fa fa-search-plus"></i></a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        -->
        
        <!--
        <div class="col-sm-3">
          <div class="control-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="900ms">
            <div class="control-image">
              <img class="img-responsive" src="images/P&C/P_Registrar.jpg" alt="">
            </div>
            <div class="overlay">
              <div class="overlay-content">
                <div class="overlay-text">
                  <div class="control-info">
                    <h3>Time Hours</h3>
                    <p>Design, Photography</p>
                  </div>
                  <div class="control-overview">
                    <span class="control-link"><a class="control-read-more" href="#" data-single_url="controladores-single.html" ><i class="fa fa-link"></i></a></span>
                    <span class="control-expand"><a href="images/portfolio/portfolio-details.jpg" data-lightbox="controladores"><i class="fa fa-search-plus"></i></a></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        -->
        
       
        
      </div>
    </div>
    <div id="controladores-single-wrap">
      <div id="controladores-single">
      </div>
    </div><!-- /#controladores-single-wrap -->
  </section><!--/#controladores-->
  
  
  <!-- ----------------------- CONTROLADORES ---------------------------- -->
  
  
  
  <!-- ------------------------- ATC SCHEDULING SYSTEM --------------------------- -->
    
  <!--/#Aserca de Nosotros-->
  <section id="atc-ss" class="parallax">
    <div class="container">
      <div class="row">
        
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2>Sistema de reservas ATC IVAO ™</h2>
            <p>Con el Sistema de Reserva ATC de IVAO puede separar una dependencia y controlarla .</p>
          </div>
        </div>
        
     
        
        <div class="col-sm-14">
          <div class="about-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
		   <h2>Reservar Dependencia</h2>
            <p> Reserva aquí la dependencia que quieras controlar.</p>
            
            <form name="myform" action="https://ivao.aero/Login.aspx?r=atcss/new.asp?" method="POST" target="_blank"> 
                 <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                              RESERVAR! ATC IVAO Colombia.
                            </button>
							</form>
            <br>
			<hr>
			<br>
			<br>
			
            <h2>Dependencias Reservadas</h2>
            <p> Visualizador de dependencias reservadas.</p>
            <div class="iframe-container">
               <?php include ('dependencias.php'); ?>
            </div>
          
           
			
          </div>
        </div>
        
        
      </div>
    </div>
  </section>
  
   <!-- ------------------------- ATC SCHEDULING SYSTEM --------------------------- -->
  
    
  
  <!-- ----------------------- EVENTOS ---------------------------- -->

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
                <img class="img-responsive" src="../admin/intranet/uploads/<?php echo $row23['imagen']; ?>" alt="">
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


  
  <!-- ------------------------------ RECURSOS --------------------------- -->

  <section id="features" class="parallax">
    <div class="container">
      <div class="row count">
        
        
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
          <a target="_blank" href="http://www.aerocivil.gov.co/AIS/AIP/Paginas/Inicio.aspx">
          <i class="fa fa-map-o"></i>
          </a>
          <h3>Cartas</h3>
          <p>TMA, Aeródromos.</p>
        </div>
        
        
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
          <a target="_blank" href="https://www.ivao.aero/softdev/software.asp">
          <i class="fa fa-desktop"></i>
          </a>
          <h3 >Software</h3>                    
          <p>IVAP, IVAC</p>
        </div> 
        
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="700ms">
          <a target="_blank" href="https://webeye.ivao.aero/">
          <i class="fa fa-eye"></i>
          </a>
          <h3>IVAO Eye</h3>                    
          <p>Web Eye IVAO</p>
        </div> 
        
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="900ms">
          <a target="_blank" href="http://tracker.ivao.aero/">
          <i class="fa fa-search"></i>  
          </a>                  
          <h3>Rastreador</h3>
          <p>IVAO Flght Tracker.</p>
        </div> 
         
        <!--
        <div class="col-sm-3 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="700ms">
          <i class="fa fa-trophy"></i>
          <h3 class="timer">10</h3>                    
          <p>WINNING AWARDS</p>
        </div> 
        -->
                      
      </div>
    </div>
  </section><!--/#features-->

  <!-- ------------------------------ RECURSOS --------------------------- -->
  
  
  <!-- ------------------------------ On Line --------------------------- -->
  
  <section id="pricing">
    <div class="container">
      <div class="row">
        <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1200ms" data-wow-delay="300ms">
          <h2><b>Online</b></h2>
          <p>Miembros de la división Colombiana en Línea</p>
        </div>
      </div>
      <div class="pricing-table">
        <div class="row">
      
	  <?php include('onlines.php'); ?>
              </div>
      </div>
    </div>
  </section><!--/#pricing-->
  
  <!-- ------------------------------ PENDIENTE --------------------------- -->
  
  
  <!-- ------------------------------ CEOS & STAFF -------------------------- -->
  
  <section id="twitter" class="parallax">
    <div>
      <a class="twitter-left-control" href="#twitter-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
      <a class="twitter-right-control" href="#twitter-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-sm-offset-2">
            <div class="twitter-icon text-center">
              <i class="fa fa-users"></i>
              <h3>STAFF</h3>
              <h5>Agradecimientos a:</h5>
            </div>
            <br>
            
            <div id="twitter-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                
                
                
                <!-- DIVISION HQ -->
                
              <!--  <div class="item active wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                 <div>
                    <p>DIVISION HQ </p>
                    <img class="item" src="images/team/Foto.jpg" alt=""> 
                    <img src="images/team/-DIR.gif" alt="" BORDER=0 hspace= 0>
                    <img src="images/team/CO.gif" alt="" BORDER=0 hspace= 0><br>
                  </div>
                  <br>
                  <p>Andres Hurtado - <span>CO-DIR - Colombia Director </span></p>
                  <p> <a href="#"> <span> Email : </span> co-dir@ivao.aero</a></p>
                </div>-->
                
				
				 <?
		 
		 include('./db_login.php');
		  
		  	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
		  
	$staff = "SELECT * FROM staff order by id asc ";

	if (!$resultstaff = $db->query($staff)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
$staffss = 0;

	while ($rowss = $resultstaff->fetch_assoc()) {
		
		
		$staff_ivao = $rowss['staff_ivao'];
		
		$ranks = "SELECT * FROM ranks where id='$staff_ivao' ";

	if (!$resultranks = $db->query($ranks)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	$staffss++;

	while ($rowssa = $resultranks->fetch_assoc()) {
		$spots = $rowssa['posicion'];
		$namess = $rowssa['callsign'];
		$idaa = $rowssa['typestaff'];
		
		$tipes = "SELECT * FROM typestaff where id='$idaa' ";

	if (!$resulta = $db->query($tipes)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
		
	while ($rowsst = $resulta->fetch_assoc()) {
$tiposs = $rowsst['nombre'];
	}	
		
		
		
	}
	
	
	$ruta_img = "https://www.ivao.aero/data/images/staff/" . $rowss['vid_ivao'] . ".jpg"; // 
	
	

    if(getimagesize($ruta_img)){
    $iaap = $ruta_img;
 
    } else {
		$iaap = "https://www.ivao.aero/data/images/staff/000000.gif";
		
	}
	
	
	if($staffss==1){
		?>
                <div class="item active wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div>
                    <p><?php echo $tiposs; ?> </p>
                    <img class="item" src="<?php echo $iaap; ?>" alt=""> 
					 <td align="center" rowspan="1"><img border="0" src="https://www.ivao.aero/data/images/badge/<?php echo $spots; ?>.gif"><img border="0" src="images/team/CO.gif"></td>
<br>
                  </div>
                  <br>
                  <p><?php echo $rowss['nombres'] . ' ' . $rowss['apellidos']; ?> - <span>CO<?php echo $spots; ?> -  <?php echo $namess; ?></span></p>
                  <p> <a href="mailto:<?php echo $rowss['email']; ?>"> <span> Email : </span> <?php echo $rowss['email']; ?></a></p>
                </div>
	<?php
	} else {
		?>
		<div class="item" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div>
                    <p><?php echo $tiposs; ?> </p>
                    <img class="item" src="<?php echo $iaap; ?>" alt=""> 
                   
					<td align="center" rowspan="1"><img border="0" src="https://www.ivao.aero/data/images/badge/<?php echo $spots; ?>.gif"><img border="0" src="images/team/CO.gif"></td>
<br>
                  </div>
                  <br>
                  <p><?php echo $rowss['nombres'] . ' ' . $rowss['apellidos']; ?> - <span>CO<?php echo $spots; ?> -  <?php echo $namess; ?></span></p>
                  <p> <a href="mailto:<?php echo $rowss['email']; ?>"> <span> Email : </span> <?php echo $rowss['email']; ?></a></p>
                </div>
		
		<?
	}
	
	
	}
	?>
                
                
              
             
                
                
                
                
              </div>                        
            </div>                    
          </div>
        </div>
      </div>
    </div>
  </section><!--/#twitter-->

  <!-- ------------------------------ CEOS & STAFF -------------------------- -->


  
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
          
          
         <div class="col-sm-4 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="post-thumb">
              <div id="post-carousel"  class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#post-carousel" data-slide-to="0" class="active"></li>
                  <li data-target="#post-carousel" data-slide-to="1"></li>
                  <li data-target="#post-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img class="img-responsive" src="https://www.ivao.aero/data/images/airline/<?php echo $numeros; ?><?php echo $iaa; ?>" alt="">
                  </div>
                  <div class="item">
                    <img class="img-responsive" src="../admin/intranet/imagenair/<?php echo $vas; ?>" alt="" width="398" height="224">
                  </div>
                  <!--
                  <div class="item">
                    <a href="#"><img class="img-responsive" src="images/blog/3.jpg" alt=""></a>
                  </div>
                  -->
                </div>                               
                <!--
                <a class="blog-left-control" href="#post-carousel" role="button" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                <a class="blog-right-control" href="#post-carousel" role="button" data-slide="next"><i class="fa fa-angle-right"></i></a>
                -->
              </div> 
              <br>  
              <div class="post-meta">
              </div>
              <div class="post-icon">
                <a target="_blanck" href="<?php echo $web; ?>"><i class="fa fa-globe"></i></a>
              </div>
            </div>
            <div class="entry-header">
              <span><i class="fa fa-home"></i> <?php echo $nombre_aerolinea; ?></span>
              <br>
              <span><i class="fa fa-plane"></i> <?php echo $tipo_aerolinea; ?></span> 
            </div>
            <div class="entry-content">
              <span><i class="fa fa-globe"></i> Web: <?php echo $web; ?></span>
            </div>
			 <div class="social-icons">
                <ul>
                  <li><a class="facebook" href="?page=infoairlines&id=<?php echo  $callsign; ?>"><i class="fa fa-chevron-right"></i></a></li>
                  <!--
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                  <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                  <li><a class="rss" href="#"><i class="fa fa-rss"></i></a></li>
                  -->
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
  
    <!-- ----------------------- AEROLINEAS Y ESCUELAS VIRTUALES ---------------------------- -->
  
  
  <!-- -------------------------- CONTACTAR ----------------------------- -->

  <section id="contact">
    <!--
    <div id="google-map" class="wow fadeIn" data-latitude="52.365629" data-longitude="4.871331" data-wow-duration="1000ms" data-wow-delay="400ms"></div>
    -->
    <div id="contact-us" class="parallax">
      <div class="container">
        <div class="row">
          <div class="heading text-center col-sm-8 col-sm-offset-2 wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
            <h2>Contactenos</h2>
            <p>Formulario de contacto</p>
          </div>
        </div>
        <div class="contact-form wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
          <div class="row">
            <div class="col-sm-6">
              <form id="main-contact-form" name="contact-form" method="post" action="#">
                <div class="row  wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <span>
                      <input type="text" name="name" class="form-control" placeholder="Nombre" required="required">
                      </span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <input type="email" name="email" class="form-control" placeholder="Email" required="required">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" name="subject" class="form-control" placeholder="Asunto" required="required">
                </div>
                <div class="form-group">
                  <textarea name="message" id="message" class="form-control" rows="4" placeholder="Escriba su mensaje" required="required"></textarea>
                </div>                        
                <div class="form-group">
                  <button type="submit" class="btn-submit">Inactivo</button>
                </div>
              </form>   
            </div>
            <div class="col-sm-6">
              <div class="contact-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
                <p>Contactanos también por.</p>
                <ul class="address">
                  <!--
                  <li><i class="fa fa-map-marker"></i> <span> Direccion:</span> 2400 South Avenue A </li>
                  <li><i class="fa fa-phone"></i> <span> Telefono:</span> +928 336 2000  </li>
                  -->
                  <li><i class="fa fa-envelope"></i> <span> Email:</span><a href="mailto:co-hq@ivao.aero"> co-hq@ivao.aero</a></li>
                  <li><i class="fa fa-globe"></i> <span> Website:</span> <a target="_blanck" href="http://www.ivaocol.com.co">ivaocol.com.co</a></li>
                </ul>
              </div>                            
            </div>
          </div>
        </div>
      </div>
    </div>        
  </section><!--/#contact-->
  
  <!-- -------------------------- CONTACTAR ----------------------------- -->
  
  
  		<?php
	}
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
	} else {
		$Existe = file_exists($_GET["page"] . ".php");
		if ($Existe == true) {
			include($_GET["page"] . ".php");
		} else {
			echo "Page Not Found";
		}
	}
	
	

?>

  
  <footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.html"><img class="img-responsive" src="images/logo.png" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            
            <li><a class="facebook" target="_blanck" href="https://www.facebook.com/ivaoco/?fref=ts" ><i class="fa fa-facebook"></i></a></li>
            <li><a class="tumblr" target="_blanck" href="https://www.youtube.com/channel/UCOUr_AMGqcMu2JZwSCzWPQA"><i class="fa fa-youtube"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li> 
            <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="envelope" href="mailito:co-hq@ivao.aero"><i class="fa fa-envelope"></i></a></li>
            
            <!--
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
            -->
            
          </ul>
        </div>
      </div>
    </div>
	
	
	

    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; IVAO Colombia <?php echo date('Y'); ?>.</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right">Diseño Web <a href="#">Andres Giraldo</a>  &  Sistematización <a href="#">Andres Zapata</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
  <script type="text/javascript" src="js/jquery.inview.min.js"></script>
  <script type="text/javascript" src="js/wow.min.js"></script>
  <script type="text/javascript" src="js/mousescroll.js"></script>
  <script type="text/javascript" src="js/smoothscroll.js"></script>
  <script type="text/javascript" src="js/jquery.countTo.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>

</body>
</html>