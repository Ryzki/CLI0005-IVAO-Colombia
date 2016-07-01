<div class="nav-collapse collapse">
	<ul class="nav pull-right">

		<!--##### HOME #####-->
		<li <?php echo (strstr($_SERVER["SCRIPT_NAME"],"index"))?'class="active"':''; ?>><a href="./">Inicio</a></li>

		<!--##### BRIEFING #####-->
<?php
		change_db($sqlconn,$rfedatabase);
		$query = "SELECT briefatc,briefpilots FROM rfe_about";
		$query = mysqlexec($sqlconn,$query);
		
		$menuexit = "";
		if (@mysql_result($query,0,'briefatc')) $menuexit='<li><a href="'.mysql_result($query,0,'briefatc').'">ATC Briefing</a></li>';
		if (@mysql_result($query,0,'briefpilots')) $menuexit.='<li><a href="'.mysql_result($query,0,'briefpilots').'">Pilots Briefing</a></li>';
		
		if (strlen($menuexit) != 0) {
?>
			<li class="dropdown <?php echo (strstr($_SERVER["SCRIPT_NAME"],"brief"))?'active':''; ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Briefing <b class="caret"></b></a>
				<ul class="dropdown-menu">
<?php
				if (empty($menuexit)) {	echo '<li><a href="#">None</a></li>'; } else { echo $menuexit; }
?>
				</ul>
			</li>
<?php
		}
?>
		<!--##### ABOUT #####-->
		<li <?php echo (strstr($_SERVER["SCRIPT_NAME"],"about"))?'class="active"':''; ?>><a href="about">Acerca del RFE</a></li>

		<!--##### BOOKING #####-->
		<li <?php echo (strstr($_SERVER["SCRIPT_NAME"],"booking"))?'class="active"':''; ?>><a href="booking" <?php echo (strstr($_SERVER["SCRIPT_NAME"],"booking"))?'':'id="booklink"'; ?> style="text-decoration: underline;">Reserva su vuelo!</a></li>

<?php
		//if($IVAO_Info->result) {

		change_db($sqlconn,$rfedatabase);
		$query = "SELECT id FROM rfe_flights WHERE vid='".$IVAO_Info->vid."'";
		$query = mysqlexec($sqlconn,$query);
		if(mysql_num_rows($query) > 0) {
?>
			<!--##### PILOT LOUNGE #####-->
			<li class="dropdown <?php echo (strstr($_SERVER["SCRIPT_NAME"],"bookedflights") || strstr($_SERVER["SCRIPT_NAME"],"ais"))?'active':''; ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sala de Piloto <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="bookedflights">Mis vuelos reservados</a></li>
					<li><a href="ais">AIS Salón</a></li>
				</ul>
			</li>
<?php
		}
	
		/*
		$query = "SELECT id FROM rfe_atc WHERE vid='".$IVAO_Info->vid."'";
		$query = mysqlexec($sqlconn,$query);
		if(mysql_num_rows($query) > 0) {*/
?>
		<!--##### ATC LOUNGE #####-->
			<!--<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">ATC Lounge <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="">Upcoming flights</a></li>-->
					<!--<li><a href="bookedatc">My Booked ATC</a></li>-->
					<!--<li><a href="weather">Weather conditions</a></li></li>
				</ul>
			</li>-->
<?php	
		//}
	//}
?>
		<!--##### ATC SCHEDULE #####-->
		<!--<li><a href="atcschedule">ATC Schedule</a></li>-->
		
		<!--##### GENERAL STATISTICS #####-->
		<li <?php echo (strstr($_SERVER["SCRIPT_NAME"],"stats"))?'class="active"':''; ?>><a href="stats">Estadísticas Generales</a></li>
		
<?php
		if($IVAO_Info->result) {
?>
			<!--##### PROFILE #####-->
			<li <?php echo (strstr($_SERVER["SCRIPT_NAME"],"profile"))?'class="active"':''; ?>><a href="profile">Mi Perfil</a></li>
<?php
		}
?>
			
<?php
		if($IVAO_Info->result) {
?>
			<!--##### LOGOUT #####-->
			<li><a data-toggle="modal" href="#modalLogoff" onClick="logout()" rel="tooltip" data-placement="bottom" data-html="true" title="<b>Logeado como</b><br><?php echo $IVAO_Info->firstname." ".$IVAO_Info->lastname." (".$IVAO_Info->vid.")"; ?>">Cerrar Sesión</a></li>
<?php
		} else {
?>
			<!--##### LOGIN #####-->
			<li><a href="<?php echo login_url; ?>?url=<?php echo url; ?>">Iniciar Sesión</a></li>
<?php
		}
?>
	</ul>
</div>