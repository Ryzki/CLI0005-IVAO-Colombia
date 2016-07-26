<?php
	
 $ip= $_SERVER['REMOTE_ADDR']; 
    $name = @trim(stripslashes($_POST['name'])); 
    $email = @trim(stripslashes($_POST['email'])); 
    $subject = @trim(stripslashes($_POST['subject'])); 
    $message = @trim(stripslashes($_POST['message'])); 

  
	$para      = $email;
$titulo    = $subject;
$mensaje   = 'Mensaje Enviado Por: ' . $name 
. ' El Mensaje es: ' . $message .
' IP: ' . $ip;
$cabeceras = 'From: co-staff@ivao.aero' . "\r\n" .
    'Reply-To: ' . $email . '' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($para, $titulo, $mensaje, $cabeceras);

  ?>
  <script>
alert('Mensaje Enviado');
window.location.href='./';
</script>