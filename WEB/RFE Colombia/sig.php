<?php/*
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

// customizable variables
$font_file_bold = 'font/MAJALLAB.TTF';
$font_file      = 'font/MAJALLA.TTF';
$font_color     = '#be3504' ;
// Entry Variable
$pilot_num      = $_GET["id"];

include("phpinc/func_mysqlexec.php");

// Image Array. With phase as variable.
$phase_img = "img/signature.png"; // Change (At Gate)

// x and y for the bottom right of the text
// so it expands like right aligned text

$query = 'SELECT DATEDIFF(datestart,CURDATE()) AS DiffDate FROM rfe_config';
$query = mysqlexec($sqlconn,$query);
$diff  = mysql_result($query,0,'DiffDate');

if ($diff > 0) {
	if ($diff == 1) {
		$message    = $diff." day remaining!";
	} else {
		$message    = $diff." days remaining!";
	}
	$submessage = "Click here to book your flight!";
} else if ($diff == 0) {
	$message    = "It's today, from 1700Z to 2300Z!";
	$submessage = "Click here to book your flight!";
} else if ($diff < 0) {
	$message    = "Thank you for participating of the event!";
	$submessage = "Stay tuned! http://us.ivao.aero";
}

// trust me for now...in PNG out PNG
$mime_type          = 'image/png' ;
$extension          = '.png' ;
$s_end_buffer_size  = 4096 ;

// check for GD support
if(!function_exists('ImageCreate'))
    fatal_error('Error: Server does not support PHP image generation') ;

// check font availability;
if(!is_readable($font_file)) {
    fatal_error('Error: The server is missing the specified font.') ;
}

// create and measure the text
$font_rgb = hex_to_rgb($font_color);

// If phase is not null, pick image based on the array
$image_file = $phase_img;

$image =  imagecreatefrompng($image_file);

// allocate colors and measure final text position
//$font_color = ImageColorAllocate($image,$font_rgb['red'],$font_rgb['green'],$font_rgb['blue']) ;
$white = ImageColorAllocate($image,255,255,255) ;
$black = ImageColorAllocate($image,0,0,0) ;

// Write the text
imagettftext($image, 25, 0, 2, 58, $black, $font_file, $message);
imagettftext($image, 25, 0, 4, 60, $black, $font_file, $message);
imagettftext($image, 25, 0, 3, 59, $white, $font_file, $message);

imagettftext($image, 25, 0, 2, 88, $black, $font_file, $submessage);
imagettftext($image, 25, 0, 4, 90, $black, $font_file, $submessage);
imagettftext($image, 25, 0, 3, 89, $white, $font_file, $submessage);

header('Content-type: ' . $mime_type) ;
ImagePNG($image) ;

ImageDestroy($image) ;
exit ;
?>