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
$lng['staffingb'] = 'Staff en linea';
$lng['atcingb'] = 'ATC en linea - CO';
$lng['noatcingb'] = 'No hay ATC en linea.';
$lng['trafficingb'] = 'Trafico Salidas/Llegadas';
$lng['notrafficingb'] = '_No hay trafico Salidas/Llegadas.';
$lng['atcbingb'] = '<a href="http://www.ivao.aero/atcss/new.asp" target="_blank">Add a Booking</a>';
$lng['noatcbingb'] = 'No se puede reservar.';
$lng['totalonline'] = 'Hay %s ATC(s) y %s  piloto(s) conectado(s) en IVAO.';
$lng['today'] = 'Hoy';
$lng['tomorrow'] = 'Mañana';
$weekdays = array(
    1 => 'Lunes',
    2 => 'Martes',
    3 => 'Miercoles',
    4 => 'Jueves',
    5 => 'Viernes',
    6 => 'Sabado',
    0 => 'Domingo'
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
  <tr>
    <th>ATC en Linea IVAO CO</th><th>Trafico Salidas/Llegadas</th><th>Staff IVAO CO</th>
  </tr>
</thead>
<tbody>

	
    <tr>
    <td><?
	
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
            echo '<tr><td colspan="2" align="left"><strong>' . $apicao . ' - ' . $airports[$apicao] . '</td></tr>';
        }
        
        // Realname
        $realname = remove_accents(ucwords($controller[2]));
        
        // Level
        $level = $ctrlevel[$controller[16]];
        
        echo '<tr><td width="60"><li><a href="./?page=flighttrack&cs='. $controller[0] .'" onClick="MM_openBrWindow(\'./?page=flighttrack&cs='. $controller[0] .'\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=600\');return false" target="_blank"><font color="red">' . $position . '</font></a></td><td><a href="http://www.ivao.aero/members/person/details.asp?id=' . $controller[1] . '" onClick="MM_openBrWindow(\'http://www.ivao.aero/members/person/details.asp?id=' . $controller[1] . '\',\'\',\'scrollbars=yes,resizable=yes,width=800,height=600\');return false" target="_blank" title="' . $realname . '"><font color="red">' . $controller[1] . '</font></a>&nbsp;(' . $level . ')</li></td></tr>';
    }
    echo '</table>';
} else {

    echo '<p style="margin-bottom: 20px; margin-left: 10px; color: gray;"><i>' . $lng['noatcingb'] . '</i></p>';
}


?></td>

<td>
<?
// Pilots
//echo '<h3>' . $lng['trafficingb'] . '</h3>';
if (count($pilots) != 0) {
    echo '<table class="trafficlisttable">';
    foreach ($pilots as $pilot) {
        $realname = $pilot[2];
        if (substr($realname,-5,1) == ' ') {
            $realname = substr($realname,0,-5);
        }
        $realname = remove_accents(ucwords($pilot[2]));
        echo '<tr><td width="50"><a href="./?page=flighttracks&cs=' . $pilot[0] . '" onClick="MM_openBrWindow(\'./?page=flighttracks&cs=' . $pilot[0] . '\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=600\');return false" target="_blank" title="' . $realname . '"><font color="red">' . $pilot[0] . '</font></a></td><td width="30">' . $pilot[11] . '</td><td>&gt;&nbsp;' . $pilot[13] . '</td></tr>';
    }
    echo '</table>';
} else {
    echo '<p style="margin-bottom: 20px; margin-left: 10px; color: gray;"><i>' .$lng['notrafficingb'] . '</i></p>';
}
?>
</td>
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
	
	echo "No hay Staff de División IVAO Colombia en Linea.";
}

?>
</td>
  </tr>
						
    
					  

</tbody>
</table>


<?

echo '<br><hr>';
echo 'Hay '; echo count($controllers); echo' controladores, '; echo count($pilots); echo' pilotos, y '; echo count($staff); echo' miembros del Staff en línea en Colombia.';
echo '<br><hr><br><h1>IVAO World</h1>';
echo '<div class="trafficlistnettotal">' . sprintf($lng['totalonline'], $controllercount, $pilotcount) . '</div>';
?>