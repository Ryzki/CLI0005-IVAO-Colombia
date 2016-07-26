<?php
//define variables
define('cookie_name', 'ivao_token');
define('login_url', 'http://login.ivao.aero/index.php');
define('api_url', 'http://login.ivao.aero/api.php');
define('url', 'http://www.ivaocol.com.co/es/gca/');

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

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IVAO Colombia | GCA</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">

    </head>

    <body>

	

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-7 text">
						<img src="./assets/img/co.svg" width="30%"/>
						<hr>
                            <h1><strong>GCA</strong> IVAO Colombia</h1>
                            <div class="description">
                            	<p>
La división Colombiana espera que los aspirantes al GCA cuenten con una calificación que sea equivalente a la posición a la que desean controlar. Por esto sólo se tendrán en cuenta los usuarios que ostenten el rango ADC "Aerodrome Controller" o superiór. La siguiente lista muestra las posiciones que se pueden cubrir:
<br>
<b><font color="yellow">ADC -> DEL/GND/TWR</font> | <font color="red">APC -> DEL/GND/TWR/APP</font> | <font color="blue">ACC -> DEL/GND/TWR/APP/CTR</font></b>  
									</p>
                            </div>
                            
                        </div>
                        <div class="col-sm-5 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Aplicar al GCA</h3>
                            		<p>Al enviar la solicitud, ha de inferir que acepta los términos de registro, manejo de información y los derechos de aprobación son reservados a IVAO Colombia:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="registration-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-first-name">Nombre Completo</label>
			                        	<input type="text" name="form-first-name" value="<?php echo utf8_decode($user_array->firstname) . ' ' . utf8_decode($user_array->lastname); ?>" class="form-first-name form-control" id="form-first-name" readonly="readonly">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-last-name">VID IVAO</label>
			                        	<input type="text" name="form-last-name" value="<?php echo $user_array->vid; ?>" class="form-last-name form-control" id="form-last-name" readonly="readonly">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-email">Email</label>
			                        	<input type="text" name="form-email" placeholder="Email..." class="form-email form-control" id="form-email">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-about-yourself">Explicación breve por la cual solicita el GCA</label>
			                        	<textarea name="form-about-yourself" placeholder="Explicación breve por la cual solicita el GCA" 
			                        				class="form-about-yourself form-control" id="form-about-yourself"></textarea>
			                        </div>
			                        <button type="submit" class="btn">Enviar Solicitud!</button>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>