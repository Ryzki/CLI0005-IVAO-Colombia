<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Parse flights from FlightStats structure.
   Author: Filipe Fonseca    13/06/2014
Revisions: 
==========================================================================
SCRIPT STILL IN TEST! DON'T USE IT!
It'1l not be documented until the final and stable version.
========================================================================*/

if (empty($_GET["m"]) OR (($_GET["m"] != "dep") AND ($_GET["m"] != "arr"))){
		echo "<h1>Choose mode DEP or ARR!</h1>";
		exit();
}

?>

<?php

set_time_limit(0);
include("func_mysqlexec.php");

function goodFlightNumber($flightNumber) {
	$iata = explode(" ",$flightNumber);
	
	$info = file_get_contents("http://www.airlinecodes.co.uk/airlcoderes.asp?iatacode=".$iata[0]);
	
	$info = explode('<h1 align="Center">Airline Code Search Result</h1>',$info);
	$info = explode('</table>',$info[1]);
	$info = explode('ICAO-Code:',$info[0]);
	$info = explode('Prefix-Code:',$info[1]);
	$info = explode('<td>',$info[0]);
	$info = explode('</td>',$info[1]);
	$info = $info[0];
	
	if (empty($info)) {
		$info = $iata[0];
	}
	
	if ($info == "OO") {
		$info = "SKW";
	} else if ($info == "5X") {
		$info = "UPS";
	} else if ($info == "FX") {
		$info = "FDX";
	} else if ($info == "1I") {
		$info = "EJA";
	} else if ($info == "RS") {
		$info = "SKV";
	} else if ($info == "EM") {
		$info = "CFS";
	} else if ($info == "XC") {
		$info = "KDC";
	} else if ($info == "FTT") {
		$info = "FFT";
	} else if ($info == "RSH") {
		$info = "JLL";
	} else if ($info == "CVA") {
		$info = "CLX";
	}
	 
	return $info.$iata[1];
}
function goodAirport($iata) {
	$info = file_get_contents("http://www.airlinecodes.co.uk/aptcoderes.asp?iatacode=".$iata);
	
	$info = explode('<h1 align="center">Airport Code Search Result</h1>',$info);
	$info = explode('</table>',$info[1]);
	$info = explode('ICAO-Code:',$info[0]);
	$info = explode('FAA-Code:',$info[1]);
	$info = explode('<td>',$info[0]);
	$info = explode('</td>',$info[1]);
	$info = $info[0];
	
	return $info;
}

function goodAircraftCode($iata) {
	$info = file_get_contents("http://www.airlinecodes.co.uk/arctypes.asp");
	
	$info = explode($iata,$info);
	$info = explode('</tr>',$info[1]);
	$info = explode('</td>',$info[0]);
	$info = explode('>',$info[1]);
	$info = trim($info[1]);
	
	return $info;
}

$query = "SELECT timezone FROM rfe_config";
$query = mysqlexec($sqlconn,$query);
$timezone = mysql_result($query,0,'timezone');

if (substr($timezone,0,1) == "+") {
	$timezone = "-".substr($timezone,1,strlen($timezone));
} else if (substr($timezone,0,1) == "-") {
	$timezone = substr($timezone,1,strlen($timezone));
}

$rawFile = file_get_contents("abcde.html");

$arrayFile = explode('style="width:40px;">Track</th>',$rawFile);
$arrayFile = explode('<td class="label">Sort By</td>',$arrayFile[1]);
$arrayFile = explode('</table>',$arrayFile[0]);
$arrayFile = explode('<td nowrap="nowrap">',$arrayFile[0]);
$trashVar  = array_shift($arrayFile);

foreach ($arrayFile as $htmlFlight) {
	$fieldArray = explode('</td>',$htmlFlight);
	
	$otherICAO = explode('</a>',$fieldArray[0]);
	$otherICAO = explode('>',$otherICAO[0]);
	$otherICAO = goodAirport($otherICAO[1]);
	
	$flightNumber = explode('<td nowrap>',$fieldArray[1]);
	$flightNumber = explode('>',$flightNumber[1]);
	$flightNumber = explode('</a',$flightNumber[1]);
	$flightNumber = goodFlightNumber($flightNumber[0]);
	
	$timeofOperation = explode('<td nowrap>',$fieldArray[4]);
	$timeofOperation = str_replace("\n","",$timeofOperation[1]);
	//$timeofOperation = toZulu($timeofOperation);
	
	$gate = $fieldArray[6];
	$gate = explode('<td>',$fieldArray[6]);
	$gate = explode('>',$gate[1]);
	
	// KDFW
	//$gate = str_replace("\n","",$gate[1]);
	
	// KSEA
	$terminal = explode("<",$gate[0]);
	$terminal = explode("-",$terminal[0]);
	$terminal = trim($terminal[1]);
	$gate = trim(str_replace("\n","",$gate[1]));
	$gate = $terminal." ".$gate;
	
	$acft = explode('<td>',$fieldArray[8]);
	$acft = str_replace("\n","",$acft[1]);
	//$acft = goodAircraftCode($acft);
	
	$route = file_get_contents("http://flightaware.com/live/flight/".$flightNumber);
	/*$route = explode('<th class="secondaryHeader">Route</th>',$route);*/
	$route = explode('<th class="secondaryHeader">Rota</th>',$route);
	$route = explode('(',$route[1]);
	$route = explode('>',$route[0]);
	$route = trim($route[1]);
	
	//echo $otherICAO." | ".$flightNumber." | ".$timeofOperation." (".toZulu($timeofOperation)."Z) | ".$gate." | ".$acft." | ".$route."<br/>";
	
	$querysel = "SELECT apticao FROM rfe_config";
	$querysel = mysqlexec($sqlconn,$querysel);
	
	if ($_GET["m"] == "dep") {
		$arr = $otherICAO;
		$dep = mysql_result($querysel,0,'apticao');
		$deptime = date("H:i", strtotime($timeofOperation));
		
		$querysel = "SELECT * FROM rfe_flights WHERE (flightnumber = '".$flightNumber."' AND deptime = DATE_FORMAT(ADDTIME('$deptime','$timezone'),'%H:%i:%s'))";
		$querysel = mysqlexec($sqlconn,$querysel);
		if (mysql_num_rows($querysel) > 0 ) { continue; }
		
	} else if ($_GET["m"] == "arr") {
		$arr = mysql_result($querysel,0,'apticao');
		$dep = $otherICAO;
		$arrtime = date("H:i", strtotime($timeofOperation));
		
		$querysel = "SELECT * FROM rfe_flights WHERE (flightnumber = '".$flightNumber."' AND arrtime = DATE_FORMAT(ADDTIME('$arrtime','$timezone'),'%H:%i:%s'))";
	   $querysel = mysqlexec($sqlconn,$querysel);
		if (mysql_num_rows($querysel) > 0) { continue; }
		
	}
	
	$query = "INSERT INTO rfe_flights VALUES
		('',
		'".strtoupper($flightNumber)."',
		null,
		'".strtoupper($dep)."',
		'".strtoupper($arr)."',
		".(empty($deptime) ? "null" : "DATE_FORMAT(ADDTIME('$deptime','$timezone'),'%H:%i:%s')").",
		".(empty($arrtime) ? "null" : "DATE_FORMAT(ADDTIME('$arrtime','$timezone'),'%H:%i:%s')").",
		".(empty($gate) ? "null" : "'".strtoupper($gate)."'").",
		'".strtoupper($acft)."',
		".(empty($route) ? "null" : "'".strtoupper($route)."'").",
		null,
		null,
		null,
		0)";
		
		//echo $query."<br/>";
		$query = mysqlexec($sqlconn,$query);
	
	$deptime = null; $arrtime = null;
	
}

?>

Flights added.