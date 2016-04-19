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
							<h1 class="muted">What's a RFE?</h1>
							<p>RFE stands for <b>R</b>eal <b>F</b>light <b>E</b>vent. It's an event where the real world airline schedules of an airport are followed during the time of event by all the participants.
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
									<h3>Wide Variety of Flights</h3>
									<p> Many airlines fly inside <?php echo mysql_result($querysel,0,0); ?> daily. So, by participating of the event, you'll have the opportunity to see different airlines on the airport.</p>
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
									<h3>Realistic ATC Service</h3>
									<p> During the event, all ATC positions possible are staffed to provide ATC service to the pilots.</p>
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
									<h3>Different People</h3>
									<p> Every IVAO member can join in the event by making his/her flight. So, the RFE is an opportunity to meet new people from different cultures.</p>
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
									<h3>An unique opportunity</h3>
									<p> We don't do this events often in <?php echo mysql_result($querydate,0,'division'); ?> . So, don't lose this opportunity!</p>
								</div>
							</div>
						</div>
					</div>


				</div>

<div class="container">
					<div class="row">
						<div class="span12">
							<h1 class="muted">How can I join it?</h1>
							<p>Look to the menu above and click over <b>Book your flight</b>!<br/>
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