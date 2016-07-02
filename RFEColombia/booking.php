<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the booking page.
   Author: Filipe Fonseca    13/06/2014
Revisions: Filipe Fonseca    17/08/2015
========================================================================*/
// INCLUDES
include("phpinc/config.inc.php");

// Get radio callsign configuration
$querycall = "SELECT useradiocallsign FROM rfe_config";
$querycall = mysqlexec($sqlconn,$querycall);
$radiocall  = mysql_result($querycall, 0, 'useradiocallsign');
?>
        <!--################ WRAP START ################-->

        <div id="wrap">

            <!--################ HEADER START ################-->

        
			  <header class="page-title" style="background: url(./images/header0.jpg) no-repeat;width:100%;height:300px">
			<div class="container" >
                   <ul class="slides">
				  
							<li><h1 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);">Reserve su vuelo!</h1><h3 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);">Debido a la cantidad de vuelos, esta página puede tomar algún tiempo para cargar. Por favor sea paciente.</h3><br/><img src="images/divlogo/divlogo@140px.png"/><br/><br/></li>
						</ul>
<!--						<h1><font color="red">Reserve su vuelo!</font></h1><br> <h3><font color="black">Debido a la cantidad de vuelos, esta página puede tomar algún tiempo para cargar. Por favor sea paciente.</font></h3> -->
                </div>
            </header>
				

				<section class="services-page">
							<div class="container">
								<input type="text" id="searchbook" placeholder="Número de Vuelo, ICAO, Aeronave (Código IATA)..." style="width: 100%;height:100%;font-size: 16px;" ><br>
							</div>
							
							<div class="container" id="resulttable">
								<table class="table table-striped table-hover">
									<thead style="background-color: white;border-bottom: 1px solid #ddd;">
										<tr align="center"><th class="col-sm-1">&nbsp;</th><th class="col-sm-1">&nbsp;</th><th class="col-sm-1">Vuelo</th><th class="col-sm-3">Aeronave</th><th class="col-sm-1">Origen</th><th class="col-sm-1">Destino</th><th class="col-sm-1">Tiempo</th><th class="col-sm-1">Gate</th><th class="col-sm-1">Estado</th></tr>
									</thead>
									<tbody id="resultbody">	
									</tbody>
								</table>
							</div>
							
							<div class="container" id="bookingtable">

								<!-- Nav tabs -->
								<ul class="nav nav-tabs">
								
<?php
								if (isset($_REQUEST['viewall']) AND ($_REQUEST['viewall'] == "1")) {
?>
									<li class="active" style="width:100%;text-align:center;"><a href="#all" data-toggle="tab"><img src="images/dep.png"> TODOS LOS VUELOS <img src="images/arr.png"></a></li>
<?php								
								} else {
							
									$query3 = "SELECT id FROM rfe_private";
									$query3 = mysqlexec($sqlconn,$query3);
									$allslots = mysql_num_rows($query3);

									if ($allslots > 0) {
?>									
										<li class="active" style="width:33%;text-align:center;"><a href="#dep" data-toggle="tab"><img src="images/dep.png"> Salidas</a></li>
										<li style="width:34%;text-align:center;"><a href="#arr" data-toggle="tab"><img src="images/arr.png"> Llegadas</a></li>
										<li style="width:33%;text-align:center;"><a href="#priv" data-toggle="tab"><img src="images/priv.png"> Slots Privados</a></li>
<?php
									} else {
?>
										<li class="active" style="width:50%;text-align:center;"><a href="#dep" data-toggle="tab"><img src="images/dep.png"> Salidas</a></li>
										<li style="width:50%;text-align:center;"><a href="#arr" data-toggle="tab"><img src="images/arr.png"> Llegadas</a></li>
<?php
									}
									
								}
?>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
								
<?php
								if (isset($_REQUEST['viewall']) AND ($_REQUEST['viewall'] == "1")) {
?>
									<div class="tab-pane fade in active" id="all">
										<table class="table table-striped table-hover">
											<thead style="background-color: white;border-bottom: 1px solid #ddd;">
													<tr align="center"><th class="col-sm-1">&nbsp;</th><th class="col-sm-1">Vuelo</th><?php if ($radiocall) echo '<th class="col-sm-1">Radio</th>'; ?><th class="col-sm-3">Aeronave</th><th class="col-sm-1">Destino</th><th class="col-sm-1">Tiempo</th><th class="col-sm-1">Slots</th><th class="col-sm-1">Gate</th><th class="col-sm-1">Estado</th>
													<?php if ($is_admin) { echo "<th>Manage</th>"; } ?>

												</tr>
											</thead>
											<tbody>	
<?php				
												// MANNING ALL FLIGHTS		
												change_db($sqlconn,$rfedatabase);
												$query = "SELECT timestart,timeend,timezone,TIME_TO_SEC(TIMEDIFF(timeend,timestart)) AS timediff FROM rfe_config";
												$query = mysqlexec($sqlconn,$query);
												$ts = mysql_result($query,0,"timestart");
												$te = mysql_result($query,0,"timeend");
												$tz = mysql_result($query,0,"timezone");
												$td = mysql_result($query,0,"timediff");

												$query = "SELECT id, flightnumber, IFNULL(radiocallsign,flightnumber) AS radiocallsign, acft, origin, destination,IFNULL(DATE_FORMAT(deptime, '%H%i'),'????') AS deptime,IFNULL(DATE_FORMAT(arrtime, '%H%i'),'????') AS arrtime,
												        DATE_FORMAT(CONVERT_TZ(deptime,'+00:00','".$tz."'), '%H%i') AS deplocaltime, DATE_FORMAT(CONVERT_TZ(arrtime,'+00:00','".$tz."'), '%H%i') AS arrlocaltime, IFNULL(gate,'<span style=\'color: red;font-style: italic\'>TBD</span>') AS gate, vid, bookingstatus
														FROM rfe_flights
														ORDER BY id";
												$query = mysqlexec($sqlconn,$query);
												$queryn = mysql_num_rows($query);
													
												for ($i=0;$i<$queryn;$i++) {
													change_db($sqlconn,$navdatabase);
													$queryorig = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"origin")."'";
													$queryorig = mysqlexec($sqlconn,$queryorig);
													$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"destination")."'";
													$querydest = mysqlexec($sqlconn,$querydest);
													change_db($sqlconn,$rfedatabase);
													
													$queryturnover = "SELECT turnover
													                  FROM rfe_flights
																			WHERE flightnumber = '".mysql_result($query,$i,"flightnumber")."'";
													$queryturnover = mysqlexec($sqlconn,$queryturnover);
													$turnover = mysql_result($queryturnover,0,'turnover');
													
													if (empty($turnover)) {		
														$queryturnover = "SELECT id, flightnumber
																 FROM rfe_flights
																 WHERE destination='".mysql_result($query,$i,"origin")."'
																 AND origin='".mysql_result($query,$i,"destination")."'
																 ".$timeclauseturnover."
																 AND (flightnumber LIKE '".substr(mysql_result($query,$i,"flightnumber"),0,3)."".((int)substr(mysql_result($query,$i,"flightnumber"),3,strlen(mysql_result($query,$i,"flightnumber")))+1) ."' OR flightnumber LIKE '".substr(mysql_result($query,$i,"flightnumber"),0,3)."".((int)substr(mysql_result($query,$i,"flightnumber"),3,strlen(mysql_result($query,$i,"flightnumber")))-1) ."')";
														$queryturnover = mysqlexec($sqlconn,$queryturnover);
														$turnover = mysql_num_rows($queryturnover);
													} else {
														$queryturnover = "SELECT flightnumber
																				FROM rfe_flights
																				WHERE id = '".mysql_result($queryturnover,0,"turnover")."'";
														$queryturnover = mysqlexec($sqlconn,$queryturnover);
														//$turnover = mysql_num_rows($queryturnover);
													}
?>
													<tr>
													<td style="vertical-align:middle"><?php if (file_exists("logos/".substr(mysql_result($query,$i,'flightnumber'),0,3).".gif")) { ?><img src="logos/<?php echo substr(mysql_result($query,$i,'flightnumber'),0,3); ?>.gif"/><?php } ?></td>
													<td style="vertical-align:middle"><?php if ($turnover <> 0) { ?><i class="fa fa-refresh fa-spin" rel="tooltip" data-placement="top" data-html="true" title="Turnover flight:<br><b><?php echo mysql_result($queryturnover,0,"flightnumber"); ?></b>"></i> <?php } echo mysql_result($query,$i,'flightnumber'); ?></td>
													<?php if ($radiocall) { ?><td style="vertical-align:middle"><?php if (is_null(mysql_result($query,$i,'radiocallsign'))) { echo mysql_result($query,$i,'flightnumber'); } else { echo mysql_result($query,$i,'radiocallsign'); } ?></td><?php } ?>
													<td style="vertical-align:middle;text-align:center"><span rel="tooltip" data-placement="top" title="<?php echo aircraftname(mysql_result($query,$i,'acft'),'name'); ?>"><?php echo aircraftname(mysql_result($query,$i,'acft')); ?></span></td>
													<td style="vertical-align:middle"><?php echo getCountry(mysql_result($query,$i,'origin'),"alt","24")." ".mysql_result($query,$i,'origin')." - ".mysql_result($queryorig,0,'Name'); ?></td>
													<td style="vertical-align:middle;cursor: pointer;" data-toggle="modal" onClick="loadModalAirport('<?php echo mysql_result($query,$i,'destination'); ?>')" href="#modalAirport"><?php echo getCountry(mysql_result($query,$i,'destination'),"alt","24")." ".mysql_result($query,$i,'destination')." - ".@mysql_result($querydest,0,'Name'); ?></td>
													<td style="vertical-align:middle"><span rel="tooltip" data-placement="top" title="<?php echo mysql_result($query,$i,'deplocaltime'); ?>LT"><?php echo mysql_result($query,$i,'deptime'); ?>Z</span><br/><span rel="tooltip" data-placement="top" title="<?php echo mysql_result($query,$i,'arrlocaltime'); ?>LT"><?php echo mysql_result($query,$i,'arrtime'); ?>Z</span></td>
													
													<?php if(strpos(mysql_result($query,$i,'gate')," ") === FALSE) { ?>
														<td style="vertical-align:middle;"><i class="fa fa-plane" rel="tooltip" data-placement="bottom" title="Gate"></i> <?php echo mysql_result($query,$i,'gate'); ?></td>
													<?php } else { ?>
														<td style="vertical-align:middle;"><i class="fa fa-building-o" rel="tooltip" data-placement="top" title="Terminal"></i> <?php echo str_replace(' ','<br><i class="fa fa-plane" rel="tooltip" data-placement="bottom" title="Gate"></i> ',mysql_result($query,$i,'gate')); ?></td>
													<?php } ?>
													
<?php
													$vid = mysql_result($query,$i,'vid');
													if (empty($vid)) {
?>
														<td style="vertical-align:middle"><button type="button" class="btn btn-success" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Disponible</button></td>
<?php
													} else {
														if (mysql_result($query,$i,'bookingstatus') == 1) {
?>
															<td style="vertical-align:middle;"><button type="button" class="btn btn-warning" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Reservado <b><?php echo mysql_result($query,$i,'vid'); ?>
<?php
														} else if (mysql_result($query,$i,'bookingstatus') == 2) {
?>
															<td style="vertical-align:middle;"><button type="button" class="btn btn-danger" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Reservado <b><?php echo mysql_result($query,$i,'vid'); ?>
<?php
														}
													}
													
													if ($is_admin) echo '<td style="vertical-align:middle"><img src="images/edit.png" data-toggle="modal" class="bookingadmin" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.33);" href="#modalEdit" onClick="loadEdit('.mysql_result($query,$i,"id").')" rel="tooltip" data-placement="left" title="Edit flight"> <img src="images/del.png" data-toggle="modal" class="bookingadmin" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.33);" href="#modalDelete" onClick="loadDelete('.mysql_result($query,$i,"id").')"  rel="tooltip" data-placement="right" title="Delete flight"></td>';
?>
													</tr>
<?php
												}
?>
											</tbody>
										</table>
									</div>
									
<?php
								} else {
?>
								
									<div class="tab-pane fade in active" id="dep">
										<table class="table table-striped table-hover">
											<thead style="background-color: white;border-bottom: 1px solid #ddd;">
													<tr align="center"><th class="col-sm-1">&nbsp;</th><th class="col-sm-1">Vuelo</th><?php if ($radiocall) echo '<th class="col-sm-1">Radio</th>'; ?><th class="col-sm-3">Aeronave</th><!--<th class="col-sm-1">Origin</th>--><th class="col-sm-1">Destino</th><th class="col-sm-1">Tiempo</th><th class="col-sm-1">Gate</th><th class="col-sm-1">Estado</th>
													<?php if ($is_admin) { echo "<th>Manage</th>"; } ?>

												</tr>
											</thead>
											<tbody>	
<?php				
												// MANNING DEPARTURES		
												change_db($sqlconn,$rfedatabase);
												$query = "SELECT timestart,timeend,timezone,TIME_TO_SEC(TIMEDIFF(timeend,timestart)) AS timediff FROM rfe_config";
												$query = mysqlexec($sqlconn,$query);
												$ts = mysql_result($query,0,"timestart");
												$te = mysql_result($query,0,"timeend");
												$tz = mysql_result($query,0,"timezone");
												$td = mysql_result($query,0,"timediff");
												if ($td > 0) {
													$timeclause         = "AND (deptime >= '".$ts."' AND deptime <= '".$te."')";
													$timeclauseturnover = "AND (arrtime >= '".$ts."' AND arrtime <= '".$te."')";
												} else if ($td < 0) {
													$timeclause         = "AND (deptime >= '".$ts."' OR deptime <= '".$te."')";
													$timeclauseturnover = "AND (arrtime >= '".$ts."' OR arrtime <= '".$te."')";
												} else if ($td == 0) {
													$timeclause         = "";
													$timeclauseturnover = "";
												}
												
												$query = "SELECT id, flightnumber, IFNULL(radiocallsign,flightnumber) AS radiocallsign, acft, origin, destination,DATE_FORMAT(deptime, '%H%i') AS deptime,
												         DATE_FORMAT(CONVERT_TZ(deptime,'+00:00','".$tz."'), '%H%i') AS deplocaltime, IFNULL(gate,'<span style=\'color: red;font-style: italic\'>TBD</span>') AS gate, vid, bookingstatus
														 FROM rfe_flights
														 WHERE origin='".mysql_result($querysel,0,"apticao")."'
														 ".$timeclause."
														 ORDER BY deplocaltime";
												$query = mysqlexec($sqlconn,$query);
												$queryn = mysql_num_rows($query);
													
												for ($i=0;$i<$queryn;$i++) {
													change_db($sqlconn,$navdatabase);
													$queryorig = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"origin")."'";
													$queryorig = mysqlexec($sqlconn,$queryorig);
													$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"destination")."'";
													$querydest = mysqlexec($sqlconn,$querydest);
													change_db($sqlconn,$rfedatabase);
													
													$queryturnover = "SELECT turnover
													                  FROM rfe_flights
																			WHERE flightnumber = '".mysql_result($query,$i,"flightnumber")."'";
													$queryturnover = mysqlexec($sqlconn,$queryturnover);
													$turnover = mysql_result($queryturnover,0,'turnover');
													
													if (empty($turnover)) {		
														$queryturnover = "SELECT id, flightnumber
																 FROM rfe_flights
																 WHERE destination='".mysql_result($query,$i,"origin")."'
																 AND origin='".mysql_result($query,$i,"destination")."'
																 ".$timeclauseturnover."
																 AND (flightnumber LIKE '".substr(mysql_result($query,$i,"flightnumber"),0,3)."".((int)substr(mysql_result($query,$i,"flightnumber"),3,strlen(mysql_result($query,$i,"flightnumber")))+1) ."' OR flightnumber LIKE '".substr(mysql_result($query,$i,"flightnumber"),0,3)."".((int)substr(mysql_result($query,$i,"flightnumber"),3,strlen(mysql_result($query,$i,"flightnumber")))-1) ."')";
														$queryturnover = mysqlexec($sqlconn,$queryturnover);
														$turnover = mysql_num_rows($queryturnover);
													} else {
														$queryturnover = "SELECT flightnumber
																				FROM rfe_flights
																				WHERE id = '".mysql_result($queryturnover,0,"turnover")."'";
														$queryturnover = mysqlexec($sqlconn,$queryturnover);
														//$turnover = mysql_num_rows($queryturnover);
													}
?>
													<tr>
													<td style="vertical-align:middle"><?php if (file_exists("logos/".substr(mysql_result($query,$i,'flightnumber'),0,3).".gif")) { ?><img src="logos/<?php echo substr(mysql_result($query,$i,'flightnumber'),0,3); ?>.gif"/><?php } ?></td>
													<td style="vertical-align:middle"><?php if ($turnover <> 0) { ?><i class="fa fa-refresh fa-spin" rel="tooltip" data-placement="top" data-html="true" title="Turnover flight:<br><b><?php echo mysql_result($queryturnover,0,"flightnumber"); ?></b>"></i> <?php } echo mysql_result($query,$i,'flightnumber'); ?></td>
													<?php if ($radiocall) { ?><td style="vertical-align:middle"><?php if (is_null(mysql_result($query,$i,'radiocallsign'))) { echo mysql_result($query,$i,'flightnumber'); } else { echo mysql_result($query,$i,'radiocallsign'); } ?></td><?php } ?>
													<td style="vertical-align:middle;text-align:center"><span rel="tooltip" data-placement="top" title="<?php echo aircraftname(mysql_result($query,$i,'acft'),'name'); ?>"><?php echo aircraftname(mysql_result($query,$i,'acft')); ?></span></td>
													<!--<td style="vertical-align:middle"><?php echo getCountry(mysql_result($query,$i,'origin'),"alt","24")." ".mysql_result($query,$i,'origin')." - ".mysql_result($queryorig,0,'Name'); ?></td>-->
													<td style="vertical-align:middle;cursor: pointer;" width="48%" data-toggle="modal" onClick="loadModalAirport('<?php echo mysql_result($query,$i,'destination'); ?>')" href="#modalAirport"><?php echo getCountry(mysql_result($query,$i,'destination'),"alt","24")." ".mysql_result($query,$i,'destination')." - ".@mysql_result($querydest,0,'Name'); ?></td>
													<td style="vertical-align:middle"><span rel="tooltip" data-placement="top" title="<?php echo mysql_result($query,$i,'deplocaltime'); ?>LT"><?php echo mysql_result($query,$i,'deptime'); ?>Z</span></td>
													
													<?php if(strpos(mysql_result($query,$i,'gate')," ") === FALSE) { ?>
														<td style="vertical-align:middle;"><i class="fa fa-plane" rel="tooltip" data-placement="bottom" title="Gate"></i> <?php echo mysql_result($query,$i,'gate'); ?></td>
													<?php } else { ?>
														<td style="vertical-align:middle;"><i class="fa fa-building-o" rel="tooltip" data-placement="top" title="Terminal"></i> <?php echo str_replace(' ','<br><i class="fa fa-plane" rel="tooltip" data-placement="bottom" title="Gate"></i> ',mysql_result($query,$i,'gate')); ?></td>
													<?php } ?>
													
<?php
													$vid = mysql_result($query,$i,'vid');
													if (empty($vid)) {
?>
														<td style="vertical-align:middle"><button type="button" class="btn btn-success" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Disponible</button></td>
<?php
													} else {
														if (mysql_result($query,$i,'bookingstatus') == 1) {
?>
															<td style="vertical-align:middle;"><button type="button" class="btn btn-warning" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Reservado <b><?php echo mysql_result($query,$i,'vid'); ?>
<?php
														} else if (mysql_result($query,$i,'bookingstatus') == 2) {
?>
															<td style="vertical-align:middle;"><button type="button" class="btn btn-danger" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Reservado <b><?php echo mysql_result($query,$i,'vid'); ?>
<?php
														}
													}
													
													if ($is_admin) echo '<td style="vertical-align:middle"><img src="images/edit.png" data-toggle="modal" class="bookingadmin" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.33);" href="#modalEdit" onClick="loadEdit('.mysql_result($query,$i,"id").')" rel="tooltip" data-placement="left" title="Edit flight"> <img src="images/del.png" data-toggle="modal" class="bookingadmin" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.33);" href="#modalDelete" onClick="loadDelete('.mysql_result($query,$i,"id").')"  rel="tooltip" data-placement="right" title="Delete flight"></td>';
?>
													</tr>
<?php
												}
?>
											</tbody>
										</table>
									</div>
								
									<div class="tab-pane fade" id="arr">
										<table class="table table-striped table-hover">
											<thead style="background-color: white;border-bottom: 1px solid #ddd;">
												<tr align="center"><th class="col-sm-1">&nbsp;</th><th class="col-sm-1">Vuelo</th><?php if ($radiocall) echo '<th class="col-sm-1">Radio</th>'; ?><th class="col-sm-3">Aeronave</th><th class="col-sm-1">Origen</th><th class="col-sm-1">Tiempo</th><th class="col-sm-1">Gate</th><th class="col-sm-1">Estado</th>
												<?php if ($is_admin) { echo "<th>Manage</th>"; } ?>
												</tr>
											</thead>
											<tbody>	
<?php		
												// MANNING ARRIVALS
												change_db($sqlconn,$rfedatabase);
												$query = "SELECT timestart,timeend,timezone,TIME_TO_SEC(TIMEDIFF(timeend,timestart)) AS timediff FROM rfe_config";
												$query = mysqlexec($sqlconn,$query);
												$ts = mysql_result($query,0,"timestart");
												$te = mysql_result($query,0,"timeend");
												$tz = mysql_result($query,0,"timezone");
												$td = mysql_result($query,0,"timediff");
												if ($td > 0) {
													$timeclause         = "AND (arrtime >= '".$ts."' AND arrtime <= '".$te."')";
													$timeclauseturnover = "AND (deptime >= '".$ts."' AND deptime <= '".$te."')";
												} else if ($td < 0) {
													$timeclause         = "AND (arrtime >= '".$ts."' OR arrtime <= '".$te."')";
													$timeclauseturnover = "AND (deptime >= '".$ts."' OR deptime <= '".$te."')";
												} else if ($td == 0) {
													$timeclause         = "";
													$timeclauseturnover = "";
												}
												
												$query = "SELECT id, flightnumber, radiocallsign, acft, origin, destination,DATE_FORMAT(arrtime, '%H%i') AS arrtime,DATE_FORMAT(CONVERT_TZ(arrtime,'+00:00','".$tz."'), '%H%i') AS arrlocaltime, IFNULL(gate,'<span style=\'color: red;font-style: italic\'>TBD</span>') AS gate, vid, bookingstatus FROM rfe_flights
															 WHERE destination='".mysql_result($querysel,0,"apticao")."'
															 ".$timeclause."
															 ORDER BY arrlocaltime;";		
												$query = mysqlexec($sqlconn,$query);
												$queryn = mysql_num_rows($query);
												
												for ($i=0;$i<$queryn;$i++) {
													change_db($sqlconn,$navdatabase);
													$queryorig = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"origin")."'";
													$queryorig = mysqlexec($sqlconn,$queryorig);
													$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"destination")."'";
													$querydest = mysqlexec($sqlconn,$querydest);
													change_db($sqlconn,$rfedatabase);
													
													$queryturnover = "SELECT turnover
													                  FROM rfe_flights
																			WHERE flightnumber = '".mysql_result($query,$i,"flightnumber")."'";
													$queryturnover = mysqlexec($sqlconn,$queryturnover);
													$turnover = mysql_result($queryturnover,0,'turnover');
													
													if (empty($turnover)) {		
														$queryturnover = "SELECT id, flightnumber
																 FROM rfe_flights
																 WHERE destination='".mysql_result($query,$i,"origin")."'
																 AND origin='".mysql_result($query,$i,"destination")."'
																 ".$timeclauseturnover."
																 AND (flightnumber LIKE '".substr(mysql_result($query,$i,"flightnumber"),0,3)."".((int)substr(mysql_result($query,$i,"flightnumber"),3,strlen(mysql_result($query,$i,"flightnumber")))+1) ."' OR flightnumber LIKE '".substr(mysql_result($query,$i,"flightnumber"),0,3)."".((int)substr(mysql_result($query,$i,"flightnumber"),3,strlen(mysql_result($query,$i,"flightnumber")))-1) ."')";
														$queryturnover = mysqlexec($sqlconn,$queryturnover);
														$turnover = mysql_num_rows($queryturnover);
													} else {
														$queryturnover = "SELECT flightnumber
																				FROM rfe_flights
																				WHERE id = '".mysql_result($queryturnover,0,"turnover")."'";
														$queryturnover = mysqlexec($sqlconn,$queryturnover);
														//$turnover = mysql_num_rows($queryturnover);
													}
?>
													<tr>
													<td style="vertical-align:middle"><?php if (file_exists("logos/".substr(mysql_result($query,$i,'flightnumber'),0,3).".gif")) { ?><img src="logos/<?php echo substr(mysql_result($query,$i,'flightnumber'),0,3); ?>.gif"/><?php } ?></td>
													<td style="vertical-align:middle"><?php if ($turnover <> 0) { ?><i class="fa fa-refresh fa-spin" rel="tooltip" data-placement="top" data-html="true" title="Turnover flight:<br><b><?php echo mysql_result($queryturnover,0,"flightnumber"); ?></b>"></i> <?php } echo mysql_result($query,$i,'flightnumber'); ?></td>
													<?php if ($radiocall) { ?><td style="vertical-align:middle"><?php if (is_null(mysql_result($query,$i,'radiocallsign'))) { echo mysql_result($query,$i,'flightnumber'); } else { echo mysql_result($query,$i,'radiocallsign'); } ?></td><?php } ?>
													<td style="vertical-align:middle;text-align:center"><span rel="tooltip" data-placement="top" title="<?php echo aircraftname(mysql_result($query,$i,'acft'),'name'); ?>"><?php echo aircraftname(mysql_result($query,$i,'acft')); ?></span></td>
													<td style="vertical-align:middle;cursor: pointer;" width="48%" data-toggle="modal" onClick="loadModalAirport('<?php echo mysql_result($query,$i,'origin'); ?>')" href="#modalAirport"><?php echo getCountry(mysql_result($query,$i,'origin'),"alt","24")." ".mysql_result($query,$i,'origin')." - ".@mysql_result($queryorig,0,'Name'); ?></td>
													<!--<td style="vertical-align:middle"><?php echo getCountry(mysql_result($query,$i,'destination'),"alt","24")." ".mysql_result($query,$i,'destination')." - ".mysql_result($querydest,0,'Name'); ?></td>-->
													<td style="vertical-align:middle"><span rel="tooltip" data-placement="top" title="<?php echo mysql_result($query,$i,'arrlocaltime'); ?>LT"><?php echo mysql_result($query,$i,'arrtime'); ?>Z</span></td>
													
													<?php if(strpos(mysql_result($query,$i,'gate')," ") === FALSE) { ?>
														<td style="vertical-align:middle;"><i class="fa fa-plane" rel="tooltip" data-placement="bottom" title="Gate"></i> <?php echo mysql_result($query,$i,'gate'); ?></td>
													<?php } else { ?>
														<td style="vertical-align:middle;"><i class="fa fa-building-o" rel="tooltip" data-placement="top" title="Terminal"></i> <?php echo str_replace(' ','<br><i class="fa fa-plane" rel="tooltip" data-placement="bottom" title="Gate"></i> ',mysql_result($query,$i,'gate')); ?></td>
													<?php } ?>
<?php
													$vid = mysql_result($query,$i,'vid');
													if (empty($vid)) {
?>
														<td style="vertical-align:middle"><button type="button" class="btn btn-success" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Disponible</button></td>
<?php
													} else {
														if (mysql_result($query,$i,'bookingstatus') == 1) {
?>
															<td style="vertical-align:middle;"><button type="button" class="btn btn-warning" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Reservado <b><?php echo mysql_result($query,$i,'vid'); ?></b></button></td>
<?php
														} else if (mysql_result($query,$i,'bookingstatus') == 2) {
?>
															<td style="vertical-align:middle;"><button type="button" class="btn btn-danger" data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)">Reservado <b><?php echo mysql_result($query,$i,'vid'); ?></b></button></td>
<?php
														}
													}
													
													if ($is_admin) { echo '
													<td style="vertical-align:middle"><img src="images/edit.png" data-toggle="modal" class="bookingadmin" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.33);" href="#modalEdit" onClick="loadEdit('.mysql_result($query,$i,"id").')"  data-toggle="tooltip" data-placement="left" title="Edit flight"> <img src="images/del.png" data-toggle="modal" class="bookingadmin" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.33);" href="#modalDelete" onClick="loadDelete('.mysql_result($query,$i,"id").')"  data-toggle="tooltip" data-placement="right" title="Delete flight"></td>'; }
?>
													</tr>
<?php
												}
?>
										</table>
									</div>
<?php
								}
?>
									
<?php
// MANNING PRIVATE BOOKING
if (!empty($_POST["slot"]) AND !empty($_POST["callreg"]) AND !empty($_POST["orgn"]) AND !empty($_POST["dest"]) AND !empty($_POST["acft"])) {

	$query = "SELECT email FROM rfe_members WHERE vid = '".$IVAO_Info->vid."'";
	$query = mysqlexec($sqlconn,$query);
	$email = mysql_result($query,0,'email');
	  
	if (empty($email)) {
		$query = 'UPDATE rfe_members SET email= "'.$_POST["email"].'"
		          WHERE vid = "'.$IVAO_Info->vid.'"';
		$query = mysqlexec($sqlconn,$query);
	}

	$query = "SELECT iata FROM nav_aircrafts WHERE icao='".strtoupper($_POST["acft"])."'";
	$query = mysqlexec($sqlconn,$query);
	$iata  = mysql_result($query,0,"iata");
	
	if (empty($iata)) {
		$iata = strtoupper($_POST["acft"]);
	}

	$query = 'INSERT INTO rfe_privatependent(flightnumber,origin,destination,slottime,acft,route,vid,requesttimestamp) VALUES
	          ("'.strtoupper($_POST["callreg"]).'","'.strtoupper($_POST["orgn"]).'","'.strtoupper($_POST["dest"]).'","'.strtoupper($_POST["slot"]).'","'.$iata.'",'.((empty($_POST["route"])) ? 'NULL' : '"'.strtoupper($_POST["route"]).'"').',"'.$IVAO_Info->vid.'",NOW())';
	$query = mysqlexec($sqlconn,$query);
	$booksuccess = '<div class="alert alert-success"><h4>Well Done!</h4><br/>The booking has been registered. You\'ll receive an e-mail if your request has been accepted.</div>';
}
?>
									
									<div class="tab-pane fade" id="priv">
										<div class="tab-content">
											<div class="tab-pane fade in active" id="priv">
<?php
											  $query3 = "SELECT id FROM rfe_private";
											  $query3 = mysqlexec($sqlconn,$query3);
											  $allslots = mysql_num_rows($query3);
											  
											  if ($allslots > 0) {
?>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
													<tr>
														<td style="vertical-align: top;">
															<table class="table-striped table-hover" width="300px" cellpadding="8">
																<thead style="background-color: white;border-bottom: 1px solid #ddd;">
																<tr align="center"><th class="col-sm-1">Slot</th><th class="col-sm-1">Status</th></tr>
																</thead>
																<tbody>	
			<?php							
															$query = "SELECT id, DATE_FORMAT(slottime, '%H%i') AS slottime, slottime AS slottimeorig,  DATE_FORMAT(CONVERT_TZ(slottime,'+00:00','".$tz."'), '%H%i') AS slotlocaltime, vid FROM rfe_private
																	  WHERE (slottime >= '00:00' AND slottime <= '23:59')
																	  ORDER BY slottime";
															$query = mysqlexec($sqlconn,$query);
															$queryn = mysql_num_rows($query);

															for ($i=0;$i<$queryn;$i++) {
																/*change_db($sqlconn,$navdatabase);
																$queryorig = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"origin")."'";
																$queryorig = mysqlexec($sqlconn,$queryorig);
																$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"destination")."'";
																$querydest = mysqlexec($sqlconn,$querydest);
																change_db($sqlconn,$rfedatabase);*/
			?>
																<tr>
																<td align="center"><?php echo mysql_result($query,$i,'slottime'); ?>Z</td>
			<?php
																$vid = mysql_result($query,$i,'vid');
																if (empty($vid)) {
			?>
																<td align="center"><button type="button" class="btn btn-success" style="width: 200px;" data-toggle="modal" href="#">Disponible</button></td></tr>
			<?php
																} else {
			?>
																<td align="center"><button type="button" class="btn btn-danger" style="width: 200px;" data-toggle="modal" href="#modalFlights"  onClick="loadPrivate(<?php echo mysql_result($query,$i,'id'); ?>)"><b>Reservado <?php echo mysql_result($query,$i,'vid'); ?></b></button></td></tr>
			<?php
																}
															}
			?>
																</tbody>
															</table>
														</td>
														<td align="left" valign="top" style="text-align: justify">
															<span style="color: #FF0000"><strong>IMPORTANTE! Leer acá si tu deseas reservar un slot privado!</strong></span>
															<br>
															<br>
															Se puede ver en el lado izquierdo todos disponibles y reservado slots privados. Sólo puede hacer clic en las franjas horarias ya reservados para ver la información de vuelo. Para asegurarse de que el intervalo de tiempo se ajusta al otro tráfico regular, es necesario rellenar el siguiente formulario. Uno de nuestros supervisores de operaciones comprobará su reserva y añadirlo en el horario. Este proceso puede tardar un máximo de un día y usted recibirá, por supuesto, un correo de confirmación.
															<br>
															<br>
															<strong>Este slots privados son para los siguientes tipos de vuelos: VFR (para el uso de pista de hormigón), reactores de negocios, carga, líneas aéreas virtuales y los vuelos individuales. Es necesario tener una ranura, si usted no tiene una ranura para el ATC no se aceptará si no hay ninguna ranura libre disponible.</strong> Incluso una reserva durante el evento es posible. Si decide hacer un vuelo espontánea, verificar si hay una ranura disponible y el supervisor de operaciones will assign you a free slot.
															<br>
															<br>
															<strong><i>Una ranura por el movimiento!</strong> Si quiere llegar y salir de nuevo tienes que reservar dos ranuras!</i>
															<br>
															<br>
															Rellene todos los campos con cuidado con los datos necesarios. Cada campo es obligatorio. se denegarán las solicitudes de franjas llenas incorrectas. Si usted tiene cualquier pregunta, escribir un correo a la operación:
															
<?php
															// Get Contact Information of the division from the Database
															$query2 = "SELECT mainemail FROM rfe_contacts";
															$query2 = mysqlexec($sqlconn,$query2);
?>
															<a href="mailto:<?php echo mysql_result($query2,0,'mainemail'); ?>?subject=RFE Slot System Question"><?php echo mysql_result($query2,0,'mainemail'); ?></a>.
															<br>
															<br>
<?php                                        if ($booksuccess) echo $booksuccess; ?>
															<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
<?php															  
																  $query = "SELECT privatebook FROM rfe_config";
																  $query = mysqlexec($sqlconn,$query);
																  $privatestatus = mysql_result($query,0,'privatebook');
																  $query2 = "SELECT id FROM rfe_private WHERE vid IS NULL";
																  $query2 = mysqlexec($sqlconn,$query2);
																  $freeslots = mysql_num_rows($query2);
																  
																  if (($privatestatus == "1") AND ($freeslots != 0))  {
?>
																	<td>
																		<table border="0" cellspacing="0" cellpadding="3">
																		<form method="post" action="booking#priv" enctype="multipart/form-data">
																		<fieldset>
																		<legend>Solicitar reserva de un slot acá</legend>
																			<tr>
																				<th style="vertical-align: middle; width: 240px;">Seleccionar Slot</th>
																				<td style="vertical-align: middle; width: 80%;">
																				<select name="slot" id="slot" style="width: 33%;"/>
<?php															  
																				  $query = "SELECT DATE_FORMAT(slottime, '%H%i') AS slottime, slottime AS slottimeorig FROM rfe_private WHERE vid IS NULL ORDER BY slottime";
																				  $query = mysqlexec($sqlconn,$query);
																				  $queryn = mysql_num_rows($query);

																				  for ($i=0;$i<$queryn;$i++) {
?>
																				   <option value="<?php echo mysql_result($query,$i,"slottimeorig"); ?>"><?php echo mysql_result($query,$i,"slottime"); ?>Z</option>
<?php															  
																				  }
?>
																				</select>
																				</td>
																			</tr>
																			<tr>
																				<th style="vertical-align: middle; width: 240px;">Callsign/Registrar</th>
																				<td style="vertical-align: middle; width: 80%">
																					<input type="text" name="callreg" id="callreg" maxlength="7" style="width: 30%;font-weight: bold;" required></div>
																				</td>
																			</tr>
																			<tr>
																				<th style="vertical-align: middle; width: 240px;">Origen (ICAO)</th>
																				<td style="vertical-align: middle; width: 80%">
																					<input type="text" name="orgn" id="orgn" maxlength="4" onKeyUp='if(this.value.length == 4) { loadApt(this.value.toUpperCase(),"orgndiv"); } else { $("#orgndiv").html(""); }' style="width: 30%;" required>
																					<div id="orgndiv" style="display:inline;padding-left: 10px;"></div>
																				</td>
																			</tr>
																			<tr>
																				<th style="vertical-align: middle; width: 240px;">Destino (ICAO)</th>
																				<td style="vertical-align: middle; width: 80%;">
																					<input type="text" name="dest" id="dest" maxlength="4" onKeyUp='if(this.value.length == 4) { loadApt(this.value.toUpperCase(),"destdiv"); } else { $("#destdiv").html(""); }' style="display:inline;width: 30%;" required>
																					<div id="destdiv" style="display:inline; padding-left: 10px;"></div>
																				</td>
																			</tr>
																			<tr>
																				<th style="vertical-align: middle; width: 240px;">Aeronave (ICAO)</th>
																				<td style="vertical-align: middle; width: 80%">
																					<input type="text" name="acft" id="acft" maxlength="4" onKeyUp='if(this.value.length > 1) { loadAcft(this.value.toUpperCase()); } else { $("#acftdiv").html(""); }' style="width: 30%;" required>
																					<div id="acftdiv" style="display:inline;padding-left: 10px;"></div>
																				</td>
																			</tr>
																			<tr>
																				<th style="vertical-align: middle; width: 240px;">Ruta</th>
																				<td style="vertical-align: middle; width: 80%"><input type="text" name="route" id="route" style="width: 95%;font-family:Courier New,monospace;"/></td>
																			</tr>
																			<tr>
																				<th style="vertical-align: middle; width: 240px;">E-mail</th>
<?php															  
																			$query = "SELECT email FROM rfe_members WHERE vid = '".$IVAO_Info->vid."'";
																			$query = mysqlexec($sqlconn,$query);
																			$email = mysql_result($query,0,'email');
																	  
																			if (empty($email)) {
?>
																				<td style="vertical-align: middle; width: 80%"><input type="email" name="email" id="email" style="width: 95%;" required></td>
<?php															  
																			} else {
?>
																				<td style="vertical-align: middle; width: 80%; height: 34px;"><?php echo mysql_result($query,0,'email'); ?></td>
<?php																				
																			}
?>
																			</tr>
																			<tr>
																				<th></th>
																				<td style="vertical-align: middle; width: 80%"><button type="submit" class="btn btn-info" style="width: 200px;">Solicitar Reserva</button></td>
																			</tr>
																		</fieldset>
																		</form>
																		</table>
																	</td>
<?php
																  } else if (($privatestatus == "0") AND ($freeslots != 0)) {
?>
																	<td><center><h3>(RESERVA PRIVADA ESTA CERRADA!)</h3></center></td>
<?php
																  } else if ($freeslots == 0) {
?>
																	<td><center><h3>(Todas las ranuras estan RESERVADAS)</h3></center></td>
<?php
																  }
?>
																</tr>
															</table>
                                          </td>
													</tr>
												</table>
<?php
											} else {
?>
												<center><h3>(No hay ranuras privado a RESERVE)</h3></center>
<?php
											}
?>
											</div>
										</div>
									</div>
									
								</div>					
<?php

								if ($is_admin) {
								
									switch ($is_admin_level) {
									
										case 0:
											echo '
											<br/><br/><center>
											<div style="width: 300px; height: 48px"><span style="color: #999;">Editor Menu</span><br/>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);" data-toggle="modal" href="#modalAdd" onClick="loadAdd();">
													<img src="images/add.png"> Add Flight
												</div>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);">
													<a href="booking?viewall=1"><img src="images/plane.png"> View All Flights</a>
												</div>
											</div></center>';
											break;
										case 1:
											echo '
											<br/><br/><center>
											<div style="width: 450px; height: 48px"><span style="color: #999;">Admin Menu</span><br/>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);" data-toggle="modal" href="#modalAdd" onClick="loadAdd();">
													<img src="images/add.png"> Add Flight
												</div>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);" data-toggle="modal" href="booking?viewall=1">
													<img src="images/plane.png"> View All Flights
												</div>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);">
													<a href="booking?viewall=1"><img src="images/plane.png"> View All Flights</a>
												</div>
											</div></center>';
											break;
										case 2:
											echo '
											<br/><br/><center>
											<div style="width: 750px; height: 48px"><span style="color: #999;">Admin Menu</span><br/>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);" data-toggle="modal" href="#modalAdd" onClick="loadAdd();">
													<img src="images/add.png"> Add Flight
												</div>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);">
													<a href="booking?viewall=1"><img src="images/plane.png"> View All Flights</a>
												</div>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);" data-toggle="modal" href="#modalEditEvent" onClick="loadEditEvent();">
													<img src="images/editgen.png">  Edit Event
												</div>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);" data-toggle="modal" href="#modalSlotManage" onClick="loadSlotManage();">
													<img src="images/slot.png">  Slot Management
												</div>
												<div class="eventedit" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.5);" data-toggle="modal" href="#modalAdmin" onClick="loadAdminEdit();">
													<img src="images/user.png">  Admin Control
												</div>
											</div></center>';
											break;
										default:
											break;
										
									}
								
								}
?>
							</div>
						</section>   
						
				</div>


        <!--################ PUSH WILL KEEP THE FOOTER AT BOTTOM IF YOU WANT TO CREATE OTHER PAGES ################-->
        <div id="push"></div>


		<!--################ FOOTER START ################
		                         AND
		#################### JAVASCRIPTS #################-->
		<?php include("phpinc/footer.inc.php"); ?>
		<!--################ FOOTER END ################-->
		<script>
			var offset = $('.navbar').height();
			$("html:not(.legacy) table").stickyTableHeaders({fixedOffset: offset});
		</script>
<?php															  
		$query = "SELECT id,email FROM rfe_members WHERE vid = '".$IVAO_Info->vid."'";
		$query = mysqlexec($sqlconn,$query);
		$email = mysql_result($query,0,'email');
  
		if (isset($IVAO_Info) AND empty($email)) {
?>
		<script>
			 $(window).load(function(){
				  $('#modalMail').modal('show');
			 });
		</script>
<?php															  
		}
?>

		
        <!--Modals--> 
<?php
		/*$query = "SELECT id FROM rfe_flights ORDER BY id";
		$query = mysqlexec($sqlconn,$query);
		$queryn = mysql_num_rows($query);*/
?>
		<div id="modalFlights" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
		<div id="modalAirport" class="modal hide fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
		<div id="modalAdd" class="modal hide fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
		<div id="modalEdit" class="modal hide fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
		<div id="modalDelete" class="modal hide fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
		<div id="modalEditEvent" class="modal hide fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
		<div id="modalSlotManage" class="modal hide fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
		<div id="modalAdmin" class="modal hide fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
	
		<div id="modalMail" class="modal hide fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Registre su email</h3>
			</div>
			<div id="modalMailbody" class="modal-body">
				<p>Por favor, con el fin de obtener actualizaciones y confirmaciones de nosotros directamente en su correo electrónico, se escriben a continuación y pulse el botón Guardar. Muchas gracias.</p>
				<input type="email" placeholder="Escribir su correo acá" name="membermail" id="membermail" style="width: 95%;font-weight: bold;" required/>
			</div>

			<div class="modal-footer">
				<button class="btn btn-inverse" data-dismiss="modal" aria-hidden="true">Cerrar</button>
				<button name="singlebutton" class="btn btn-success" onClick="saveMail('<?php echo mysql_result($query,0,'id'); ?>');">Guardar Correo</button>
			</div>
		</div>
		

 </body>

</html>