<?php

header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

include("func_mysqlexec.php");
include("func_general.php");

$param = strtoupper($_GET["s"]);

if (!empty($param)) {
	$query = "SELECT datestart,dateend,timestart,timeend,timezone FROM rfe_config";
	$query = mysqlexec($sqlconn,$query);
	$datestart = mysql_result($query,0,"datestart");
	$dateend   = mysql_result($query,0,"dateend");
	$ts = mysql_result($query,0,"timestart");
	$te = mysql_result($query,0,"timeend");
	$tz = mysql_result($query,0,"timezone");
	
	if ($datestart != $dateend) {
		$midword = "OR";
	} else {
		$midword = "AND";
	}

	$query = "SELECT f.id, f.flightnumber, f.origin, f.destination, IFNULL(DATE_FORMAT(f.deptime, '%H%i'),'----') AS deptime,
				 IFNULL(DATE_FORMAT(f.arrtime, '%H%i'),'----') AS arrtime, IFNULL(deptime,arrtime) AS opstimeorig, IFNULL(DATE_FORMAT(deptime, '%H%i'),DATE_FORMAT(arrtime, '%H%i')) AS opstime, IFNULL(f.gate,'TBD') AS gate, f.acft, IFNULL(f.route,'TBD') AS route, f.vid, f.bookingstatus, m.name
				 FROM rfe_flights AS f
				 LEFT JOIN rfe_members AS m ON m.vid = f.vid
				 WHERE (f.flightnumber LIKE '%".$param."%' OR f.origin LIKE '%".$param."%' OR f.destination LIKE '%".$param."%' OR f.acft LIKE '%".$param."%')
				 AND (IFNULL(deptime,arrtime) >= '".$ts."' ".$midword." IFNULL(deptime,arrtime) <= '".$te."')
				 ORDER BY opstime";

	$query = mysqlexec($sqlconn,$query);
	$queryn = mysql_num_rows($query);

	for ($i=0;$i<$queryn;$i++) {
			change_db($sqlconn,$navdatabase);
			$queryorig = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"origin")."'";
			$queryorig = mysqlexec($sqlconn,$queryorig);
			$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"destination")."'";
			$querydest = mysqlexec($sqlconn,$querydest);
			change_db($sqlconn,$rfedatabase);
			$queryapt = "SELECT apticao FROM rfe_config";
			$queryapt = mysqlexec($sqlconn,$queryapt);
			$queryo = "SELECT DATE_FORMAT(CONVERT_TZ(CONCAT(CURDATE(),' ','".mysql_result($query,$i,"opstimeorig")."'),'+00:00','".$tz."'), '%H%i') AS opslocaltime";
			$queryo = mysqlexec($sqlconn,$queryo);	
			$result .= '<tr><td style="vertical-align:middle">';
			
			if (mysql_result($query,$i,'origin')==mysql_result($queryapt,0,'apticao')) {
				$result .= '<img src="images/dep.png" rel="tooltip" data-placement="top" title="Departing Flight"></td><td style="vertical-align:middle">';
			} else if (mysql_result($query,$i,'destination')==mysql_result($queryapt,0,'apticao')) {
				$result .= '<img src="images/arr.png" rel="tooltip" data-placement="top" title="Arriving Flight"></td><td style="vertical-align:middle">';
			}

			if (file_exists("../logos/".substr(mysql_result($query,$i,'flightnumber'),0,3).".gif")) {
				$result .= '<img src="logos/'.substr(mysql_result($query,$i,'flightnumber'),0,3).'.gif">';
			} else {
				$result .= '&nbsp;';
			}
			
			$result .= '</td><td style="vertical-align:middle">';
			$result .= mysql_result($query,$i,'flightnumber');		
			$result .= '</td><td style="vertical-align:middle;text-align:center;"><span rel="tooltip" data-placement="top" title="'.aircraftname(mysql_result($query,$i,'acft'),'name').'">';
			$result .= aircraftname(mysql_result($query,$i,'acft'));
			$result .= '</span></td><td style="vertical-align:middle">';			
			$result .= getCountry(mysql_result($query,$i,'origin'),"norm","24")." ".mysql_result($query,$i,'origin')." - ".mysql_result($queryorig,0,'Name');
			$result .= '</td><td style="vertical-align:middle">';
			$result .= getCountry(mysql_result($query,$i,'destination'),"norm","24")." ".mysql_result($query,$i,'destination')." - ".mysql_result($querydest,0,'Name');
			
			$result .= '</td><td style="vertical-align:middle"><span rel="tooltip" data-placement="top" title="'.mysql_result($queryo,0,'opslocaltime').'LT">';
			$result .= mysql_result($query,$i,'opstime');
			$result .= 'Z</span></td><td style="vertical-align:middle">';
			$result .= mysql_result($query,$i,'gate');
			
			$result .= '</td>';
			
			$vid = mysql_result($query,$i,'vid');
			if (empty($vid)) {
				$result .= '<td style="vertical-align:middle"><button type="button" class="btn btn-success" data-toggle="modal" href="#modalFlights" onClick="loadModal('.mysql_result($query,$i,'id').')">Available</button></td>';
			} else {
				if (mysql_result($query,$i,'bookingstatus') == 1) {
					$result .= '<td style="vertical-align:middle;"><button type="button" class="btn btn-warning" data-toggle="modal" href="#modalFlights" onClick="loadModal('.mysql_result($query,$i,'id').')">Booked by <b>'.mysql_result($query,$i,'vid').'</b></button></td>';
				} else if (mysql_result($query,$i,'bookingstatus') == 2) {
					$result .='<td style="vertical-align:middle;"><button type="button" class="btn btn-danger" data-toggle="modal" href="#modalFlights" onClick="loadModal('.mysql_result($query,$i,'id').'">Booked by <b>'.mysql_result($query,$i,'vid').'</b></button></td>';
				}
			}

			$result .= '</tr>';
	}

		$result .= ($queryn > 0 ? '<script>$(document).ready(function(){$("[rel=tooltip]").tooltip();});</script>' : '');
		echo $result;
}
?>