
<div class="onlinediv"><div class="online"><style type="text/css">
.trafficlistnettotal {
	background-color: #D9EDF7;
	color: #3A87AD;
	padding-top: 10px;
	padding-right: 10px;
	padding-bottom: 10px;
	padding-left: 10px;
	border: 1px solid #96CDE9;
	border-radius: 1px;
	margin-top: 5px;
	margin-bottom: 5px;
}

tr.trafico {
	width: 1024px;
	border-bottom: 5px solid #EFEFEF;
}
tr.trafico > td {
	width: 256px;
	border-bottom: 1px solid #D8D8D8;
	text-align: center;
}
tr.princ{
	background-color: #2a4982;
	color: #FFFFFF;
	text-align: center;
	height: 35px;
	}
	
	div.boton {
	background-color: #2F5E9F;
	width: 200px;
	height: 50px;
	text-align: center;
	margin-left: auto;
	margin-right: auto;
	border: 1px solid #15356F;
	border-radius: 13px;
	margin-top: 20px;
}
div.boton:hover {
	background-color: #437BC7;
}

input.boton {
	color: #FFFFFF;
	background-color: #2a4982;
	padding-top: 7px;
	padding-right: 15px;
	padding-bottom: 7px;
	padding-left: 15px;
	border: 1px solid #2a4982;
	font-family:'Open Sans', sans-serif;
	font-size: 16px;
}
input.boton:disabled {
	color: #FFFFFF;
	background-color: #7E7F7F;
	padding-top: 7px;
	padding-right: 15px;
	padding-bottom: 7px;
	padding-left: 15px;
	border: 1px solid #838486;
	font-family: 'Open Sans', sans-serif;
	font-size: 16px;
}

input.boton:hover {
	background-color: #416EC1;
}
</style>
<?
/**
 * IVAO Traffic list
 *
 * @author Aki Kettunen www.akikettu.net
 * @package defaultPackage
 */
/*
BEGINNG OF CONFIGURATION
*/

/**
 * 	EDIT by Chris Doehring (272909), 2012-12-04
 *  Added check function for local airport country codes...
 *
 */
 function checkCountryIcao($check) {
	$countryicao = array('SK');
	
	foreach($countryicao as $id => $value) {
		if(trim($value) == trim($check)) {
			return true;
		}
	}
	return false;
 }



// For easy translation..
$lng['staffingb'] = 'Staff Online';
$lng['atcingb'] = 'ATC Online - CO';
$lng['noatcingb'] = 'No hay ATC en linea.';
$lng['trafficingb'] = 'Traffic Departures/Arrivals';
$lng['notrafficingb'] = 'There is not traffic No hay trafico Departures/Arrivals.';
$lng['atcbingb'] = '<a href="http://www.ivao.aero/atcss/new.asp" target="_blank">Add a Booking</a>';
$lng['noatcbingb'] = 'You can not schedule.';
$lng['totalonline'] = 'There are %s ATC(s) and %s  pilot(s) online in IVAO.';
$lng['today'] = 'Today';
$lng['tomorrow'] = 'Tomorrow';
$weekdays = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    0 => 'Sunday'
);

// Put here 2 first letter of airport ICAO codes
#$countryicao = 'NW';

// Put here country code of staff members
$staffcountry = 'CO';

$airports = array(
'SKBO' => '', 
'SKRG' => '', 
'SKCL' => '', 
'SKPE' => '', 
'SKSP' => '', 
'SKSM' => '', 
'SKCG' => '', 
'SKRH' => '', 
'SKBG' => '', 
'SKMD' => '', 
'SKBQ' => '', 
'SKBS' => '', 
);

$validcontrollers = array('DEL','GND','TWR','DEP','APP','CTR','FSS');

$ctrlevel = array(
   1 => 'OBS',
   2 => 'AS1',
   3 => 'AS2',
   4 => 'AS3',
   5 => 'ADC',
   6 => 'ADP',
   7 => 'ACC',
   8 => '<span class="green">SEC</span>',
   9 => '<span class="green">SAI</span>',
  10 => '<span class="green">CAI</span>',
  11 => '<span class="red">SUP</span>',
  12 => '<span class="red">ADM</span>'
);

/*
END OF CONFIGURATION
*/

//http://www.ivao.aero/whazzup/status.txt
//http://dataservice.gatools.org/data/ivao.txt

// DOWNLOAD ONLINE-LISTAUS
//---------------------------------------------------------------------------------------------------------
$filecontents = file_get_contents('http://api.ivao.aero/getdata/whazzup/whazzup.txt');
$rows = explode("\n", $filecontents);

$filepart = '';
$pilots = array();
$pilotcount = 0;
$controllers = array();
$staff = array();
$controllercount = 0;
$generaldata = array();

foreach ($rows as $row) {
    if (substr($row,0,1) == '!') {
        $filepart = substr($row,1);
    } else {
        switch ($filepart) {
            case 'CLIENTS':
                $fields = explode(":", $row);
                if ($fields[3] == 'ATC') {
                    $controllercount++;
                    if (in_array(substr($fields[0],-3), $validcontrollers) && checkCountryIcao(substr($fields[0],0,2))) { array_push($controllers, $fields); }
                        if (substr($fields[0],0,3) == $staffcountry . '-') { array_push($staff, $fields); }
                } else {
                    $pilotcount++;
                    if (checkCountryIcao(substr($fields[11],0,2)) OR checkCountryIcao(substr($fields[13],0,2))) {
                        array_push($pilots, $fields);
                    }
                }
                break;
            case 'GENERAL':
                list($key, $value) = explode('=', $row);
                $generaldata[trim($key)] = trim($value);
                break;
        }
    }
}


// DOWNLOAD BOOKING LIST
//---------------------------------------------------------------------------------------------------------
$filecontentsa = file_get_contents('http://www.ivao.aero/schedule/indd.asp');
$rowsa = explode("\n", $filecontentsa);

$filepart = '';
$booking_pilots = array();
$booking_controllers = array();

foreach ($rowsa as $rowa) {
    if (substr($rowa,0,1) == '!') {
        $filepart = substr($rowa,1);
    } else {
        switch (trim($filepart)) {
            case 'CLIENTS:':
                $fields = explode(":", $rowa);
                if ($fields[3] == 'ATC') {
                    if (checkCountryIcao(substr($fields[0],0,2))) { 
                        switch ($fields[16]) {
                            case DateAdd(0):
                            if (!isset($booking_controllers[0])) { $booking_controllers[0] = array(); }
                            array_push($booking_controllers[0], $fields);
                            break;
                            
                            case DateAdd(1):
                            if (!isset($booking_controllers[1])) { $booking_controllers[1] = array(); }
                            array_push($booking_controllers[1], $fields);
                            break;
                            
                            case DateAdd(2):
                            if (!isset($booking_controllers[2])) { $booking_controllers[2] = array(); }
                            array_push($booking_controllers[2], $fields);
                            break;
                            
/**/

                            case DateAdd(3):
                            if (!isset($booking_controllers[3])) { $booking_controllers[3] = array(); }
                            array_push($booking_controllers[3], $fields);
                            break;
                            
                            case DateAdd(4):
                            if (!isset($booking_controllers[4])) { $booking_controllers[4] = array(); }
                            array_push($booking_controllers[4], $fields);
                            break;
                            
                            case DateAdd(5):
                            if (!isset($booking_controllers[5])) { $booking_controllers[5] = array(); }
                            array_push($booking_controllers[5], $fields);
                            break;
                            
                            case DateAdd(6):
                            if (!isset($booking_controllers[6])) { $booking_controllers[6] = array(); }
                            array_push($booking_controllers[6], $fields);
                            break;

                        }
                    }
                } else {
                    if (checkCountryIcao(substr($fields[11],0,2)) OR checkCountryIcao(substr($fields[13],0,2))) {
                        array_push($booking_pilots, $fields);
                    }
                }
                break;
        }
    }
}

function remove_accents( $string )
{
   $string = htmlentities($string);
   return preg_replace("/&([a-z])[a-z]+;/i","$1",$string);
}




// BOOKINGS
//-------------------------------------------------------------------------------------------------------------------
// ATC




function DateAdd($v,$d=null , $f="Ymd"){
 	
$d=($d?$d:GMdate("Y-m-d")); 
    return GMdate($f,strtotime($v." days",strtotime($d))); 
}










?>

 <table class="table table-striped" width="100%">
<thead>
  <tr class="princ">
    <th>ATC Online IVAO CO</th><th>Staff IVAO CO</th>
  </tr>
</thead>
<tbody>

	
    <tr>
    <td><?
	include('./db_login.php');
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// ATC
//echo '<h3>' . $lng['atcingb'] . '</h3>';
if (count($controllers) != 0) {
    $capicao = '';
    echo '<table width="100%">';
    foreach ($controllers as $controller) {
if (substr_count($controller[0],'_') == 1) {
          list ($apicao, $position) = explode('_', $controller[0]);
        } else {
          list ($apicao, $position1, $position2) = explode('_', $controller[0]);
          $position = $position2 . ' (' . $position1 .')';
        }

        if ($apicao != $capicao) {
            $capicao = $apicao;
			
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3991 ="select * from airports where ident='$apicao'";

	if (!$result3991 = $db->query($sql3991)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3991 = $result3991->fetch_assoc()) {
		
		$iso_countrya= $row3991["iso_country"];
		$callsignesa= $row3991["name"];
	}
	
	
	
            echo '<tr><td colspan="2" align="left"><img src="../admin/intranet/country-flags/' . $iso_countrya . '.png">' . ' ' . '<strong>' . $callsignesa . ' (' . $apicao . ') - ' . $airports[$apicao] . '</td></tr>';
        }
        
        // Realname
        $realname = remove_accents(ucwords($controller[2]));
        
        // Level
        $level = $ctrlevel[$controller[16]];
        
        echo '<tr><td width="60"><li><a href="./?page=flighttrack&cs='. $controller[0] .'" onClick="MM_openBrWindow(\'./?page=flighttrack&cs='. $controller[0] .'\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=600\');return false" ><font color="red">' . $position . '</font></a></td><td><a href="http://www.ivao.aero/members/person/details.asp?id=' . $controller[1] . '" onClick="MM_openBrWindow(\'http://www.ivao.aero/members/person/details.asp?id=' . $controller[1] . '\',\'\',\'scrollbars=yes,resizable=yes,width=800,height=600\');return false" target="_blank" title="' . $realname . '"><font color="red">' . $controller[1] . '</font></a>&nbsp;(' . $level . ')</li></td></tr>';
    }
    echo '</table>';
} else {

    echo '<p style="margin-bottom: 20px; margin-left: 10px; color: gray;"><i>' . $lng['noatcingb'] . '</i></p>';
}


?></td>

<td>

<?

//STAFF
//-------------------------------------------------------------------------------------------------------------------
if (count($staff) != 0) {
  //  echo '<h3>' . $lng['staffingb'] . '</h3>
  echo '<table class="trafficlisttable" width="160">';
    foreach ($staff as $staffmember) {
        $realname = $staffmember[2];
        $realname = remove_accents(ucwords($realname));
        echo '<tr><td><a href="http://www.ivao.aero/staff/details.asp?id=' . $staffmember[0] . '" target="_blank" onClick="MM_openBrWindow(\'http://www.ivao.aero/staff/details.asp?id=' . $staffmember[0] . '\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=600\');return false" title="' . $staffmember[0] . '"><font color="red">'. $staffmember[0]. ' (' . $staffmember[1] . ') </font></a></td></tr>';
    }
    echo '</table>';
} else {
	
	echo "There is not staff of IVAO Colombia Division Online.";
}

?>
</td>
  </tr>
						
    
					  

</tbody>
</table>






<br><hr>


<h2>Pilots Online</h2>
<table cellpadding="0" cellspacing="0" class="trafficlisttable" width="100%">
<tr class="princ">
<td>Airline</td><td>Callsign</td><td>Departure</td><td>Arrival</td><td>Information</td></tr>
<tr class='trafico'>
<td></td><td></td><td></td><td></td><td></td>
</tr>
<?
// Pilots
//echo '<h3>' . $lng['trafficingb'] . '</h3>';
if (count($pilots) != 0) {

    foreach ($pilots as $pilot) {
        $realname = $pilot[2];
        if (substr($realname,-5,1) == ' ') {
            $realname = substr($realname,0,-5);
        }
        $realname = remove_accents(ucwords($pilot[2]));
        //echo '<tr><td width="50"><a href="./?page=flighttracks&cs=' . $pilot[0] . '" onClick="MM_openBrWindow(\'./?page=flighttracks&cs=' . $pilot[0] . '\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=600\');return false" title="' . $realname . '"><font color="red">' . $pilot[0] . '</font></a></td><td width="30">' . $pilot[11] . '</td><td>&gt;&nbsp;' . $pilot[13] . '</td></tr>';

		$salida = $pilot[11];
		$llegada = $pilot[13];
        $vida =$pilot[1];
		
		$callsignes = substr($pilot[0],0,3);
		
		
			 	$ruta_img = "./logos/" . $callsignes . ".gif"; // 
	
	$nops=0;
$iip=0;
    if(getimagesize($ruta_img)){
 $logose = '<img src="' . $ruta_img . '" width="50%">';
    } else {
	$logose = "";	
	$iip =1;
	}
	
	if($iip==1) {
		
		
		  $sql3991ap ="select * from airlines where icao_aerolinea='$callsignes'";

	if (!$result3991ap = $db->query($sql3991ap)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3991ap = $result3991ap->fetch_assoc()) {
		
		$numeros= $row3991ap["numeros"];
		
		
		 	$ruta_imga = "https://www.ivao.aero/data/images/airline/" . $numeros . ".jpg";
	$ruta_imgs = "https://www.ivao.aero/data/images/airline/" . $numeros . ".png"; // 
	$ruta_imgss = "https://www.ivao.aero/data/images/airline/" . $numeros . ".gif"; // 
	
	
	

    if(getimagesize($ruta_imga)){
	$logose = '<img src="https://www.ivao.aero/data/images/airline/' . $numeros . '.jpg" width="45%">';

    } else

    if(getimagesize($ruta_imgs)){
  	$logose = '<img src="https://www.ivao.aero/data/images/airline/' . $numeros . '.png" width="45%">';

    } else
	
	    if(getimagesize($ruta_imgss)){
   	$logose = '<img src="https://www.ivao.aero/data/images/airline/' . $numeros . '.gif" width="45%">';

    }	else {
		
			$logose = "";
	}
		
	}
		
	
		
		
	}
  $iso_countryaa = "";
  $callsignesaa = "";
  
  $iso_countryaaa="";
  $callsignesaaa = "";
  $sql3991a ="select * from airports where ident='$salida'";

	if (!$result3991a = $db->query($sql3991a)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3991a = $result3991a->fetch_assoc()) {
		
		$iso_countryaa= $row3991a["iso_country"];
		$callsignesaa= $row3991a["name"];
	}
	
  
  
   $sql3991aa ="select * from airports where ident='$llegada'";

	if (!$result3991aa = $db->query($sql3991aa)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3991aa = $result3991aa->fetch_assoc()) {
		
		$iso_countryaaa= $row3991aa["iso_country"];
		$callsignesaaa= $row3991aa["name"];
	}
?>
<tr class='trafico'>
<td>

<p class="header3"><?php echo $logose; ?></p></td>
<td>

<p class="header3"><a href='https://www.ivao.aero/Member.aspx?Id=<?php echo $vida; ?>'><?php echo $pilot[0]; ?></a></p></td><td width="30">
<p class="header3"><img src="../admin/intranet/country-flags/<?php echo $iso_countryaa; ?>.png"> (<?php echo $salida; ?>) <br><?php echo $callsignesaa; ?></p></td><td>
<p class="header3"><img src="../admin/intranet/country-flags/<?php echo $iso_countryaaa; ?>.png"> (<?php echo $llegada; ?>) <br><?php echo $callsignesaaa; ?></p> </td>
<td>
<input class='boton' type='button' name='button' id='button' value='See' target="_self" onclick='window.open("./?page=flighttracks&cs=<?php echo $pilot[0]; ?>")' /></input></td>
</tr>
<?
   }
   
} else {
    echo '<p style="margin-bottom: 20px; margin-left: 10px; color: gray;"><i>' .$lng['notrafficingb'] . '</i></p>';
}
?>

</table>
</div>
</div>

<?

echo '<br><hr>';
echo 'There are '; echo count($controllers); echo' controllers, '; echo count($pilots); echo' pilots, and '; echo count($staff); echo' Staff´s members online in Colombia.';
echo '<br><hr><br><h1><font color="black">IVAO World</font></h1>';
echo '<div class="trafficlistnettotal">' . sprintf($lng['totalonline'], $controllercount, $pilotcount) . '</div>';
?>