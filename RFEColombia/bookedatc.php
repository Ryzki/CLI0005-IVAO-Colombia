<?php
set_time_limit(0);
include("phpinc/func_mysqlexec.php");
include("phpinc/func_general.php");

// Test for rfe_config
configexists();

if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
} else {
	header('Location: .');
}

$query = "SELECT id FROM rfe_atc WHERE vid='".$IVAO_Info->vid."'";
$query = mysqlexec($sqlconn,$query);
$queryn = mysql_num_rows($query);

if($queryn == 0) {
	header('Location: .');
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
								<a class="brand" href="./">  <img src="images/logo.png" id="logokhan"></a>
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
                    <h2>Mis posiciones ATC reservadas</h2>
                </div>
            </header>

            <section class="services-page">
						  <div class="container">
							
							<div id="ajaxinfo"></div>
							
<?php
				change_db($sqlconn,$rfedatabase);
				$query = "SELECT id FROM rfe_atc WHERE vid='".$IVAO_Info->vid."'";
				$query = mysqlexec($sqlconn,$query);
				if(mysql_num_rows($query) > 0) {
?>
								<div class="accordion" id="accordion2">
<?php			
									$query = "SELECT id,position,freq,timestart,timeend,vid,name,
														IF( SUBTIME( timestart , '6:0' ) <0,
														ADDTIME( timestart , '18:0' ),
														SUBTIME( timestart , '6:0' ) ) AS timestart2
														FROM rfe_atc WHERE vid='".$IVAO_Info->vid."'
														ORDER BY timestart2";
									$query = mysqlexec($sqlconn,$query);
									$queryn = mysql_num_rows($query);
							
									for ($i=0;$i<$queryn;$i++) {
											$id = mysql_result($query,$i,'id');
?>
									<div class="accordion-group" id="accordflt<?php echo $id; ?>">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $i; ?>">
												<?php echo mysql_result($query,$i,"position")." | ".substr(str_replace(':','',mysql_result($query,$i,'timestart')),0,4)."Z - ".substr(str_replace(':','',mysql_result($query,$i,'timeend')),0,4)."Z"; ?>
											</a>
										</div>
										<div id="collapse<?php echo $i; ?>" class="accordion-body collapse">
											<div class="accordion-inner">
<?php
						echo '<table width="100%" border=0 cellpadding=0>
						<tr style="border-bottom: 1px solid #444">
							<td><b>Position</b></td>
							<td><b>Frequency</b></td>
						</tr>
						<tr height="60px">
							<td style="vertical-align: middle;"><span style="font-size: 30px;">'.mysql_result($query,$i,'position').'</span><br/></td>
							<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;">'.mysql_result($query,$i,'freq').'</span></td>
						</tr>
						<tr style="border-bottom: 1px solid #444">
							<td><b>Start Time</b></td>
							<td><b>End Time</b></td>
						</tr>
						<tr height="60px">
							<td style="vertical-align: middle;"><span style="font-size: 30px;">'.substr(str_replace(':','',mysql_result($query,$i,'timestart')),0,4).'</span><br/><span style="font-size: 10px;">ZULU</span></td>
							<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;">'.substr(str_replace(':','',mysql_result($query,$i,'timeend')),0,4).'</span><br/><span style="font-size: 10px;">ZULU</span></td>
						</tr>
					</table><br/>'
?>
											</div>
										</div>
									</div>
<?php
									}
?>
								</div>
<?php
				}
?>
              </div>
            </section>   

        </div>

        <!--################ PUSH WILL KEEP THE FOOTER AT BOTTOM IF YOU WANT TO CREATE OTHER PAGES ################-->

        <div id="push"></div>


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

 </body>

</html>