<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");

if ($_GET["s"] == "book") {
	$query = "UPDATE rfe_flights SET
						vid = '".$_GET["vid"]."',
						bookingstatus = 1
						WHERE id = ".$_GET["id"];
	$query = mysqlexec($sqlconn,$query);
} else if ($_GET["s"] == "confirm") {
	$query = "UPDATE rfe_flights SET
						bookingstatus = 2
						WHERE id = ".$_GET["id"];
	$query = mysqlexec($sqlconn,$query);
} else if ($_GET["s"] == "unbook") {
	$query = "UPDATE rfe_flights SET
						vid = null,
						bookingstatus = 0,
						bookingtimestamp = null
						WHERE id = ".$_GET["id"];
	$query = mysqlexec($sqlconn,$query);
}

?>