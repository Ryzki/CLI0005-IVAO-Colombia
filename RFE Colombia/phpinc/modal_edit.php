<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal editing the flight's details.
   Author: Filipe Fonseca    05/08/2014
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
$querymodal = "SELECT f.id, f.flightnumber, f.radiocallsign, f.origin, f.destination, f.deptime, f.arrtime, f.gate, f.acft, f.route, f.vid, m.name,
               turn.flightnumber AS turnover
               FROM rfe_flights AS f
					LEFT JOIN rfe_members AS m ON m.vid = f.vid
					LEFT JOIN rfe_flights AS turn ON f.turnover = turn.id
					WHERE f.id='".$flightID."'";
$querymodal = mysqlexec($sqlconn,$querymodal);

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
			<table border="0" cellspacing="0" cellpadding="3">
				<tr>
					<th style="vertical-align: middle; width: 240px;">Flight Number</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"flightnumber"); ?>" name="flightnumber" id="flightnumber" maxlength="7" style="width: 30%;font-weight: bold;" required/>
					</td>
				</tr>
<?php
			if ($radiocall) {
?>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Radio Callsign</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"radiocallsign"); ?>" name="radiocallsign" id="radiocallsign" maxlength="7" style="width: 30%;font-weight: bold;" required/>
					</td>
				</tr>
<?php
			}
?>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Origin (ICAO)</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"origin"); ?>" name="origin" id="origin" maxlength="4" onKeyUp='if(this.value.length == 4) { loadApt(this.value.toUpperCase(),"origindiv"); } else { $("#origindiv").html(""); }' style="width: 30%;" required/>
						<div id="origindiv" style="display:inline;padding-left: 10px;"></div>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Destination (ICAO)</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"destination"); ?>" name="destination" id="destination" maxlength="4" onKeyUp='if(this.value.length == 4) { loadApt(this.value.toUpperCase(),"destinationdiv"); } else { $("#destinationdiv").html(""); }' style="display:inline;width: 30%;" required/>
						<div id="destinationdiv" style="display:inline;padding-left: 10px;"></div>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Departure Zulu Time</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="time" value="<?php echo mysql_result($querymodal,0,"deptime"); ?>" name="deptime" id="deptime" maxlength="4" style="display:inline;width: 30%;"/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Arrival Zulu Time</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="time" value="<?php echo mysql_result($querymodal,0,"arrtime"); ?>" name="arrtime" id="arrtime" maxlength="4" style="display:inline;width: 30%;"/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Gate</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"gate"); ?>" name="gate" id="gate" style="display:inline;width: 30%;"/>
						<div style="margin-top: -12px;font-size: 12px;">Use a space to separate terminal of gate number. If no space, just gate number</div>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Aircraft (IATA)</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"acft"); ?>" name="acft0" id="acft0" maxlength="3" style="width: 30%;" required/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Route</th>
					<td style="vertical-align: middle; width: 80%"><textarea name="route0" id="route0" style="width: 95%;font-family:Courier New,monospace;"><?php echo mysql_result($querymodal,0,"route"); ?></textarea></td>
				</tr>

				<tr>
					<th style="vertical-align: middle; width: 240px;">Turnover Flight</th>
					<td style="vertical-align: middle; width: 80%">
						<select name="turnover" id="turnover" style="width: 100%;">
							<option value="null">Select</option>
<?php
						$queryflightlist = "SELECT id,flightnumber,origin,destination FROM rfe_flights ORDER BY flightnumber";
						$queryflightlist = mysqlexec($sqlconn,$queryflightlist);
						for ($i=0;$i<mysql_num_rows($queryflightlist);$i++) {
?>
							 <option value="<?php echo mysql_result($queryflightlist,$i,'id'); ?>" <?php if(mysql_result($queryflightlist,$i,"flightnumber") == (mysql_result($querymodal,0,"turnover"))) { echo "selected"; } ?>><?php echo mysql_result($queryflightlist,$i,'flightnumber')." (".mysql_result($queryflightlist,$i,'origin')."-".mysql_result($queryflightlist,$i,'destination').")"; ?></option>
<?php
						}
?>
						</select>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">VID/Name</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"vid"); ?>" name="vid0" id="vid0" maxlength="6" style="display:inline;width: 30%;"/>
						<input type="text" value="<?php echo mysql_result($querymodal,0,"name"); ?>" name="name0" id="name0" style="display:inline;width: 50%;" disabled/>
					</td>
				</tr>
				
			</table>
			
			<div id="errorMessages" style="color: red;padding: 10px 0px;"></div>
			
	</div>

	<div class="modal-footer" id="modalFlightsfooter">
		<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
		<button name="singlebutton" class="btn btn-info" onClick="updatePosition(<?php echo mysql_result($querymodal,0,'id'); ?>);">Update flight</button>
	</div>