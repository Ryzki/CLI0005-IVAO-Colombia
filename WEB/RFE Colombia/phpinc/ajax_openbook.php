<?php
include("func_mysqlexec.php");

if ($_GET["act"] == "open") {
	$query = "UPDATE rfe_config SET status = 1";
	$query = mysqlexec($sqlconn,$query);
} else if ($_GET["act"] == "count") {
	$query = "UPDATE rfe_config SET status = 0";
	$query = mysqlexec($sqlconn,$query);
}

?>