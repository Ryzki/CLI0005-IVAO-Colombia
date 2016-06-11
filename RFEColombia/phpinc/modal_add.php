<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal adding a flight.
   Author: Filipe Fonseca    05/08/2014
Revisions: Filipe Fonseca    17/08/2015
========================================================================*/
// INCLUDES
include("func_mysqlexec.php");
include("func_general.php");

// If the cookie is existent, get the Info Array with details of the user.
if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
}

// GLOBAL VARIABLES
global $navdatabase, $rfedatabase, $IVAO_Info, $sqlconn;

// Get radio callsign configuration
$querymodal = "SELECT useradiocallsign FROM rfe_config";
$querymodal = mysqlexec($sqlconn,$querymodal);
$radiocall  = mysql_result($querymodal, 0, 'useradiocallsign');
?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Add a flight</h3>
	</div>
	<div id="modalFlightsbody" class="modal-body">
			<table border="0" cellspacing="0" cellpadding="3">
				<tr>
					<th style="vertical-align: middle; width: 260px;">Flight Number</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" name="flightnumber" id="flightnumber" maxlength="7" style="width: 30%;font-weight: bold;" required/>
					</td>
				</tr>
<?php
			if ($radiocall) {
?>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Radio Callsign</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" name="radiocallsign" id="radiocallsign" maxlength="7" style="width: 30%;font-weight: bold;" required/>
					</td>
				</tr>
<?php
			}
?>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Origin (ICAO)</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" name="origin" id="origin" maxlength="4" onKeyUp='if(this.value.length == 4) { loadApt(this.value.toUpperCase(),"origindiv"); } else { $("#origindiv").html(""); }' style="width: 30%;" required/>
						<div id="origindiv" style="display:inline;padding-left: 10px;"></div>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Destination (ICAO)</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" name="destination" id="destination" maxlength="4" onKeyUp='if(this.value.length == 4) { loadApt(this.value.toUpperCase(),"destinationdiv"); } else { $("#destinationdiv").html(""); }' style="display:inline;width: 30%;" required/>
						<div id="destinationdiv" style="display:inline;padding-left: 10px;"></div>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Departure Zulu Time</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="time" name="deptime" id="deptime" style="display:inline;width: 30%;"/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Arrival Zulu Time</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="time" name="arrtime" id="arrtime" style="display:inline;width: 30%;"/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Terminal/Gate</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" name="gate" id="gate" style="display:inline;width: 30%;"/>
						<div style="margin-top: -12px;font-size: 12px;">Use a space to separate terminal of gate number. If no space, just gate number</div>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Aircraft (IATA)</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" name="acft1" id="acft1" maxlength="3" style="width: 30%;" required/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 260px;">Route</th>
					<td style="vertical-align: middle; width: 80%"><textarea name="route1" id="route1" style="width: 95%;font-family:Courier New,monospace;"></textarea></td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 260px;">VID/Name</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" name="vid1" id="vid1" maxlength="6" style="display:inline;width: 30%;"/>
						<input type="text" name="name1" id="name1" style="display:inline;width: 50%;"/>
					</td>
				</tr>
				
			</table>
	</div>

	<div class="modal-footer" id="modalFlightsfooter">
		<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
		<button name="singlebutton" class="btn btn-success" onClick="addFlight();">Add flight</button>
	</div>