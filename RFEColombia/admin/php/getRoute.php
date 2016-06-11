<?php
set_time_limit(0);

include("func_mysqlexec.php");

if (!empty($_GET["flt"])) {

	$rawHTML = file_get_contents("http://flightaware.com/live/flight/".$_GET["flt"]);
	/*$route = explode('<th class="secondaryHeader">Route</th>',$rawHTML);*/
	$route = explode('<th class="secondaryHeader">Rota</th>',$rawHTML);
	/*print_r($route);*/
	$route = explode('(',$route[1]);
	$route = explode('>',$route[0]);
	$route = trim($route[1]);
	echo $route;
} else {

	$query = "SELECT * FROM rfe_flights WHERE (origin LIKE 'K%' AND destination LIKE 'K%' AND vid IS NOT NULL AND route IS NULL)";
	/*$query = "SELECT * FROM rfe_flights WHERE (
						( (	( (origin LIKE 'K%') OR (origin LIKE 'C%') OR (origin LIKE 'M%') OR (origin LIKE 'P%') ) AND destination LIKE 'K%') 
						OR (origin LIKE 'K%' AND ( (destination LIKE 'K%') OR (destination LIKE 'C%') OR (destination LIKE 'M%') OR (destination LIKE 'P%') ) ) )
						AND vid IS NOT NULL AND route IS NULL)";*/
	$query = mysqlexec($sqlconn,$query);
	$queryn = mysql_num_rows($query);
	
	//for ($i=0;$i<$queryn;$i++) {
	for ($i=0;$i<20;$i++) {
	
		$rawHTML = file_get_contents("http://flightaware.com/live/flight/".mysql_result($query,$i,"flightnumber"));

		//echo $rawHTML;
		//exit();
		$route = explode('<th class="secondaryHeader">Route</th>',$rawHTML);
		$route = explode('(',$route[1]);
		$route = explode('>',$route[0]);
		$route = explode('<',$route[1]);
		$route = trim($route[0]);
		
		if (!empty($route)) {
			echo mysql_result($query,$i,"flightnumber")." - ".mysql_result($query,$i,"origin")." - ".mysql_result($query,$i,"destination")." - ".$route."<br/>";
			$query0 = "UPDATE rfe_flights SET route='".$route."' WHERE id=".mysql_result($query,$i,"id");
			$query0 = mysqlexec($sqlconn,$query0);
		}
	
	}
	
}

?>