<?php
	header('Content-type: application/json');
	$status = array(
		'type'=>'success',
		'message'=>'Gracias por ponerte en contacto con nosotros. Tan pronto como sea posible nosotros te responderemos.'
	);
 $ip= $_SERVER['REMOTE_ADDR']; 
    $name = @trim(stripslashes($_POST['name'])); 
    $email = @trim(stripslashes($_POST['email'])); 
    $subject = @trim(stripslashes($_POST['subject'])); 
    $message = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = 'co-wm@ivao.aero';//replace with your email

    $body = 'Nombre: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Asunto: ' . $subject . "\n\n" . 'Mensaje: ' . $message . "\n\n" . 'SEGURIDAD IVAO Colombia: IP ' . $ip;

    $success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

    echo json_encode($status);
    die;