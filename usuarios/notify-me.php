<?php


	

	$infos = $user_array->vid;
	
	
		
		
		
	$to = $correo;
$subject = "Confirmación Sistema IVAO Colombia";
$txt = "En este Email, encontrará consignada la información para validar su ingreso al sistema.

Link: http://www.ivaocol.com.co/es/validacioninfo.php?vid=$infos&estado=1

=================================================

Mensaje automático, Saludos.
";
$headers = "From: co-wm@ivao.aero" . "\r\n" .
"CC: co-wm@ivao.aero";



mail($to,utf8_decode($subject),$txt,$headers);	





		
		
		?>
				
			
		<script>
alert('El correo ha sido enviado, en un lapso de un dia llegara el correo!.');
window.location = './';
</script>