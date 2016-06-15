<?php

set_time_limit(0);
include("func_mysqlexec.php");

$query = "SELECT id,deptime,arrtime FROM rfe_flights";
$query = mysqlexec($sqlconn,$query);
$queryn = mysql_num_rows($query);

for ($i=0;$i<$queryn;$i++) {
	if (is_null(mysql_result($query,$i,'arrtime'))) {
		$deptime = mysql_result($query,$i,'deptime');
		$depid   = mysql_result($query,$i,'id');
		$query_update = "UPDATE rfe_flights SET deptime=DATE_FORMAT(ADDTIME('$deptime','-01:00:00'),'%H:%i:%s') WHERE id = $depid";
		//echo $query_update;
		$query_update = mysqlexec($sqlconn,$query_update);
	}
	if (is_null(mysql_result($query,$i,'deptime'))) {
		$arrtime = mysql_result($query,$i,'arrtime');
		$arrid   = mysql_result($query,$i,'id');
		$query_update = "UPDATE rfe_flights SET arrtime=DATE_FORMAT(ADDTIME('$arrtime','-01:00:00'),'%H:%i:%s') WHERE id = $arrid";
		//echo $query_update;
		$query_update = mysqlexec($sqlconn,$query_update);
	}
}
?>