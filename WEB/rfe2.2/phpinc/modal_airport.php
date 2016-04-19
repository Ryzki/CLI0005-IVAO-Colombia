<link href="font/font-weather.css" rel="stylesheet" type="text/css" />
<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal showing the airports' details.
   Author: Filipe Fonseca    14/06/2014
Revisions: 
========================================================================*/
// INCLUDES
include("func_mysqlexec.php");
include("func_general.php");
include("func_weather.php");

// EXTERNAL VARIABLES
$aptICAO  = $_REQUEST["icao"];

// GLOBAL VARIABLES
global $navdatabase, $rfedatabase, $sqlconn;

// Get Information of the Departure and Arrival airports from the Database
change_db($sqlconn,$navdatabase);
$queryapt = "SELECT Name,Latitude,Longtitude,Elevation FROM airports WHERE ICAO='".$aptICAO."'";
$queryapt = mysqlexec($sqlconn,$queryapt);
change_db($sqlconn,$rfedatabase);
?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 style="font-weight: 300"><?php echo getCountry($aptICAO); ?> <?php echo $aptICAO; ?> - <?php echo mysql_result($queryapt,0,'name'); ?></h3>
	</div>
	<div id="modalbody" class="modal-body">

		<div class="accordion" id="detailsaccordion">
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordion" href="#collapsedetails">
						Airport Details
					</a>
				</div>
				<div id="collapsedetails" class="accordion-body collapse">
					<div class="accordion-inner">
						<?php echo getDetailsAD($aptICAO); ?>
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordion" id="collapsemetarheading" href="#collapsemetar" onClick="loadMETAR('<?php echo $aptICAO; ?>');">
						METAR
					</a>
				</div>
				<div id="collapsemetar" class="accordion-body collapse">
					<div class="accordion-inner" style="font-family: 'Lucida Sans Typewriter', 'Courier New', monospace;" id="collapsemetarcontent">
						<center><img src="images/loadingsm.gif"/></center>
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordion" id="collapsetafheading" href="#collapsetaf" onClick="loadTAF('<?php echo $aptICAO; ?>')">
						TAF
					</a>
				</div>
				<div id="collapsetaf" class="accordion-body collapse">
					<div class="accordion-inner" style="font-family: 'Lucida Sans Typewriter', 'Courier New', monospace;" id="collapsetafcontent">
						<center><img src="images/loadingsm.gif"/></center>
					</div>
				</div>
			</div>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordion" href="#collapsemap">
						Airport Map
					</a>
				</div>
				<div id="collapsemap" class="accordion-body collapse">
					<div class="accordion-inner">
						<?php echo getMap($aptICAO); ?><br/>
					</div>
				</div>
			</div>
		</div>
	</div>