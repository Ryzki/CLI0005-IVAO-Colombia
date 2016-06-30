<?php
	/**
	 * @Project: IVAO COLOMBIA
	 * @Author: Andrés Zapata
	 * @Web http://www.ivaocol.com.co/
	 * Copyright (c) 2016 Andrés Zapata
	 * VAM is licensed under the following license:
	 *   Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International (CC BY-NC-SA 4.0)
	 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/4.0/
	 */
?>
<?php

	
session_start();


$id = $_SESSION["id"];


	if ($id == '') {
		echo '<meta http-equiv="refresh" content="0; url=../ />';
	} else {



include('./db_login.php');

	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}

	$sql = "SELECT * FROM staff where id='$id'";

	if (!$result = $db->query($sql)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row = $result->fetch_assoc()) {

		    $staff_ivao = $row['staff_ivao'];

			$nombres = $row['nombres'];

			$apellidos = $row['apellidos'];

			$vid_ivao = $row['vid_ivao'];

			$ip_first = $row['ip_first'];

			$last_ip = $row['last_ip'];

			$email = $row['email'];
			
			$id = $row['id'];
			
			$last_visit_date = $row['last_visit_date'];
			
			
			
			$sql555 = "SELECT * FROM ranks where id='$staff_ivao'";

	if (!$result555 = $db->query($sql555)) {

		die('There was an error running the query  [' . $db->error . ']');

	}

	while ($row555 = $result555->fetch_assoc()) {
		$cargol = $row555['callsign'];	
		$posl = $row555['posicion'];	
		$email_ivao = $row555['email'];		
		$idaa = $row555['typestaff'];
	}	
	
	
	
	
	
			
	

	}


	
	



	



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IVAO Colombia | Staff</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
	<link rel="shortcut icon" href="../../img/favicon.png" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">IVAO CO</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : <?php echo $last_visit_date; ?> &nbsp; <a href="./?page=logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="https://www.ivao.aero/data/images/staff/<?php echo $vid_ivao; ?>.jpg" class="user-image img-responsive"/>
					</li>
				
				
				<?php if ($idaa==1 || $idaa== 7) { ?>
				<li>
                        <a class="active-menu"  href="./"><i class="fa fa-dashboard fa-3x"></i> Información de la División</a>
                    </li>
					<li  >
                        <a  href="?page=myprofile"><i class="fa fa-edit fa-3x"></i> Mi Perfil </a>
                    </li>
							<?php
											
											

	
	$sql3a ="select * from buzonmensajes where departamento='$idaa'";

	if (!$result3a = $db->query($sql3a)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3a = $result3a->fetch_assoc()) {
		$titulo= $row3a["titulo"];
		$mensaje= $row3a["mensaje"];
		$departamento= $row3a["departamento"];
		$fecha= $row3a["fecha"];
		$estado = $row3a["estado"];
		
		
		$sql3aa ="select * from typestaff where id='$departamento'";

	if (!$result3aa = $db->query($sql3aa)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3aa = $result3aa->fetch_assoc()) {
	$departamentoa= $row3aa["nombre"];	
	}
	
	$conts=0;
	// Estado
// 0 = Nuevo
// 1 = Leido
// 2 = Respondido
// 3 = Nuevo mensaje
// 4 = Eliminado

if($estado==0) {
	$vares = '<span class="label label-success">Mensaje Recibido</span>';
} else if($estado==1) {
	$vares = '<span class="label label-warning">Mensaje Leído</span>';
} else if($estado==2) {
	$vares = '<span class="label label-danger">Mensaje Respondido</span>';
} else if($estado==3) {
	$vares = '<span class="label label-info">Mensaje Nuevo</span>';
}
	
if	($estado<>4) {
	$conts++;
}

	}
?>
				<li  >
                        <a  href="?page=sugerencias"><i class="fa fa-edit fa-3x"></i> Buzón Sugerencias <font color="red"> +<?php echo $conts; ?></font></a>
                    </li>
				 <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Staff IVAO<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?page=new-staff">Añadir Staff</a>
                            </li>
                            <li>
                                <a href="?page=visualstaff">Administrar Staff</a>
                            </li>
							<li>
                                <a href="?page=cargos_staff">Grupos de Staff</a>
                            </li>
							<li>
                                <a href="?page=tipos_staff">Tipos de Staff</a>
                            </li>
							
                        </ul>
                      </li>  
					  
					  
					  <li>
                        <a  href="./?page=eventos"><i class="fa fa-desktop fa-3x"></i> Eventos</a>
                    </li>
					  
					 <li>
                        <a  href="./?page=noticias"><i class="fa fa-desktop fa-3x"></i> Examenes</a>
                    </li>
                    
                     <li>
                        <a  href="./?page=notams"><i class="fa fa-desktop fa-3x"></i> Notams</a>
                    </li>
				
				
                    <li>
                        <a  href="./?page=airlines"><i class="fa fa-qrcode fa-3x"></i> Aerolineas Virtuales</a>
                    	
                      <li/>
					  
					  
					
					 <li>
                        <a href="#"><i class="fa fa-table fa-3x"></i> Centro de Entrenamiento<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?page=ranksatc">Rangos ATC</a>
                            </li>
                            <li>
                                <a href="?page=rankspca">Rangos Pilotos</a>
                            </li>
							<li>
                                <a href="?page=materialatc">Material para ATC</a>
                            </li>
							<li>
                                <a href="?page=materialpca">Material para Pilotos</a>
                            </li>
							
                        </ul>
                      </li>  
					  
					  
					   <li>
                        <a href="#"><i class="fa fa-table fa-3x"></i> Eventos ATC Reservas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?page=fra">Lista FRA</a>
                            </li>
                            <li>
                                <a href="?page=eventatcs">Eventos</a>
                            </li>
							
							
                        </ul>
                      </li> 
				<? } else {
					
					?>
						<li>
                        <a class="active-menu"  href="./"><i class="fa fa-dashboard fa-3x"></i> Información de la División</a>
                    </li>
					<li  >
                        <a  href="?page=myprofile"><i class="fa fa-edit fa-3x"></i> Mi Perfil </a>
                    </li>
			
				<li  >
                        <a  href="?page=sugerencias"><i class="fa fa-edit fa-3x"></i> Buzón Sugerencias <font color="red"> +<?php echo $conts; ?></font></a>
                    </li>
			
					  
					  
					  <li>
                        <a  href="./?page=eventos"><i class="fa fa-desktop fa-3x"></i> Eventos</a>
                    </li>
					  
					 <li>
                        <a  href="./?page=noticias"><i class="fa fa-desktop fa-3x"></i> Examenes</a>
                    </li>
                    
                     <li>
                        <a  href="./?page=notams"><i class="fa fa-desktop fa-3x"></i> Notams</a>
                    </li>
				
				
                    <li>
                        <a  href="./?page=airlines"><i class="fa fa-qrcode fa-3x"></i> Aerolineas Virtuales</a>
                    	
                      <li/>
					  
					  
					
					 <li>
                        <a href="#"><i class="fa fa-table fa-3x"></i> Centro de Entrenamiento<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="?page=ranksatc">Rangos ATC</a>
                            </li>
                            <li>
                                <a href="?page=rankspca">Rangos Pilotos</a>
                            </li>
							<li>
                                <a href="?page=materialatc">Material para ATC</a>
                            </li>
							<li>
                                <a href="?page=materialpca">Material para Pilotos</a>
                            </li>
							
                        </ul>
                      </li>  
					
					
					
					
					
				<?php	
					
				}
				
				
				
				?>
				
				
				
				
				
				
				
				
				
				
				
				
		
				
				
				
				
				
				
				
				
				

						
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
		
		<?php
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
		?>
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>IVAO Colombia Dashboard</h2>   
                        <h5>Bienvenido <?php echo $nombres . ' ' . $apellidos; ?> , Encantado de verte de nuevo. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-envelope-o"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php

$sql37 ="select * from airlines";

	if (!$result37 = $db->query($sql37)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$o=0;
	while ($row37 = $result37->fetch_assoc()) {
	$o++;
	
	}
 echo $o;
?> VA's</p>
                    <p class="text-muted">Aerolineas</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">+<?php

$sql378 ="select * from eventos";

	if (!$result378 = $db->query($sql378)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$os=0;
	while ($row378 = $result378->fetch_assoc()) {
	$os++;
	
	}
 echo $os;
?></p>
                    <p class="text-muted">Eventos</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-bell-o"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">+<?php

$sql3789 ="select * from noticias";

	if (!$result3789 = $db->query($sql3789)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$osa=0;
	while ($row3789 = $result3789->fetch_assoc()) {
	$osa++;
	
	}
 echo $osa;
?></p>
                    <p class="text-muted">Examenes</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">+<?php

$sql37891 ="select * from notams";

	if (!$result37891 = $db->query($sql37891)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	$osar=0;
	while ($row37891 = $result37891->fetch_assoc()) {
	$osar++;
	
	}
 echo $osar;
?></p>
                    <p class="text-muted">Notams</p>
                </div>
             </div>
		     </div>
			</div>
                 <!-- /. ROW  -->
                <hr />                
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue">
                    <i class="fa fa-warning"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Staff's IVAO CO</p>
                    <p class="text-muted">Información de Staff Activos en la división</p>
                    <p class="text-muted">Time Left: 1 sec</p>
                    <hr />
                    <p class="text-muted">
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








$filecontentso = file_get_contents('http://www.ivao.aero/schedule/indd.asp');
$rowso = split("\n", $filecontentso);
$fileparto = '';
$controllerso = array();

//echo '<div class="bg"><table class="trafficlisttable">';
foreach ($rowso as $rowo) {

if (substr($rowso,0,2) == '!') {
                $fileparto = substr($rowso,2);
        }

 
	$fieldsa = split(":", $rowo);
	
	$controllerso = $fieldsa[0];
	
	$rest = substr($controllerso, 0,2); 
	
	if ($rest == "SK") {
		
	$fechas = $fieldsa[6];	
	$años = substr($fieldsa[6], 0,4); 
	$mess = substr($fieldsa[6], 4, 2); 
	

	
	$dias = substr($fieldsa[6], 6,2); 
	
	
	//$hora = substr($fecha, 8,9); 
	//$minutos = substr($fecha, 10,11); 
	//$segundos = substr($fecha, 12,13); 
	
		if ($mes == 01) {
		$meses = "Enero";
	} else if ($mes == 02) {
		$meses = "Febrero";
	} else if ($mes == 03) {
		$meses = "Marzo";
	} else if ($mes == 04) {
		$meses = "Abril";
	} else if ($mes == 05) {
		$meses = "Mayo";
	} else if ($mes == 06) {
		$meses = "Junio";
	} else if ($mes == 07) {
		$meses = "Julio";
	} else if ($mes == 08) {
		$meses = "Agosto";
	} else if ($mes == 09) {
		$meses = "Septiembre";
	} else if ($mes == 10) {
		$meses = "Octubre";
	} else if ($mes == 11) {
		$meses = "Noviembre";
	} else if ($mes == 12) {
		$meses = "Diciembre";
	}
	
//echo '<tr><td><b><font color="black"><li>' . $fieldsa[0] . '</b>' . '     ' . $fieldsa[1] . '</li></font></td></tr>';
//echo '<button class="btn btn-danger"><i class="fa fa-pencil"></i>Más Detalles</button>';


} 
}
//echo '</table></div>';


//echo '<button class="btn btn-danger"><i class="fa fa-pencil"></i>' .$lng['atcbingb'] . '</button>';



// Pilots
//echo '<h3>' . $lng['trafficingb'] . '</h3>';
if (count($pilots) != 0) {
   // echo '<table class="trafficlisttable">';
    foreach ($pilots as $pilot) {
        $realname = $pilot[2];
        if (substr($realname,-5,1) == ' ') {
            $realname = substr($realname,0,-5);
        }
        $realname = remove_accents(ucwords($pilot[2]));
       // echo '<tr><td width="50"><a href="http://www.ivao.ca/flighttrack.php?cs=' . $pilot[0] . '" onClick="MM_openBrWindow(\'http://www.ivao.ca/flighttrack.php?cs=' . $pilot[0] . '\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=600\');return false" target="_blank" title="' . $realname . '">' . $pilot[0] . '</a></td><td width="30">' . $pilot[11] . '</td><td>&gt;&nbsp;' . $pilot[13] . '</td></tr>';
    }
  //  echo '</table>';
} else {
  //  echo '<p style="margin-bottom: 20px; margin-left: 10px; color: gray;"><i>' .$lng['notrafficingb'] . '</i></p>';
}
?>


<?

//STAFF
//-------------------------------------------------------------------------------------------------------------------
if (count($staff) != 0) {
  //  echo '<h3>' . $lng['staffingb'] . '</h3>
  echo '<table class="trafficlisttable" width="160">';
    foreach ($staff as $staffmember) {
        $realname = $staffmember[2];
        $realname = remove_accents(ucwords($realname));
        echo '<tr><td><a href="http://www.ivao.aero/staff/details.asp?id=' . $staffmember[0] . '" target="_blank" onClick="MM_openBrWindow(\'http://www.ivao.aero/staff/details.asp?id=' . $staffmember[0] . '\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=600\');return false" title="' . $staffmember[0] . '">'. $staffmember[0]. '</a></td></tr>';
    }
    echo '</table>';
} else {
	
	echo "No hay Staff de División IVAO Colombia en Linea.";
}

?>



<?

echo '<br><hr>';
echo 'Hay '; echo count($controllers); echo' controladores, '; echo count($pilots); echo' pilotos, y '; echo count($staff); echo' miembros del Staff en línea en Colombia.';
echo '<br><hr><br><h1>IVAO World</h1>';
echo '<div class="trafficlistnettotal">' . sprintf($lng['totalonline'], $controllercount, $pilotcount) . '</div>';
?>
                    </p>
                </div>
             </div>
		     </div>
                    
                    
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel back-dash">
                               <i class="fa fa-dashboard fa-3x"></i><strong> &nbsp; ATC Online</strong>
                             <p class="text-muted">
							 <?php
							 
							 
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
           echo '<tr><td colspan="2"><strong>' . $apicao . ' - ' . $airports[$apicao] . '</td></tr>';
        }
        
        // Realname
        $realname = remove_accents(ucwords($controller[2]));
        
        // Level
        $level = $ctrlevel[$controller[16]];
        
        echo '<tr><td colspan="2"><a href="#" onClick="MM_openBrWindow(\'#'. $controller[0] .'\',\'\',\'scrollbars=yes,resizable=yes,width=700,height=600\');return false" target="_blank">&nbsp;&nbsp;<font color="red">' . $position . '</font></a></td><td><a href="http://www.ivao.aero/members/person/details.asp?id=' . $controller[1] . '" onClick="MM_openBrWindow(\'http://www.ivao.aero/members/person/details.asp?id=' . $controller[1] . '\',\'\',\'scrollbars=yes,resizable=yes,width=800,height=600\');return false" target="_blank" title="' . $realname . '"><font color="red">' . $controller[1] . '</font></a>&nbsp;(' . $level . ')</td></tr>';
    }
   echo '</table>';
} else {

    echo '<p style="margin-bottom: 20px; margin-left: 10px; color: gray;"><i>' . $lng['noatcingb'] . '</i></p>';
}

							 ?></p>
                        </div>
                       
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12 ">
                        <div class="panel ">
          <div class="main-temp-back">
            <div class="panel-body">
              <div class="row">
                <div class="col-xs-6"> <i class="fa fa-desktop"></i> <b><h3>Info División</h3></b> </div>
               <br>
				 <div class="col-xs-9"> 
<?php
include('./db_login.php');
	$id = $_GET['id'];
	
	$db = new mysqli($db_host , $db_username , $db_password , $db_database);
	$db->set_charset("utf8");
	
	if ($db->connect_errno > 0) {
		die('Unable to connect to database [' . $db->connect_error . ']');
	}

	
	$sql3 ="select * from infodivision where id=1";

	if (!$result3 = $db->query($sql3)) {
		die('There was an error running the query [' . $db->error . ']');
	}
	while ($row3 = $result3->fetch_assoc()) {
		$members= $row3["members"];
        $pilots= $row3["pilots"];
		$atc= $row3["atc"];
		$puesto= $row3["puesto"];
	
	}
	

		

	?>
	 
	
	  <form role="form" action="?page=infoactualizado" method="post">
                                        <div class="form-group">
                                            <label>Miembros Activos</label>
                                            <input class="form-control" name="members" value="<?php echo $members; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Pilotos</label>
                                            <input class="form-control" name="pca" value="<?php echo $pilots; ?>"/>
                                        </div>
										<div class="form-group">
                                            <label>Controladores</label>
                                            <input class="form-control" name="atc" value="<?php echo $atc; ?>"/>
                                        </div>
								<div class="form-group">
                                            <label>Puesto IVAO</label>
                                            <input class="form-control" name="spot" value="<?php echo $puesto; ?>"/>
                                        </div>
                                        <button type="submit" class="btn btn-default">Actualizar Info</button>

                                    </form>
                                  
				 </div>	 
								  
             </div>
            </div>
          </div>
          
        </div>
                   
			
    </div>
                        
        </div>
            
                
               
                 <!-- /. ROW  -->           
    </div>
             <!-- /. PAGE INNER  -->
            </div>
			
			<?php
	}
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
	} else {
		$Existe = file_exists($_GET["page"] . ".php");
		if ($Existe == true) {
			include($_GET["page"] . ".php");
		} else {
			echo "Page Not Found";
		}
	}
	
	

?>
<center><h5><font color="white">Adaptación diseño y Sistematización: Andrés Zapata 	&copy; <?php echo date('Y'); ?>. Todos los Derechos Reservados.</font></h5></center>

         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>

	<?php } ?>
