<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Contains functions for usage in the RFE System.
   Author: Filipe Fonseca    13/06/2014
Revisions: Filipe Fonseca    21/06/2014
           Filipe Fonseca    11/03/2015
========================================================================*/

/*========================================================================
Variables: Definition for IVAO connection.
========================================================================*/
define('cookie_name', 'rfe_token');
define('login_url', 'http://login.ivao.aero/index.php');
define('api_url', 'http://login.ivao.aero/api.php');
//define('api_url', 'http://api.ivao.aero/getdata/whazzup/whazzup.txt');
//define('api_url', 'http://api.ivao.aero/getdata/whazzup/whazzup.txt.gz');
define('url', 'http://www.ivaocol.com.co/RFEColombia/');

/*========================================================================
 Function: airlinename
    Usage: Returns airline's callsign and flight number from XXX1234 standard.
Arguments:
	$flightnumber - XXX1234 standard
	$exit         - Method of data's return (e.g., for AAL1234):
                    >    all - American 1234
					> number - 1234
========================================================================*/
function airlinename($flightnumber,$exit="all") {

	// SQL Pointer is a global variable
	global $sqlconn;
	
	// Separate words and numbers from variable.
	//list($airline,$number) = preg_split( '/([a-z]+)/i', $flightnumber, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
	$airline = substr($flightnumber,0,3);
	$number = substr($flightnumber,3,strlen($flightnumber));
	
	if ($exit == "number") {
		return $number;
	} else if ($exit == "name") {
		$queryairline = "SELECT name FROM nav_airlines WHERE icao='".$airline."'";
		$queryairline = mysqlexec($sqlconn,$queryairline);
		return @mysql_result($queryairline,0,"name");
	} else if ($exit == "all") {	
		$queryairline = "SELECT callsign FROM nav_airlines WHERE icao='".$airline."'";
		$queryairline = mysqlexec($sqlconn,$queryairline);
		return @mysql_result($queryairline,0,"callsign")." ".$number;
	}
}

/*========================================================================
 Function: aircraftname
    Usage: Returns aircrafts's full name or ICAO from the IATA code.
Arguments:
	$iata - Aircraft's IATA code
	$exit - Method of data's return (e.g., for M1F):
            > icao - MD11
			> name - McDonnell-Douglas MD-11F
========================================================================*/
function aircraftname($iata,$exit="icao") {

	// SQL Pointer is a global variable
	global $sqlconn;
	
	$queryaircraft = "SELECT icao,name FROM nav_aircrafts WHERE iata='".$iata."'";
	$queryaircraft = mysqlexec($sqlconn,$queryaircraft);
	
	if ($exit == "icao") {
		return @mysql_result($queryaircraft,0,"icao");
	} else if ($exit == "name") {
		return @mysql_result($queryaircraft,0,"name");
	}
}

/*========================================================================
 Function: getCountry
    Usage: Returns a flag of the country where the airport is in.
Arguments:
	$icao - Airfield's ICAO name
========================================================================*/
function getCountry($icao,$place="norm",$size="48",$path="short") {

	global $_SERVER;
	
	// Get information data from text file and parse it
	if ($place == "norm") {
		$page = file_get_contents("cprefix.txt");
	} else if ($place == "alt") {
		$page = file_get_contents("phpinc/cprefix.txt");
	}
	$page = explode("\n",$page);
	
	// Known exceptions:
	if ($icao == "WBSB") { return "<img src=\"flags/".$size."/BN.png\"/>"; }
	if ($icao == "NFFN") { return "<img src=\"flags/".$size."/FJ.png\"/>"; }
	if ($icao == "HSSJ") { return "<img src=\"flags/".$size."/SS.png\"/>"; }
	if ($icao == "PGUM") { return "<img src=\"flags/".$size."/GU.png\"/>"; }
	if ($icao == "PGUA") { return "<img src=\"flags/".$size."/GU.png\"/>"; }
	if ($icao == "PTRO") { return "<img src=\"flags/".$size."/PW.png\"/>"; }
	
	// Goes through the list of prefixes...
	foreach ($page as $line) {
	
		$country = explode(":",$line);
		
		// ...and finds a combination.
		if ($country[0] == substr($icao,0,2)) {
			// If found, returns the flag AS IMAGE.
			if ($path == "short") {
				return "<img src=\"flags/".$size."/".$country[1].".png\"/>";
			} else if ($path == 'full') {
				$baseuri = explode("/",$_SERVER['SCRIPT_NAME']);
				array_pop($baseuri);	array_pop($baseuri);
				return "http://".$_SERVER['SERVER_NAME'].implode("/",$baseuri)."/flags/".$size."/".$country[1].".png";
			}
		} else {
			// If not found, continue in the iteration.
			continue;
		}

			// If no match at all, returns a IMAGE with a question mark.
			if ($path == "short") {
				return "<img src=\"flags/".$size."/_unknown.png\"/>";
			} else if ($path == "full") {
				$baseuri = explode("/",$_SERVER['SCRIPT_NAME']);
				array_pop($baseuri);	array_pop($baseuri);
				return "http://".$_SERVER['SERVER_NAME'].implode("/",$baseuri)."/flags/".$size."/_unknown.png\"/>";
			}
		
	}
	
}

/*========================================================================
 Function: getOnlinePos
    Usage: See if the member is logged in with the event's callsign or don't.
Arguments:
	 $vid - Member's VID
	$exit - Event's callsign
========================================================================*/
function getOnlinePos($vid,$callsign) {

// Get the WhazzUp feed and parse it.
$whazzupfeed  = file_get_contents('http://www.vkzmp.com/whazzup/whazzup.txt');
$whazzuparray = explode("\n",$whazzupfeed);

$avoiddata = true;
foreach ($whazzuparray as $linefeed) {

	// Starts pickind details when in clients section.
	if ($linefeed == "!CLIENTS") {
		$avoiddata = false;
	}
	
	if ($avoiddata) {
		continue;
	} else {
		// If the VID is online and is a pilot, gets the online line and breaks off the foreach.
		if ((strpos($linefeed, ":".$vid.":") != 0) AND (strpos($linefeed, ":PILOT:") != 0)) {
			$onlineline = $linefeed;
			break;
		} else {
			continue;
		}
	}
	
}

// If the pilot is online...
if (!empty($onlineline)) {
	// ...check the callsign.
	$actualcallsign = explode(":",$onlineline);
	$actualcallsign = $actualcallsign[0];
	
	// If the callsign is the same of the event...
	if ($actualcallsign == $callsign) {
		// ...the pilot is shown online.
		return '<img src="images/online.png"/> <span style="color: #006307;">Online</span>';
	} else {
		// Else the pilot is shown online, but gray.
		return '<img src="images/online1.png"/> <span style="color: #7c7c7c;">Online</span>';
	}
} else {
	// If the pilot is offline, show it offline.
	return '<img src="images/offline.png"/> <span style="color: #e40000;">Offline</span>';
}

}

/*========================================================================
 Function: getOnlineDetails
    Usage: Get details of the pilot when online
Arguments:
	 $vid - Member's VID
========================================================================*/
function getOnlineDetails($vid) {

// Get the WhazzUp feed and parse it.
$whazzupfeed  = file_get_contents('http://www.vkzmp.com/whazzup/whazzup.txt');
$whazzuparray = explode("\n",$whazzupfeed);

$avoiddata = true;
foreach ($whazzuparray as $linefeed) {

	// Starts pickind details when in clients section.
	if ($linefeed == "!CLIENTS") {
		$avoiddata = false;
	}
	
	if ($avoiddata) {
		continue;
	} else {
		// If the VID is online and is a pilot, gets the online line and breaks off the foreach.
		if ((strpos($linefeed, ":".$vid.":") != 0) AND (strpos($linefeed, ":PILOT:") != 0)) {
			$onlineline = $linefeed;
			break;
		} else {
			continue;
		}
	}
	
}

// If the pilot is online...
if (!empty($onlineline)) {
	// ...return the details of his flight as an array.
	$detailsonline = explode(":",$onlineline);
	$detailsonline["STATUS"]="online";
	return $detailsonline;
} else {
	// Else, return the status to the system.
	$detailsonline["STATUS"]="offline";
	return $detailsonline;
}

}

/*========================================================================
 Function: decimal_distance
    Usage: Calculates the decimal distance between two coordinates.
Arguments:
	 $lat1, $lon1 - Coordinates of the point 1 (in decimal degrees)
	 $lat2, $lon2 - Coordinates of the point 2 (in decimal degrees)
========================================================================*/
function decimal_distance($lat1="",$lon1="",$lat2="",$lon2="") {
//$radius is determined using the following formula
//(360 degrees)*(60 minutes per degree)*(1.852) km per minute
//give a circumference of 40003.2 km
//radius is circumference/(2*pi) which gives us 6637km or 3956miles
$radius=3437.7467707849392526078892888461;
$lat1 = deg2rad ($lat1);
$lat2 = deg2rad ($lat2);
$lon1 = deg2rad ($lon1);
$lon2 = deg2rad ($lon2);
//Haversine Formula (from R.W. Sinnott, "Virtues of the Haversine",
//Sky and Telescope, vol. 68, no. 2, 1984, p. 159):
$dlon=$lon2-$lon1;
$dlat=$lat2-$lat1;
$sinlat=sin($dlat/2);
$sinlon=sin($dlon/2);
$a=($sinlat*$sinlat)+cos($lat1)*cos($lat2)*($sinlon*$sinlon);
$c=2*asin(min(1,sqrt($a)));
$d=$radius*$c;
//
return round($d,2);
}

/*========================================================================
 Function: flighttime
    Usage: Calculates the estimated flight time, based in the aircraft's performance.
Arguments:
	 $orgn - Origin of the flight
	 $dest - Destination of the flight
	 $acft - Aircraft used
========================================================================*/
function flighttime($orgn,$dest,$acft) {

	// SQL Pointer is a global variable
	global $navdatabase,$rfedatabase,$sqlconn;

	// Pick up LatLon of each airfield
	change_db($sqlconn,$navdatabase);
	$queryorig = "SELECT Latitude,Longtitude FROM airports WHERE ICAO='".$orgn."'";
	$queryorig = mysqlexec($sqlconn,$queryorig);
	$querydest = "SELECT Latitude,Longtitude FROM airports WHERE ICAO='".$dest."'";
	$querydest = mysqlexec($sqlconn,$querydest);
	change_db($sqlconn,$rfedatabase);
	// Pick up average speed of the aircraft
	$queryacft = "SELECT speed FROM nav_aircrafts WHERE iata='".$acft."'";
	$queryacft = mysqlexec($sqlconn,$queryacft);
	
	$speed = mysql_result($queryacft,0,'speed');
	
	if (empty($speed)) {
		$query = "SELECT speed FROM nav_aircrafts WHERE icao='".$acft."'";
		$query = mysqlexec($sqlconn,$query);
		
		if (empty($speed)) {
			$spd = 250;
		} else {
			$spd = mysql_result($query,0,'speed');
		}
	} else {
		$spd = mysql_result($queryacft,0,'speed');
	}
	
	$flightdistance = decimal_distance(mysql_result($queryorig,0,'Latitude'),mysql_result($queryorig,0,'Longtitude'),mysql_result($querydest,0,'Latitude'),mysql_result($querydest,0,'Longtitude'));
	//$flighttime     = ($flightdistance/mysql_result($queryacft,0,'speed'));
	$flighttime = ($flightdistance/$spd)+0.3; // 20 min added as climb/descent.
	$timeHours = floor($flighttime);
	$timeMinutes = $flighttime-$timeHours;
	$timeMinutes = round($timeMinutes*60);
	return sprintf("%02.0f",$timeHours).sprintf("%02.0f",$timeMinutes);
}

/*========================================================================
 Function: timeOperation
    Usage: Performs an operation in the time.
Arguments:
	 $time  - Original time
	 $drtn  - Duration to be added/subtracted
	 $oprtn - Operation to be done (+ or -).
========================================================================*/
function timeOperation($time,$drtn,$oprtn) {
	$timeHour = substr($time,0,2);
	$timeMins = substr($time,2,2);
	$drtnHour = substr($drtn,0,2);
	$drtnMins = substr($drtn,2,2);
	
	if ($oprtn == "add") {
		$newHour = $timeHour+$drtnHour;
		$newMins = $timeMins+$drtnMins;

		if ($newMins >= 60) { $newMins -= 60; $newHour+=1; }
		if ($newHour >= 24) { $newHour -= 24; }
	} else if ($oprtn == "diff") {
		$newHour = $timeHour-$drtnHour;
		$newMins = $timeMins-$drtnMins;
		
		if ($newMins < 0) { $newMins += 60; $newHour-=1; }
		if ($newHour <= 0) { $newHour += 24; }
		if ($newHour == 24) { $newHour -= 24; }
	}	
	
	return sprintf("%02.0f",$newHour).sprintf("%02.0f",$newMins);
}

/*========================================================================
 Function: getMap
    Usage: Retrieve a Google Map in the point of the airfield.
Arguments:
	 $icao - ICAO code of the airport
========================================================================*/
function getMap($icao) {

	// SQL Pointer is a global variable
	global $navdatabase,$rfedatabase,$sqlconn;

	change_db($sqlconn,$navdatabase);
	$sql = "SELECT Latitude,Longtitude,Elevation FROM Airports WHERE ICAO='$icao'";
	$res = mysqlexec($iddata,$sql);
	change_db($sqlconn,$rfedatabase);

	$latitud   = mysql_result($res,0,0);
	$longitud  = mysql_result($res,0,1);

	echo "<iframe width='530' height='250' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://maps.google.com.br/?ie=UTF8&amp;hq=&amp;ll=$latitud,$longitud&amp;spn=0.04753,0.076818&amp;t=k&amp;z=13&amp;vpsrc=6&amp;output=embed'></iframe>";
}

/*========================================================================
 Function: getDetailsAD
    Usage: Retrieve details of the airfield.
Arguments:
	 $icao - ICAO code of the airport
========================================================================*/
function getDetailsAD($icao) {

	// SQL Pointer is a global variable
	global $navdatabase,$rfedatabase,$sqlconn;

	change_db($sqlconn,$navdatabase);
	$sql = "SELECT Latitude,Longtitude,Elevation FROM Airports WHERE ICAO='$icao'";
	$res = mysqlexec($iddata,$sql);
	change_db($sqlconn,$rfedatabase);

	$latitud   = mysql_result($res,0,0);
	$longitud  = mysql_result($res,0,1);
	$elevation = mysql_result($res,0,2);

	echo '<table class="table table-bordered table-condensed table-striped">';
	//echo '<table class="table table-condensed">';
	echo '<tr><th>Coordinates</th><td colspan="3">'.DECtoDMS($latitud,"Lat").', '.DECtoDMS($longitud,"Lon").' ('.sprintf('%2.6f',$latitud).', '.sprintf('%3.6f',$longitud).')</td></tr>';
	echo '<tr><th>Elevation</th><td colspan="3">'.$elevation.' ft ('.bcmul($elevation,0.3048,0).' m)</td></tr>';
	echo '<tr><th>DMG</th><td colspan="3">'.getDMG($latitud,$longitud).'</td></tr>';
	//echo '</table>';

	change_db($sqlconn,$navdatabase);
	$sql = "SELECT rwy.Ident,rwy.TrueHeading,rwy.Length,rwy.Width,rwy.Surface,ils.ident,ils.category,ils.Freq,ils.HasDME
			FROM Airports AS apt
			LEFT JOIN Runways AS rwy ON rwy.AirportID = apt.ID
			LEFT JOIN ILSes AS ils ON ils.RunwayID = rwy.ID
			WHERE apt.ICAO = '".$icao."' ORDER BY rwy.Ident";
	$res = mysqlexec($iddata,$sql);
	change_db($sqlconn,$rfedatabase);

	//echo '<table class="table table-bordered table-condensed table-striped">';
	echo '<tr><th colspan=4 style="background: #d4d4d4;"><center>Runways</center></th></tr>';
	echo "<tr><th style='text-align: center;'>ID</th><th style='text-align: center;'>Dimensions</th><th style='text-align: center;'>Surface</th><th style='text-align: center;'>ILS</th></tr>";

	for ($i=0;$i<mysql_num_rows($res);$i++) {
		echo "<tr><td style='text-align: center;vertical-align: middle;'>".mysql_result($res,$i,0)."</td><td style='text-align: center;vertical-align: middle;'>".mysql_result($res,$i,2)." ft X ".mysql_result($res,$i,3)." ft<br>".bcmul(mysql_result($res,$i,2),0.3048,0)." m X ".bcmul(mysql_result($res,$i,3),0.3048,0)." m</td><td style='text-align: center;vertical-align: middle;'>".mysql_result($res,$i,4)."</td>";
		$ils = mysql_result($res,$i,5);
		if (!(empty($ils))) {
			if (mysql_result($res,$i,6) == 0) {
				echo "<td style='text-align: center;vertical-align: middle;'>".$ils." (LOC) - ".bcdiv(dechex(mysql_result($res,$i,7)),"10000",3)."</td></tr>";
			} else {
				echo "<td style='text-align: center;vertical-align: middle;'>".$ils." (CAT ".mysql_result($res,$i,6).") - ".bcdiv(dechex(mysql_result($res,$i,7)),"10000",3)."</td></tr>";
			}
		} else {
			echo "<td style='text-align: center;vertical-align: middle;'>none</td></tr>";
		}
	}

	echo "</table>";

}

/*========================================================================
 Function: getDMG
    Usage: Retrieve DMG of a point.
Arguments:
	 $lat - Latitude of the point
	 $lon - Longitude of the point
========================================================================*/
function getDMG($lat,$lon,$saida="form") {
	$data = @file_get_contents("http://www.ngdc.noaa.gov/geomag-web/calculators/calculateDeclination?lat1=".$lat."&lon1=".$lon."&startYear=".gmDate("Y")."&startMonth=".gmDate("m")."&startDay=".gmDate("d")."&resultFormat=csv");
	$data = explode("\n",$data);
	$data = $data[14];
	$data = explode(",",$data);
	$data = $data[4];

	if ($saida == "form") {
		if ($data < 0) {
			$dir = "W";
			$data = bcmul($data,-1,1);
		} else {
			$dir = "E";
			$data = bcmul($data,1,1);
		}

		return $dir.$data;
	} else {
		return $data;
	}
}

/*========================================================================
 Function: DMStoDEC
    Usage: Convert DMS coordinate to decimal.
Arguments:
	 $dec - Degrees.
	 $min - Minutes.
	 $sec - Seconds.
========================================================================*/
function DMStoDEC($deg,$min,$sec) {
    return $deg+((($min*60)+($sec))/3600);
}    

/*========================================================================
 Function: DECtoDMS
    Usage: Convert decimal coordinate to DMS.
Arguments:
	  $dec - Decimal Degrees
	 $hemi - Hemisphere.
========================================================================*/
function DECtoDMS($dec,$hemi) {
	if ($hemi == "Lat") {
		if (substr($dec,0,1) == "-") {	
			$dec=substr($dec,1,strlen($dec));
			$pos = "S";
		} else {
			$pos = "N";
		}
		
		$vars = explode(".",$dec);
		$deg = $vars[0];
		$tempma = "0.".$vars[1];

		$tempma = $tempma * 3600;
		$min = floor($tempma / 60);
		$sec = floor($tempma - ($min*60));

		return sprintf("%s%02d° %02d' %02d\"",$pos,$deg,$min,$sec);
	}
	
	if ($hemi == "Lon") {
		if (substr($dec,0,1) == "-") {	
			$dec=substr($dec,1,strlen($dec));
			$pos = "W";
		} else {
			$pos = "E";
		}
		
		$vars = explode(".",$dec);
		$deg = $vars[0];
		$tempma = "0.".$vars[1];

		$tempma = $tempma * 3600;
		$min = floor($tempma / 60);
		$sec = floor($tempma - ($min*60));

		return sprintf("%s%03d° %02d' %02d\"",$pos,$deg,$min,$sec);
	}
} 
?>