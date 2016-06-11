<?php
// FUNCTIONS
function loadMETAR($icao) {

	$i = 0;
	do  {
		$metar = @file_get_contents("ftp://tgftp.nws.noaa.gov/data/observations/metar/stations/$icao.TXT");
		$i++;
	} while ((empty($metar)) AND ($i <= 5));

	if (empty($metar)) {
		return "No message retrieved";
	} else {
		return preg_replace('!\s+!', ' ', strstr($metar,$icao));
	}

}

function loadTAF($icao) {

	$i = 0;
	do  {
		$taf = @file_get_contents("ftp://tgftp.nws.noaa.gov/data/forecasts/taf/stations/$icao.TXT");
		$i++;
	} while ((empty($taf) AND ($i <= 5)));

	if (empty($taf)) {
		return "No message retrieved";
	} else {
		return strtr(strstr($taf,$icao),"\n","");
	}

}

function getAirportInfo($icao){
	$site = @file_get_contents('http://www.ourairports.com/airports/'.$icao.'/pilot-info.html');
	if (isset($site)) {
		$getname1 = explode('<div id="general">', $site);
		$getname2 = explode('</h2>',$getname1[1]);
		$getname3 = explode('<h2>General information for',$getname2[0]);
		$getcodes1 = explode('Airport codes:</span> ', $site);
		$getcodes2 = explode('<br />', $getcodes1[1]);
		$getservices1 = explode('>Serves:</span> ', $site);
		$getservices2 = explode('<br />', $getservices1[1]);
		$services = explode(',', $getservices2[0]);
		$getlatpos1 = explode('Latitude:</span> ', $site);
		$getlatpos2 = explode(' <span', $getlatpos1[1]);
		$aiplat = $getlatpos2[0];
		$getlonpos1 = explode('Longitude:</span> ', $site);
		$getlonpos2 = explode(' <span', $getlonpos1[1]);
		$aiplon = trim($getlonpos2[0]);
		$getelev1 = explode('Field elevation:</span> ', $site);
		$getelev2 = explode('<br />', $getelev1[1]);
		$aipelev = explode('&#', $getelev2[0]);
		$getdmg1 = explode('Magnetic variation:</span> ', $site);
		$getdmg2 = explode('<br />', $getdmg1[1]);
		$aipdmg = explode('&deg;', $getdmg2[0]); $aipdmg = round($aipdmg[0]).$aipdmg[1];
		if (substr($aipdmg,-1) == "W") {
			$aipdmg = substr($aipdmg,0,-1);
		} else {
			$aipdmg = (-1)*substr($aipdmg,0,-1);
		}
		$getpos1 = explode('Longitude:</span> ', $site);
		$getlonpos2 = explode(' <span', $getlonpos1[1]);
		$aiplon = trim($getlonpos2[0]);
		$aipelev = trim(str_replace(",","",$aipelev[0]))." ft";

		if (count($services) == 3) {
			$city = utf8_decode(trim($services[0]));
			$state = utf8_decode(trim($services[1]));
			$country = utf8_decode(trim($services[2]));
		} else if (count($services) == 2) {
			$city = utf8_decode(trim($services[0]));
			$state = null;
			$country = utf8_decode(trim($services[1]));
		} else if (count($services) == 1) {
			$city = null;
			$state = null;
			$country = utf8_decode(trim($services[0]));
		}

		$aipname = utf8_decode(trim($getname3[1]));
		$aipname = trim(str_replace("Airport","",$aipname));
		$aipname = trim(str_replace("International","Intl",$aipname));
		$codes = explode(' ', $getcodes2[0]);
		$iata = trim($codes[0]);
		$icao = trim($codes[1]);
		$final = array("Name" => $aipname,
						 "IATA" => $iata,
						 "ICAO" => $icao,
						 "City" => $city,
						 "State/Province" => $state,
						 "Country" => $country,
						 "Latitude" => $aiplat,
						 "Longitude" => $aiplon,
						 "Elevation" => $aipelev,
						 "DMG" => $aipdmg);
		return $final;
	}
}

function relativeHumidity($temperature,$dewpoint) {
	return 100*bcpow(((112-0.1*$temperature+$dewpoint)/(112+0.9*$temperature)),8,2);
}

function metarParse($metar) {
	//========================================================================================
	// Parsing the METAR for TTS reading
	//========================================================================================
	// Verifying the existence of TEMPO or BECMG sections.
	if (strpos($metar,"TEMPO")) {
		// TEMPO is existent
		$rawmetar   = explode("TEMPO",$metar);
		$validmetar = $rawmetar[0];
		$tempometar = $rawmetar[1];
		$metarparse = explode(" ",trim($validmetar));
	} else if (strpos($metar,"BECMG")) {
		// BECMG is existent
		$rawmetar   = explode("BECMG",$metar);
		$validmetar = $rawmetar[0];
		$becmgmetar = $rawmetar[1];
		$metarparse = explode(" ",trim($validmetar));
	} else {
		// None of them exists
		$metarparse = explode(" ",$metar);
	}

	// Working with the METAR before TEMPO or BECMG.
	foreach ($metarparse as $metarvalue) {
		// Automatic Weather Observation Station (AWOS)
		if (preg_match('/^(AUTO)$/',trim($metarvalue))) {
			$automaticmetar = trim($metarvalue)." ";
		}
		// Wind
		if (preg_match('/^([0-9G]{5,10}|VRB[0-9]{1,2})(KT|MPS)/',trim($metarvalue))) {
			$winddirection = substr($metarvalue,0,3);
			$windspeed     = substr($metarvalue,3,2);
			$gustingpos    = strpos($metarvalue,"G");
			if (!empty($gustingpos)) {
				$windgust  = substr($metarvalue,strpos($metarvalue,"G")+1,2);
			}
			$windunit     = substr($metarvalue,-2,2);
		}
		// Wind Variation
		if (preg_match('/^([0-9]{3}(V)[0-9]{3})$/',trim($metarvalue))) {
			$windvariation = trim($metarvalue)." ";
		}
		// Visibility (and Sectors)
		if (preg_match('/^([0-9]{4})$|^(([0-9]{4})(N|NE|E|SE|S|SW|W|NW))$|^(P)?((([0-9]{1,2}.[0-9]{1,3})|([0-9]{1,2}))SM$)$/',trim($metarvalue))) {
			$visibility .= trim($metarvalue)." ";
		}
		if (preg_match('/^(CAVOK)$/',trim($metarvalue))) {
			$visibility  = "CAVOK";
		}
		// RVR
		if (preg_match('/^(R)([0-9]{2})(L|C|R)?\/(((P|M)?[0-9]{4}(FT)?|([0-9]{4}V[0-9]{4}))(FT)?(N|U|D)?)$/',trim($metarvalue))) {
			$rvr .= trim($metarvalue)." ";
		}
		// Weather Phenomena
		if (preg_match('/^(VC)?(-|\+)?(MI|PR|BC|DR|BL|SH|TS|FZ)?((DZ|RA|SN|SG|IC|PL|GR|GS|UP)+)?(BR|FG|FU|VA|DU|SA|HZ|PY)?(PO|SQ|FC|SS)?$/',trim($metarvalue))) {
			$phenomena .= $metarvalue." ";
		}
		// Ceiling (cloud coverage)
		if (preg_match('/^(((FEW|SCT|BKN|OVC)([0-9]{3}|\/\/\/))|(VV)[0-2]{3}|(NSC|SKC))/',trim($metarvalue))) {
			$ceiling .= $metarvalue." ";
		}
		// Temperature and Dewpoint
		if (preg_match('/^(M)?([0-9]{2}|\/\/)\/(M)?([0-9]{2}|\/\/)$/',trim($metarvalue))) {
			$arraytemp   = explode("/",$metarvalue);
			$temperature = str_replace("M","-",$arraytemp[0]);
			$dewpoint    = str_replace("M","-",$arraytemp[1]);
		}
		// Altimeter
		if (preg_match('/^(A|Q)([0-9]{4})/',trim($metarvalue))) {
			$altimeter = $metarvalue;
		}
		// NOSIG
		if (preg_match('/^(NOSIG)$/',trim($metarvalue))) {
			$nosig = $metarvalue;
		}
	}
		$metarfinal = array("winddirection" => $winddirection,
						 "windspeed" => trim($windspeed),
						 "windgust" => trim($windgust),
						 "windunit" => trim($windunit),
						 "visibility" => trim($visibility),
						 "phenomena" => trim($phenomena),
						 "ceiling" => trim($ceiling),
						 "temperature" => trim($temperature),
						 "dewpoint" => trim($dewpoint),
						 "altimeter" => trim($altimeter));
		return $metarfinal;
}
?>