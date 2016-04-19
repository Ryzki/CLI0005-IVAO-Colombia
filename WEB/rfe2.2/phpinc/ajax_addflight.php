<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");

if (!empty($_GET["flightnumber"]) AND !empty($_GET["origin"]) AND !empty($_GET["destination"]) AND !empty($_GET["acft"])) {

		$query = "INSERT INTO rfe_flights VALUES
		('',
		'".strtoupper($_GET["flightnumber"])."',
		".(empty($_GET["radiocallsign"]) ? "null" : "'".strtoupper($_GET["radiocallsign"])."'").",
		'".strtoupper($_GET["origin"])."',
		'".strtoupper($_GET["destination"])."',
		".(empty($_GET["deptime"]) ? "null" : "'".$_GET["deptime"]."'").",
		".(empty($_GET["arrtime"]) ? "null" : "'".$_GET["arrtime"]."'").",
		".(empty($_GET["gate"]) ? "null" : "'".strtoupper($_GET["gate"])."'").",
		'".strtoupper($_GET["acft"])."',
		".(empty($_GET["route"]) ? "null" : "'".strtoupper($_GET["route"])."'").",
		null,
		".(empty($_GET["vid"]) ? "null" : $_GET["vid"]).",
		null,
		0)";
		$query = mysqlexec($sqlconn,$query);
}

if ($_GET["addslot"]) {
		$query = "INSERT INTO rfe_private VALUES
		('',
		null,
		null,
		null,
		'".$_GET["newslot"]."',
		null,
		null,
		null,
		null)";
		$query = mysqlexec($sqlconn,$query);
}

if ($_GET["addadmin"]) {
		$query = "INSERT INTO rfe_admins VALUES
		('',
		".$_GET["newadmin"].",
		0)";
		$query = mysqlexec($sqlconn,$query);
}
?>