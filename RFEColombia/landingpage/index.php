<?php
include("../phpinc/func_mysqlexec.php");
include("../phpinc/func_general.php");

$querysel = "SELECT status,aptname, DATE_FORMAT(datestart,'%d %M %Y') AS eventdate, DATE_FORMAT(timestart,'%H:%i:%s') AS eventtime FROM rfe_config";
$querysel = mysqlexec($sqlconn,$querysel);

$status = mysql_result($querysel,0,'status');

if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
}

if (!empty($IVAO_Info->vid)) {

	$query = "SELECT * FROM rfe_admins WHERE vid = ".$IVAO_Info->vid;
	$query = mysqlexec($sqlconn,$query);
	
	if (($status != 1) AND (mysql_num_rows($query)!=0)) {
		header('Location: ../');
	}
	
} else {

	if ($status == 1) {
		header('Location: ../');
	}

}
/*if ($status == 1) {
	header('Location: ../');
}*/

/*
//if the token is set in the link
if($_GET['IVAOTOKEN'] && $_GET['IVAOTOKEN'] !== 'error') {
	setcookie(cookie_name, $_GET['IVAOTOKEN'], time()+3600);
	header('Location: '.url);
	exit;
} elseif($_GET['IVAOTOKEN'] == 'error') {
	die('This domain is not allowed to use the Login API! Contact the System Administrator!');
}

if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
}*/

// Check if the user is admin
$query = "SELECT vid FROM rfe_admins WHERE vid='".$IVAO_Info->vid."'";
$query = mysqlexec($sqlconn,$query);

if(mysql_num_rows($query) > 0) {
	$is_admin = true;
}

$is_admin = (mysql_num_rows($query) > 0 ? true : false);

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8"/>
	<title>RFE <?php echo mysql_result($querysel,0,'aptname'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content=""/>
	<meta name="keywords" content=""/>
	<meta name="description" content=""/>
	<link href='http://fonts.googleapis.com/css?family=Yellowtail|Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/styles.css"/>
	<link rel="stylesheet" href="fonts/css/fontello.css">

	<style>
		body {background: #444;}
	</style>
	<!--[if IE 7]>
		<script type='text/javascript' src="js/jquery.fitvids.js"></script>
	<![endif]-->
</head>

<body>
	<div id="container" class="container">
		<div id="shadow" class="shadow"></div>
		<div id="overlay" class="overlay"></div>
<?php
		if ($status == 0) {
?>
		<div class="md-modal md-effect-12" id="modal-1">
			<div class="md-content">
				<div class="head">
					<span>About the Event</span>
				</div>
				<div>
					<p>An RFE (<b>R</b>eal <b>F</b>light <b>E</b>vent) is an event where the real world airline schedules of an airport are followed during the time of event by all the participants..</p>
					<p>Many airlines fly inside <?php echo mysql_result($querysel,0,'aptname'); ?> daily. So, by participating of the event, you'll have the opportunity to see different airlines on the airport.</p>
					<p>During the event, all ATC positions possible are staffed to provide ATC service to the pilots.</p>
					<p>Every IVAO member can join in the event by making his/her flight. So, the RFE is an opportunity to meet new people from different cultures.</p>
				</div>
				<button class="md-close"><span class="icon-cancel"></span></button>
			</div>
		</div>
		<div class="md-modal md-effect-12" id="modal-2">
			<div class="md-content">
				<div class="head">
					<span>Airport Video</span>
				</div>
				<div>
					<center><iframe width="640" height="400" src="//www.youtube.com/embed/videoseries?list=PLAmSpVDwromPyj8A5KeLUNVxDfHCG2nE7" frameborder="0" allowfullscreen></iframe></center>
				</div>
				<button class="md-close"><span class="icon-cancel"></span></button>
			</div>
		</div>
<?php
		}
?>
		<div class="md-overlay"></div>
		<div class="wrapper">
			<div class="header">
				<div class="logo">
					<img src="../images/divlogo/divlogo@140px.png"/><br/>
					<span>RFE <?php echo mysql_result($querysel,0,'aptname'); ?></span>
				</div>
				<div class="desc">
<?php
					if ($status == 0) {
?>
					<h1>We'll release the booking system as soon as possible! Stay tuned!</h1>
<?php
					} else if ($status == -1) {
?>
					<h1>Thanks a lot for your participation! Stay tuned for next events in our division!</h1>
					<br>
					<h1><a href="http://www.ivaous.org">ivaous.org</a></h1>
<?php
					}
?>
				</div>
			</div><!-- End Header -->
<?php
		if ($status == 0) {
?>
			<div id="countdown">
				<div class="count"><span class="days">02</span><p class="timeRefDays">days</p></div>
				<div class="count"><span class="hours">00</span><p class="timeRefHours">hours</p></div>
				<div class="count"><span class="minutes">00</span><p class="timeRefMinutes">minutes</p></div>
				<div class="count last"><span class="seconds">00</span><p class="timeRefSeconds">seconds</p></div>
			</div>
			<div class="more-info"><center>
				<button class="md-trigger" data-modal="modal-1" original-title="About the Event"><span class="icon-user"></span></button>
				<button class="md-trigger" data-modal="modal-2" original-title="Airport Video"><span class="icon-video"></span></button>
				</center>
			</div>
<?php
		}
?>
		</div><!-- End Wrapper -->
		
<?php
		if (isset($IVAO_Info)) {
			if ($is_admin) {
				if ($status == 0) {
?>
					<div style="position: absolute; top: 98%; left: 93.5%; font-size: 10px;"><a href="#" onClick="openBookings();">Open bookings</a></div>
<?php
				} else if ($status == -1) {
?>
					<div style="position: absolute; top: 98%; left: 93.5%; font-size: 10px;"><a href="#" onClick="toCountdown();">To countdown</a></div>
<?php
				}
			}
		} else {
?>
			<div style="position: absolute; top: 98%; left: 97%; font-size: 10px;"><a href="<?php echo login_url; ?>?url=<?php echo url; ?>">Admin</a></div>
<?php
		}
?>
	</div><!-- End Container -->

	<script type="text/javascript">
		var ambient_value = '#630175'; <!-- ambient color-->
		var diffuse_value = '#948E00'; <!-- diffuse color-->
	</script>

	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type='text/javascript' src="js/countdown.js"></script>
	<script type='text/javascript' src="js/classie.js"></script>
	<script type='text/javascript' src="js/main.js"></script>
	<script type='text/javascript' src="js/modalEffects.js"></script>
	<script type='text/javascript' src="js/modernizr.custom.js"></script>
	<script type='text/javascript' src="js/jquery.tipsy.js"></script>
	<script type='text/javascript' src="js/main.js"></script>
	<script type='text/javascript' src="js/jquery.easing.min.js"></script>
	<script type='text/javascript' src="js/supersized.3.2.7.min.js"></script>
	<script type="text/javascript">
		jQuery(function($){
			$.supersized({
				slide_interval :4000, // Length between transitions
				transition : 1, // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
				transition_speed : 1000, // Speed of transition
				slide_links : 'blank', // Individual links for each slide (Options: false, 'num', 'name', 'blank')
				slides : [ 
					{image : 'images/1.jpg', title : '', thumb : '', url : '#'},
					{image : 'images/2.jpg', title : '', thumb : '', url : '#'},
					{image : 'images/3.jpg', title : '', thumb : '', url : '#'},
					{image : 'images/4.jpg', title : '', thumb : '', url : '#'},
					{image : 'images/5.jpg', title : '', thumb : '', url : '#'},
					{image : 'images/6.jpg', title : '', thumb : '', url : '#'},
					{image : 'images/7.jpg', title : '', thumb : '', url : '#'},
					{image : 'images/8.jpg', title : '', thumb : '', url : '#'}
					]
			});
			
	$("#countdown").countdown({
		date: "<?php echo mysql_result($querysel,0,'eventdate')." ".mysql_result($querysel,0,'eventtime'); ?>", // Change this to your desired date to countdown to
		format: "on"
	});
	
		});
		
		function openBookings() {
			$.ajax({
				type    : "GET",
				url     : "../phpinc/ajax_openbook.php",
				dataType: "html",
				contentType: 'application/x-www-form-urlencoded',
				beforeSend: function(jqXHR) {
					jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
				},
				data    : { act: "open" },
			}).done(function (result) {
				window.location.reload(true);
			});
		}
		
		function toCountdown() {
			$.ajax({
				type    : "GET",
				url     : "../phpinc/ajax_openbook.php",
				dataType: "html",
				contentType: 'application/x-www-form-urlencoded',
				beforeSend: function(jqXHR) {
					jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
				},
				data    : { act: "count" },
			}).done(function (result) {
				window.location.reload(true);
			});
		}
	</script>
</body>

</html>