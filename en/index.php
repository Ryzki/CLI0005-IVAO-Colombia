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
  <script type="text/javascript"> 
  
  function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

					   function display_ct() {
var strcount
var x = new Date()
var x1=x.toUTCString();// changing the display to UTC string
document.getElementById('ct').innerHTML = x1;
tt=display_c();
}
</script>
<body class="homepage" onload=display_ct();>

	<?php
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
		?>

		
    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-plane-square"></i>  The best division!</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
					 

<font color="white"><span id='ct' ></span></font>
                            <ul class="social-share">
                                <li><a href="https://www.facebook.com/ivaoco/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCOUr_AMGqcMu2JZwSCzWPQA"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="https://twitter.com/ivaoco"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/ivaocolombia/"><i class="fa fa-instagram"></i></a></li>
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
                        <li class="active"><a href="./">Home</a></li>
						 <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=division">Division</a></li>
                                <li><a href="./?page=staff">Staff</a></li>
                                <li><a href="#">Rules</a></li>
                                <li><a href="#">HQ Awards</a></li>
                            </ul>
                        </li>
						 <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pilots <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=registrar">Registration</a></li>
                                <li><a href="./?page=pcastep">First Steps</a></li>
                                <li><a href="./?page=rankpca">Ranks</a></li>
                                <li><a href="./?page=forma">Training</a></li>
								<li><a href="http://www.aerocivil.gov.co/AIS/AIP/Paginas/Inicio.aspx">Charts</a></li>
								<li><a href="https://www.ivao.aero/softdev/ivap.asp">IvAp Software</a></li>
                            </ul>
                        </li>
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Controllers <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=registrar">Registration</a></li>
								  <li><a href="./?page=atcstep">First Steps</a></li>
								    <li><a href="./?page=rankatc">Ranks</a></li>
									 <li><a href="./?page=formatc">Training</a></li>
									  <li><a href="./?page=fra">List FRA</a></li>
									   <li><a href="https://mega.nz/#F!mZYzxIAB!M5hD_lr_6tyj4_2yIaiJvg">Sector Files</a></li>
									   <li><a href="https://www.ivao.aero/softdev/ivac.asp">IvAc Software</a></li>
                              
                                
                            </ul>
                        </li>
                       
                        <li><a href="./?page=eventosdeivao">Events</a></li>
                        <li><a href="./?page=nuestrasaerolineas">Airlines VA</a></li>
                       <li><a href="./?page=contactenosivao">Contact Us</a></li>  
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
					 <?
		 
		 include('./db_login.php');
		  
$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
		  
	$sql2377aa = "SELECT * FROM airlines order by id asc";

if (!$result2377aa = $db->query($sql2377aa)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
$vassa = 2;

	while ($row2377aa = $result2377aa->fetch_assoc()) {
	

		 
		 $vassa++;


  

	
	?>
                <li data-target="#main-slider" data-slide-to="<?php echo $vassa; ?>"></li>
	<?php } ?>
				
            </ol>
            <div class="carousel-inner">

                <div class="item active" style="background-image: url(images/slider/bg1.jpg)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Would you like to be a virtual air controller?</h1>
                                    <h2 class="animation animated-item-2">IVAO Colombia offers this oportunity to you of enjoying the experience of being a controller!</h2>
                                    <a class="btn-slide animation animated-item-3" href="./?page=registrar">Sign Up!</a>
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
                                    <h1 class="animation animated-item-1">Would you like to be a virtual pilot?</h1>
                                    <h2 class="animation animated-item-2">IVAO Colombia offers the oportunity to you of enjoying the experience of being a Pilot!</h2>
                                    <a class="btn-slide animation animated-item-3" href="./?page=registrar">Sign Up!</a>
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
				<!--- AEROLINEAS VIRTUALES PUBLICIDAD -->
                <div class="item" style="background-image: url(../admin/intranet/imagenair/<?php echo $row2377a["imagen_va"]; ?>)">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1">Airline <span> <?php echo $row2377a["nombre_aerolinea"]; ?></span></h1>
                                    <h2 class="animation animated-item-2">Certified for IVAO World</h2>
                                    <a class="btn-slide animation animated-item-3" href="<?php echo $row2377a["web"]; ?>">See</a>
                                </div>
                            </div>
                            
							
                        </div>
                    </div>
                </div><!--/.item-->
				
			<?php } ?> 	
				
				
				
				
				
				
				
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
                <p class="lead">This division waits up for the quality in the air activities made in the IVAO System. <br> That's why, we give the next functions to our members.</p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-bullhorn"></i>
                            <h2>Promote Events</h2>
                            <h3>Our members through of the system will be able to be aware about the next events.</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-comments"></i>
                            <h2>Inbox</h2>
                            <h3>Our members will be able to contact us through the system.</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-cloud-download"></i>
                            <h2>Training</h2>
                            <h3>Our system has a good and full training place for the members.</h3>
                        </div>
                    </div><!--/.col-md-4-->
                
                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-leaf"></i>
                            <h2>Profile</h2>
                            <h3>Our unique system gives you the option to edit your profile.</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-cogs"></i>
                            <h2>Conectivity</h2>
                            <h3>Our services are conected indirect and directly with IVAO.</h3>
                        </div>
                    </div><!--/.col-md-4-->

                    <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <i class="fa fa-plane"></i>
                            <h2>Schedules</h2>
                            <h3>The quality is not improvised, as a result of that, we have ATC and RFE System.</h3>
                        </div>
                    </div><!--/.col-md-4-->
                </div><!--/.services-->
            </div><!--/.row-->    
        </div><!--/.container-->
    </section><!--/#feature-->

    <section id="recent-works">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Online</h2>
                <p class="lead">Active Members at the moment! <script>
var meses = new Array ("January","February","March","April","May","June","July","August","September","October","November","December");
var f=new Date();
document.write(f.getDate() + " of " + meses[f.getMonth()] + " of " + f.getFullYear());
</script><br> Pilots, Controllers and Staff.</p>
            </div>

            <div class="row">
                <?php include('onlines.php'); ?>
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#recent-works-->

    <section id="services" class="service-item">
	   <div class="container">
            <div class="center wow fadeInDown">
                <h2>Quality and Efficiency</h2>
                <p class="lead">IVAO Colombia has an administrative place for the Staff <br> It has the next benefits that are offer for the members.</p>
            </div>

            <div class="row">

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services1.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Private Statistics</h3>
                            <p>We have information about the members that visit the website.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services2.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Timing Events</h3>
                            <p>The Events are shown according to the schedule.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services3.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Maintenance System</h3>
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
                            <h3 class="media-heading">Innovative Ideas</h3>
                            <p>The departaments are working together.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services5.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Digital Service</h3>
                            <p>Our website is flexible on any device.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services6.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">RFE System</h3>
                            <p>We have Quality's System for the Real Flight Event.</p>
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
                        <h2>Information</h2>
                        <p>Here we have a short information collected statistics of the IVAO Colombia division.</p>
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
                            <h3>Active Members</h3>
                            <div class="progress">
                              <div class="progress-bar  color1" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="bar-width">+<?php echo $membersact; ?></span>
                              </div>

                            </div>
                        </div>

                        <div class="progress-wrap">
                            <h3>Pilots</h3>
                            <div class="progress">
                              <div class="progress-bar color2" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentaje; ?>%">
                               <span class="bar-width">+<?php echo  $pcas; ?></span>
                              </div>
                            </div>
                        </div>

                        <div class="progress-wrap">
                            <h3>Controllers</h3>
                            <div class="progress">
                              <div class="progress-bar color3" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $porcentajedos; ?>%">
                                <span class="bar-width">+<?php echo  $atcs; ?></span>
                              </div>
                            </div>
                        </div>

                        <div class="progress-wrap">
                            <h3>Division's Place</h3>
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
                                  Mission
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
                                             <h4>What is it?</h4>
                                             <p>Keeping the high quality standars for air controllers and pilots.</p>
                                        </div>
                                  </div>
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwo1">
                                  Vission
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseTwo1" class="panel-collapse collapse">
                              <div class="panel-body">
                                By 2020 We will have become one of the best divisions worldwide. 
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseThree1">
                                  Goals
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseThree1" class="panel-collapse collapse">
                              <div class="panel-body">
                                <li>Improve the division's level.</li>
								<li>Help the division's members.</li>
								<li>Promote the creation of airlines.</li>
								<li>Cheer the members up to get training.</li>
							
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h3 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseFour1">
                                  HQ Department
                                  <i class="fa fa-angle-right pull-right"></i>
                                </a>
                              </h3>
                            </div>
                            <div id="collapseFour1" class="panel-collapse collapse">
                              <div class="panel-body">
                                The Director of Colombia IVAO division is:
								<li>Miguel Ángel Ospino</li>
								The Vice Director of Colombia IVAO division is:
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
                                    <li class=""><a href="#tab1" data-toggle="tab" class="analistic-01">IVAO History</a></li>
                                    <li class="active"><a href="#tab2" data-toggle="tab" class="analistic-02">IVAO Objective</a></li>
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
                                                 <p>The International Virtual Aviation Organisation (IVAO) was created in 1998 as a nonprofit organization dedicated to give free service to aviation enthusiasts. You can enjoy participating in simulated flight across the world, as well as provide traffic control service.</p>
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
                                                 <p>The main objective of IVAO is to provide a quality environment and the community realism of the simulated flight , this includes a real-time system for operations ONLINE , a database with information about aviation training organization and events online. </p>
                                            </div>
                                        </div>
                                     </div>

                                     <div class="tab-pane fade" id="tab3">
                                        <p>
The Republic of Colombia , is located northwest of South America , the only country washed by two oceans on this continent , the Atlantic and the Pacific , has an area of 1,141,748 square kilometers , which added to the maritime area for a total of 2,070,408 square kilometers and has a population of about 45 million.

The country is characterized by mostly mountainous, due to the ridge system located in southwestern , central, western and northeastern regions , however the plains are in the east and north and south characterized the latter being a sylvan place and inaccessible air transport being the only tool to get there.
                   </div>
                                     
                                     <div class="tab-pane fade" id="tab4">
                                        <p>
The IVAO ATC client, known as the Pro Controller is an autonomous program developed specifically for IVAO , based on real radars of Belgocontrol , Eurocontrol and Amsterdam Radar , which lets you control the network.
 <br><a href="https://www.ivao.aero/softdev/ivac.asp#dl">DOWNLOAD</a></p>
                                     </div>

                                     <div class="tab-pane fade" id="tab5">
                                        <p>IVAO pilot client IvAp known as , is a plug -in that allows programs to connenct flight simulation network of IVAO using the following simulators:

 <li>Microsoft Flight Simulator 2004/X</li>
 <li>X-Plane 8 /9/10</li>
 <li>Prepar3D</li>
 
<br><a href="https://www.ivao.aero/softdev/ivap.asp">DOWNLOAD</a>
 </p>
										</div>
                                </div> <!--/.tab-content-->  
                            </div> <!--/.media-body--> 
                        </div> <!--/.media-->     
                    </div><!--/.tab-wrap-->               
                </div><!--/.col-sm-6-->

                <div class="col-xs-12 col-sm-4 wow fadeInDown">
                    <div class="testimonial">
                        <h2>Opinions</h2>
                         <div class="media testimonial-inner">
                            <div class="pull-left">
                                <img class="img-responsive img-circle" src="images/testimonials1.png">
                            </div>
                            <div class="media-body">
                                <p>Every Day, We make all the possible thing to improve the division.</p>
                                <span><strong>Miguel Ángel Ospino/</strong> Director of IVAO CO</span>
                            </div>
                         </div>

                         <div class="media testimonial-inner">
                            <div class="pull-left">
                                <img class="img-responsive img-circle" src="images/testimonials1.png">
                            </div>
                            <div class="media-body">
                                <p>Helping to keep and improve the quality standars.</p>
                                <span><strong>Santiago Espitia Ramirez/</strong> Vice Director of IVAO CO</span>
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
                <h2>Aviation leading to the top!</h2>
                <p class="lead">Staff working every day to get the best results and become the best division of IVAO.</p>
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
                            <h2>Do you have any questions, recommendation or opinion? Tell us! </h2>
                            <p>Please remember to use our messaging system or mailbox to get your messages faster and be effective to respond.</p>
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
                        <div class="top-number"><p><i class="fa fa-plane-square"></i>  The best Division!</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
					
                       <div class="social">
					   <font color="white"><span id='ct' ></span></font>
                            <ul class="social-share">
                                <li><a href="https://www.facebook.com/ivaoco/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCOUr_AMGqcMu2JZwSCzWPQA"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="https://twitter.com/ivaoco"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://www.instagram.com/ivaocolombia/"><i class="fa fa-instagram"></i></a></li>
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
                        <li class="active"><a href="./">Home</a></li>
						 <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=division">Division</a></li>
                                <li><a href="./?page=staff">Staff</a></li>
                                <li><a href="#">Rules</a></li>
                                <li><a href="#">HQ Awards</a></li>
                            </ul>
                        </li>
						 <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pilots <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=registrar">Registration</a></li>
                                <li><a href="./?page=pcastep">First Steps</a></li>
                                <li><a href="./?page=rankpca">Ranks</a></li>
                                <li><a href="./?page=forma">Training</a></li>
								<li><a href="http://www.aerocivil.gov.co/AIS/AIP/Paginas/Inicio.aspx">Charts</a></li>
								<li><a href="https://www.ivao.aero/softdev/ivap.asp">IvAp Software</a></li>
                            </ul>
                        </li>
						<li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Controllers <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="./?page=registrar">Registration</a></li>
								  <li><a href="./?page=atcstep">First Steps</a></li>
								    <li><a href="./?page=rankatc">Ranks</a></li>
									 <li><a href="./?page=formatc">Training</a></li>
									  <li><a href="./?page=fra">List FRA</a></li>
									   <li><a href="https://mega.nz/#F!mZYzxIAB!M5hD_lr_6tyj4_2yIaiJvg">Sector Files</a></li>
									   <li><a href="https://www.ivao.aero/softdev/ivac.asp">IvAc Software</a></li>
                              
                                
                            </ul>
                        </li>
                       
                        <li><a href="./?page=eventosdeivao">Events</a></li>
                        <li><a href="./?page=nuestrasaerolineas">Airlines VA</a></li>
                      <li><a href="./?page=contactenosivao">Contact Us</a></li>
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
                        <h3>Division</h3>
                        <ul>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Support</h3>
                        <ul>
                            <li><a href="./?page=contactenosivao">Contact Us</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>We</h3>
                        <ul>
                            <li><a href="./?page=staff">Staff</a></li>
                        </ul>
                    </div>    
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Official</h3>
                        <ul>
                            <li><a href="https://www.ivao.aero/">IVAO World</a></li>
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
                    &copy; <?php echo date('Y'); ?>  <a target="_blank" href="http://co.ivao.aero" title="IVAO Colombia">IVAO Colombia</a>. All rights reserved. Development and Adaptation: Andres Zapata, Andres Giraldo.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="./">Home</a></li>
                        <li><a href="./?page=division">About Us</a></li>
                     <li><a href="./?page=contactenosivao">Contact Us</a></li> 
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