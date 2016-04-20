<?php
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");

if ($_GET["deladmin"]) {
	$query = "DELETE FROM rfe_admins WHERE id=".$_GET["id"];
	$query = mysqlexec($sqlconn,$query);
} else {
	$query = "DELETE FROM rfe_flights WHERE id=".$_GET["id"];
	$query = mysqlexec($sqlconn,$query);
}
?>