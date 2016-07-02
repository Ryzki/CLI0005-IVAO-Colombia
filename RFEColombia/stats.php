<?php
include("phpinc/config.inc.php");
?>
        <!--################ WRAP START ################-->

        <div id="wrap">

            <!--################ HEADER START ################-->

         
			
			
			<header class="page-title" style="background: url(./images/header1.jpg) no-repeat;width:100%;height:300px">
			<div class="container" >
                   <ul class="slides">
				  
							<li><h1 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);">Estadísticas Generales</h1><br/><img src="images/divlogo/divlogo@140px.png"/><br/><br/></li>
						</ul>
<!--						<h1><font color="red">Reserve su vuelo!</font></h1><br> <h3><font color="black">Debido a la cantidad de vuelos, esta página puede tomar algún tiempo para cargar. Por favor sea paciente.</font></h3> -->
                </div>
            </header>
				

            <section class="services-page">
						  <div class="container">
							
							<h3>Estadísticas detalladas</h3>
							
<?php
								$query = "SELECT timestart,timeend,timezone,TIME_TO_SEC(TIMEDIFF(timeend,timestart)) AS timediff FROM rfe_config";
								$query = mysqlexec($sqlconn,$query);
								$ts = mysql_result($query,0,"timestart");
								$te = mysql_result($query,0,"timeend");
								$tz = mysql_result($query,0,"timezone");
								$td = mysql_result($query,0,"timediff");
								if ($td > 0) {
									$timeclause         = "(deptime >= '".$ts."' AND deptime <= '".$te."') OR (arrtime >= '".$ts."' AND arrtime <= '".$te."')";
								} else if ($td < 0) {
									$timeclause         = "(deptime >= '".$ts."' OR deptime <= '".$te."') OR (arrtime >= '".$ts."' OR arrtime <= '".$te."')";
								} else if ($td == 0) {
									$timeclause         = "";
								}
								

								change_db($sqlconn,$rfedatabase);
								$query = "SELECT COUNT( * ) AS totalflights FROM rfe_flights WHERE ".$timeclause;
								$query = mysqlexec($sqlconn,$query);
								$totalflights = mysql_result($query,0,'totalflights');
								$query = "SELECT COUNT(*) AS bookedflights FROM rfe_flights WHERE vid IS NOT NULL AND (".$timeclause.")";
								$query = mysqlexec($sqlconn,$query);
								$bookedflights = mysql_result($query,0,'bookedflights');
								
								$bookpercent = ($bookedflights/$totalflights)*100;
								$freepercent = 100-$bookpercent;
?>
								<p><b>Numero de Vuelos:</b> <?php echo $totalflights; ?></p>
								<p><b>Vuelos reservados:</b> <?php echo $bookedflights; ?> (<?php echo round($bookpercent); ?>%)</p>
								<p><b>Vuelos disponibles:</b> <?php echo $totalflights-$bookedflights; ?> (<?php echo 100-round($bookpercent); ?>%)</p>
								<div class="progress progress-striped active">
									<div class="bar bar-success" style="width: <?php echo $freepercent; ?>%"></div>
									<div class="bar bar-danger" style="width: <?php echo $bookpercent; ?>%"></div>
								</div>
								
<!--								
							<h3>Statistics in Time Frames</h3>
<?php
							change_db($sqlconn,$rfedatabase);
							$query = "SELECT timestart,timeend FROM rfe_config";
							$query = mysqlexec($sqlconn,$query);
							$start = substr(mysql_result($query,0,'timestart'),0,2);
							$end   = substr(mysql_result($query,0,'timeend'),0,2);
							
							for ($i=$start;$i<$end+1;$i++) {
							
								if ($i % 2 == 0) {
									echo "<div class=\"row margintop20\">";
								}
							
								if ($i >= 24) {
									$time = ($i-24)*100;
								} else {
									$time = $i*100;
								}
								$time100 = $time+100;
?>
							<div class="span6">
							<h4><?php printf("%04d",$time); ?>Z - <?php  printf("%04d",$time100); ?>Z</h4>
<?php
								change_db($sqlconn,$rfedatabase);
								$query = "SELECT COUNT( * ) AS totalflights FROM rfe_flights WHERE (deptime >= ".$time." AND deptime < ".$time100.") OR (arrtime > ".$time." AND arrtime < ".$time100.")";
								$query = mysqlexec($sqlconn,$query);
								$totalflights = mysql_result($query,0,'totalflights');
								$query = "SELECT COUNT(*) AS bookedflights FROM rfe_flights WHERE (deptime >= ".$time." AND deptime < ".$time100.") AND vid IS NOT NULL AND origin = '".mysql_result($querysel,0,'apticao')."'";
								$query = mysqlexec($sqlconn,$query);
								$bookedflightsdep = mysql_result($query,0,'bookedflights');
								$query = "SELECT COUNT(*) AS bookedflights FROM rfe_flights WHERE (arrtime >= ".$time." AND arrtime < ".$time100.") AND vid IS NOT NULL AND destination = '".mysql_result($querysel,0,'apticao')."'";
								$query = mysqlexec($sqlconn,$query);
								$bookedflightsarr = mysql_result($query,0,'bookedflights');
								$bookedflights = $bookedflightsdep + $bookedflightsarr;
								
								$bookpercent = @($bookedflights/$totalflights)*100;
								$freepercent = 100-$bookpercent;
?>
								<p><b>Total flights:</b> <?php echo $totalflights; ?></p>
								<p><b>Booked flights:</b> <?php echo $bookedflights; ?> (<?php echo round($bookpercent); ?>%)</p>
								<p><b>Available flights:</b> <?php echo $totalflights-$bookedflights; ?> (<?php echo 100-round($bookpercent); ?>%)</p>
								<div class="progress progress-striped active">
									<div class="bar bar-success" style="width: <?php echo $freepercent; ?>%"></div>
									<div class="bar bar-danger" style="width: <?php echo $bookpercent; ?>%"></div>
								</div>
							</div>
<?php
								if ($i % 2 != 0) {
									echo "</div>";
								}
							}
?>
-->
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
		function removePosition(id,accordid) {
			$("#"+accordid).hide();
			$("#"+accordid).html('');
			$.ajax({
				type    : "GET",
				url     : "registerflt.php",
				dataType: "html",
				contentType: 'application/x-www-form-urlencoded',
				beforeSend: function(jqXHR) {
					jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
				},
				data    : { s: "unbook", id: id, },
			}).done(function (result) {
				window.location.reload();
			});
		};
</script>

 </body>

</html>