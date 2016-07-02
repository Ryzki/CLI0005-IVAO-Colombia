<?php
include("phpinc/config.inc.php");
?>
    <!--################ WRAP START ################-->

        <div id="wrap">

            <!--################ HEADER START ################-->

           
			
			<header class="page-title" style="background: url(./images/header3.jpg) no-repeat;width:100%;height:300px">
			<div class="container" >
                   <ul class="slides">
				  
							<li><h1 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);">Mis vuelos reservados</h1><h3 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);">Si no aparecen todos sus vuelos aquí, por favor, actualice la página (pulse F5).</h3><br/><img src="images/divlogo/divlogo@140px.png"/><br/><br/></li>
						</ul>
<!--						<h1><font color="red">Reserve su vuelo!</font></h1><br> <h3><font color="black">Debido a la cantidad de vuelos, esta página puede tomar algún tiempo para cargar. Por favor sea paciente.</font></h3> -->
                </div>
            </header>

            <section class="services-page">
						  <div class="container">
							
							<div id="ajaxinfo"></div>
							
<?php
				change_db($sqlconn,$rfedatabase);
				$query = "SELECT id FROM rfe_flights WHERE vid='".$IVAO_Info->vid."'";
				$query = mysqlexec($sqlconn,$query);
				if(mysql_num_rows($query) > 0) {
?>
								<div class="accordion" id="accordion2">
<?php			
									$query = "SELECT timestart,timeend,timezone,TIME_TO_SEC(TIMEDIFF(timeend,timestart)) AS timediff FROM rfe_config";
									$query = mysqlexec($sqlconn,$query);
									$tz = mysql_result($query,0,"timezone");
									
									$query = "SELECT id, flightnumber, IFNULL(radiocallsign,flightnumber) AS radiocallsign, acft, origin, destination,
									          IFNULL(DATE_FORMAT(deptime, '%H%i'),'----') AS deptime, DATE_FORMAT(CONVERT_TZ(deptime,'+00:00','".$tz."'), '%H%i') AS deplocaltime,
												 IFNULL(DATE_FORMAT(arrtime, '%H%i'),'----') AS arrtime, DATE_FORMAT(CONVERT_TZ(arrtime,'+00:00','".$tz."'), '%H%i') AS arrlocaltime,
												 IFNULL(gate,'TBD') AS gate, IFNULL(route,'TBD') AS route, vid, bookingstatus,
												 IFNULL(deptime,arrtime) AS reftime
												 FROM rfe_flights
												 WHERE vid='".$IVAO_Info->vid."'
												 ORDER BY reftime";

									/*$query = "SELECT id,flightnumber,origin,destination,IFNULL(deptime,'----') AS deptime,IFNULL(arrtime,'----') AS arrtime,IFNULL(gate,'TBD') AS 	gate,acft,IFNULL(route,'TBD') AS route,vid, ADDTIME( RIGHT( CAST( deptime AS time ) , 5 ) , '4:0' ) AS deptime2
									FROM rfe_flights WHERE vid='".$IVAO_Info->vid."'
									ORDER BY deptime2";*/
									$query = mysqlexec($sqlconn,$query);
									
									/*$query = "SELECT timezone FROM rfe_config";
									$query = mysqlexec($sqlconn,$query);
									$tz = mysql_result($query,0,"timezone");
									
									$query = "SELECT id, flightnumber, acft, origin, destination, IFNULL(DATE_FORMAT(deptime, '%H%i'),'----') AS deptime,IFNULL(DATE_FORMAT(arrtime, '%H%i'),'----') AS arrtime, DATE_FORMAT(CONVERT_TZ(deptime,'+00:00','".$tz."'), '%H%i') AS deplocaltime, DATE_FORMAT(CONVERT_TZ(arrtime,'+00:00','".$tz."'), '%H%i') AS arrlocaltime,IFNULL(deptime,arrtime) AS reftime, IFNULL(gate,'TBD') AS gate, IFNULL(route,'TBD') AS route, vid FROM rfe_flights
									WHERE vid='".$IVAO_Info->vid."'
									AND ((deptime >= '00:00' AND deptime <= '23:59') OR (arrtime >= '00:00' AND arrtime <= '23:59'))
									ORDER BY reftime";		 
									$query = mysqlexec($sqlconn,$query);*/

									$queryn = mysql_num_rows($query);
									
									$queryapt = "SELECT apticao FROM rfe_config";
									$queryapt = mysqlexec($sqlconn,$queryapt);
							
									for ($i=0;$i<$queryn;$i++) {
										change_db($sqlconn,$navdatabase);
										$queryorig  = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"origin")."'";
										$queryorig  = mysqlexec($sqlconn,$queryorig);
										$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"destination")."'";
										$querydest = mysqlexec($sqlconn,$querydest);
										change_db($sqlconn,$rfedatabase);
										
										if (mysql_result($query,$i,'origin')==mysql_result($queryapt,0,'apticao')) {
											$direction = '<img src="images/dep.png" rel="tooltip" data-placement="top" title="Departing Flight">';
										} else if (mysql_result($query,$i,'destination')==mysql_result($queryapt,0,'apticao')) {
											$direction = '<img src="images/arr.png" rel="tooltip" data-placement="top" title="Arriving Flight">';
										}
										if (file_exists("logos/".substr(mysql_result($query,$i,'flightnumber'),0,3).".gif")) {
											$logo = '<img src="logos/'.substr(mysql_result($query,$i,'flightnumber'),0,3).'.gif"/> | ';
										} else {
											$logo = '';
										}	
										$id = mysql_result($query,$i,'id');
?>
									<div class="accordion-group" id="accordflt<?php echo $id; ?>">
										<div class="accordion-heading">
											<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $i; ?>">
												<?php echo $direction." ".$logo.mysql_result($query,$i,"flightnumber")." (".airlinename(mysql_result($query,$i,'flightnumber')).") | ".mysql_result($query,$i,'origin')."-".mysql_result($query,$i,'destination'); ?>&nbsp;<span class="label label-warning pull-right" onMouseOut="$(this).addClass('label-warning').removeClass('label-info');" onMouseOver="$(this).addClass('label-info').removeClass('label-warning');" onClick="removePosition(<?php echo $id; ?>,'accordflt<?php echo $id; ?>');">Click acá para borrar este vuelo.</span>
<?php
												if (mysql_result($query,$i,'bookingstatus') == 1) {
?>
													<span class="label label-important pull-right" style="margin-left: 3px; margin-right: 3px;">No Confirmado</span>
													<span id="maillabel<?php echo $id; ?>" class="label label-inverse pull-right" onClick="sendBookmail(<?php echo $id; ?>);" style="margin-left: 3px; margin-right: 3px;">Enviar Confirmación al E-mail</span>
<?php
												} else if (mysql_result($query,$i,'bookingstatus') == 2) {
?>
												<span class="label label-success pull-right" style="margin-left: 3px; margin-right: 3px;">Confirmado</span>
<?php
												}
?>
											</a>
										</div>
										<div id="collapse<?php echo $i; ?>" class="accordion-body collapse">
											<div class="accordion-inner">

												<table width="100%" border=0 cellpadding=0>
													<tr style="border-bottom: 1px solid #444">
														<td><b>Vuelo</b></td>
														<td><b>Salida</b></td>
														<td><b>Llegada</b></td>
													</tr>
													<tr height="60px">
														<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo mysql_result($query,$i,'flightnumber'); ?></span><br/><span style="font-size: 10px;"><?php echo airlinename(mysql_result($query,$i,'flightnumber')); ?></span></td>
														<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($query,$i,'origin'),"alt")." ".mysql_result($query,$i,'origin'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($queryorig,0,'Name'); ?></span>
														<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($query,$i,'destination'),"alt")." ".mysql_result($query,$i,'destination'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($querydest,0,'Name'); ?></span>
													</tr>
													<tr style="border-bottom: 1px solid #444">
														<td><b>Aeronave</b> <a href="http://www.airliners.net/search/photo.search?q=<?php echo str_ireplace(" ","+",aircraftname(mysql_result($query,$i,'acft'))); ?>+<?php echo str_ireplace(" ","+",airlinename(mysql_result($query,$i,'flightnumber'),"name")); ?>" target="_blank" style="color: #333;" onMouseOver="this.style.color='#F00'" onMouseOut="this.style.color='#333'"><i class="icon-camera" title="Click here to see pictures of this aircraft"></i></a></td>
														<td><b>Hora de Salida</b></td>
														<td><b>Hora de Llegada</b></td>
													</tr>
													<tr height="60px">
														<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo aircraftname(mysql_result($query,$i,'acft')); ?></span><br/><span style="font-size: 10px;"><?php echo aircraftname(mysql_result($query,$i,'acft'),"name"); ?></span></td>
														<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if (mysql_result($query,$i,'deptime')!="----") { echo mysql_result($query,$i,'deptime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($query,$i,'arrtime'),flighttime(mysql_result($query,$i,'origin'),mysql_result($query,$i,'destination'),mysql_result($query,$i,'acft')),"diff"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if (mysql_result($query,$i,'deptime')!="----") { echo "ZULU"; } else {?><span style="color: red;">ZULU (ESTIMATO AUTOMATICAMENTE)</span><?php }?></span>
														<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if (mysql_result($query,$i,'arrtime')!="----") { echo mysql_result($query,$i,'arrtime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($query,$i,'deptime'),flighttime(mysql_result($query,$i,'origin'),mysql_result($query,$i,'destination'),mysql_result($query,$i,'acft')),"add"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if (mysql_result($query,$i,'arrtime')!="----") { echo "ZULU"; } else {?><span style="color: red;">ZULU (ESTIMATO AUTOMATICAMENTE)</span><?php }?></span>
													</tr>
													<tr style="border-bottom: 1px solid #444">
														<td><b>Gate</b></td>
														<td colspan="2"><b>Ruta</b> <span style="font-size: 12px;">(extraída de FlightAware - Doble click aqui)</span></td>
													</tr>
													<tr height="50px">
													<?php if(strpos(mysql_result($query,0,'gate')," ") === FALSE) { ?>
														<td style="vertical-align: middle;"><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-plane" title="Gate"></i> <?php echo mysql_result($query,0,'gate'); ?></span></td>
													<?php } else { ?>
														<td style="vertical-align: middle;"><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-building-o" title="Terminal"></i> <?php echo ( strpos(mysql_result($query,0,'gate')," ") ? ( substr(mysql_result($query,0,'gate'),0,strpos(mysql_result($query,0,'gate')," "))) : mysql_result($query,0,'gate')); ?></span><span style="font-size: 24px; font-weight: bold; padding: 5px; display: block; text-align: center"><i class="fa fa-plane" title="Gate"></i> <?php echo ( strpos(mysql_result($query,0,'gate')," ") ? (substr(mysql_result($query,0,'gate'),strpos(mysql_result($query,0,'gate')," "),strlen(mysql_result($query,0,'gate')))) : "TBD"); ?></span></td>
													<?php } ?>
														<td style="vertical-align: middle;" colspan=2><span style="font-size: 15px;"><?php echo mysql_result($query,$i,'route'); ?></span></td>
													</tr>
												</table><br/>
											</div>
										</div>
									</div>
<?php
									}
?>
								</div>
<?php
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

 </body>

</html>