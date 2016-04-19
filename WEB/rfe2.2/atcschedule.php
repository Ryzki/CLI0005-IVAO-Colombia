<?php
set_time_limit(0);
include("phpinc/func_mysqlexec.php");
include("phpinc/func_general.php");

// Test for rfe_config
configexists();

if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
}

$query = "SELECT DISTINCT position FROM rfe_atc";
$query = mysqlexec($sqlconn,$query);
$queryn = mysql_num_rows($query);
for ($i=0;$i<$queryn;$i++) {
	$atcpositions[] =  mysql_result($query,$i,'position');
}

$querysel = "SELECT apticao,aptname FROM rfe_config";
$querysel = mysqlexec($sqlconn,$querysel);
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
				<title>RFE <?php echo mysql_result($querysel,0,"aptname"); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">


        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'> 

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
        <!-- Le fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.html">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.html">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.html">
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.html">
        <link rel="shortcut icon" href="ico/favicon.html">

    </head>

    <body>

        <!--################ NAVIGATION START ################-->

        <div class="navbar-wrapper" >
            <div class="navbar navbar-static-top navbar-inverse" id="navigation">
						<div class="navbar-inner">
							<div class="container">
								<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="brand" href="./">  <img src="phpinc/generatelogo.php" id="logokhan"></a>
<?php        		include("phpinc/menu.inc.php"); ?>
							</div>
						</div>
					</div>
				</div>


        <!--################ NAVIGATION END ################-->

        <!--################ WRAP START ################-->

        <div id="wrap">

            <!--################ HEADER START ################-->

            <header class="page-title">
                <div class="container">
                    <h2>ATC Schedule</h2>
                </div>
            </header>

            <section class="services-page">
						  <div class="container">
							
							<table align="center" class="table">
								<thead>
								<tr>
									<th></th>
<?php
									change_db($sqlconn,$rfedatabase);
									$query = "SELECT timestart,timeend FROM rfe_config";
									$query = mysqlexec($sqlconn,$query);
									$start = substr(mysql_result($query,0,'timestart'),0,2);
									$end   = substr(mysql_result($query,0,'timeend'),0,2);
									
									for ($i=$start;$i<$end+1;$i++) {
										$j = $i+1;
										echo "<th><center>". sprintf('%02.0f',$i) ."Z-". sprintf('%02.0f',$j) ."Z</center></th>";
									}
?> 
								</tr>
								</thead>
								<tbody>
<?php
							foreach ($atcpositions as $position) {
?>
								<tr><th><center><?php echo $position; ?></center></th>
<?php
								change_db($sqlconn,$rfedatabase);
								$query = "SELECT timestart,timeend FROM rfe_config";
								$query = mysqlexec($sqlconn,$query);
								$start = substr(mysql_result($query,0,'timestart'),0,2);
								$end   = substr(mysql_result($query,0,'timeend'),0,2);
								
								for ($i=$start;$i<$end+1;$i++) {
									if ($i >= 24) {
										$timestart = $i-24;
									} else {
										$timestart = $i;
									}
									
									$timeend = $timestart+1;

									change_db($sqlconn,$rfedatabase);
									$query = "SELECT vid,name FROM rfe_atc WHERE timestart = '".$timestart.":00:00' AND timeend = '".$timeend.":00:00' AND position = '".$position."'";
									$query = mysqlexec($sqlconn,$query);
									$vid = @mysql_result($query,0,"vid");
									
									if (!empty($vid)) {
?>
									<td style="background-color: #dff0d8;"><center><a href="http://www.ivao.aero/members/person/details.asp?ID=<?php echo $vid; ?>" target="_blank" style="color: black;" title="<?php echo mysql_result($query,0,"name"); ?>"><?php echo $vid; ?></a></center></td>
<?php
									} else {
?>
									<td>&nbsp;</td>
<?php
									}
								}
							}
?>
							</tbody>
							</table>
							</div>
            </section>   

        </div>

        <!--################ PUSH WILL KEEP THE FOOTER AT BOTTOM IF YOU WANT TO CREATE OTHER PAGES ################-->
				



		<!--################ FOOTER START ################-->

		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="span3">
						<img src="images/logo.png" >
						<p>Brought to you by IVAO-US.</p>
						<p class="copyright">
							© <?php echo gmdate("Y"); ?> IVAO United States
						</p>
					</div>

					<div class="span4">
						<h1><i class="icon-facebook"></i></h1>
						<p><a href="http://www.facebook.com/ivaousa">Find us on Facebook</a>.</p>
					</div>


				</div>
			</div>

		</footer>


		<!--################ FOOTER END ################-->




        <!--################ JAVASCRIPTS ################-->


        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/modernizr.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.fitvids.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/twitter.js"></script>

        <script src="js/stellar.js"></script>
        <script src="js/nicescroll.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox-thumbs0ff5.js?v=1.0.2"></script>
        <script type="text/javascript" src="js/jquery.fancybox-mediae209.js?v=1.0.0"></script>
        <script src="js/jquery.flexslider.js"></script>
        <script src="js/retina.js"></script>
        <script src="js/custom.js"></script>

<script>
		function removePosition(id,accordid) {
			$("#"+accordid).hide();
			$("#"+accordid).html('');
			$.ajax({
				type    : "GET",
				url     : "registerflt.php",
				dataType: "html",
				contentType: 'application/x-www-form-urlencoded',
				beforeSend: function(jqXHR) {
					jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
				},
				data    : { s: "unbook", id: id, },
			}).done(function (result) {
				window.location.reload();
			});
		};
</script>

 </body>

</html>