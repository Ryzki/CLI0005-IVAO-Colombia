<?php
include("phpinc/config.inc.php");
?>
		<!--################ WRAP START ################-->

		<div id="wrap">

			<!--################ HEADER START ################-->
<?php
			$querydate = "SELECT DATE_FORMAT(datestart,'%M %D') AS eventdate, DATE_FORMAT(timestart,'%H%iZ') AS starttime, DATE_FORMAT(timeend,'%H%iZ') AS endtime, division FROM rfe_config";
			$querydate = mysqlexec($sqlconn,$querydate);
?>
			<!--<header data-stellar-background-ratio="0">
				<div class="container home">
					<div class="flexslider home">
						<ul class="slides">
							<li><h1 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);">RFE <?php echo mysql_result($querysel,0,'aptname'); ?></h1><h3 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);"><?php echo mysql_result($querydate,0,'eventdate'); ?>, <?php echo mysql_result($querydate,0,'starttime'); ?>-<?php echo mysql_result($querydate,0,'endtime'); ?> | Enjoy the event prepared by IVAO <?php echo mysql_result($querydate,0,'division'); ?>!</h3><br/><img src="images/divlogo.png"/><br/><br/></li>
						</ul>
					</div>
				</div>
			</header>-->
			
			<header data-stellar-background-ratio="0">

				<div class="container">
						<div id="bgcarousel" class="carousel container slide">
							<div class="carousel-inner">
								<div class="active item one"></div>
								<div class="item two"></div>
								<div class="item three"></div>
								<div class="item four"></div>
							</div>
						</div>
					<div class="flexslider home">
						<ul class="slides">
							<li><h1 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);">RFE <?php echo mysql_result($querysel,0,'aptname'); ?></h1><h3 style="color: #fff; text-shadow: 3px 3px 2px rgba(25, 25, 25, 1);"><?php echo mysql_result($querydate,0,'eventdate'); ?>, <?php echo mysql_result($querydate,0,'starttime'); ?>-<?php echo mysql_result($querydate,0,'endtime'); ?> | Enjoy the event prepared by IVAO <?php echo mysql_result($querydate,0,'division'); ?>!</h3><br/><img src="images/divlogo/divlogo@140px.png"/><br/><br/></li>
						</ul>
					</div>

				</div>

			</header>

			<!--################ HEADER END ################-->

			<!--################ MAIN CONTAINER START ################-->



			<!--################ FEATURES SECTION START ################-->
			<section  id="features" class="paddingtop10 features-home-page">
				<div class="container">
					<!--<div class="row">
						<div class="span12">
							<center><iframe width="800" height="450" src="//www.youtube.com/embed/G5WCi77p5E0?rel=0" frameborder="0" allowfullscreen></iframe></center>
						</div>
					</div>-->
					
					<div class="row">
						<div class="span12">
							<h1 class="muted">QUE ES RFE?</h1>
							<p>RFE significa <b>R</b>eal <b>F</b>light <b>E</b>vent. Es un evento donde se siguen los horarios de las aerolíneas del mundo real de un aeropuerto durante la hora de celebración por todos los participantes.
							</p>
						</div>
					</div>

					<div class="row">
						<!-- Feature -->
						<div class="span6 feature-option-3">
							<div class="row">
								<div class="span1">
									<i class="fa fa-plane fa-4x features-option-3-icon"></i>
								</div>
								<div class="span4 feature-detail">
									<h3>Amplia variedad de Vuelos</h3>
									<p> Muchas compañías aéreas vuelan en el interior <?php echo mysql_result($querysel,0,0); ?> diariamente. Por lo tanto, al participar del evento, Se tendrá la oportunidad de ver diferentes aerolíneas en el aeropuerto.</p>
								</div>
							</div>
						</div>
						<!-- Feature -->
						<div class="span6 feature-option-3">
							<div class="row">
								<div class="span1">
									<i class="fa fa-headphones fa-4x features-option-3-icon"></i>
								</div>
								<div class="span4 feature-detail">
									<h3>Servicio ATC realista</h3>
									<p> Durante el evento, todas las posiciones posibles ATC se proveen de personal para ofrecer un servicio ATC para los pilotos.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- Feature -->
						<div class="span6 feature-option-3">
							<div class="row">
								<div class="span1">
									<i class="fa fa-user fa-4x features-option-3-icon"></i>
								</div>
								<div class="span4 feature-detail">
									<h3>Gente diferente</h3>
									<p> Cada miembro de IVAO puede unirse en el evento y hacer su vuelo. Por lo tanto, El RFE es una oportunidad para conocer nuevas personas de diferentes culturas.</p>
								</div>
							</div>
						</div>
						<!-- Feature -->
						<div class="span6 feature-option-3">
							<div class="row">
								<div class="span1">
									<i class="fa fa-smile-o fa-4x features-option-3-icon"></i>
								</div>
								<div class="span4 feature-detail">
									<h3>Una oportunidad única</h3>
									<p> Nosotros no hacemos este tipo de eventos a menudo en <?php echo mysql_result($querydate,0,'division'); ?> . Por lo tanto, no pierda esta oportunidad!</p>
								</div>
							</div>
						</div>
					</div>


				</div>

<div class="container">
					<div class="row">
						<div class="span12">
							<h1 class="muted">¿Cómo puedo participar en ella?</h1>
							<p>Mira al menú de arriba y haga clic sobre <b> Reserve su vuelo</b>!<br/>
							<br/>
							</p>

						</div>

					</div>


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

 </body>

</html>