<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>IVAO Colombia</title>
	
	<!-- core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/font-awesome.min.css" rel="stylesheet">
    <link href="./css/animate.min.css" rel="stylesheet">
    <link href="./css/prettyPhoto.css" rel="stylesheet">
    <link href="./css/main.css" rel="stylesheet">
    <link href="./css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="./images/ico/favicon.png">
</head><!--/head-->

<body class="homepage">

	<?php
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
		?>

		
    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-plane-square"></i>  La mejor división!</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="./">Inicio</a></li>
						 <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acerca de Nosotros <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=division">División</a></li>
                                <li><a href="./?page=staff">Staff</a></li>
                                <li><a href="#">Reglamento</a></li>
                                <li><a href="#">HQ Awards</a></li>
                            </ul>
                        </li>
						 <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pilotos <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=registrar">Registrarse</a></li>
                                <li><a href="./?page=pcastep">Primeros Pasos</a></li>
                                <li><a href="./?page=rankpca">Rangos</a></li>
                                <li><a href="./?page=forma">Formación</a></li>
								<li><a href="http://www.aerocivil.gov.co/AIS/AIP/Paginas/Inicio.aspx">Cartas</a></li>
								<li><a href="https://www.ivao.aero/softdev/ivap.asp">IvAp Software</a></li>
                            </ul>
                        </li>
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Controladores <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=registrar">Registrarse</a></li>
								  <li><a href="./?page=atcstep">Primeros Pasos</a></li>
								    <li><a href="./?page=rankatc">Rangos</a></li>
									 <li><a href="./?page=formatc">Formación</a></li>
									  <li><a href="./?page=fra">Lista FRA</a></li>
									   <li><a href="https://mega.nz/#F!mZYzxIAB!M5hD_lr_6tyj4_2yIaiJvg">Sector Files</a></li>
									   <li><a href="https://www.ivao.aero/softdev/ivac.asp">IvAc Software</a></li>
                              
                                
                            </ul>
                        </li>
                       
                        <li><a href="./?page=eventosdeivao">Eventos</a></li>
                        <li><a href="./?page=nuestrasaerolineas">Aerolíneas VA</a></li>
                        <li><a href="./?page=contactenosivao">Contactenos</a></li>     
<li><a href="http://login.ivao.aero/index.php?url=http://www.ivaocol.com.co/usuarios/login.php">LOGIN</a></li>    						
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->
	
	
	

    <section id="main-slider" class="no-margin">
        <div class="carousel slide">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">

                <div class="item active" style="background-image: url(images/slider/bg1.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Deseas ser un controlador aéreo virtual?</h1>
                                    <h2 class="animation animated-item-2">IVAO Colombia, te ofrece la oportunidad de disfrutar la experiencia de ser un Controlador!</h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Regístrate!</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="images/slider/img1.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(images/slider/bg2.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Deseas ser un piloto virtual?</h1>
                                    <h2 class="animation animated-item-2">IVAO Colombia, te ofrece la oportunidad de disfrutar la experiencia de ser un Piloto!</h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                                </div>
                            </div>

                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="slider-img">
                                    <img src="images/slider/img2.png" class="img-responsive">
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/.item-->

				
				
				
				
				
				
				<!--- AEROLINEAS VIRTUALES PUBLICIDAD -->
                <div class="item" style="background-image: url(images/slider/bg3.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Lorem ipsum dolor sit amet consectetur adipisicing elit</h1>
                                    <h2 class="animation animated-item-2">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
                                    <a class="btn-slide animation animated-item-3" href="#">Read More</a>
                                </div>
                            </div>
                            
							
                        </div>
                    </div>
                </div><!--/.item-->
				
				
				
				
				
				
				
				
				
				<!-- FIN PUBLICIDAD AEROLINEAS -->
            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section><!--/#main-slider-->
	


    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>IVAO Colombia</h2>
                <p class="lead">Esta división vela por la calidad de las actividades aéreas realizadas en el Sistema de IVAO. <br> Por ende, nosotros proveemos las siguientes funciones a nuestros usuarios.</p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-bullhorn"></i>
                            <h2>Difución Eventos</h2>
                            <h3>Nuestros usuarios desde el sistema podrán estar al tanto de los próximos eventos</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-comments"></i>
                            <h2>Buzón Mensajes</h2>
                            <h3>Nuestros usuarios podrán ponerse en contacto con nosotros</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-cloud-download"></i>
                            <h2>Entrenamiento</h2>
                            <h3>Nuestro sistema posee un sitio de entrenamiento para los usuarios</h3>
                        </div>
                    </div><!--/.col-md-4-->
                
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-leaf"></i>
                            <h2>Perfil</h2>
                            <h3>Nuestro sistema único, te da la opción de personalizar tu perfil</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-cogs"></i>
                            <h2>Conectividad</h2>
                            <h3>Nuestros servicios están conectados indirecta y directamente con IVAO</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-plane"></i>
                            <h2>Reservas</h2>
                            <h3>La calidad no se improvisa, por ende tenemos sistema de reserva ATC y RFE</h3>
                        </div>
                    </div><!--/.col-md-4-->
                </div><!--/.services-->
            </div><!--/.row-->    
        </div><!--/.container-->
    </section><!--/#feature-->

    <section id="recent-works">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>En Línea</h2>
                <p class="lead">Miembros activos al momento! <script>
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var f=new Date();
document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
</script><br> Pilotos, Controladores y Staff.</p>
            </div>

            <div class="row">
                <?php include('onlines.php'); ?>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#recent-works-->

    <section id="services" class="service-item">
	   <div class="container">
            <div class="center wow fadeInDown">
                <h2>Calidad y Eficiencia</h2>
                <p class="lead">IVAO Colombia posee un sitio administrativo del Staff <br> En el cual, se mantienen las siguientes ventajas ofrecidas a los usuarios.</p>
            </div>

            <div class="row">

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services1.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Estadísticas Confidenciales</h3>
                            <p>Tenemos información de los usuarios que visitan la web.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services2.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Temporización Eventos</h3>
                            <p>Los Eventos se muestran acorde a la programación.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services3.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Mantenimiento Sistema</h3>
                            <p>Un adecuado mantenimiento a la web.</p>
                        </div>
                    </div>
                </div>  

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services4.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Ideas Inovativas</h3>
                            <p>Todos los departamentos trabajando en conjunto.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services5.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Servicio Digital</h3>
                            <p>Nuestro sitio web es flexible en cualquier dispositivo.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services6.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Sistema RFE</h3>
                            <p>Tenemos sistemas de calidad para el Real Flight Event.</p>
                        </div>
                    </div>
                </div>                                                
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#services-->

    <section id="middle">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 wow fadeInDown">
                    <div class="skill">
                        <h2>Información</h2>
                        <p>Acá nosotros disponemos una corta información, de las estadísticas recolectadas de la división.</p>
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
                        <div class="progress-wrap">
                            <h3>Miembros Activos</h3>
                            <div class="progress">
                              <div class="progress-bar  color1" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="bar-width">+<?php echo $membersact; ?></span>
                              </div>

                            </div>
                        </div>

                        <div class="progress-wrap">
                            <h3>Pilotos</h3>
                            <div class="progress">
                              <div class="progress-bar color2" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentaje; ?>%">
                               <span class="bar-width">+<?php echo  $pcas; ?></span>
                              </div>
                            </div>
                        </div>

                        <div class="progress-wrap">
                            <h3>Controladores</h3>
                            <div class="progress">
                              <div class="progress-bar color3" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentajedos; ?>%">
                                <span class="bar-width">+<?php echo  $atcs; ?></span>
                              </div>
                            </div>
                        </div>

                        <div class="progress-wrap">
                            <h3>Puesto de la División</h3>
                            <div class="progress">
                              <div class="progress-bar color4" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porc; ?>%">
                                <span class="bar-width">+<?php echo $posos; ?></span>
                              </div>
                            </div>
                        </div>
                    </div>

                </div><!--/.col-sm-6-->

                <div class="col-sm-6 wow fadeInDown">
                    <div class="accordion">
                        <h2>IVAO Colombia</h2>
                        <div class="panel-group" id="accordion1">
                          <div class="panel panel-default">
                            <div class="panel-heading active">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne1">
                                  Misión
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>

                            <div id="collapseOne1" class="panel-collapse collapse in">
                              <div class="panel-body">
                                  <div class="media accordion-inner">
                                        <div class="pull-left">
                                            <img class="img-responsive" src="images/accordion1.png">
                                        </div>
                                        <div class="media-body">
                                             <h4>Cuál es?</h4>
                                             <p>Mantener los altos estándares de calidad para controladores aéreos y los pilotos.</p>
                                        </div>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
                                  Visión
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseTwo1" class="panel-collapse collapse">
                              <div class="panel-body">
                                Para el 2020 llegar a ser una de las mejores divisiones a nivel mundial. 
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
                                  Objetivos
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseThree1" class="panel-collapse collapse">
                              <div class="panel-body">
                                <li>Subir el nivel de la división.</li>
								<li>Ayudar a los miembros de la división.</li>
								<li>Promover la creación de aerolíneas.</li>
								<li>Animar a los usuarios a entrenarsen.</li>
							
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
                                  HQ Departamento
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseFour1" class="panel-collapse collapse">
                              <div class="panel-body">
                                El Director de la división IVAO Colombia es:
								<li>Miguel Ángel Ospino</li>
								El Vice Director de la división es:
								<li>Santiago Espitia Ramirez</li>
                              </div>
                            </div>
                          </div>
                        </div><!--/#accordion1-->
                    </div>
                </div>

            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#middle-->

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 wow fadeInDown">
                   <div class="tab-wrap"> 
                        <div class="media">
                            <div class="parrent pull-left">
                                <ul class="nav nav-tabs nav-stacked">
                                    <li class=""><a href="#tab1" data-toggle="tab" class="analistic-01">Historia IVAO</a></li>
                                    <li class="active"><a href="#tab2" data-toggle="tab" class="analistic-02">Objetivo IVAO</a></li>
                                    <li class=""><a href="#tab3" data-toggle="tab" class="tehnical">Colombia</a></li>
                                    <li class=""><a href="#tab4" data-toggle="tab" class="tehnical">IvAc Software</a></li>
                                    <li class=""><a href="#tab5" data-toggle="tab" class="tehnical">IvAp Software</a></li>
                                </ul>
                            </div>

                            <div class="parrent media-body">
                                <div class="tab-content">
                                    <div class="tab-pane fade" id="tab1">
                                        <div class="media">
                                           <div class="pull-left">
                                                <img class="img-responsive" src="images/tab2.png">
                                            </div>
                                            <div class="media-body">
                                                 <h2>INTERNATIONAL VIRTUAL AVIATION ORGANISATION</h2>
                                                 <p>La International Virtual Aviation Organisation (IVAO) nace en 1998 como una organización sin fines de lucros, que se dedica gratuitamente a brindarle servicio a los entusiastas de la aviación. En ella disfrutamos participando del vuelo simulado a lo largo y ancho del mundo, así como también ofrecemos servicio de control de tránsito.</p>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="tab-pane fade active in" id="tab2">
                                        <div class="media">
                                           <div class="pull-left">
                                                <img class="img-responsive" src="images/tab1.png">
                                            </div>
                                            <div class="media-body">
                                                 <h2>INTERNATIONAL VIRTUAL AVIATION ORGANISATION</h2>
                                                 <p>El principal objetivo de IVAO es proporcionar un entorno de calidad y realismo a la comunidad del vuelo simulado, esto incluye un sistema en tiempo real para las operaciones ONLINE, una base de datos con información de aviación, organización de entrenamientos en línea y eventos. </p>
                                            </div>
                                        </div>
                                     </div>

                                     <div class="tab-pane fade" id="tab3">
                                        <p>La republica de Colombia, se encuentra ubicada al noroeste de Suramérica, siendo el único país bañado por dos océanos en este continente, el Atlántico y el Pacifico, posee una superficie de 1.141.748 km², que sumada a la extensión marítima arroja un total de 2.070.408 km², y tiene una población cercana a los 45 millones de habitantes.

El país se caracteriza por ser en su mayoría montañoso, debido a el sistema de cordilleras ubicado en el suroccidente, centro, occidente y nororiente, por el contrario las llanuras se encuentran en el oriente y el norte y el sur caracterizándose este ultimo por ser un lugar selvático y de difícil acceso siendo el transporte aéreo al única herramienta para llegar allí.
                   </div>
                                     
                                     <div class="tab-pane fade" id="tab4">
                                        <p>
El IVAO ATC cliente, conocido como el IvAc, es un programa autónomo desarrollado específicamente para IVAO , basado en los radares reales de Belgocontrol , Eurocontrol y radar Amsterdam, que le permite controlar en la red. <br><a href="https://www.ivao.aero/softdev/ivac.asp#dl">DESCARGAR</a></p>
                                     </div>

                                     <div class="tab-pane fade" id="tab5">
                                        <p>
El piloto de IVAO cliente , conocido como IvAp , es un plug-in que permite a los programas de simulación de vuelo a connenct a la red de IVAO usando los siguientes simuladores :

 <li>Microsoft Flight Simulator 2004/X</li>
 <li>X-Plane 8 /9/10</li>
 <li>Prepar3D</li>
 
<br><a href="https://www.ivao.aero/softdev/ivap.asp">DESCARGAR</a>
 </p>
										</div>
                                </div> <!--/.tab-content-->  
                            </div> <!--/.media-body--> 
                        </div> <!--/.media-->     
                    </div><!--/.tab-wrap-->               
                </div><!--/.col-sm-6-->

                <div class="col-xs-12 col-sm-4 wow fadeInDown">
                    <div class="testimonial">
                        <h2>Opiniones</h2>
                         <div class="media testimonial-inner">
                            <div class="pull-left">
                                <img class="img-responsive img-circle" src="images/testimonials1.png">
                            </div>
                            <div class="media-body">
                                <p>Cada vez, hacemos lo posible para mejorar la división.</p>
                                <span><strong>Miguel Ángel Ospino/</strong> Director de IVAO CO</span>
                            </div>
                         </div>

                         <div class="media testimonial-inner">
                            <div class="pull-left">
                                <img class="img-responsive img-circle" src="images/testimonials1.png">
                            </div>
                            <div class="media-body">
                                <p>Ayudando a mantener y mejorar los estándares de calidad.</p>
                                <span><strong>Santiago Espitia Ramirez/</strong> Vice Director de IVAO CO</span>
                            </div>
                         </div>

                    </div>
                </div>

            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#content-->

    <section id="partner">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Llevando la Aviación a lo más alto!</h2>
                <p class="lead">Cada día el Staff trabajando para obtener los mejores resultados y llegar a ser la mejor división de IVAO.</p>
            </div>    

            <div class="partners">
                <ul>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="images/partners/partner1.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="images/partners/partner2.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" src="images/partners/partner3.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="images/partners/partner4.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="images/partners/partner5.png"></a></li>
                </ul>
            </div>        
        </div><!--/.container-->
    </section><!--/#partner-->

    <section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="pull-left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h2>¿Tienes alguna duda, recomendación u opinión? Cuéntanos!</h2>
                            <p>Por favor, recuerda usar nuestro sistema de mensajería o buzón de mensajes para poder obtener tus mensajes más rápidos y ser efectivos para responder.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->

   
	
	
	  <?php
		
	} else {
		
		?>
		
		
		
		<header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-plane-square"></i>  La mejor división!</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./"><img src="images/logo.png" alt="logo"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="./">Inicio</a></li>
						 <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acerca de Nosotros <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=division">División</a></li>
                                <li><a href="./?page=staff">Staff</a></li>
                                <li><a href="#">Reglamento</a></li>
                                <li><a href="#">HQ Awards</a></li>
                            </ul>
                        </li>
						 <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pilotos <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=registrar">Registrarse</a></li>
                                <li><a href="./?page=pcastep">Primeros Pasos</a></li>
                                <li><a href="./?page=rankpca">Rangos</a></li>
                                <li><a href="./?page=forma">Formación</a></li>
								<li><a href="http://www.aerocivil.gov.co/AIS/AIP/Paginas/Inicio.aspx">Cartas</a></li>
								<li><a href="https://www.ivao.aero/softdev/ivap.asp">IvAp Software</a></li>
                            </ul>
                        </li>
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Controladores <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=registrar">Registrarse</a></li>
								  <li><a href="./?page=atcstep">Primeros Pasos</a></li>
								    <li><a href="./?page=rankatc">Rangos</a></li>
									 <li><a href="./?page=formatc">Formación</a></li>
									  <li><a href="./?page=fra">Lista FRA</a></li>
									   <li><a href="https://mega.nz/#F!mZYzxIAB!M5hD_lr_6tyj4_2yIaiJvg">Sector Files</a></li>
									   <li><a href="https://www.ivao.aero/softdev/ivac.asp">IvAc Software</a></li>
                              
                                
                            </ul>
                        </li>
                       
                        <li><a href="./?page=eventosdeivao">Eventos</a></li>
                        <li><a href="./?page=nuestrasaerolineas">Aerolíneas VA</a></li>
                        <li><a href="./?page=contactenosivao">Contactenos</a></li>     
<li><a href="http://login.ivao.aero/index.php?url=http://www.ivaocol.com.co/usuarios/login.php">LOGIN</a></li>    						
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
		
    </header><!--/header-->
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
 <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>División</h3>
                        <ul>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Soporte</h3>
                        <ul>
                            <li><a href="#">Contactenos</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Nosotros</h3>
                        <ul>
                            <li><a href="#">Staff</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Oficial</h3>
                        <ul>
                            <li><a href="#">IVAO World</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->
    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; <?php echo date('Y'); ?><a target="_blank" href="http://co.ivao.aero" title="IVAO Colombia">IVAO Colombia</a>. Todos Los Derechos Reservados. Desarrollo y Adaptación: Andres Zapata, Andres Giraldo.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="./">Inicio</a></li>
                        <li><a href="./">Acerca de Nosotros</a></li>
                        <li><a href="./">Contactenos</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.prettyPhoto.js"></script>
    <script src="./js/jquery.isotope.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/wow.min.js"></script>
</body>
</html>