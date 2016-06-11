<!DOCTYPE html>
<html lang="en">
    
<head>
	<meta charset="utf-8">
	<title>RFE <?php echo mysql_result($querysel,0,"aptname"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Expires" content="-1">

	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>

	<!--Le HTML5 shim, for IE6-8 support of HTML5 elements--> 
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- Le styles -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css" media="all" />
	<link rel="stylesheet" type="text/css" href="css/jquery.fancybox-thumbs0ff5.css?v=1.0.2" />
	<link href="css/animate.css" rel="stylesheet" type="text/css" />
	<link href="css/isotope.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/style-responsive.css" rel="stylesheet" type="text/css" />
	<link href="css/myown.css" rel="stylesheet" type="text/css" />
	
	
</head>

<body>

<!--################ NAVIGATION START ################-->

	<div class="navbar-wrapper" >

	<?php if(strpos($_SERVER["PHP_SELF"],'index.php')) { ?>
		<div class="navbar navbar-fixed-top" id="navigation">
	<?php } else { ?>
		<div class="navbar navbar-fixed-top navbar-inverse" id="navigation">
	<?php } ?>

			<div class="navbar-inner">
				<div class="container">
					<a class="brand" href="./" id="rfelogo"><!--<img src="images/divlogo.png" width='15' height='12'>--><img src="phpinc/generatelogo.php"></a>
					<?php include("menu.inc.php"); ?>
				</div>
			</div>
		</div>
	</div>


        <!--################ NAVIGATION END ################-->
