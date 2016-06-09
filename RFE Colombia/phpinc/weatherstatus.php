<?php

include("func_mysqlexec.php");
change_db($sqlconn,$navdatabase);

/*
    attempt to create an image containing the error message given. 
    if this works, the image is sent to the browser. if not, an error
    is logged, and passed back to the browser as a 500 code instead.
*/
function fatal_error($message) {
	// send an image
	if(function_exists('ImageCreate')) {
		$width = ImageFontWidth(5) * strlen($message) + 10 ;
		$height = ImageFontHeight(5) + 10 ;
		if($image = ImageCreate($width,$height)) {
			$background = ImageColorAllocate($image,255,255,255) ;
			$text_color = ImageColorAllocate($image,0,0,0) ;
			ImageString($image,5,5,5,$message,$text_color) ;    
			header('Content-type: image/png') ;
			ImagePNG($image) ;
			ImageDestroy($image) ;
			exit ;
		}
	}
	// send 500 code
	header("HTTP/1.0 500 Internal Server Error") ;
	print($message) ;
	exit ;
}


/* 
    decode an HTML hex-code into an array of R,G, and B values.
    accepts these formats: (case insensitive) #ffffff, ffffff, #fff, fff 
*/    
function hex_to_rgb($hex) {
	// remove '#'
	if(substr($hex,0,1) == '#')
		$hex = substr($hex,1) ;

	// expand short form ('fff') color to long form ('ffffff')
	if(strlen($hex) == 3) {
		$hex = substr($hex,0,1) . substr($hex,0,1) .
		substr($hex,1,1) . substr($hex,1,1) .
		substr($hex,2,1) . substr($hex,2,1) ;
	}

	if(strlen($hex) != 6)
		fatal_error('Error: Invalid color "'.$hex.'"') ;

	// convert from hexidecimal number systems
	$rgb['red'] = hexdec(substr($hex,0,2)) ;
	$rgb['green'] = hexdec(substr($hex,2,2)) ;
	$rgb['blue'] = hexdec(substr($hex,4,2)) ;

	return $rgb ;
}

function reciprocalRunway($rwy) {
	list($rwynumber,$letter) = preg_split( '/([a-z]+)/i', $rwy, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
	
	if ($rwynumber >= 1 && $rwynumber <= 18) {
		$recrwynumber = $rwynumber+18;
	} else {
		$recrwynumber = $rwynumber-18;
	}
	
	if (isset($letter)) {
		switch($letter) {
			case "L":
				$recletter = "R";
				break;
			case "R":
				$recletter = "L";
				break;
			case "C":
				$recletter = "C";
				break;
		}
	}
	
	return sprintf("%02d",$recrwynumber).$recletter;
}

// FUNCTIONS
function loadMETAR($icao) {

	$i = 0;
	do  {
		$metar = @file_get_contents("ftp://tgftp.nws.noaa.gov/data/observations/metar/stations/$icao.TXT");
		$i++;
	} while ((empty($metar)) AND ($i <= 5));

	if (empty($metar)) {
		return "NONE";
	} else {
		return preg_replace('!\s+!', ' ', strstr($metar,$icao));
	}

}

function loadTAF($icao) {

	$i = 0;
	do  {
		$taf = @file_get_contents("ftp://tgftp.nws.noaa.gov/data/forecasts/taf/stations/$icao.TXT");
		$i++;
	} while ((empty($taf)) AND ($i <= 5));

	if (empty($taf)) {
		return "NONE";
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
			if ($windunit == "PS") $windunit = "MPS";
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
		if (preg_match('/^(((FEW|SCT|BKN|OVC)([0-9]{3}|\/\/\/))|(VV)[0-2]{3}|(NSC|SKC|CLR))/',trim($metarvalue))) {
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
			$altimeter = str_replace("=","",$metarvalue);
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
						 "windvariation" => trim($windvariation),
						 "visibility" => trim($visibility),
						 "phenomena" => trim($phenomena),
						 "ceiling" => trim($ceiling),
						 "temperature" => trim($temperature),
						 "dewpoint" => trim($dewpoint),
						 "altimeter" => trim($altimeter));
		return $metarfinal;
}

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
				return "flags/".$size."/".$country[1].".png";
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
				return "flags/".$size."/_unknown.png";
			} else if ($path == "full") {
				$baseuri = explode("/",$_SERVER['SCRIPT_NAME']);
				array_pop($baseuri);	array_pop($baseuri);
				return "http://".$_SERVER['SERVER_NAME'].implode("/",$baseuri)."/flags/".$size."/_unknown.png\"/>";
			}
		
	}
	
}

//============================================================
// CUSTOM VARIABLES
//============================================================
$font_file_1    = '../font/TAHOMA.TTF';
$font_file_2    = '../font/ARIALN.TTF';
$font_file_3    = '../font/ARIALNB.TTF';
$font_color_1   = '#000000' ;
$runway_color   = '#7d7d7d' ;
$c_rose_color   = '#eeeeee' ;
$dims_color     = '#ffff00' ;
$barb_color     = '#ee0000' ;
$gust_color     = '#990000' ;
$red            = '#ff0000' ;
$var_barb_color = '#095615' ;
$var_barb_bg    = '#EDF2ED' ;
$image_width    = 400;
$image_width_normal = 400;
$image_width_large  = 600;
$image_height   = 460;
$rose_center_x  = 200;
$rose_center_y  = 226;
$radius         = 150;
// Entry Variable
$icao           = $_GET["icao"];
$rwyidentquery  = $_GET["rwy"];
$rwyident[0]    = $rwyidentquery;
$rwyident[1]    = reciprocalRunway($_GET["rwy"]);
asort($rwyident);

//============================================================
// INITIAL SQL QUERY
//============================================================
if (empty($icao))
	fatal_error('Error: No ICAO code filled');
if (empty($rwyidentquery))
	fatal_error('Error: No Runway filled');

$query = "SELECT rwy.Ident,rwy.TrueHeading,rwy.Length,rwy.Width,apt.Name FROM runways AS rwy
			 LEFT JOIN airports AS apt ON apt.ID = rwy.AirportID
			 WHERE apt.ICAO = '".$icao."'
			 AND ident = '".$rwyidentquery."'";
$query = mysqlexec($sqlconn,$query);
$queryn = mysql_num_rows($query);

if ($queryn == 0)
	fatal_error('Error: Runway '.$rwyidentquery.' is invalid for '.$icao);

//============================================================
// BUFFER AND HEADER INFORMATION
//============================================================
$mime_type          = 'image/png' ;
$extension          = '.png' ;
$s_end_buffer_size  = 4096 ;
// check for GD support
if(!function_exists('ImageCreate'))
    fatal_error('Error: Server does not support PHP image generation') ;
	 
//============================================================
// GET METEOROLOGICAL INFORMATION
//============================================================
$metar     = loadMETAR($icao);
$aptinfo   = getAirportInfo($icao);
$metardata = metarParse($metar);

$winddir   = $metardata['winddirection'];
$dmg       = $aptinfo['DMG'];

//============================================================
// IMAGE CREATION AND PROPERTIES
//============================================================
$image =  imagecreatetruecolor($image_width, $image_height);
//imageantialias($image, true);
imagealphablending($image, true);

//============================================================
// COLOR ALLOCATION
//============================================================
$bg_white = ImageColorAllocate($image,255,255,255);
$bg_black = ImageColorAllocate($image,0,0,0);

$font_rgb = hex_to_rgb($runway_color);
$runway_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
$font_rgb = hex_to_rgb($c_rose_color);
$c_rose_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
$font_rgb = hex_to_rgb($barb_color);
$barb_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
$font_rgb = hex_to_rgb($gust_color);
$gust_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
$font_rgb = hex_to_rgb($red);
$red = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
$font_rgb = hex_to_rgb($var_barb_color);
$var_barb_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
$font_rgb = hex_to_rgb($var_barb_bg);
$var_barb_bg = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
$font_rgb = hex_to_rgb($dims_color);
$dims_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);
$font_rgb = hex_to_rgb($font_color_1);
$font_color_1 = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']) ;

// Transparent Background
/*imagealphablending($image, false);
$transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparency);
imagesavealpha($image, true);*/

//============================================================
// DRAWING: BACKGROUND
//============================================================
ImageFill ($image,0,0,$black);
ImageFilledRectangle ($image,1,1, $image_width-2 ,$image_height-2 ,$bg_white);


//============================================================
// DRAWING: FLAG
//============================================================
$flag =  "../".getCountry($icao,"norm",48);
$flag = imagecreatefrompng($flag);

$insert_x = imagesx($flag);
$insert_y = imagesy($flag);

imagecopy($image,$flag,0,-7,0,0,$insert_x,$insert_y);

//============================================================
// DRAWING: TITLE - ICAO CODE AND AIRPORT NAME
//============================================================
$name = $icao." - ".mysql_result($query,0,'Name');

$y_finalpos = 24;

$box_width = $image_width;
$box = @ImageTTFBBox(15,0,$font_file_1,$name);
$text_width = abs($box[2]-$box[0]);
$text_height = abs($box[5]-$box[3]);

$difference = $box_width - $text_width;
$put_text_x = ($difference)/2;

$put_text_y = $y_finalpos;

imagettftext($image, 15, 0, $put_text_x-1, $put_text_y-1, $bg_white, $font_file_1, $name);
imagettftext($image, 15, 0, $put_text_x-1, $put_text_y+1, $bg_white, $font_file_1, $name);
imagettftext($image, 15, 0, $put_text_x+1, $put_text_y-1, $bg_white, $font_file_1, $name);
imagettftext($image, 15, 0, $put_text_x+1, $put_text_y+1, $bg_white, $font_file_1, $name);
imagettftext($image, 15, 0, $put_text_x, $put_text_y, $font_color_1, $font_file_1, $name);

//============================================================
// DRAWING: SUBTITLE - RUNWAY INDICATION
//============================================================
$name = "Runway ".implode("/",$rwyident);

$y_finalpos = 49;

$box_width = $image_width;
$box = @ImageTTFBBox(13,0,$font_file_1,$name);
$text_width = abs($box[2]-$box[0]);
$text_height = abs($box[5]-$box[3]);

$difference = $box_width - $text_width;
$put_text_x = ($difference)/2;

$put_text_y = $y_finalpos;

imagettftext($image, 13, 0, $put_text_x, $put_text_y, $font_color_1, $font_file_1, $name);

//imagestring($image, 5, 100, 10, $icaocode, $bg_black);

//============================================================
// DRAWING: COMPASS ROSE
//============================================================
// Compass Rose
imagefilledpolygon($image, array($rose_center_x,$rose_center_y, $rose_center_x,$rose_center_y-$radius, $rose_center_x+$radius*0.21,$rose_center_y-$radius*0.21),3,$c_rose_color);
imagepolygon($image, array($rose_center_x,$rose_center_y, $rose_center_x+$radius,$rose_center_y, $rose_center_x+$radius*0.21,$rose_center_y-$radius*0.21),3,$c_rose_color);
imagefilledpolygon($image, array($rose_center_x,$rose_center_y, $rose_center_x+$radius,$rose_center_y, $rose_center_x+$radius*0.21,$rose_center_y+$radius*0.21),3,$c_rose_color);
imagepolygon($image, array($rose_center_x,$rose_center_y, $rose_center_x,$rose_center_y+$radius, $rose_center_x+$radius*0.21,$rose_center_y+$radius*0.21),3,$c_rose_color);
imagefilledpolygon($image, array($rose_center_x,$rose_center_y, $rose_center_x,$rose_center_y+$radius, $rose_center_x-$radius*0.21,$rose_center_y+$radius*0.21),3,$c_rose_color);
imagepolygon($image, array($rose_center_x,$rose_center_y, $rose_center_x-$radius,$rose_center_y, $rose_center_x-$radius*0.21,$rose_center_y+$radius*0.21),3,$c_rose_color);
imagefilledpolygon($image, array($rose_center_x,$rose_center_y, $rose_center_x-$radius,$rose_center_y, $rose_center_x-$radius*0.21,$rose_center_y-$radius*0.21),3,$c_rose_color);
imagepolygon($image, array($rose_center_x,$rose_center_y, $rose_center_x,$rose_center_y-$radius, $rose_center_x-$radius*0.21,$rose_center_y-$radius*0.21),3,$c_rose_color);

//============================================================
// DRAWING: RUNWAY
//============================================================
$course = mysql_result($query,0,'TrueHeading')+$dmg;
$new_x  =  ceil($rose_center_x+cos(deg2rad($course-90))*$radius);
$new_y  = floor($rose_center_y+sin(deg2rad($course-90))*$radius);
$new_x2 =  ceil($rose_center_x-cos(deg2rad($course-90))*$radius);
$new_y2 = floor($rose_center_y-sin(deg2rad($course-90))*$radius);

$ptsrwy = array(ceil($new_x-cos(deg2rad($course))*8),floor($new_y-sin(deg2rad($course))*7),
					 ceil($new_x+cos(deg2rad($course))*7),floor($new_y+sin(deg2rad($course))*8),
					 ceil($new_x2+cos(deg2rad($course))*7),floor($new_y2+sin(deg2rad($course))*8),
					 ceil($new_x2-cos(deg2rad($course))*8),floor($new_y2-sin(deg2rad($course))*7),);
imagefilledpolygon($image, $ptsrwy, 4, $runway_color);

$strwidth  = ImageFontWidth(3) * strlen(reciprocalRunway($rwyidentquery)); $strheight = ImageFontHeight(3);
imagestring($image, 3, ceil($new_x-$strwidth/2+sin(deg2rad($course))*14), floor($new_y-$strheight/2-cos(deg2rad($course))*14), reciprocalRunway($rwyidentquery), $runway_color);

$strwidth  = ImageFontWidth(3) * strlen($rwyidentquery); $strheight = ImageFontHeight(3);
imagestring($image, 3, ceil($new_x2-$strwidth/2-sin(deg2rad($course))*14), floor($new_y2-$strheight/2+cos(deg2rad($course))*14), $rwyidentquery, $runway_color);

$style = array($bg_white, $bg_white, $bg_white, $bg_white, $bg_white, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
imagesetstyle($image, $style);
imageline($image, $new_x, $new_y, $new_x2, $new_y2, IMG_COLOR_STYLED);

/*if ($course >= 180) $course -= 180;
$name = bcmul(mysql_result($query,0,'Length'),0.3048,0)." m x ".bcmul(mysql_result($query,0,'Width'),0.3048,0)." m l ".mysql_result($query,0,'Length')." ft x ".mysql_result($query,0,'Width')." ft";
$x_finalpos = $rose_center_x;
$y_finalpos = $rose_center_y;
$box_width  = $radius;
$box = @ImageTTFBBox(10,$course-($course*2)+90,$font_file_1,$name);
$center_x = ($box[2]-$box[0])/2.0 + ($box[2]-$box[4])/2.0;
$center_y = ($box[3]-$box[1])/2.0 + ($box[7]-$box[1])/2.0;
$put_text_x = $x_finalpos-$center_x-ceil(sin(deg2rad($course))*5);
$put_text_y = $y_finalpos-$center_y+floor(cos(deg2rad($course))*5);
$put_text_x = $x_finalpos-$center_x;
$put_text_y = $y_finalpos-$center_y;
imagettftext($image, 10, $course-($course*2)+90, $put_text_x, $put_text_y, $dims_color, $font_file_1, $name);*/

/*
if ($course <= 180) $course += 180;
$name = mysql_result($query,0,'Length')." ft x ".mysql_result($query,0,'Width')." ft";
$x_finalpos = $rose_center_x;
$y_finalpos = $rose_center_y;
$box_width  = $radius;
$box = @ImageTTFBBox(9,$course-($course*2)+90,$font_file_1,$name);
$center_x = abs($box[2]-$box[0])/2.0 - abs($box[2]-$box[4])/2.0;
$center_y = abs($box[3]-$box[1])/2.0 + abs($box[7]-$box[1])/2.0;
$put_text_x = $x_finalpos+$center_x+sin(deg2rad($course))*4;
$put_text_y = $y_finalpos+$center_y+cos(deg2rad($course))*4;
imagettftext($image, 9, $course-($course*2)+90, $put_text_x, $put_text_y, $font_color_1, $font_file_1, $name);
*/

//============================================================
// DRAWING: VARIABLE WIND VARB
//============================================================
if (!empty($metardata['windvariation'])) {
	$firstangle  = substr($metardata['windvariation'],0,3);
	$secondangle = substr($metardata['windvariation'],-3,3);
	
	// First barb
	$angle = $firstangle+$dmg;
	$new_x =  ceil($rose_center_x+cos(deg2rad($angle-90))*$radius);
	$new_y = floor($rose_center_y+sin(deg2rad($angle-90))*$radius);

	$ptsarr = array(ceil($new_x-sin(deg2rad($angle))*12),floor($new_y+cos(deg2rad($angle))*12),
						 ceil($new_x -cos(deg2rad($angle))*8),floor($new_y-sin(deg2rad($angle))*7) ,
						 ceil($new_x+cos(deg2rad($angle))*7) ,floor($new_y+sin(deg2rad($angle))*8));
	imagefilledpolygon($image, $ptsarr, 3, $var_barb_color);
	
	$style = array($var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
	imagesetstyle($image, $style);
	imageline($image,$rose_center_x,$rose_center_y, ceil($new_x-sin(deg2rad($angle))*12), floor($new_y+cos(deg2rad($angle))*12), IMG_COLOR_STYLED);
	
	// Second barb
	$angle = $secondangle+$dmg;
	$new_x =  ceil($rose_center_x+cos(deg2rad($angle-90))*$radius);
	$new_y = floor($rose_center_y+sin(deg2rad($angle-90))*$radius);

	$ptsarr = array(ceil($new_x-sin(deg2rad($angle))*12),floor($new_y+cos(deg2rad($angle))*12),
						 ceil($new_x -cos(deg2rad($angle))*8),floor($new_y-sin(deg2rad($angle))*7) ,
						 ceil($new_x+cos(deg2rad($angle))*7) ,floor($new_y+sin(deg2rad($angle))*8));
	imagefilledpolygon($image, $ptsarr, 3, $var_barb_color);
	
	$style = array($var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
	imagesetstyle($image, $style);
	imageline($image,$rose_center_x,$rose_center_y, ceil($new_x-sin(deg2rad($angle))*12), floor($new_y+cos(deg2rad($angle))*12), IMG_COLOR_STYLED);
	
	// Arc
	
	//imagefilledarc($image,$rose_center_x,$rose_center_y,$radius*2 +4,$radius*2 +2,$firstangle+$dmg-90,$secondangle+$dmg-90,$var_barb_bg,IMG_ARC_PIE);
	
	for ($i=20;$i<=$radius*2;$i=$i+25) {
		$style = array($var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, $var_barb_color, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT, IMG_COLOR_TRANSPARENT);
		imagesetstyle($image, $style);
		imagearc($image,$rose_center_x,$rose_center_y,$i+4,$i+2,$firstangle+$dmg-90,$secondangle+$dmg-90,IMG_COLOR_STYLED);
	}

	
}

//============================================================
// DRAWING: MAIN WIND BARB
//============================================================
if ($winddir == '000' && $metardata['windspeed'] == '00') {
	imageellipse($image, $rose_center_x, $rose_center_y, $radius/1.5, $radius/1.5, $barb_color);
	$strwidth  = ImageFontWidth(5) * strlen("WIND CALM"); $strheight = ImageFontHeight(5);
	imagestring($image, 5, ceil($rose_center_x-$strwidth/2), floor($rose_center_y-$strheight/2), "WIND CALM", $barb_color);
} else if ($winddir == 'VRB') {
	imageellipse($image, $rose_center_x, $rose_center_y, $radius/0.85, $radius/0.85, $barb_color);
	$strwidth  = ImageFontWidth(5) * strlen("VARIABLE DIRECTION"); $strheight = ImageFontHeight(5);
	imagestring($image, 5, ceil($rose_center_x-$strwidth/2), floor($rose_center_y-$strheight/2), "VARIABLE DIRECTION", $barb_color);
} else {
	$angle = $winddir+$dmg;
	$new_x =  ceil($rose_center_x+cos(deg2rad($angle-90))*$radius);
	$new_y = floor($rose_center_y+sin(deg2rad($angle-90))*$radius);

	$ptsarr = array(ceil($new_x-sin(deg2rad($angle))*12),floor($new_y+cos(deg2rad($angle))*12),
						 ceil($new_x -cos(deg2rad($angle))*8),floor($new_y-sin(deg2rad($angle))*7) ,
						 ceil($new_x+cos(deg2rad($angle))*7) ,floor($new_y+sin(deg2rad($angle))*8));
	imagefilledpolygon($image, $ptsarr, 3, $barb_color);
	imageline($image,$rose_center_x,$rose_center_y, ceil($new_x-sin(deg2rad($angle))*12), floor($new_y+cos(deg2rad($angle))*12), $barb_color);
	
	if ($metardata['windspeed'] > 10) {
		$ptsarr = array(ceil($new_x-sin(deg2rad($angle))*24),floor($new_y+cos(deg2rad($angle))*24),
							 ceil($new_x -cos(deg2rad($angle))*8-sin(deg2rad($angle))*12),floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*12) ,
							 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*12) ,floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*12));
		imagefilledpolygon($image, $ptsarr, 3, $barb_color);
	}
	if ($metardata['windspeed'] > 20) {
		$ptsarr = array(ceil($new_x-sin(deg2rad($angle))*36),floor($new_y+cos(deg2rad($angle))*36),
							 ceil($new_x -cos(deg2rad($angle))*8-sin(deg2rad($angle))*24),floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*24) ,
							 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*24) ,floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*24));
		imagefilledpolygon($image, $ptsarr, 3, $barb_color);
	}
	if ($metardata['windspeed'] > 30) {
		$ptsarr = array(ceil($new_x-sin(deg2rad($angle))*48),floor($new_y+cos(deg2rad($angle))*48),
							 ceil($new_x -cos(deg2rad($angle))*8-sin(deg2rad($angle))*36),floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*36) ,
							 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*36) ,floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*36));
		imagefilledpolygon($image, $ptsarr, 3, $barb_color);
	}
	
	if (!empty($metardata['windgust'])) {
		if ($metardata['windspeed'] <= 10) {
			imageline($image, ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*12),floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*12), ceil($new_x+cos(deg2rad($angle))*7),floor($new_y+sin(deg2rad($angle))*8), $gust_color);
		} else if ($metardata['windspeed'] > 10 && $metardata['windspeed'] <= 20) {
			$ptsarr = array(ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*24), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*24) ,
							    ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*24), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*24) ,
							    ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*27), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*27) ,
								 ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*27), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*27));
			imagefilledpolygon($image, $ptsarr, 4, $gust_color);
			if ($metardata['windgust'] > 10) {
				$ptsarr = array(ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*29), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*29) ,
									 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*29), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*29) ,
									 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*32), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*32) ,
									 ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*32), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*32));
				imagefilledpolygon($image, $ptsarr, 4, $gust_color);
			}
		} else if ($metardata['windspeed'] > 20 && $metardata['windspeed'] <= 30) {
			$ptsarr = array(ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*36), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*36) ,
							    ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*36), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*36) ,
							    ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*39), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*39) ,
								 ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*39), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*39));
			imagefilledpolygon($image, $ptsarr, 4, $gust_color);
			if ($metardata['windgust'] > 10) {
				$ptsarr = array(ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*41), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*41) ,
									 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*41), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*41) ,
									 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*44), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*44) ,
									 ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*44), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*44));
				imagefilledpolygon($image, $ptsarr, 4, $gust_color);
			}
		} else if ($metardata['windspeed'] > 30 ) {
			$ptsarr = array(ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*48), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*48) ,
							    ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*48), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*48) ,
							    ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*51), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*51) ,
								 ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*51), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*51));
			imagefilledpolygon($image, $ptsarr, 4, $gust_color);
			if ($metardata['windgust'] > 10) {
				$ptsarr = array(ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*53), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*53) ,
									 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*53), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*53) ,
									 ceil($new_x+cos(deg2rad($angle))*7-sin(deg2rad($angle))*56), floor($new_y+sin(deg2rad($angle))*8+cos(deg2rad($angle))*56) ,
									 ceil($new_x-cos(deg2rad($angle))*8-sin(deg2rad($angle))*56), floor($new_y-sin(deg2rad($angle))*7+cos(deg2rad($angle))*56));
				imagefilledpolygon($image, $ptsarr, 4, $gust_color);
			}
		}
	}

	$windmsg = $metardata['windspeed'].$metardata['windunit'];

	$strwidth  = ImageFontWidth(3) * strlen($windmsg); $strheight = ImageFontHeight(3);
	imagestring($image, 3, ceil($new_x-$strwidth/2+sin(deg2rad($angle))*17), floor($new_y-$strheight/2-cos(deg2rad($angle))*12), $windmsg, $barb_color);
}

//============================================================
// DRAWING: COMPASS CARD
//============================================================
for ($angle=0;$angle<360;$angle++) {

	$new_x =  ceil($rose_center_x+cos(deg2rad($angle-90))*$radius);
	$new_y = floor($rose_center_y+sin(deg2rad($angle-90))*$radius);
	
	if (($angle % 90) == 0) {
		imageline($image, $new_x-sin(deg2rad($angle))*20,$new_y+cos(deg2rad($angle))*20, $new_x,$new_y , $black);
	} else if (($angle % 30) == 0) {
		imageline($image, $new_x-sin(deg2rad($angle))*15,$new_y+cos(deg2rad($angle))*15, $new_x,$new_y , $black);
	} else if (($angle % 10) == 0) {
		imageline($image, $new_x-sin(deg2rad($angle))*10,$new_y+cos(deg2rad($angle))*10, $new_x,$new_y , $black);
	} else if (($angle % 5) == 0) {
		imageline($image, $new_x-sin(deg2rad($angle))*5,$new_y+cos(deg2rad($angle))*5, $new_x,$new_y , $black);
	} /*else if (($angle % 1) == 0) {
		imageline($image, $new_x-sin(deg2rad($angle))*1,$new_y+cos(deg2rad($angle))*1, $new_x,$new_y , $c_rose_color);
	}*/
	
	if ($angle == 0) {
		imagestring($image, 4, $new_x-3-sin(deg2rad($angle))*25,$new_y+cos(deg2rad($angle))*25 , "N", $black);
	} else if ($angle == 90) {
		imagestring($image, 4, $new_x-8-sin(deg2rad($angle))*25,$new_y-8+cos(deg2rad($angle))*25 , "E", $black);
	} else if ($angle == 180) {
		imagestring($image, 4, $new_x-4-sin(deg2rad($angle))*25,$new_y-14+cos(deg2rad($angle))*25 , "S", $black);
	} else if ($angle == 270) {
		imagestring($image, 4, $new_x+3-sin(deg2rad($angle))*25,$new_y-8+cos(deg2rad($angle))*25 , "W", $black);
	} 
}

//============================================================
// DRAWING: FOOTER WEATHER ICON
//============================================================
if (($metardata["visibility"] == "CAVOK") OR ($metardata["ceiling"] == "NSC") OR ($metardata["ceiling"] == "SKC") OR ($metardata["ceiling"] == "CLR")) {
	$pictogram = "sunny";
	$pictogrammsg = "Clear";
} else if (strpos($metardata["phenomena"],"FG") !== false) {
	$pictogram = "fog";
	$pictogrammsg = "Foggy";
} else if ((strpos($metardata["phenomena"],"HZ") !== false) OR (strpos($metardata["phenomena"],"MI") !== false)) {
	$pictogram = "mist";
	$pictogrammsg = "Misty/Hazy";
} else if (strpos($metardata["phenomena"],"TSRA") !== false) {
	$pictogram = "tstorm2";
	$pictogrammsg = "Thunderstorms";
} else if (strpos($metardata["phenomena"],"TS") !== false) {
	$pictogram = "03";
} else if (strpos($metardata["phenomena"],"-RA") !== false) {
	$pictogram = "shower1";
	$pictogrammsg = "Light Rain";
} else if (strpos($metardata["phenomena"],"+RA") !== false) {
	$pictogram = "shower3";
	$pictogrammsg = "Heavy Rain";
} else if (strpos($metardata["phenomena"],"RA") !== false) {
	$pictogram = "shower2";
	$pictogrammsg = "Rainy";
} else if (strpos($metardata["phenomena"],"SN") !== false) {
	$pictogram = "snow2";
	$pictogrammsg = "Snowy";
} else if (strpos($metardata["ceiling"],"OVC") !== false) {
	$pictogram = "cloudy5";
	$pictogrammsg = "Overcast";
} else if (strpos($metardata["ceiling"],"BKN") !== false) {
	$pictogram = "cloudy4";
	$pictogrammsg = "Cloudy";
} else if (strpos($metardata["ceiling"],"SCT") !== false) {
	$pictogram    = "cloudy3";
	$pictogrammsg = "Sparse Clouds";
} else if (strpos($metardata["ceiling"],"FEW") !== false) {
	$pictogram = "cloudy2";
	$pictogrammsg = "Few Clouds";
} else {
	$pictogram = "dunno";
	$pictogrammsg = "Unknown";
}

$flag   = "../weathericons/".$pictogram.".png";
$flag   = imagecreatefrompng($flag);
$insert_x = imagesx($flag);
$insert_y = imagesy($flag);

imagecopyresized($image,$flag,159,$image_height-60,0,0,58,58,$insert_x,$insert_y);

//============================================================
// DRAWING: TEMPERATURE AND RELATiVE HUMIDITY
//============================================================
if ($metardata['temperature'] < 0) {
	$flag   = "../weathericons/temp1.png";
} else if ($metardata['temperature'] >= 0 && $metardata['temperature'] < 15) {
	$flag   = "../weathericons/temp2.png";
} else if ($metardata['temperature'] >= 15 && $metardata['temperature'] < 30) {
	$flag   = "../weathericons/temp3.png";
} else if ($metardata['temperature'] >= 30 && $metardata['temperature'] < 40) {
	$flag   = "../weathericons/temp4.png";
} else if ($metardata['temperature'] >= 40) {
	$flag   = "../weathericons/temp5.png";
} 
$flag   = imagecreatefrompng($flag);
$insert_x = imagesx($flag);
$insert_y = imagesy($flag);
imagecopy($image,$flag,-4,$image_height-63,0,0,$insert_x,$insert_y);

$name = $metardata['temperature']."°C";
$x_finalpos = 33;
$y_finalpos = $image_height-42;
$box_width = 30;
$box = @ImageTTFBBox(12,0,$font_file_1,$name);
$text_width = abs($box[2]-$box[0]);
$text_height = abs($box[5]-$box[3]);
$difference = $box_width - $text_width;
$put_text_x = $x_finalpos+$difference;
$put_text_y = $y_finalpos;
imagettftext($image, 12, 0, $put_text_x, $put_text_y, $font_color_1, $font_file_1, $name);

$flag   = "../weathericons/relativehumidity.png";
$flag   = imagecreatefrompng($flag);
$insert_x = imagesx($flag);
$insert_y = imagesy($flag);
imagecopy($image,$flag,-2,$image_height-30,0,0,$insert_x,$insert_y);

$name = 100*bcpow(((112-0.1*$metardata['temperature']+$metardata['dewpoint'])/(112+0.9*$metardata['temperature'])),8,2)."%";
$x_finalpos = 33;
$y_finalpos = $image_height-10;
$box_width = 30;
$box = @ImageTTFBBox(12,0,$font_file_1,$name);
$text_width = abs($box[2]-$box[0]);
$text_height = abs($box[5]-$box[3]);
$difference = $box_width - $text_width;
$put_text_x = $x_finalpos+$difference;
$put_text_y = $y_finalpos;
imagettftext($image, 12, 0, $put_text_x, $put_text_y, $font_color_1, $font_file_1, $name);

$flag   = "../weathericons/visib.png";
$flag   = imagecreatefrompng($flag);
$insert_x = imagesx($flag);
$insert_y = imagesy($flag);
imagecopy($image,$flag,71,$image_height-63,0,0,$insert_x,$insert_y);

$name = $metardata["visibility"];

if ($name == '9999' OR $name == 'CAVOK') {
	$name = '>10km';
} else if ($name == '10SM') {
	$name = '>10mi';
} else if (!strstr($name,'SM')) {
	$name = (int)$name."m";
} else if (strstr($name,'SM')) {
	$name = (int)substr($name,0,strlen($name)-2)."mi";
}

$x_finalpos = 123;
$y_finalpos = $image_height-42;
$box_width = 30;
$box = @ImageTTFBBox(12,0,$font_file_1,$name);
$text_width = abs($box[2]-$box[0]);
$text_height = abs($box[5]-$box[3]);
$difference = $box_width - $text_width;
$put_text_x = $x_finalpos+$difference;
$put_text_y = $y_finalpos;
imagettftext($image, 12, 0, $put_text_x, $put_text_y, $font_color_1, $font_file_1, $name);

$flag   = "../weathericons/baro.png";
$flag   = imagecreatefrompng($flag);
$insert_x = imagesx($flag);
$insert_y = imagesy($flag);
imagecopy($image,$flag,70,$image_height-32,0,0,$insert_x,$insert_y);

$name = $metardata["altimeter"];
$x_finalpos = 123;
$y_finalpos = $image_height-10;
$box_width = 30;
$box = @ImageTTFBBox(12,0,$font_file_1,$name);
$text_width = abs($box[2]-$box[0]);
$text_height = abs($box[5]-$box[3]);
$difference = $box_width - $text_width;
$put_text_x = $x_finalpos+$difference;
$put_text_y = $y_finalpos;
imagettftext($image, 12, 0, $put_text_x, $put_text_y, $font_color_1, $font_file_1, $name);

//============================================================
// DRAWING: QNH/A AND WEATHER STATUS
//============================================================
//imagettftext($image, 14, 0, 14, $image_height-40, $font_color_1, $font_file_1, $metardata["altimeter"]);
//imagettftext($image, 12, 0, 54, $image_height-30, $font_color_1, $font_file_1, $pictogrammsg);
imagettftext($image, 12, 0, 218, $image_height-25, $font_color_1, $font_file_1, $pictogrammsg);
//imagestring($image, 5, 70, $image_height-25 , $metardata["altimeter"], $black);

//============================================================
// DRAWING: FOOTER
//============================================================
$flag   = "../images/divlogous.png";
$flaglg = "../images/divlogous-lg.png";
$flagsm = "../images/divlogous-sm.png";
$flag   = imagecreatefrompng($flag);
$flaglg = imagecreatefrompng($flaglg);
$flagsm = imagecreatefrompng($flagsm);

$insert_x = imagesx($flag);
$insert_y = imagesy($flag);
$insert_xlg = imagesx($flaglg);
$insert_ylg = imagesy($flaglg);
$insert_xsm = imagesx($flagsm);
$insert_ysm = imagesy($flagsm);

//imagecopymerge($image,$flaglg,$image_width/2-$insert_xlg/2,$rose_center_y-$insert_ylg/2,0,0,$insert_xlg,$insert_ylg,3);
imagecopymerge($image,$flag,$image_width-150,$image_height-150,0,0,$insert_x,$insert_y,7);
imagecopy($image,$flagsm,$image_width-60,$image_height-92,0,0,$insert_xsm,$insert_ysm);

imagestring($image, 2, $image_width-75, $image_height-37 , "Retrieved at", $black);
imagestring($image, 2, $image_width-106, $image_height-25 , gmdate("d/m/Y")." ".gmdate("G:i")."Z", $black);
imagestring($image, 1, $image_width-94, $image_height-10 , "IVAO United States", $black);

// pontos limites
// CENTRO  $rose_center_x,$rose_center_y
// TOPO    149,91
// BAIXO   149,369
// RIGHT   288,230
// LEFT     10,230

//============================================================
// DRAWING: SIDE INFO (IF ACTIVATED)
//============================================================
/*
// Wind
imagestring($image, 5, $image_width-240, 75 , "Wind", $black);
imagettftext($image, 14, 0, $image_width-160, 88, $red, $font_file_1, $metardata["winddirection"]."/".$metardata["windspeed"].$metardata["windunit"]);
// Visibility
imagestring($image, 5, $image_width-240, 105 , "Visib", $black);
imagettftext($image, 14, 0, $image_width-160, 118, $red, $font_file_1, $metardata["visibility"]);
// Phenomena
imagestring($image, 5, $image_width-240, 135 , "Precip", $black);
imagettftext($image, 14, 0, $image_width-160, 148, $red, $font_file_1, $metardata["phenomena"]);
// Ceiling
imagestring($image, 5, $image_width-240, 165 , "Ceil", $black);
imagettftext($image, 14, 0, $image_width-160, 178, $red, $font_file_1, $metardata["ceiling"]);
// Temperature/Dewpoint
imagestring($image, 5, $image_width-240, 195 , "Temp/Dew", $black);
imagettftext($image, 14, 0, $image_width-160, 208, $red, $font_file_1, $metardata["temperature"]."°C/".$metardata["dewpoint"]."°C");
*/
/*
$metarfinal = array("winddirection" => $winddirection,
				 "windspeed" => trim($windspeed),
				 "windgust" => trim($windgust),
				 "windunit" => trim($windunit),
				 "windvariation" => trim($windvariation),
				 "visibility" => trim($visibility),
				 "phenomena" => trim($phenomena),
				 "ceiling" => trim($ceiling),
				 "temperature" => trim($temperature),
				 "dewpoint" => trim($dewpoint),
				 "altimeter" => trim($altimeter));
*/

header('Content-type: ' . $mime_type) ;
ImagePNG($image) ;

ImageDestroy($image) ;

change_db($sqlconn,$rfedatabase);
exit;
?>