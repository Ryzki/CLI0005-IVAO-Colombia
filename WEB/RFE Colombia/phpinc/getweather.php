<?php

include("func_mysqlexec.php");
include("func_weather.php");

$apticao = $_REQUEST["icao"];
$wxmes   = $_REQUEST["wx"];

if ($wxmes == "metar") {
	echo loadMETAR($apticao);
} else if ($wxmes == "taf") {
	echo loadTAF($apticao);
} else if ($wxmes == "name") {
	change_db($sqlconn,$navdatabase);
	$query = "SELECT Name FROM airports WHERE ICAO='".$apticao."'";
	$query = mysqlexec($sqlconn,$query);
	$name  = @mysql_result($query,0,"Name");
	
	if ($name) {
		echo $name;
	} else {
		echo "<b>(not found)</b>";
	}
	change_db($sqlconn,$rfedatabase);
} else if ($wxmes == "acft") {
	$query = "SELECT name FROM nav_aircrafts WHERE icao='".$apticao."' ORDER BY id LIMIT 1";
	$query = mysqlexec($sqlconn,$query);
	$name  = @mysql_result($query,0,"name");
	
	if ($name) {
		echo $name;
	} else {
		echo "<b>(not found)</b>";
	}
} else if ($wxmes == "mail") {
	$query = "SELECT m.email FROM rfe_members AS m LEFT JOIN rfe_privatependent AS pp ON pp.vid = m.vid WHERE pp.id='".$apticao."'";
	$query = mysqlexec($sqlconn,$query);
	$email  = @mysql_result($query,0,"email");
	
	if ($email) {
		echo $email;
	} else {
		echo "<b>(not found)</b>";
	}
}
?>