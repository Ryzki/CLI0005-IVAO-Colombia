<?php
include("phpinc/config.inc.php");
?>
<!--################ WRAP START ################-->

<div id="wrap">

	<!--################ HEADER START ################-->

	<header class="page-title">
		 <div class="container">
			  <h2>AIS Room <small> Please, be patient to load all the information</small></h2>
		 </div>
	</header>

	<section class="services-page">
		<div class="container">
<?php
			change_db($sqlconn,$rfedatabase);
			$query = "SELECT id FROM rfe_flights WHERE vid='".$IVAO_Info->vid."'";
			$query = mysqlexec($sqlconn,$query);
			if(mysql_num_rows($query) > 0) {
?>
				<div class="accordion" id="accordion2">
<?php			
					$query = "SELECT timezone FROM rfe_config";
					$query = mysqlexec($sqlconn,$query);
					$tz = mysql_result($query,0,"timezone");
					
					$query = "SELECT id, flightnumber, acft, origin, destination,DATE_FORMAT(deptime, '%H%i') AS deptime,DATE_FORMAT(arrtime, '%H%i') AS arrtime,DATE_FORMAT(CONVERT_TZ(deptime,'+00:00','".$tz."'), '%H%i') AS deplocaltime,DATE_FORMAT(CONVERT_TZ(arrtime,'+00:00','".$tz."'), '%H%i') AS arrlocaltime,IFNULL(deptime,arrtime) AS reftime, gate, vid FROM rfe_flights
               WHERE vid='".$IVAO_Info->vid."'
               AND ((deptime >= '00:00' AND deptime <= '23:59') OR (arrtime >= '00:00' AND arrtime <= '23:59'))
               ORDER BY reftime";		 
					$query = mysqlexec($sqlconn,$query);
					$queryn = mysql_num_rows($query);
			
					for ($i=0;$i<$queryn;$i++) {
						change_db($sqlconn,$navdatabase);
						$queryorig  = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"origin")."'";
						$queryorig  = mysqlexec($sqlconn,$queryorig);
						$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"destination")."'";
						$querydest = mysqlexec($sqlconn,$querydest);
						change_db($sqlconn,$rfedatabase);
							if (file_exists("logos/".substr(mysql_result($query,$i,'flightnumber'),0,3).".gif")) {
								$logo = '<img src="logos/'.substr(mysql_result($query,$i,'flightnumber'),0,3).'.gif"/> | ';
							} else {
								$logo = '';
							}	
?>
						<div class="accordion-group">
							<div class="accordion-heading">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $i; ?>">
									<?php echo $logo.mysql_result($query,$i,"flightnumber")." (".airlinename(mysql_result($query,$i,'flightnumber')).") | ".mysql_result($query,$i,'origin')."-".mysql_result($query,$i,'destination'); ?>
								</a>
							</div>
							
							<div id="collapse<?php echo $i; ?>" class="accordion-body collapse">
								<div class="accordion-inner">
									
									<div class="accordion" id="accordflt<?php echo $i; ?>">
										<div class="accordion-group">
										
											<div class="accordion-heading">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordflt<?php echo $i; ?>" href="#collapse<?php echo $i; ?>orgn"><?php echo getCountry(mysql_result($query,$i,'origin'),"alt","24")." ".mysql_result($queryorig,0,'Name')." (".mysql_result($query,$i,'origin').")"; ?></a>
											</div>
											<div id="collapse<?php echo $i; ?>orgn" class="accordion-body collapse">
												<div class="accordion-inner">
												
													<div class="accordion" id="detailsaccordionorgn<?php echo $i; ?>">
														<div class="accordion-group">
															<div class="accordion-heading">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordionorgn<?php echo $i; ?>" href="#collapsedetailsorgn<?php echo $i; ?>">
																	Airport Details
																</a>
															</div>
															<div id="collapsedetailsorgn<?php echo $i; ?>" class="accordion-body collapse">
																<div class="accordion-inner">
																	<?php echo getDetailsAD(mysql_result($query,$i,'origin')); ?>
																</div>
															</div>
														</div>
														<div class="accordion-group">
															<div class="accordion-heading">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordionorgn<?php echo $i; ?>" id="collapsemetarheadingorgn<?php echo $i; ?>" href="#collapsemetarorgn<?php echo $i; ?>" onClick="loadMETAR('<?php echo mysql_result($query,$i,'origin'); ?>','collapsemetarcontentorgn<?php echo $i; ?>');">
																	METAR
																</a>
															</div>
															<div id="collapsemetarorgn<?php echo $i; ?>" class="accordion-body collapse">
																<div class="accordion-inner" style="font-family: 'Lucida Sans Typewriter', 'Courier New', monospace;" id="collapsemetarcontentorgn<?php echo $i; ?>">
																	<center><img src="images/loadingsm.gif"/></center>
																</div>
															</div>
														</div>
														<div class="accordion-group">
															<div class="accordion-heading">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordionorgn<?php echo $i; ?>" id="collapsetafheadingorgn<?php echo $i; ?>" href="#collapsetaforgn<?php echo $i; ?>" onClick="loadTAF('<?php echo mysql_result($query,$i,'origin'); ?>','collapsetafcontentorgn<?php echo $i; ?>')">
																	TAF
																</a>
															</div>
															<div id="collapsetaforgn<?php echo $i; ?>" class="accordion-body collapse">
																<div class="accordion-inner" style="font-family: 'Lucida Sans Typewriter', 'Courier New', monospace;" id="collapsetafcontentorgn<?php echo $i; ?>">
																	<center><img src="images/loadingsm.gif"/></center>
																</div>
															</div>
														</div>
														<div class="accordion-group">
															<div class="accordion-heading">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordionorgn<?php echo $i; ?>" href="#collapsemaporgn<?php echo $i; ?>">
																	Airport Map
																</a>
															</div>
															<div id="collapsemaporgn<?php echo $i; ?>" class="accordion-body collapse">
																<div class="accordion-inner">
																	<center><?php echo getMap(mysql_result($query,$i,'origin')); ?></center><br/>
																</div>
															</div>
														</div>
													</div>
													
												</div>
											</div>
										</div>
										<div class="accordion-group">	
											<div class="accordion-heading">
												<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordflt<?php echo $i; ?>" href="#collapse<?php echo $i; ?>dest"><?php echo getCountry(mysql_result($query,$i,'destination'),"alt","24")." ".mysql_result($querydest,0,'Name')." (".mysql_result($query,$i,'destination').")"; ?></a>
											</div>
											<div id="collapse<?php echo $i; ?>dest" class="accordion-body collapse">
												<div class="accordion-inner">
											
													<div class="accordion" id="detailsaccordiondest<?php echo $i; ?>">
														<div class="accordion-group">
															<div class="accordion-heading">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordiondest<?php echo $i; ?>" href="#collapsedetailsdest<?php echo $i; ?>">
																	Airport Details
																</a>
															</div>
															<div id="collapsedetailsdest<?php echo $i; ?>" class="accordion-body collapse">
																<div class="accordion-inner">
																	<?php echo getDetailsAD(mysql_result($query,$i,'destination')); ?>
																</div>
															</div>
														</div>
														<div class="accordion-group">
															<div class="accordion-heading">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordiondest<?php echo $i; ?>" id="collapsemetarheadingdest<?php echo $i; ?>" href="#collapsemetardest<?php echo $i; ?>" onClick="loadMETAR('<?php echo mysql_result($query,$i,'destination'); ?>','collapsemetarcontentdest<?php echo $i; ?>');">
																	METAR
																</a>
															</div>
															<div id="collapsemetardest<?php echo $i; ?>" class="accordion-body collapse">
																<div class="accordion-inner" style="font-family: 'Lucida Sans Typewriter', 'Courier New', monospace;" id="collapsemetarcontentdest<?php echo $i; ?>">
																	<center><img src="images/loadingsm.gif"/></center>
																</div>
															</div>
														</div>
														<div class="accordion-group">
															<div class="accordion-heading">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordiondest<?php echo $i; ?>" id="collapsetafheadingdest<?php echo $i; ?>" href="#collapsetafdest<?php echo $i; ?>" onClick="loadTAF('<?php echo mysql_result($query,$i,'destination'); ?>','collapsetafcontentdest<?php echo $i; ?>')">
																	TAF
																</a>
															</div>
															<div id="collapsetafdest<?php echo $i; ?>" class="accordion-body collapse">
																<div class="accordion-inner" style="font-family: 'Lucida Sans Typewriter', 'Courier New', monospace;" id="collapsetafcontentdest<?php echo $i; ?>">
																	<center><img src="images/loadingsm.gif"/></center>
																</div>
															</div>
														</div>
														<div class="accordion-group">
															<div class="accordion-heading">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordiondest<?php echo $i; ?>" href="#collapsemapdest<?php echo $i; ?>">
																	Airport Map
																</a>
															</div>
															<div id="collapsemapdest<?php echo $i; ?>" class="accordion-body collapse">
																<div class="accordion-inner">
																	<center><?php echo getMap(mysql_result($query,$i,'destination')); ?></center><br/>
																</div>
															</div>
														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
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