<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal deleting the flight.
   Author: Filipe Fonseca    05/08/2014
Revisions: 
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
$querymodal = "SELECT id,flightnumber
               FROM rfe_flights WHERE id='".$flightID."'";
$querymodal = mysqlexec($sqlconn,$querymodal);

// Check if the airline has a logo and gets it.
if (file_exists("../logos/".substr(mysql_result($querymodal,0,'flightnumber'),0,3).".gif")) {
	$logo = '<img src="logos/'.substr(mysql_result($querymodal,0,'flightnumber'),0,3).'.gif"/> ';
} else {
	$logo = '';
}	
?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><?php echo $logo; ?>Vuelo <?php echo substr(mysql_result($querymodal,0,'flightnumber'),3,strlen(mysql_result($querymodal,0,'flightnumber'))); ?></h3>
	</div>
	<div id="modalFlightsbody" class="modal-body">
		<div class="alert alert-error" style="height:65px;"><center><br/><h4> ¿Tú <em>realmente</em> quieres eliminar este vuelo?</h4></center></div>
	</div>

	<div class="modal-footer" id="modalFlightsfooter">
		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cerrar</button>
		<button name="singlebutton" class="btn btn-danger" onClick="deletePosition(<?php echo mysql_result($querymodal,0,'id'); ?>);">Borrar vuelo</button>
	</div>