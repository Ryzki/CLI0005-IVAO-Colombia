<?php
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

// customizable variables
$image_width    = 500;
$image_height   = 112;
$font_file_bold = '../font/MAJALLAB.TTF';
$font_file      = '../font/MAJALLAB.TTF';
$font_color     = '#be3504' ;
$font_size      = 60;
$font_angle     = 0;
// Entry Variable
$pilot_num      = $_GET["id"];

include("func_mysqlexec.php");

// x and y for the bottom right of the text
// so it expands like right aligned text

$query   = 'SELECT aptname FROM rfe_config';
$query   = mysqlexec($sqlconn,$query);
$aptname = mysql_result($query,0,'aptname');
if (strpos($aptname,"/")) {
	$aptname = substr($aptname,0,strpos($aptname,"/"));
} else {
	$aptname = mysql_result($query,0,'aptname');
}

$message    = "RFE ".$aptname;

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
$dimensions  = imagettfbbox($font_size, $font_angle, $font_file, $message);
$text_width  = $dimensions[2];
$text_height = $dimensions[7];
$center_x    = ($image_width-$text_width)/2;
$center_x    = 0;
$center_y    = ($image_height-$text_height)/2;

$image =  imagecreatetruecolor($image_width, $image_height);

// Transparent Background
imagealphablending($image, false);
$transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparency);
imagesavealpha($image, true);

// allocate colors and measure final text position
$white = ImageColorAllocate($image,255,255,255) ;
$black = ImageColorAllocate($image,0,0,0) ;

// Write the text
imagettftext($image, $font_size, $font_angle, $center_x, $center_y, $white, $font_file, $message);

header('Content-type: ' . $mime_type) ;
ImagePNG($image) ;

ImageDestroy($image) ;
exit ;
?>