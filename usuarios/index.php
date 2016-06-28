<?php
//define variables
define('cookie_name', 'ivao_token');
define('login_url', 'http://login.ivao.aero/index.php');
define('api_url', 'http://login.ivao.aero/api.php');
define('url', 'http://www.ivaocol.com.co/');

//redirect function
function redirect() {
	setcookie(cookie_name, '', time()-3600);
	header('Location: '.url);
	exit;
}

//if the token is set in the link
if($_GET['IVAOTOKEN'] && $_GET['IVAOTOKEN'] !== 'error') {
	setcookie(cookie_name, $_GET['IVAOTOKEN'], time()+3600);
	header('Location: '.url);
	exit;
} elseif($_GET['IVAOTOKEN'] == 'error') {
	die('This domain is not allowed to use the Login API! Contact the System Adminstrator!');
}

//check if the cookie is set and/or is correct
if($_COOKIE[cookie_name]) {
	$user_array = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
	if($user_array->result) {
		//Success! A user has been found!
		
	} else {
		redirect();
    }
} else {
	redirect();
}




$infos = $user_array->vid;
		
		include('./db_login.php');
		
		$db = new mysqli($db_host , $db_username , $db_password , $db_database);
		$db->set_charset("utf8");
		if ($db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
		
		$sql115 = "select * from usuariosivao where vid=$infos";

		if (!$result115 = $db->query($sql115)) {
			die('There was an error running the query [' . $db->error . ']');
		}
		$is=0;
		
		while ($row2 = $result115->fetch_assoc()) {
			$is++;
		}
		
		$ip = $_SERVER['REMOTE_ADDR']; 
			$division = $user_array->division;
			$country = $user_array->country;
			$ranks= $user_array->ratingpilot;
			$ranks2= $user_array->ratingatc;
			$skype = $user_array->skype;
			$nombre = utf8_decode($user_array->firstname);
			$apellido = utf8_decode($user_array->lastname);
			
		if ($is>0){
			
			
			
				
				$sql1157 = "UPDATE usuariosivao set nombres='$nombre', apellidos='$apellido', skype='$skype', rangopca='$ranks', rangoatc='$ranks2', pais='$country ', division='$division', lastconect=now(), lastip='$ip' where vid='$infos'";

		if (!$result1157 = $db->query($sql1157)) {
			die('There was an error running the query [' . $db->error . ']');
		}
				
			
		
		
			
			
			
			
		} else
			
			{
				
					$sql177 = "insert into usuariosivao (vid,nombres,apellidos,skype,rangopca,rangoatc,pais,division,lastconect,lastip,ip)
                    values ('$infos','$nombre','$apellido','$skype','$ranks','$ranks2','$country','$division',now(),'$ip','$ip');";
				if (!$result77 = $db->query($sql177)) {
					die('There was an error running the query [' . $db->error . ']');
				}
				
				
			}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>IVAO Colombia</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar"  data-image="assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="./" class="simple-text">
                    IVAO Colombia
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="./">
                        <i class="pe-7s-graph"></i>
                        <p>INICIO</p>
                    </a>
                </li>
                <li>
                    <a href="./?page=user">
                        <i class="pe-7s-user"></i>
                        <p>Mi Perfil</p>
                    </a>
                </li>
                <li>
                    <a href="./?page=training">
                        <i class="pe-7s-note2"></i>
                        <p>Entrenamiento</p>
                    </a>
                </li>
                <li>
                    <a href="./?page=eventosatc">
                        <i class="pe-7s-news-paper"></i>
                        <p>Eventos ATC Reserva!</p>
                    </a>
                </li>
                <!--  <li>
                    <a href="./?page=airlines">
                        <i class="pe-7s-science"></i>
                        <p>Aerolíneas</p>
                    </a>
                </li> -->
                <li>
                    <a href="./?page=examenes">
                        <i class="pe-7s-map-marker"></i>
                        <p>Mis Examenes</p>
                    </a>
                </li>
               <!-- <li>
                    <a href="notifications.html">
                        <i class="pe-7s-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li> -->
				<li class="active-pro">
                    <a href="../RFEColombia/">
                        <i class="pe-7s-rocket"></i>
                        <p>RFE Colombia</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
 
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="./" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
						 <?
		  
		  include('./db_login.php');
		  
		  	$db = new mysqli($db_host , $db_username , $db_password , $db_database);

	$db->set_charset("utf8");

	if ($db->connect_errno > 0) {

		die('Unable to connect to database [' . $db->connect_error . ']');

	}
	
	$sql2a = "SELECT * FROM eventos ";

	if (!$result2a = $db->query($sql2a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	$ia=0;

	while ($row2a = $result2a->fetch_assoc()) {
	
	
	
	$añoa = substr ($row2a['fecha'], 0,4);
	$mesa = substr ($row2a['fecha'], 5,2);
	$diaa = substr ($row2a['fecha'], 8,2);
	$fechassa = $añoa .''.$mesa.''.$diaa;
	$hoya = date("Ymd");  
	if($fechassa >= $hoya) {
	$ia++;
	}
	}
	
	$sql23a = "SELECT * FROM noticias ";

	if (!$result23a = $db->query($sql23a)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	$ippa=0;

	while ($row23a = $result23a->fetch_assoc()) {
	
	
	$añoa = substr ($row23a['fecha'], 0,4);
	$mesa = substr ($row23a['fecha'], 5,2);
	$diaa = substr ($row23a['fecha'], 8,2);
	$fechassa = $añoa .''.$mesa.''.$diaa;
	$hoya = date("Ymd");  
	if($fechassa >= $hoya) {
	$ippa++;
	
	}
	}
	
	$sql23pa = "SELECT * FROM notams ";

	if (!$result23pa = $db->query($sql23pa)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	
$ippla=0;
	while ($row23pa = $result23pa->fetch_assoc()) {
	
	
	
$ippla++;

	}
	
	
	$total = $ippa+$ia+$ippla;
	?>
	
	
	
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
									<?php if($total==0) {
										
									} else { ?>
                                    <span class="notification"><?php echo $total; ?></span>
									<?php } ?>
                              </a>
                              <ul class="dropdown-menu">
							  <li><a><b>EVENTOS</b></a></li>
							   <?
		  
		
	
	$sql2 = "SELECT * FROM eventos ";

	if (!$result2 = $db->query($sql2)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	$i=0;

	while ($row2 = $result2->fetch_assoc()) {
	
	
	
	$año = substr ($row2['fecha'], 0,4);
	$mes = substr ($row2['fecha'], 5,2);
	$dia = substr ($row2['fecha'], 8,2);
	$fechass = $año .''.$mes.''.$dia;
	$hoy = date("Ymd");  
	if($fechass >= $hoy) {
	$i++;
	?>
	
	
	
	
		  
		  <li><a href="./?page=infoevent&id=<?php echo $row2['id']; ?>"><?php echo $row2['nombre']; ?> (<?php echo $row2['fecha']; ?>)</a></li>
	
	<?
	
	} 
	}
	
	
	if ($i==0)
	{
	echo '<li><a>No hay Eventos disponibles aún.</a></li>';
	
	 
	} 
		  
		  
		  ?>
		  <li><a><b>EXAMENES</b></a></li>
		  
		  <?
		 
	
	$sql23 = "SELECT * FROM noticias ";

	if (!$result23 = $db->query($sql23)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	$ipp=0;

	while ($row23 = $result23->fetch_assoc()) {
	
	
	$año = substr ($row23['fecha'], 0,4);
	$mes = substr ($row23['fecha'], 5,2);
	$dia = substr ($row23['fecha'], 8,2);
	$fechass = $año .''.$mes.''.$dia;
	$hoy = date("Ymd");  
	if($fechass >= $hoy) {
	$ipp++;
	
	?>
          
          
          <li><a href="./?page=infoexamen&id=<?php echo $row23['id']; ?>"><?php echo $row23['nombre_examen']; ?> (<?php echo $row23['fecha']; ?>)</a></li>
          
         
		  
		  
		  
	<?php  
	
	}
	}
	
	
	if ($ipp==0)
	{
	
	echo '<li><a>No hay Noticias o Examenes disponibles aún.</a></li>';
	 
	} 
		  
		  
		  ?>
		  <li><a><b>NOTAMS</b></a></li>
		   <?
		 
	
	$sql23p = "SELECT * FROM notams ";

	if (!$result23p = $db->query($sql23p)) {

		die('There was an error running the query  [' . $db->error . ']');

	}
	
	
$ippl=0;
	while ($row23p = $result23p->fetch_assoc()) {
	
	
	
$ippl++;
	
	?>
          
          
          <li><a href="./?page=infonotams&id=<?php echo $row23p['id']; ?>"><?php echo $row23p['titulo']; ?> (<?php echo $row23p['fecha']; ?>)</a></li>
          
         
		  
		  
		  
	<?php  
	
	
	
	}
	
	if ($ippl==0)
	{
	
	echo '<li><a>No hay Notams disponibles aún.</a></li>';
	 
	} 
		  
		  
		  ?>
                                
                              </ul>
                        </li>
                      
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="./?page=user">
                               Cuenta
                            </a>
                        </li>
                    <!--    <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Dropdown
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li> -->
                        <li>
                            <a href="./logout.php">
                                Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<?php
	if (!isset($_GET["page"]) || trim($_GET["page"]) == "") {
		?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Staff's IVAO CO</h4>
                                <p class="category">Información de Staff Activos en la división</p>
                            </div>
							<style type="text/css">
#global {
	height: 240px;
	width: 270px;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
}
#mensajes {
	height: auto;
}
.texto {
	padding:4px;
	background:#fff;
}

#global1 {
	height: 240px;
	width: 420px;
	border: 1px solid #ddd;
	background: #f1f1f1;
	overflow-y: scroll;
}
#mensajes1 {
	height: auto;
}
.texto1 {
	padding:4px;
	background:#fff;
}
</style>

                            <div class="content">
                                <div class="ct-chart ct-perfect-fourth">
								<div id="global">
  <div id="mensajes">
  <br>
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

?></div>
</div>
</div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> IVAO
                                        <i class="fa fa-circle text-danger"></i> Mejor
                                        <i class="fa fa-circle text-warning"></i> Cada día
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-clock-o"></i> Actualizado hace 1 sec.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">ATC en Línea</h4>
                                <p class="category">Información detallada de Controladores activos en división Colombia.</p>
                            </div>
                            <div class="content">
                                <div class="ct-chart">
											<div id="global1">
  <div id="mensajes1">
  <br>
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

							 ?>
							</div></div>	</div>
                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Los
                                        <i class="fa fa-circle text-danger"></i> Mejores
                                        <i class="fa fa-circle text-warning"></i> IVAO CO!
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Actualizado hace 1 sec.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">IVAO Colombia</h4>
                                <p class="category">Staff CO.</p>
                            </div>
                            <div class="content">
                                <div class="ct-chart">
								<h1>Gracias por ser parte de nuestra comunidad. Cada día crecemos y mejoramos!</h1>
								<h2>La mejor división! IVAO Colombia.</h2>
								</div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> #Colombia
                                        <i class="fa fa-circle text-danger"></i> #IVAO
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> CEO & Staff IVAO Colombia. Todos Los Derechos Reservados.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                </div>
            </div>
        </div>
<?php
	} else {
	
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
        <footer class="footer">
            <div class="container-fluid">
              <!--  <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav> -->
                <p class="copyright pull-right">
                    &copy; <?php echo date('Y'); ?> <a href="http://www.ivaocol.com.co">IVAO Colombia</a>, Sistematización Andrés Zapata.
                </p>
            </div>
        </footer>

    </div>
	
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to <b>IVAO Colombia Dashboard</b> - <?php echo utf8_decode($user_array->firstname).' '.utf8_decode($user_array->lastname). ' (' . $user_array->vid . ') !'; ?>."

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>
