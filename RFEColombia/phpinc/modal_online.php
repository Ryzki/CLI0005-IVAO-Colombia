<?php

include("func_mysqlexec.php");
include("func_general.php");

$flightID  = $_REQUEST["id"];

if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
}

global $navdatabase, $rfedatabase, $IVAO_Info, $sqlconn;

$querymodal = "SELECT f.id, f.flightnumber, f.origin, f.destination, IFNULL(DATE_FORMAT(f.deptime, '%H%i'),'----') AS deptime,
               IFNULL(DATE_FORMAT(f.arrtime, '%H%i'),'----') AS arrtime,IFNULL(f.gate,'TBD') AS gate, f.acft, IFNULL(f.route,'TBD') AS route, f.vid, m.name
               FROM rfe_flights AS f
					LEFT JOIN rfe_members AS m ON m.vid = f.vid
					WHERE f.id='".$flightID."'";
$querymodal = mysqlexec($sqlconn,$querymodal);

$onlineData = getOnlineDetails(mysql_result($querymodal,0,'vid'));

change_db($sqlconn,$navdatabase);
$queryorig = "SELECT Latitude,Longtitude FROM airports WHERE ICAO='".$onlineData[11]."'";
$queryorig = mysqlexec($sqlconn,$queryorig);
$querydest = "SELECT Latitude,Longtitude FROM airports WHERE ICAO='".$onlineData[13]."'";
$querydest = mysqlexec($sqlconn,$querydest);
change_db($sqlconn,$rfedatabase);



if ($onlineData["STATUS"] == "offline") {
	$modal .= '
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Pilot is Offline</h3>
	</div>';
	
} else {

// Sim Version
	switch($onlineData[47]) {
		case 0:
			$simVersion = '<span class="label label-primary pull-right">Prepar3D</span>';
			break;
		case 8:
			$simVersion = '<span class="label label-success pull-right">FS2004</span>';
			break;
		case 9:
			$simVersion = '<span class="label label-info pull-right">FSX</span>';
			break;
		case 11:
			$simVersion = '<span class="label label-warning pull-right">X-Plane</span>';
			break;
		default:
			$simVersion = '<span class="label label-muted pull-right">Unknown</span>';
			break;		
	}

// Current aircraft type
	$aircraftInUse = explode("-",$onlineData[9]);
	$aircraftInUse = explode("/",$aircraftInUse[0]);
	$aircraftInUse = $aircraftInUse[1];
	
	
	//print_r($onlineData);
// Planned arrival
	$distFwn = decimal_distance($onlineData[5],$onlineData[6],mysql_result($queryorig,0,'Latitude'),mysql_result($queryorig,0,'Longtitude'));
	$distRem = decimal_distance($onlineData[5],$onlineData[6],mysql_result($querydest,0,'Latitude'),mysql_result($querydest,0,'Longtitude'));
	
	if ($distFwn < 2) {
		if ($onlineData[8] > 0) {
			$remTime = "Taxi Out";
		} else {
			$remTime = "Boarding";
		}
	} else if ($distRem < 2) {
		if ($onlineData[8] > 0) {
			$remTime = "Taxi In";
		} else {
			$remTime = "On Blocks";
		}
	} else {
		$timeRem = $distRem/$onlineData[8];
		$remHours = floor($timeRem);
		$remMinutes = $timeRem-$remHours;
		$remMinutes = round($remMinutes*60);
		$remTime = sprintf("%02.0f",$remHours)."h".sprintf("%02.0f",$remMinutes).' to go';
	}
		

$modal .= '
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>'.$onlineData[0].' <small>'.airlinename($onlineData[0]).'</small></h3>
	</div>
	<div id="modalFlightsbody" class="modal-body">
		<table width="100%" border=0 cellpadding=0>
			<tr>
				<td>Flown by <b>'.mysql_result($querymodal,0,'name').'</b> ('.mysql_result($querymodal,0,'vid').').</td>
				<td>'.$simVersion.'</td>
			</tr>
		</table><br/>
				<table width="100%" border=0 cellpadding=0>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Flight</b></td>
						<td><b>Departure</b></td>
						<td><b>Arrival</b></td>
					</tr>
					<tr height="40px">
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.$onlineData[0].'</span></td>
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.$onlineData[11].'</span></td>
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.$onlineData[13].'</span></td>
					</tr>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Aircraft</b></td>
						<td><b>EOBT</b></td>
						<td><b>Planned Arrival Time</b></td>
					</tr>
					<tr height="40px">
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.$aircraftInUse.'</span></td>
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.sprintf("%04.0f",$onlineData[22]).'z</span>
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.$remTime.'</span>
					</tr>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Current Altitude</b></td>
						<td><b>Current GS</b></td>
						<td><b>Squawk</b></td>
					</tr>
					<tr height="40px">
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.$onlineData[7].' ft</span></td>
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.$onlineData[8].' kt</span></td>
						<td style="vertical-align: middle;"><span style="font-size: 20px;">'.$onlineData[17].'</span></td>
					</tr>
					<tr style="border-bottom: 1px solid #444">
						<td colspan="3"><b>Filled Route</b></td>
					</tr>
					<tr height="40px">
						<td style="vertical-align: middle;" colspan="3">'.$onlineData[30].'</td>
					</tr>
				</table><br/>
		</div>';

}

echo $modal;

?>