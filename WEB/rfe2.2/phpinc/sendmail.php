<?php
/*========================================================================
(C) 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Send confirmation mails for bookings.
   Author: Filipe Fonseca    13/06/2014
Revisions:
========================================================================*/
include("func_mysqlexec.php");
include("func_general.php");

// Get Information of the Flight from the Database
$queryconfig = "SELECT division,aptname,sendermail FROM rfe_config";
$queryconfig = mysqlexec($sqlconn,$queryconfig);

// Send e-mail to pilot.
$sender = mysql_result($queryconfig,0,"sendermail");

// Base URL for e-mail messages
$baseuri = explode("/",$_SERVER['SCRIPT_NAME']);
array_pop($baseuri);	array_pop($baseuri);
$baseuri = "http://".$_SERVER['SERVER_NAME'].implode("/",$baseuri);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$sender."\r\n";

if ($_REQUEST["action"] == "bookdone") {

	// Get Information of the Flight from the Database
	$querymodal = "SELECT f.id, f.flightnumber, f.origin, f.destination, IFNULL(DATE_FORMAT(f.deptime, '%H%i'),'----') AS deptime,
						IFNULL(DATE_FORMAT(f.arrtime, '%H%i'),'----') AS arrtime, IFNULL(f.gate,'TBD') AS gate, f.acft, IFNULL(f.route,'TBD') AS route, f.vid, m.name, m.email
						FROM rfe_flights AS f
						LEFT JOIN rfe_members AS m ON m.vid = f.vid
						WHERE f.id='".$_REQUEST["id"]."'";
	$querymodal = mysqlexec($sqlconn,$querymodal);
	
	$subject = "RFE ".mysql_result($queryconfig,0,'aptname')." - Regular Booking Confirmation";
	$email   = mysql_result($querymodal,0,'email');
	
	$validationkey = crypt(mysql_result($querymodal,0,"id").mysql_result($querymodal,0,"flightnumber").mysql_result($querymodal,0,"vid"),'$1$IVAOUS$');
	$validationkey = str_replace("/","",substr($validationkey,10,strlen($validationkey)));
	$validationkey = str_replace(".","",$validationkey);
	
	if (empty($email)) {
		exit();
	}

	// Get Information of the Departure and Arrival airports from the Database
	change_db($sqlconn,$navdatabase);
	$queryorig  = "SELECT Name FROM airports WHERE ICAO='".mysql_result($querymodal,0,"origin")."'";
	$queryorig  = mysqlexec($sqlconn,$queryorig);
	$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($querymodal,0,"destination")."'";
	$querydest = mysqlexec($sqlconn,$querydest);
	change_db($sqlconn,$rfedatabase);

	$msg='<!DOCTYPE html>
	<html>
		<head>
			<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400" rel="stylesheet" type="text/css">
			<style>
				* {font-family: "Lato", sans-serif; margin: 5px auto;}
				h1,h3 {font-weight: 300;} h2 {font-weight: 500;}
				table.main {width: 600px; border:1px solid darkgray;padding: 10px;background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(0,0,0,0.04) 100%),linear-gradient(to bottom, rgba(255,255,255,0.85) 0%,rgba(255,255,255,0.85) 100%),0% 0%/40% no-repeat url('.$baseuri.'/images/divlogo/divlogo@940px.png),linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.6) 100%),50% 50%/180% no-repeat url('.$baseuri.'/images/divlogo/divlogo@940px.png); box-shadow: 0px 0px 20px darkgray;}
				table.flight {margin: 25px 0 25px 0;}
				p {margin: 10 0;text-align: justify;} p.end{margin: 30px 0 0 0;text-align: right;} p.foot{margin: 30px 0 0 0;font-size: 13px; color: rgba(0,0,0,0.3);}
			</style>
		</head>
		<body>
			<table class="main" border="0" cellpadding="0" cellspacing="0" width="500px">
				<tr>
					<td width=160>
						<img src="'.$baseuri.'/images/divlogo/divlogo@140px.png">
					</td>
					<td>
						<h1>IVAO '.mysql_result($queryconfig,0,'division').'</h1>
						<h2>RFE '.mysql_result($queryconfig,0,'aptname').'</h2>
						<h3>Booking System</h3>
					</td>
				</tr>
				<tr>
					<td colspan=2>
						<p>Dear <strong>'.substr(mysql_result($querymodal,0,"name"),0,strpos(mysql_result($querymodal,0,"name")," ")).'</strong>,</p><p>we\'re sending this e-mail to you in order to <strong>confirm</strong> the <strong>intention</strong> of reservation of the detailed flight below:</p>

						<table class="flight" width="100%" border=0 cellpadding=0 cellspacing=0>
							<tr>
								<td style="border-bottom: 1px solid #444"><b>Flight</b></td>
								<td style="border-bottom: 1px solid #444"><b>Departure</b></td>
								<td style="border-bottom: 1px solid #444"><b>Arrival</b></td>
							</tr>
							<tr height="60px">
								<td style="vertical-align: middle;"><span style="font-size: 30px;">'.mysql_result($querymodal,0,'flightnumber').'</span><br/><span style="font-size: 10px;">'.airlinename(mysql_result($querymodal,0,'flightnumber')).'</span></td>
								<td style="vertical-align: middle;"><span style="font-size: 30px;"><img style="vertical-align: middle;" src="'.getCountry(mysql_result($querymodal,0,'origin'),'norm','48','full').'"> '.mysql_result($querymodal,0,'origin').'</span><br/><span style="font-size: 10px;">'. mysql_result($queryorig,0,'Name').'</span>
								<td style="vertical-align: middle;"><span style="font-size: 30px;"><img style="vertical-align: middle;" src="'.getCountry(mysql_result($querymodal,0,'destination'),'norm','48','full').'"> '.mysql_result($querymodal,0,'destination').'</span><br/><span style="font-size: 10px;">'. mysql_result($querydest,0,'Name').'</span>
							</tr>
							<tr style="border-bottom: 1px solid #444">
								<td style="border-bottom: 1px solid #444"><b>Aircraft</b></td>
								<td style="border-bottom: 1px solid #444"><b>Departure Time</b></td>
								<td style="border-bottom: 1px solid #444"><b>Arrival Time</b></td>
							</tr>
							<tr height="60px">
								<td style="vertical-align: middle;"><span style="font-size: 30px;">'.aircraftname(mysql_result($querymodal,0,'acft')).'</span><br/><span style="font-size: 10px;">'.aircraftname(mysql_result($querymodal,0,'acft'),"name").'</span></td>
								<td style="vertical-align: middle;"><span style="font-size: 30px;">';
								
								if (mysql_result($querymodal,0,'deptime')!="----") {
									$msg .= mysql_result($querymodal,0,'deptime'); 
								} else {
									$msg .= '<span style="color: red;">'.timeOperation(mysql_result($querymodal,0,'arrtime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"diff").'</span>';
								}
								
								$msg .= '</span><br/><span style="font-size: 10px;">';
								
								if (mysql_result($querymodal,0,'deptime')!="----") {
									$msg .= "ZULU"; 
								} else {
									$msg .= '<span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span>';
								}
								
								$msg .= '</span></td><td style="vertical-align: middle;"><span style="font-size: 30px;">';
								
								if (mysql_result($querymodal,0,'arrtime')!="----") {
									$msg .= mysql_result($querymodal,0,'arrtime'); 
								} else {
									$msg .= '<span style="color: red;">'.timeOperation(mysql_result($querymodal,0,'deptime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"add").'</span>';
								}
								
								$msg .= '</span><br/><span style="font-size: 10px;">';
								
								if (mysql_result($querymodal,0,'arrtime')!="----") {
									$msg .= "ZULU"; 
								} else {
									$msg .= '<span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span>';
								}
								
								$msg .='</span></td>
							</tr>
							<tr style="border-bottom: 1px solid #444">
								<td style="border-bottom: 1px solid #444"><b>Gate</b></td>
								<td style="border-bottom: 1px solid #444" colspan="2"><b>Route</b> <span style="font-size: 12px;">(extracted from FlightAware - double-check it)</span></td>
							</tr>
							<tr height="50px">
								<td style="vertical-align: middle;"><span style="font-size: 30px; font-weight: bold;background-color: #F2EF30; padding: 0 10px;">'.mysql_result($querymodal,0,'gate').'</span></td>
								<td style="vertical-align: middle;" colspan=2><span style="font-size: 15px;">'.mysql_result($querymodal,0,'route').'</span></td>
							</tr>
						</table>
										
						<p style="color: #443a00; border: 1px solid #443a00; background-color: rgba(234,232,130,0.6); padding: 10px 10px 10px 10px;">If you do have intention to fly it, please <strong>confirm</strong>, by clicking <a href="'.$baseuri.'/validate?k='.mysql_result($querymodal,0,'id').'.'.$validationkey.'">HERE</a>.</p>
						<p style="color: #440000; border: 1px solid #440000; background-color: rgba(234,130,130,0.6); padding: 10px 10px 10px 10px;">If you <strong>don\'t</strong> have intention to fly it, please <strong>cancel</strong> your booking ASAP via the form in the event\'s website in order to release the slot to another pilot.</p>
						<p>Thank you very much for your interest in our event!</p>
						<p class="end">Yours truly,<br><br><strong>IVAO '.mysql_result($queryconfig,0,'division').'</strong><br/>Event Department</p>
						<p class="foot">This is an automatic e-mail. Do not reply it. If you think you received this mail as a mistake, disregard it and delete from your computer, smartphone etc. In case of any doubt, contact one of our staff members.</p>
						
					</td>
				</tr>
			</table>
		</body>
	</html>';
	
	echo "BOOKING MAIL SENT";

} if ($_REQUEST["action"] == "privatedone") {

	// Get Information of the Flight from the Database
	$querymodal = "SELECT p.id, p.flightnumber, p.origin, p.destination, IFNULL(DATE_FORMAT(p.slottime, '%H%i'),'----') AS slottime, p.acft,
                  IFNULL(p.route,'Not informed') AS route, p.vid, m.name, m.email
                  FROM rfe_privatependent AS p
					   LEFT JOIN rfe_members AS m ON m.vid = p.vid
						WHERE p.id='".$_REQUEST["id"]."'";
	$querymodal = mysqlexec($sqlconn,$querymodal);
	$queryapt = "SELECT apticao FROM rfe_config";
	$queryapt = mysqlexec($sqlconn,$queryapt);
	
	$subject = "RFE ".mysql_result($queryconfig,0,'aptname')." - Private Booking Confirmation";
	$email   = mysql_result($querymodal,0,'email');

	if (mysql_result($querymodal,0,'origin') == mysql_result($queryapt,0,'apticao')) {
		$movement = "dep";
	} else if (mysql_result($querymodal,0,'destination') == mysql_result($queryapt,0,'apticao')) {
		$movement = "arr";
	} else {
		$movement = "unk";
	}

	// Get Information of the Departure and Arrival airports from the Database
	change_db($sqlconn,$navdatabase);
	$queryorig  = "SELECT Name FROM airports WHERE ICAO='".mysql_result($querymodal,0,"origin")."'";
	$queryorig  = mysqlexec($sqlconn,$queryorig);
	$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($querymodal,0,"destination")."'";
	$querydest = mysqlexec($sqlconn,$querydest);
	change_db($sqlconn,$rfedatabase);

	$msg='<!DOCTYPE html>
	<html>
		<head>
			<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400" rel="stylesheet" type="text/css">
			<style>
				* {font-family: "Lato", sans-serif; margin: 5px auto;}
				h1,h3 {font-weight: 300;} h2 {font-weight: 500;}
				table.main {width: 600px; border:1px solid darkgray;padding: 10px;background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(0,0,0,0.04) 100%),linear-gradient(to bottom, rgba(255,255,255,0.85) 0%,rgba(255,255,255,0.85) 100%),0% 0%/40% no-repeat url('.$baseuri.'/images/divlogo/divlogo@940px.png),linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.6) 100%),50% 50%/180% no-repeat url('.$baseuri.'/images/divlogo/divlogo@940px.png); box-shadow: 0px 0px 20px darkgray;}
				table.flight {margin: 25px 0 25px 0;}
				p {margin: 10 0;text-align: justify;} p.end{margin: 30px 0 0 0;text-align: right;} p.foot{margin: 30px 0 0 0;font-size: 13px; color: rgba(0,0,0,0.3);}
			</style>
		</head>
		<body>
			<table class="main" border="0" cellpadding="0" cellspacing="0" width="500px">
				<tr>
					<td width=160>					
						<img src="'.$baseuri.'/images/divlogo/divlogo@140px.png">
					</td>
					<td>
						<h1>IVAO '.mysql_result($queryconfig,0,'division').'</h1>
						<h2>RFE '.mysql_result($queryconfig,0,'aptname').'</h2>
						<h3>Booking System</h3>
					</td>
				</tr>
				<tr>
					<td colspan=2>
						<p>Dear <strong>'.substr(mysql_result($querymodal,0,"name"),0,strpos(mysql_result($querymodal,0,"name")," ")).'</strong>,</p><p>we\'re sending this e-mail to you to <strong>confirm</strong> the reservation of your requested <strong>private slot</strong>, as detailed below:</p>

						<table class="flight" width="100%" border=0 cellpadding=0 cellspacing=0>
							<tr>
								<td style="border-bottom: 1px solid #444"><b>Flight</b></td>
								<td style="border-bottom: 1px solid #444"><b>Departure</b></td>
								<td style="border-bottom: 1px solid #444"><b>Arrival</b></td>
							</tr>
							<tr height="60px">
								<td style="vertical-align: middle;"><span style="font-size: 30px;">'.mysql_result($querymodal,0,'flightnumber').'</span></td>
								<td style="vertical-align: middle;"><span style="font-size: 30px;"><img style="vertical-align: middle;" src="'.getCountry(mysql_result($querymodal,0,'origin'),'norm','48','full').'"> '.mysql_result($querymodal,0,'origin').'</span><br/><span style="font-size: 10px;">'. mysql_result($queryorig,0,'Name').'</span>
								<td style="vertical-align: middle;"><span style="font-size: 30px;"><img style="vertical-align: middle;" src="'.getCountry(mysql_result($querymodal,0,'destination'),'norm','48','full').'"> '.mysql_result($querymodal,0,'destination').'</span><br/><span style="font-size: 10px;">'. mysql_result($querydest,0,'Name').'</span>
							</tr>
							<tr style="border-bottom: 1px solid #444">
								<td style="border-bottom: 1px solid #444"><b>Aircraft</b></td>
								<td style="border-bottom: 1px solid #444"><b>Departure Time</b></td>
								<td style="border-bottom: 1px solid #444"><b>Arrival Time</b></td>
							</tr>
							<tr height="60px">
								<td style="vertical-align: middle;"><span style="font-size: 30px;">'.aircraftname(mysql_result($querymodal,0,'acft')).'</span><br/><span style="font-size: 10px;">'.aircraftname(mysql_result($querymodal,0,'acft'),"name").'</span></td>
								<td style="vertical-align: middle;"><span style="font-size: 30px;">';
								
								if ($movement == "dep") {
									$msg .= mysql_result($querymodal,0,'slottime'); 
								} else {
									$msg .= '<span style="color: red;">'.timeOperation(mysql_result($querymodal,0,'slottime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"diff").'</span>';
								}
								
								$msg .= '</span><br/><span style="font-size: 10px;">';
								
								if ($movement == "dep") {
									$msg .= "ZULU"; 
								} else {
									$msg .= '<span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span>';
								}
								
								$msg .= '</span></td><td style="vertical-align: middle;"><span style="font-size: 30px;">';
								
								if ($movement == "arr") {
									$msg .= mysql_result($querymodal,0,'slottime'); 
								} else {
									$msg .= '<span style="color: red;">'.timeOperation(mysql_result($querymodal,0,'slottime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"add").'</span>';
								}
								
								$msg .= '</span><br/><span style="font-size: 10px;">';
								
								if ($movement == "arr") {
									$msg .= "ZULU"; 
								} else {
									$msg .= '<span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span>';
								}
								
								$msg .='</span></td>
							</tr>
							<tr style="border-bottom: 1px solid #444">
								<td style="border-bottom: 1px solid #444"><b>Gate</b></td>
								<td style="border-bottom: 1px solid #444" colspan="2"><b>Route</b> <span style="font-size: 12px;">(extracted from FlightAware - double-check it)</span></td>
							</tr>
							<tr height="50px">
								<td style="vertical-align: middle;"><span style="font-size: 30px; font-weight: bold;background-color: #F2EF30; padding: 0 10px;">TBD</span></td>
								<td style="vertical-align: middle;" colspan=2><span style="font-size: 15px;">'.mysql_result($querymodal,0,'route').'</span></td>
							</tr>
						</table>
										
						<p>If you don\'t have intention to fly, please <strong>cancel</strong> your reservation ASAP via the form in the event\'s website in order to release the slot to another pilot.</p>
						<p>Thank you very much for your interest in our event!</p>
						<p class="end">Yours truly,<br><br><strong>IVAO '.mysql_result($queryconfig,0,'division').'</strong><br/>Event Department</p>
						<p class="foot">This is an automatic e-mail. Do not reply it. If you think you received this mail as a mistake, disregard it and delete from your computer, smartphone etc. In case of any doubt, contact one of our staff members.</p>
						
					</td>
				</tr>
			</table>
		</body>
	</html>';

} else if ($_REQUEST["action"] == "freemsg") {

	$subject = $_REQUEST["subject"];

	// Get Information of the Flight from the Database
	$querymember = "SELECT m.name, m.email	FROM rfe_privatependent AS pp
						LEFT JOIN rfe_members AS m ON m.vid = pp.vid
						WHERE pp.id='".$_REQUEST["id"]."'";
	$querymember = mysqlexec($sqlconn,$querymember);
	$email = mysql_result($querymember,0,"email");

	$msg='<!DOCTYPE html>
	<html>
		<head>
			<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400" rel="stylesheet" type="text/css">
			<style>
				* {font-family: "Lato", sans-serif; margin: 5px auto;}
				h1,h3 {font-weight: 300;} h2 {font-weight: 500;}
				table.main {width: 600px; border:1px solid darkgray;padding: 10px;background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(0,0,0,0.04) 100%),linear-gradient(to bottom, rgba(255,255,255,0.85) 0%,rgba(255,255,255,0.85) 100%),0% 0%/40% no-repeat url('.$baseuri.'/images/divlogo/divlogo@940px.png),linear-gradient(to bottom, rgba(255,255,255,0.6) 0%,rgba(255,255,255,0.6) 100%),50% 50%/180% no-repeat url('.$baseuri.'/images/divlogo/divlogo@940px.png); box-shadow: 0px 0px 20px darkgray;}
				table.flight {margin: 25px 0 25px 0;}
				p {margin: 10 0;text-align: justify;} p.end{margin: 30px 0 0 0;text-align: right;} p.foot{margin: 30px 0 0 0;font-size: 13px; color: rgba(0,0,0,0.3);}
			</style>
		</head>
		<body>
			<table class="main" border="0" cellpadding="0" cellspacing="0" width="500px">
				<tr>
					<td width=160>
						<img src="'.$baseuri.'/images/divlogo/divlogo@140px.png">
					</td>
					<td>
						<h1>IVAO '.mysql_result($queryconfig,0,'division').'</h1>
						<h2>RFE '.mysql_result($queryconfig,0,'aptname').'</h2>
						<h3>Booking System</h3>
					</td>
				</tr>
				<tr>
					<td colspan=2>
						<p>Dear <strong>'.substr(mysql_result($querymember,0,"name"),0,strpos(mysql_result($querymember,0,"name")," ")).'</strong>,</p>
						
						'.$_REQUEST["body"].'
						
						<p class="end">Yours truly,<br><br><strong>IVAO '.mysql_result($queryconfig,0,'division').'</strong><br/>Event Department</p>
						<p class="foot">This is an automatic e-mail. Do not reply it. If you think you received this mail as a mistake, disregard it and delete from your computer, smartphone etc. In case of any doubt, contact one of our staff members.</p>
						
					</td>
				</tr>
			</table>
		</body>
	</html>';

}

//echo $subject."<br>";
//echo $msg;

if (isset($_REQUEST["action"])) {
	//echo $email."<br>".$subject."<br>".$msg."<br>".$headers;
	//echo $msg;
	mail($email, $subject, $msg, $headers);
}
?>
