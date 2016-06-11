
<!DOCTYPE html>
<html lang="en">
    
<head>
	<meta charset="utf-8">
	<title>RFE System | Install</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<meta http-equiv="Cache-control" content="no-cache">
	<meta http-equiv="Expires" content="-1">

	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>

	<!--Le HTML5 shim, for IE6-8 support of HTML5 elements--> 
	<!--[if lt IE 9]>
	<script src="../http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- Le styles -->
	<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="../css/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="../css/jquery.fancybox.css" media="all" />
	<link rel="stylesheet" type="text/css" href="../css/jquery.fancybox-thumbs0ff5.css?v=1.0.2" />
	<link href="../css/animate.css" rel="stylesheet" type="text/css" />
	<link href="../css/isotope.css" rel="stylesheet" type="text/css" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<link href="../css/style-responsive.css" rel="stylesheet" type="text/css" />
	<link href="../css/myown.css" rel="stylesheet" type="text/css" />
	
	<style>
		html, body {
			height: 100%;
			overflow: hidden;
		}
		.services-page {
			min-height: 100%;
			height: auto !important;
			height: 100%;
		}
		.row {
			width: 100%;
			position: absolute;
			top: 40px;
			bottom: 0;
		}
		.steps {
			position: absolute;
			top: 0;
			bottom: 0;
			width: 20%;
			padding: 5px 5px;
			background-color: #EEE;
			border: 1px solid #CCC;
		}
		.steps h4 {
			margin-left: 10px;
		}
		.steps ol li.active {
			color: #C00;
		}
		.text {
			position: absolute;
			top: 0;
			bottom: 0;
			margin-left: 25%;
		}
		
		.text button {
			position: relative;
			left: 120%;
		}
	</style>
	
</head>

<body>

	<div class="navbar-wrapper">
		<div class="navbar navbar-fixed-top navbar-inverse" id="navigation">
			<div class="navbar-inner">
				<div class="container">
					<a class="brand" style="color:white;margin-top:3px">IVAO-US | RFE System</a>
				</div>
			</div>
		</div>
	</div>

	<section class="services-page">
		<div class="row">
<?php
	if (empty($_GET["s"])) {
		require("install1.php");
	} else {
		require("install".$_GET["s"].".php");
	}
?>
		</div>
	</section>

	<script src="../js/jquery.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<script src="../js/modernizr.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/jquery.fitvids.js"></script>
	<script src="../js/jquery.easing.1.3.js"></script>
	<script src="../js/twitter.js"></script>

	<script src="../js/stellar.js"></script>
	<script src="../js/nicescroll.min.js"></script>
	<script src="../js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="../js/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="../js/jquery.fancybox-thumbs0ff5.js?v=1.0.2"></script>
	<script type="text/javascript" src="../js/jquery.fancybox-mediae209.js?v=1.0.0"></script>
	<script src="../js/jquery.flexslider.js"></script>
	<script src="../js/retina.js"></script>
	<script src="../js/custom.js"></script>
	<script src="../ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="../js/rfe.functions.js"></script>

</body>

</html>