<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal showing the private flight's details.
   Author: Filipe Fonseca    13/06/2014
Revisions: Filipe Fonseca    17/08/2015
========================================================================*/
// INCLUDES
include("func_mysqlexec.php");
include("func_general.php");

// EXTERNAL VARIABLES
$flightID  = $_REQUEST["id"];

// GLOBAL VARIABLES
global $navdatabase, $rfedatabase, $IVAO_Info, $sqlconn;

// Get Information of the Flight from the Database
$querymodal = "SELECT p.id, p.flightnumber, p.origin, p.destination, IFNULL(DATE_FORMAT(p.slottime, '%H%i'),'----') AS slottime, p.acft,
               IFNULL(p.route,'Not informed') AS route, p.vid, m.name, m.ratingpilot, m.division, m.privacy
               FROM rfe_private AS p
					LEFT JOIN rfe_members AS m ON m.vid = p.vid
					WHERE p.id='".$flightID."'";
$querymodal = mysqlexec($sqlconn,$querymodal);
// Get Information of the Flight from the Database
$queryapt = "SELECT apticao FROM rfe_config";
$queryapt = mysqlexec($sqlconn,$queryapt);

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

// Check if the airline has a logo and gets it.
if (file_exists("../logos/".substr(mysql_result($querymodal,0,'flightnumber'),0,3).".gif")) {
	$logo = '<img src="logos/'.substr(mysql_result($querymodal,0,'flightnumber'),0,3).'.gif"/> | ';
} else {
	$logo = '';
}	
?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?php echo $logo; ?>Slot #<?php echo mysql_result($querymodal,0,'id'); ?> | <?php echo mysql_result($querymodal,0,'slottime'); ?>Z | <?php echo mysql_result($querymodal,0,'flightnumber'); ?></h3>
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
						<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo mysql_result($querymodal,0,'flightnumber'); ?></span></td>
						<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($querymodal,0,'origin'))." ".mysql_result($querymodal,0,'origin'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($queryorig,0,'Name'); ?></span>
						<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($querymodal,0,'destination'))." ".mysql_result($querymodal,0,'destination'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($querydest,0,'Name'); ?></span>
					</tr>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Aircraft</b></td>
						<td><b>Departure Time</b></td>
						<td><b>Arrival Time</b></td>
					</tr>
					<tr height="60px">
						<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo aircraftname(mysql_result($querymodal,0,'acft')); ?></span><br/><span style="font-size: 10px;"><?php echo aircraftname(mysql_result($querymodal,0,'acft'),"name"); ?></span></td>
						<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if ($movement == 'dep') { echo mysql_result($querymodal,0,'slottime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($querymodal,0,'slottime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"diff"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if ($movement == 'dep') { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span></td>
						<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if ($movement == 'arr') { echo mysql_result($querymodal,0,'slottime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($querymodal,0,'slottime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"add"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if ($movement == 'arr') { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span></td>
					</tr>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Gate</b></td>
						<td colspan="2"><b>Route</b> <span style="font-size: 12px;">(filled by the pilot)</span></td>
					</tr>
					<tr height="50px">
						<td style="vertical-align: middle;"><span style="font-size: 30px; font-weight: bold;background-color: #F2EF30; padding: 0 10px;">-</span></td>
						<td style="vertical-align: middle;" colspan=2><span style="font-size: 15px;"><?php echo mysql_result($querymodal,0,'route'); ?></span></td>
					</tr>
				</table><br/>

<?php 
$vid = mysql_result($querymodal,0,'vid');
if (empty($vid)) {
		if($IVAO_Info->result) {
?>
					Do you want to register this flight (logged as <strong><?php echo $IVAO_Info->vid; ?></strong> - <?php echo $IVAO_Info->firstname.' '.$IVAO_Info->lastname; ?>)?
				</fieldset>
			</form>
		</div>

		<div class="modal-footer">
			<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
			<button id="<?php echo mysql_result($querymodal,0,'flightnumber'); ?>" name="singlebutton" class="btn btn-success" onClick="registerPosition('<?php echo $IVAO_Info->vid; ?>','<?php echo $IVAO_Info->firstname.' '.$IVAO_Info->lastname; ?>','<?php echo mysql_result($querymodal,0,'id'); ?>','<?php echo $modalID; ?>');">Register this flight</button>
		</div>
<?php
	} else {
?>
					Please, login yourself before register a flight!
				</fieldset>
			</form>
		</div>

		<div class="modal-footer">
			<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Close</button>
			<button name="singlebutton" class="btn btn-warning" onClick="window.location.assign('<?php echo login_url.'?url='.url; ?>')">Click here to login</button>
		</div>
<?php
	}
} else {
?>
				<table width="100%" border=0 cellpadding=0>
					<tr style="border-bottom: 1px solid #444">
						<td><b>Slot already booked by</b></td>
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
		<button name="singlebutton" class="btn btn-danger">Booked by <b><?php echo mysql_result($querymodal,0,'vid'); ?></b></button>
	</div>
<?php
}
?>