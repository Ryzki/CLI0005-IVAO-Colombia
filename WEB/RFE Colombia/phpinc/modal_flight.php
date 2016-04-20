<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal showing the flight's details.
   Author: Filipe Fonseca    13/06/2014
Revisions: Filipe Fonseca    17/08/2015
========================================================================*/
// INCLUDES
include("func_mysqlexec.php");
include("func_general.php");

// EXTERNAL VARIABLES
$flightID  = $_REQUEST["id"];

// If the cookie is existent, get the Info Array with details of the user.
if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
}

// GLOBAL VARIABLES
global $navdatabase, $rfedatabase, $IVAO_Info, $sqlconn;

// Get Information of the Flight from the Database
$querymodal = "SELECT f.id, f.flightnumber, f.radiocallsign, f.origin, f.destination, IFNULL(DATE_FORMAT(f.deptime, '%H%i'),'----') AS deptime,
               IFNULL(DATE_FORMAT(f.arrtime, '%H%i'),'----') AS arrtime, IFNULL(f.gate,'TBD') AS gate, f.acft, IFNULL(f.route,'TBD') AS route, f.vid, f.bookingstatus, m.name, m.ratingpilot, m.division, m.privacy
               FROM rfe_flights AS f
					LEFT JOIN rfe_members AS m ON m.vid = f.vid
					WHERE f.id='".$flightID."'";
$querymodal = mysqlexec($sqlconn,$querymodal);

// Get Information of the Departure and Arrival airports from the Database
change_db($sqlconn,$navdatabase);
$queryorig  = "SELECT Name,Latitude,Longtitude FROM airports WHERE ICAO='".mysql_result($querymodal,0,"origin")."'";
$queryorig  = mysqlexec($sqlconn,$queryorig);
$querydest = "SELECT Name,Latitude,Longtitude FROM airports WHERE ICAO='".mysql_result($querymodal,0,"destination")."'";
$querydest = mysqlexec($sqlconn,$querydest);
change_db($sqlconn,$rfedatabase);
$gcddistance = round(decimal_distance(mysql_result($queryorig,0,'Latitude'),mysql_result($queryorig,0,'Longtitude'),mysql_result($querydest,0,'Latitude'),mysql_result($querydest,0,'Longtitude')));

// Get radio callsign configuration
$querycall = "SELECT useradiocallsign FROM rfe_config";
$querycall = mysqlexec($sqlconn,$querycall);
$radiocall  = mysql_result($querycall, 0, 'useradiocallsign');

// Check if the airline has a logo and gets it.
if (file_exists("../logos/".substr(mysql_result($querymodal,0,'flightnumber'),0,3).".gif")) {
	$logo = '<img src="logos/'.substr(mysql_result($querymodal,0,'flightnumber'),0,3).'.gif"/> ';
} else {
	$logo = '';
}	
?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?php echo $logo; ?>Flight <?php echo substr(mysql_result($querymodal,0,'flightnumber'),3,strlen(mysql_result($querymodal,0,'flightnumber'))); ?></h3>
	</div>
	<div id="modalFlightsbody" class="modal-body">
		<form class="form-vertical form-modal">
			<fieldset>
				<table width="100%" border=0 cellpadding=0>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Flight</b></td>
						<td><b>Departure</b></td>
						<td><b>Arrival</b></td>
					</tr>
					<tr height="60px">
						<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php if ($radiocall) { if (is_null(mysql_result($querymodal,0,'radiocallsign'))) { echo mysql_result($querymodal,0,'flightnumber'); } else { echo mysql_result($querymodal,0,'radiocallsign'); } } else {echo mysql_result($querymodal,0,'flightnumber');  } ?></span><br/><span style="font-size: 10px;"><?php if ($radiocall) { if (is_null(mysql_result($querymodal,0,'radiocallsign'))) { echo airlinename(mysql_result($querymodal,0,'flightnumber')); } else { echo airlinename(mysql_result($querymodal,0,'radiocallsign')); } } else { echo airlinename(mysql_result($querymodal,0,'flightnumber')); } ?></span></td>
						<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($querymodal,0,'origin'))." ".mysql_result($querymodal,0,'origin'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($queryorig,0,'Name'); ?></span>
						<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($querymodal,0,'destination'))." ".mysql_result($querymodal,0,'destination'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($querydest,0,'Name'); ?></span>
					</tr>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Aircraft</b> <a href="http://www.airliners.net/search/photo.search?q=<?php echo str_ireplace(" ","+",aircraftname(mysql_result($querymodal,0,'acft'))); ?>+<?php echo str_ireplace(" ","+",airlinename(mysql_result($querymodal,0,'flightnumber'),"name")); ?>" target="_blank" style="color: #333;" onMouseOver="this.style.color='#ee5f5b'" onMouseOut="this.style.color='#333'"><i class="fa fa-camera" title="Click here to see pictures of this aircraft"></i></a></td>
						<td><b>Departure Time</b></td>
						<td><b>Arrival Time</b></td>
					</tr>
					<tr height="60px">
						<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo aircraftname(mysql_result($querymodal,0,'acft')); ?></span><br/><span style="font-size: 10px;"><?php echo aircraftname(mysql_result($querymodal,0,'acft'),"name"); ?></span></td>
						<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if (mysql_result($querymodal,0,'deptime')!="----") { echo mysql_result($querymodal,0,'deptime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($querymodal,0,'arrtime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"diff"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if (mysql_result($querymodal,0,'deptime')!="----") { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span></td>
						<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if (mysql_result($querymodal,0,'arrtime')!="----") { echo mysql_result($querymodal,0,'arrtime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($querymodal,0,'deptime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"add"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if (mysql_result($querymodal,0,'arrtime')!="----") { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span></td>
					</tr>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Gate</b></td>
						<td colspan="2"><b>Route</b> <span style="font-size: 12px;">(extracted from FlightAware - double-check it)</span></td>
					</tr>
					<tr height="50px">
					<?php if(strpos(mysql_result($querymodal,0,'gate')," ") === FALSE) { ?>
						<td style="vertical-align: middle;"><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-plane" title="Gate"></i> <?php echo mysql_result($querymodal,0,'gate'); ?></span></td>
					<?php } else { ?>
						<td style="vertical-align: middle;"><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-building-o" title="Terminal"></i> <?php echo ( strpos(mysql_result($querymodal,0,'gate')," ") ? ( substr(mysql_result($querymodal,0,'gate'),0,strpos(mysql_result($querymodal,0,'gate')," "))) : mysql_result($querymodal,0,'gate')); ?></span><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-plane" title="Gate"></i> <?php echo ( strpos(mysql_result($querymodal,0,'gate')," ") ? (substr(mysql_result($querymodal,0,'gate'),strpos(mysql_result($querymodal,0,'gate')," "),strlen(mysql_result($querymodal,0,'gate')))) : "TBD"); ?></span></td>
					<?php } ?>
						<td style="vertical-align: middle;" colspan=2><span style="font-size: 15px;"><?php echo mysql_result($querymodal,0,'route'); ?></span></td>
					</tr>
				</table><br/>
				
<?php
				$query = "SELECT timestart,timeend,timezone,TIME_TO_SEC(TIMEDIFF(timeend,timestart)) AS timediff FROM rfe_config";
				$query = mysqlexec($sqlconn,$query);
				$ts = mysql_result($query,0,"timestart");
				$te = mysql_result($query,0,"timeend");
				$tz = mysql_result($query,0,"timezone");
				$td = mysql_result($query,0,"timediff");
				if ($td > 0) {
					$timeclauseturnover = "AND (arrtime >= '".$ts."' AND arrtime <= '".$te."')";
				} else if ($td < 0) {
					$timeclauseturnover = "AND (arrtime >= '".$ts."' OR arrtime <= '".$te."')";
				} else if ($td == 0) {
					$timeclauseturnover = "";
				}
				
				$queryturnover = "SELECT turnover
										FROM rfe_flights
										WHERE flightnumber = '".mysql_result($querymodal,0,"flightnumber")."'";
				$queryturnover = mysqlexec($sqlconn,$queryturnover);
				$turnover = mysql_result($queryturnover,0,'turnover');
				
				if (empty($turnover)) {
					$queryturnover = "SELECT id, flightnumber, acft, origin, destination, IFNULL(DATE_FORMAT(deptime, '%H%i'),'----') AS deptime,
											IFNULL(DATE_FORMAT(arrtime, '%H%i'),'----') AS arrtime, IFNULL(gate,'TBD') AS gate, IFNULL(route,'TBD') AS route, vid
											FROM rfe_flights
											WHERE destination='".mysql_result($querymodal,0,"origin")."'
											AND origin='".mysql_result($querymodal,0,"destination")."'
											".$timeclauseturnover."
											AND (flightnumber LIKE '".substr(mysql_result($querymodal,0,"flightnumber"),0,3)."".((int)substr(mysql_result($querymodal,0,"flightnumber"),3,strlen(mysql_result($querymodal,0,"flightnumber")))+1) ."' OR flightnumber LIKE '".substr(mysql_result($querymodal,0,"flightnumber"),0,3)."".((int)substr(mysql_result($querymodal,0,"flightnumber"),3,strlen(mysql_result($querymodal,0,"flightnumber")))-1) ."')";
					$queryturnover = mysqlexec($sqlconn,$queryturnover);
					$turnover = mysql_num_rows($queryturnover);
				
					if ($turnover == 0) {
						if ($td > 0) {
							$timeclauseturnover = "AND (deptime >= '".$ts."' AND deptime <= '".$te."')";
						} else if ($td < 0) {
							$timeclauseturnover = "AND (deptime >= '".$ts."' OR deptime <= '".$te."')";
						} else if ($td == 0) {
							$timeclauseturnover = "";
						}
						$queryturnover = "SELECT id, flightnumber, acft, origin, destination, IFNULL(DATE_FORMAT(deptime, '%H%i'),'----') AS deptime,
												IFNULL(arrtime,'----') AS arrtime, IFNULL(gate,'TBD') AS gate, IFNULL(route,'TBD') AS route, vid
												FROM rfe_flights
												WHERE destination='".mysql_result($querymodal,0,"origin")."'
												AND origin='".mysql_result($querymodal,0,"destination")."'
												".$timeclauseturnover."
												AND (flightnumber LIKE '".substr(mysql_result($querymodal,0,"flightnumber"),0,3)."".((int)substr(mysql_result($querymodal,0,"flightnumber"),3,strlen(mysql_result($querymodal,0,"flightnumber")))+1) ."' OR flightnumber LIKE '".substr(mysql_result($querymodal,0,"flightnumber"),0,3)."".((int)substr(mysql_result($querymodal,0,"flightnumber"),3,strlen(mysql_result($querymodal,0,"flightnumber")))-1) ."')";
						$queryturnover = mysqlexec($sqlconn,$queryturnover);
						$turnover = mysql_num_rows($queryturnover);
					}
				} else {
					$queryturnover = "SELECT id, flightnumber, acft, origin, destination, IFNULL(DATE_FORMAT(deptime, '%H%i'),'----') AS deptime,
											IFNULL(DATE_FORMAT(arrtime, '%H%i'),'----') AS arrtime, IFNULL(gate,'TBD') AS gate, IFNULL(route,'TBD') AS route, vid
											FROM rfe_flights
					                  WHERE id = '".mysql_result($queryturnover,0,"turnover")."'";
					$queryturnover = mysqlexec($sqlconn,$queryturnover);
				}
				
				
				if (($turnover <> 0) AND (!empty($turnover))) {
					// Get Information of the Departure and Arrival airports from the Database
					change_db($sqlconn,$navdatabase);
					$queryorig  = "SELECT Name FROM airports WHERE ICAO='".mysql_result($queryturnover,0,"origin")."'";
					$queryorig  = mysqlexec($sqlconn,$queryorig);
					$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($queryturnover,0,"destination")."'";
					$querydest = mysqlexec($sqlconn,$querydest);
					change_db($sqlconn,$rfedatabase);
					
					if (is_null(mysql_result($queryturnover,0,'vid'))) {
						$bgcolor = 'green';
						$bgtext  = '<b>available</b>';
					} else {
						$bgcolor = 'darkred';
						$bgtext  = 'booked by <b>'.mysql_result($queryturnover,0,'vid').'</b>';
					}
?>
					<div class="accordion" id="accordion2">
						<div class="accordion-group" id="accordfltturnover">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseturnover" style="background-color: <?php echo $bgcolor; ?>;color: white;">
									Click to see the turnover flight (<?php echo $bgtext; ?>)
								</a>
							</div>
							<div id="collapseturnover" class="accordion-body collapse">
								<div class="accordion-inner">

									<table width="100%" border=0 cellpadding=0>
										<tr style="border-bottom: 1px solid #444">
											<td><b>Flight</b></td>
											<td><b>Departure</b></td>
											<td><b>Arrival</b></td>
										</tr>
										<tr height="60px">
											<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo mysql_result($queryturnover,0,'flightnumber'); ?></span><br/><span style="font-size: 10px;"><?php echo airlinename(mysql_result($queryturnover,0,'flightnumber')); ?></span></td>
											<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($queryturnover,0,'origin'))." ".mysql_result($queryturnover,0,'origin'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($queryorig,0,'Name'); ?></span>
											<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($queryturnover,0,'destination'))." ".mysql_result($queryturnover,0,'destination'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($querydest,0,'Name'); ?></span>
										</tr>
										<tr style="border-bottom: 1px solid #444">
											<td><b>Aircraft</b> <a href="http://www.airliners.net/search/photo.search?q=<?php echo str_ireplace(" ","+",aircraftname(mysql_result($queryturnover,0,'acft'))); ?>+<?php echo str_ireplace(" ","+",airlinename(mysql_result($queryturnover,0,'flightnumber'),"name")); ?>" target="_blank" style="color: #333;" onMouseOver="this.style.color='#ee5f5b'" onMouseOut="this.style.color='#333'"><i class="fa fa-camera" title="Click here to see pictures of this aircraft"></i></a></td>
											<td><b>Departure Time</b></td>
											<td><b>Arrival Time</b></td>
										</tr>
										<tr height="60px">
											<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo aircraftname(mysql_result($queryturnover,0,'acft')); ?></span><br/><span style="font-size: 10px;"><?php echo aircraftname(mysql_result($queryturnover,0,'acft'),"name"); ?></span></td>
											<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if (mysql_result($queryturnover,0,'deptime')!="----") { echo mysql_result($queryturnover,0,'deptime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($queryturnover,0,'arrtime'),flighttime(mysql_result($queryturnover,0,'origin'),mysql_result($queryturnover,0,'destination'),mysql_result($queryturnover,0,'acft')),"diff"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if (mysql_result($queryturnover,0,'deptime')!="----") { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span></td>
											<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if (mysql_result($queryturnover,0,'arrtime')!="----") { echo mysql_result($queryturnover,0,'arrtime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($queryturnover,0,'deptime'),flighttime(mysql_result($queryturnover,0,'origin'),mysql_result($queryturnover,0,'destination'),mysql_result($queryturnover,0,'acft')),"add"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if (mysql_result($queryturnover,0,'arrtime')!="----") { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span></td>
										</tr>
										<tr style="border-bottom: 1px solid #444">
											<td><b>Gate</b></td>
											<td colspan="2"><b>Route</b> <span style="font-size: 12px;">(extracted from FlightAware - double-check it)</span></td>
										</tr>
										<tr height="50px">
										<?php if(strpos(mysql_result($queryturnover,0,'gate')," ") === FALSE) { ?>
											<td style="vertical-align: middle;"><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-plane" title="Gate"></i> <?php echo mysql_result($queryturnover,0,'gate'); ?></span></td>
										<?php } else { ?>
											<td style="vertical-align: middle;"><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-building-o" title="Terminal"></i> <?php echo ( strpos(mysql_result($queryturnover,0,'gate')," ") ? ( substr(mysql_result($queryturnover,0,'gate'),0,strpos(mysql_result($queryturnover,0,'gate')," "))) : mysql_result($queryturnover,0,'gate')); ?></span><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-plane" title="Gate"></i> <?php echo ( strpos(mysql_result($queryturnover,0,'gate')," ") ? (substr(mysql_result($queryturnover,0,'gate'),strpos(mysql_result($queryturnover,0,'gate')," "),strlen(mysql_result($queryturnover,0,'gate')))) : "TBD"); ?></span></td>
										<?php } ?>
											<td style="vertical-align: middle;" colspan=2><span style="font-size: 15px;"><?php echo mysql_result($queryturnover,0,'route'); ?></span></td>
										</tr>
									</table><br/>
								</div>
							</div>
						</div>
					</div>
<?php 
				}
				
?>

				<div class="accordion" id="accordion3">
					<div class="accordion-group" id="accordmap">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapsemap">
								Click to see the flight map <small>(<em>Great Circle Distance: <b><?php echo $gcddistance; ?> nm</b></em>)</small>
							</a>
						</div>
						<div id="collapsemap" class="accordion-body collapse">
							<div class="accordion-inner">
							<img src="http://www.gcmap.com/map?P=c:red,<?php echo mysql_result($querymodal,0,'origin'); ?>-<?php echo mysql_result($querymodal,0,'destination'); ?>&MS=wls2&MP=r&&MX=480x300&PM=b:disc4%2b%22%25i%5cn%25%28N+%229r:black&PC=%23ff0000&PW=2&RS=shaded&RC=%23000000">
							</div>
						</div>
					</div>
				</div>

<?php

$vid = mysql_result($querymodal,0,'vid');
if (empty($vid)) {
		if($IVAO_Info->result) {
?>
					Do you want to book this flight (logged as <strong><?php echo $IVAO_Info->vid; ?></strong> - <?php echo $IVAO_Info->firstname.' '.$IVAO_Info->lastname; ?>)?
				</fieldset>
			</form>
		</div>

		<div class="modal-footer" id="modalFlightsfooter">
			<button id="closebutton" name="closebutton" class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
			<button id="cancelbutton" name="cancelbutton" class="btn btn-danger" onClick="hideDisclaimer();">No, thanks</button>
			<button id="singlebutton1" name="singlebutton1" class="btn btn-success" onClick="showDisclaimer();">Book this flight</button>
			<button id="singlebutton" name="singlebutton" class="btn btn-success" onClick="registerPosition('<?php echo $IVAO_Info->vid; ?>','<?php echo $IVAO_Info->firstname.' '.$IVAO_Info->lastname; ?>','<?php echo mysql_result($querymodal,0,'id'); ?>','<?php echo $modalID; ?>');">I agree. Book it.</button>
		</div>
		<div id="disclaimer" class="modal-body" style="position: absolute; top: 50px; height: 70%; background-color: white;">
			<div style="border-bottom: 1px solid #000;"><h3><img src="images/warning.png"> Disclaimer</h3></div>
			<br/>
			<p>Please, make sure you have the <strong>real</strong> intention to fly this flight, in order to not block the flight for other pilots.</p>
			<p>You will receive an e-mail some days before the event to confirm your flight. If you don't confirm it, the flight will be automatically unbooked and opened for booking again.</p>
			<p><strong>Check regularly the e-mail you registered in this site!</strong></p>
			<p>Thanks a lot!</p>
		</div>
<?php
	} else {
?>
					Please, login yourself before booking a flight!
				</fieldset>
			</form>
		</div>

		<div class="modal-footer">
			<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
			<button name="singlebutton" class="btn btn-primary" onClick="window.location.assign('<?php echo login_url.'?url='.url; ?>')">Click here to login</button>
		</div>
<?php
	}
} else {
?>
				<table width="100%" border=0 cellpadding=0>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Flight already booked by</b></td>
						<td><b>VID</b></td>
					</tr>
					<tr height="40px">
						<td style="vertical-align: middle;"><span style="font-size: 20px;"><?php echo (mysql_result($querymodal,0,'privacy')==1?mysql_result($querymodal,0,'name'):mysql_result($querymodal,0,'vid')); ?></span></td>
						<td style="vertical-align: middle;"><span style="font-size: 20px;"><a href="http://www.ivao.aero/members/person/details.asp?ID=<?php echo mysql_result($querymodal,0,'vid'); ?>" target="_blank"><?php echo mysql_result($querymodal,0,'vid'); ?></a></td>
					</tr>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Pilot Rating</b></td>
						<td><b>Division</b></td>
					</tr>
					<tr height="40px">
						<td style="vertical-align: middle;"><img src="https://www.ivao.aero/data/images/ratings/pilot/<?php echo mysql_result($querymodal,0,'ratingpilot'); ?>.gif"></td>
						<td style="vertical-align: middle;"><img src="flags/48/<?php echo mysql_result($querymodal,0,'division'); ?>.png"</td>
					</tr>
				</table><br/>
			</fieldset>
		</form>
	</div>

	<div class="modal-footer">
		<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
<?php
	if (mysql_result($querymodal,0,'bookingstatus') == 1) {
?>
		<button name="singlebutton" class="btn btn-warning">Booked by <b><?php echo mysql_result($querymodal,0,'vid'); ?></b></button>
<?php
	} else if (mysql_result($querymodal,0,'bookingstatus') == 2) {
?>
		<button name="singlebutton" class="btn btn-danger">Booked by <b><?php echo mysql_result($querymodal,0,'vid'); ?></b></button>
<?php
	}
?>
	</div>
<?php
}
?>

<script>
$('#disclaimer').hide();
$('#singlebutton').hide();
$('#cancelbutton').hide();
</script>