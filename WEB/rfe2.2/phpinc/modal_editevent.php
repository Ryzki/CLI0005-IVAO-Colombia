<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal editing the event's details.
   Author: Filipe Fonseca    05/08/2014
Revisions: 
========================================================================*/
// INCLUDES
include("func_mysqlexec.php");
include("func_general.php");

// EXTERNAL VARIABLES
$flightID  = $_REQUEST["id"];

// Define IVAO variables
define('cookie_name', 'rfe_token');
define('login_url', 'http://login.ivao.aero/index.php');
define('api_url', 'http://login.ivao.aero/api.php');
define('url', 'http://www.ivaous.org/main/events/rfe/booking');

// If the cookie is existent, get the Info Array with details of the user.
if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
}

// GLOBAL VARIABLES
global $navdatabase, $rfedatabase, $IVAO_Info, $sqlconn;

// Get Information of the Flight from the Database
$querymodal = "SELECT id,division,divisioniso,datestart,dateend,timestart,timeend,apticao,aptname,timezone,privatebook,status,sendermail,useradiocallsign
               FROM rfe_config";
$querymodal = mysqlexec($sqlconn,$querymodal);
?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Edit Event</h3>
	</div>
	<div id="modalFlightsbody" class="modal-body">
			<table border="0" cellspacing="0" cellpadding="3">
				<tr>
					<th style="vertical-align: middle; width: 240px;">Division Name and ISO Code</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"division"); ?>" name="division" id="division" style="width: 30%;display:inline;" required/>
						<input type="text" value="<?php echo mysql_result($querymodal,0,"divisioniso"); ?>" name="divisioniso" id="divisioniso" maxlength="2" style="width: 30%;display:inline;" required/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Starting Date and Time</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="date" value="<?php echo mysql_result($querymodal,0,"datestart"); ?>" name="datestart" id="datestart" maxlength="10" style="width: 30%;display:inline;" required/>
						<input type="time" step="1" value="<?php echo mysql_result($querymodal,0,"timestart"); ?>" name="timestart" id="timestart" maxlength="8" style="width: 30%;display:inline;" required/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Ending Date and Time</th>
					<td style="vertical-align: middle; width: 80%">
						<input type="date" value="<?php echo mysql_result($querymodal,0,"dateend"); ?>" name="dateend" id="dateend" maxlength="10" style="width: 30%;display:inline;" required/>
						<input type="time" step="1" value="<?php echo mysql_result($querymodal,0,"timeend"); ?>" name="timeend" id="timeend" maxlength="8" style="width: 30%;display:inline;" required/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Location of the Event</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"apticao"); ?>" name="apticao" id="apticao" maxlength="4" onKeyUp='if(this.value.length == 4) { loadApt(this.value.toUpperCase(),"apticaodiv"); } else { $("#apticaodiv").html(""); }' style="display:inline;width: 30%;" required/>
						<div id="apticaodiv" style="display:inline;padding-left: 10px;"></div>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Name of the Airport</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"aptname"); ?>" name="aptname" id="aptname" style="display:inline;width: 30%;"/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Timezone</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"timezone"); ?>" name="timezone" id="timezone" maxlength="6" style="display:inline;width: 30%;"/>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Private Book</th>
					<td style="vertical-align: middle; width: 80%;">
						<select name="privatebook" id="privatebook" style="width: 33%;">
							 <option value="0" <?php if(mysql_result($querymodal,0,"privatebook") == 0) { echo "selected"; } ?>>Closed</option>
							 <option value="1" <?php if(mysql_result($querymodal,0,"privatebook") == 1) { echo "selected"; } ?>>Open</option>
						</select>
					</td>
				</tr>
				<tr>
					<th style="vertical-align: middle; width: 240px;">Mail Address</th>
					<td style="vertical-align: middle; width: 80%;">
						<input type="text" value="<?php echo mysql_result($querymodal,0,"sendermail"); ?>" name="sendermail" id="sendermail" style="display:inline;width: 30%;"/>
					</td>
				</tr>	
				<tr>
					<th style="vertical-align: middle; width: 240px;">Use radio callsign?</th>
					<td style="vertical-align: middle; width: 80%">
						<select name="useradiocallsign" id="useradiocallsign" style="width: 33%;">
							 <option value="0" <?php if(mysql_result($querymodal,0,"useradiocallsign") == 0) { echo "selected"; } ?>>No</option>
							 <option value="1" <?php if(mysql_result($querymodal,0,"useradiocallsign") == 1) { echo "selected"; } ?>>Yes</option>
						</select>
					</td>
				</tr>		
				<tr>
					<th style="vertical-align: middle; width: 240px;">Status</th>
					<td style="vertical-align: middle; width: 80%">
						<select name="status" id="status" style="width: 33%;">
							 <option value="-1" <?php if(mysql_result($querymodal,0,"status") == 0) { echo "selected"; } ?>>Closed</option>
							 <option value="1" <?php if(mysql_result($querymodal,0,"status") == 1) { echo "selected"; } ?>>Open</option>
						</select>
					</td>
				</tr>				
			</table>
	</div>

	<div class="modal-footer" id="modalFlightsfooter">
		<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
		<button name="singlebutton" class="btn btn-info" onClick="updateEvent(<?php echo mysql_result($querymodal,0,'id'); ?>);">Update Event</button>
	</div>