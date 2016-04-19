<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");

if (!empty($_GET["flightnumber"]) AND !empty($_GET["origin"]) AND !empty($_GET["destination"]) AND !empty($_GET["acft"])) {

		$query = "UPDATE rfe_flights SET
		flightnumber = '".strtoupper($_GET["flightnumber"])."',
		radiocallsign = ".(empty($_GET["radiocallsign"]) ? "null" : "'".strtoupper($_GET["radiocallsign"])."'").",
		origin = '".strtoupper($_GET["origin"])."',
		destination = '".strtoupper($_GET["destination"])."',
		deptime = ".(empty($_GET["deptime"]) ? "null" : "'".$_GET["deptime"]."'").",
		arrtime = ".(empty($_GET["arrtime"]) ? "null" : "'".$_GET["arrtime"]."'").",
		gate = ".(empty($_GET["gate"]) ? "null" : "'".strtoupper($_GET["gate"])."'").",
		acft = '".strtoupper($_GET["acft"])."',
		route = ".(empty($_GET["route"]) ? "null" : "'".strtoupper($_GET["route"])."'").",
		turnover = ".(($_GET["turnover"]=='null') ? "null" : $_GET["turnover"]).",
		vid = ".(empty($_GET["vid"]) ? "null" : $_GET["vid"])."
		WHERE id=".$_GET["id"];
		
		$query = mysqlexec($sqlconn,$query);
		
		$query = "SELECT vid FROM rfe_flights WHERE id=".$_GET["id"];
		$query = mysqlexec($sqlconn,$query);
		
		if (is_null(mysql_result($query,0,'vid'))) {
			$query = "UPDATE rfe_flights SET
						 bookingstatus = 0,
						 bookingtimestamp = null
						 WHERE id=".$_GET["id"];
			$query = mysqlexec($sqlconn,$query);
		} else {
			$query = "UPDATE rfe_flights SET
						 bookingstatus = 2
						 WHERE id=".$_GET["id"];
			$query = mysqlexec($sqlconn,$query);
		}
	
}
?>