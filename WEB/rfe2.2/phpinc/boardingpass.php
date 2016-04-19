<?php

include("func_mysqlexec.php");
include("func_general.php");
include("../phpqrcode/qrlib.php");


/*
    attempt to create an image containing the error message given. 
    if this works, the image is sent to the browser. if not, an error
    is logged, and passed back to the browser as a 500 code instead.
*/
function fatal_error($message)
{
    // send an image
    if(function_exists('ImageCreate'))
    {
        $width = ImageFontWidth(5) * strlen($message) + 10 ;
        $height = ImageFontHeight(5) + 10 ;
        if($image = ImageCreate($width,$height))
        {
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

//============================================================
// CUSTOM VARIABLES
//============================================================
$image_width  = 791;
$image_height = 349;
$font_file_1  = '../font/CNR.otf';
$font_file_2  = '../font/MAJALLAB.TTF';
$font_file_3  = '../font/onuava.ttf';
$font_color   = '#be3504';
$font_size    = 30;
$font_angle   = 0;
// Entry Variable
$pilot_num      = $_GET["id"];


//============================================================
// INITIAL SQL QUERY
//============================================================
$query   = 'SELECT aptname,DATE_FORMAT(datestart, "%d %b %Y") AS date FROM rfe_config';
$query   = mysqlexec($sqlconn,$query);
$aptname = mysql_result($query,0,'aptname');
$eventdate = mysql_result($query,0,'date');
if (strpos($aptname,"/")) {
	$aptname = substr($aptname,0,strpos($aptname,"/"));
} else {
	$aptname = mysql_result($query,0,'aptname');
}
$logo_message    = "RFE ".$aptname;

$query = "SELECT f.id, f.flightnumber, f.origin, f.destination, IFNULL(DATE_FORMAT(f.deptime, '%H%i'),'----') AS deptime,
          IFNULL(DATE_FORMAT(f.arrtime, '%H%i'),'----') AS arrtime, IFNULL(f.gate,'TBD') AS gate, f.acft, IFNULL(f.route,'TBD') AS route, f.vid, f.bookingstatus, m.name, m.ratingpilot, m.division, IFNULL(DATE_FORMAT(f.deptime, '%H:%i'),DATE_FORMAT(f.arrtime, '%H:%i')) AS reftime
          FROM rfe_flights AS f
			 LEFT JOIN rfe_members AS m ON m.vid = f.vid
			 WHERE f.id='".$_GET["id"]."'";
$query  = mysqlexec($sqlconn,$query);

//============================================================
// BUFFER AND HEADER INFORMATION
//============================================================
$mime_type          = 'image/png' ;
$extension          = '.png' ;
$s_end_buffer_size  = 4096 ;
// check for GD support
if(!function_exists('ImageCreate'))
    fatal_error('Error: Server does not support PHP image generation') ;
// check font availability;
if(!is_readable($font_file_1)) {
    fatal_error('Error: The server is missing the specified font.') ;
}

//============================================================
// IMAGE CREATION AND PROPERTIES
//============================================================
$image =  imagecreatetruecolor($image_width, $image_height);
imageantialias($image, true);
imagealphablending($image, true);

// Transparent Background
/*imagealphablending($image, false);
$transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparency);
imagesavealpha($image, true);*/

//============================================================
// COLOR ALLOCATION
//============================================================
$white = ImageColorAllocate($image,255,255,255);
$black = ImageColorAllocate($image,0,0,0);

$font_rgb = hex_to_rgb($font_color);
$font_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']);

$bg_image = '../images/pass.png';
$bg_image = imagecreatefrompng($bg_image);
imagecopy($image,$bg_image,0,0,0,0,791,349);

$flag   = "../images/divlogo/divlogo@940px.png";
$flag   = imagecreatefrompng($flag);
$insert_x = imagesx($flag);
$insert_y = imagesy($flag);
imagecopymerge($image,$flag,-100,-210,0,0,$insert_x,$insert_y,12);

// Write the text
$name = explode(" ",mysql_result($query,0,"name"));
$lastname = array_pop($name);

$displayname = $lastname." / ";
foreach ($name as $eachname) {
	$displayname .= $eachname." ";
}

imagettftext($image, 7, 0, 18, 23, $font_color, $font_file_3, "FLIGHT");
imagettftext($image, 13, 0, 17, 40, $black, $font_file_1, strtoupper(trim(airlinename(mysql_result($query,0,'flightnumber')))));
imagettftext($image, 7, 0, 236, 23, $font_color, $font_file_3, "LEG");
imagettftext($image, 13, 0, 235, 40, $black, $font_file_1, strtoupper(trim(mysql_result($query,0,'origin')." TO ".mysql_result($query,0,'destination'))));
imagettftext($image, 7, 0, 375, 23, $font_color, $font_file_3, "CAPTAIN");
imagettftext($image, 13, 0, 374, 40, $black, $font_file_1, strtoupper(trim($displayname)));

imagettftext($image, 7, 0, 578, 23, $font_color, $font_file_3, "FLIGHT");
imagettftext($image, 13, 0, 577, 40, $black, $font_file_1, strtoupper(trim(airlinename(mysql_result($query,0,'flightnumber')))));


imagettftext($image, 9, 0, 19, 93, $font_color, $font_file_3, "CAPTAIN");
imagettftext($image, 20, 0, 17, 125, $black, $font_file_1, strtoupper(trim($displayname)));

imagettftext($image, 9, 0, 19, 158, $font_color, $font_file_3, "GATE");
imagettftext($image, 20, 0, 17, 192, $black, $font_file_1, strtoupper(trim(mysql_result($query,0,'gate'))));
imagettftext($image, 9, 0, 139, 158, $font_color, $font_file_3, "SLOT");
imagettftext($image, 20, 0, 137, 192, $black, $font_file_1, strtoupper(trim(mysql_result($query,0,'reftime'))));
imagettftext($image, 13, 0, 217, 192, $black, $font_file_1, strtoupper(trim("UTC  ".$eventdate)));
imagettftext($image, 9, 0, 448, 158, $font_color, $font_file_3, "ACFT");
imagettftext($image, 20, 0, 446, 192, $black, $font_file_1, strtoupper(trim(aircraftname(mysql_result($query,0,'acft')))));

imagettftext($image, 9, 0, 578, 93, $font_color, $font_file_3, "CAPTAIN");
imagettftext($image, 11, 0, 576, 120, $black, $font_file_1, strtoupper(trim($displayname)));

imagettftext($image, 9, 0, 578, 158, $font_color, $font_file_3, "GATE");
imagettftext($image, 20, 0, 576, 192, $black, $font_file_1, strtoupper(trim(mysql_result($query,0,'gate'))));
imagettftext($image, 9, 0, 676, 158, $font_color, $font_file_3, "SLOT");
imagettftext($image, 20, 0, 676, 192, $black, $font_file_1, str_replace(":","",strtoupper(trim(mysql_result($query,0,'reftime')."Z"))));

$validationkey = crypt(mysql_result($query,0,"id").mysql_result($query,0,"flightnumber").mysql_result($query,0,"vid"),'$1$IVAOUS$');
$validationkey = str_replace("/","",substr($validationkey,10,strlen($validationkey)));
$validationkey = str_replace(".","",$validationkey);

imagettftext($image, 7, 0, 19, 252, $font_color, $font_file_3, "TRACKING");
imagettftext($image, 11, 0, 18, 270, $black, $font_file_1, strtoupper(trim($validationkey)));
imagettftext($image, 7, 0, 220, 252, $font_color, $font_file_3, "DATA");
imagettftext($image, 11, 0, 220, 270, $black, $font_file_1, strtoupper(trim("RFE".mysql_result($query,0,"id"))));

$flag   = "../images/divlogous-sm.png";
$flag   = imagecreatefrompng($flag);
$insert_x = imagesx($flag);
$insert_y = imagesy($flag);
imagecopy($image,$flag,721,230,0,0,$insert_x,$insert_y);

imagettftext($image, 5, 90, 789, 292, $font_color, $font_file_3, "IVAO United States");


imagettftext($image, 22, 0, 75, 330, $white, $font_file_2, $logo_message);

$flag   = "../images/divlogo/divlogo@55px.png";
$flag   = imagecreatefrompng($flag);
$insert_x = imagesx($flag);
$insert_y = imagesy($flag);
imagecopy($image,$flag,8,294,0,0,$insert_x,$insert_y);

$filename = mysql_result($query,0,'flightnumber').".png";
$text     = $logo_message." | ".$eventdate." | ".mysql_result($query,0,'flightnumber')." | ".mysql_result($query,0,'origin')."-".mysql_result($query,0,'destination')." | ".mysql_result($query,0,'reftime')."Z | ".aircraftname(mysql_result($query,0,'acft'))." | ".mysql_result($query,0,'name');
QRcode::png($text,$filename, "L", "2", 0); 
$flag   = imagecreatefrompng($filename);
imagecopy($image,$flag,485,220,0,0,74,74);
unlink($filename);

// Check if the airline has a logo and gets it.
if (file_exists("../logos/".substr(mysql_result($query,0,'flightnumber'),0,3).".gif")) {
	$flag   = "../logos/".substr(mysql_result($query,0,'flightnumber'),0,3).".gif";
	$flag   = imagecreatefromgif($flag);
	$insert_x = imagesx($flag);
	$insert_y = imagesy($flag);
	imagecopy($image,$flag,706,331,0,0,$insert_x,$insert_y);
}

header('Content-type: ' . $mime_type);
ImagePNG($image);

ImageDestroy($image);
exit;
?>