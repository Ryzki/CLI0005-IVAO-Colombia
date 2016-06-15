<?php
include("phpinc/config.inc.php");

$validationkey = $_REQUEST["k"];

$validationkey = explode(".",$validationkey);
$flightid      = $validationkey[0];
$validationkey = $validationkey[1];

$querymodal = "SELECT f.id, f.flightnumber, f.origin, f.destination, IFNULL(DATE_FORMAT(f.deptime, '%H%i'),'----') AS deptime,
					IFNULL(DATE_FORMAT(f.arrtime, '%H%i'),'----') AS arrtime, IFNULL(f.gate,'TBD') AS gate, f.acft, IFNULL(f.route,'TBD') AS route, f.vid, m.name, m.email,  m.ratingpilot, m.division
					FROM rfe_flights AS f
					LEFT JOIN rfe_members AS m ON m.vid = f.vid
					WHERE f.id='".$flightid."'";
$querymodal = mysqlexec($sqlconn,$querymodal);

change_db($sqlconn,$navdatabase);
$queryorig  = "SELECT Name FROM airports WHERE ICAO='".mysql_result($querymodal,0,"origin")."'";
$queryorig  = mysqlexec($sqlconn,$queryorig);
$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($querymodal,0,"destination")."'";
$querydest = mysqlexec($sqlconn,$querydest);
change_db($sqlconn,$rfedatabase);

$genvalidationkey = crypt(mysql_result($querymodal,0,"id").mysql_result($querymodal,0,"flightnumber").mysql_result($querymodal,0,"vid"),'$1$IVAOUS$');
$genvalidationkey = str_replace("/","",substr($genvalidationkey,10,strlen($genvalidationkey)));
$genvalidationkey = str_replace(".","",$genvalidationkey);

?>

        <!--################ WRAP START ################-->

        <div id="wrap">

            <!--################ HEADER START ################-->

            <header class="page-title">
                <div class="container">
                    <h2>Booking Validation</h2>
                </div>
            </header>
					
            <section class="services-page">
				<div class="container">
					<div class="row">
						<div class="span12">
							<div id="abouttext">
<?php
							if ($validationkey == $genvalidationkey) {
							
										$query = "UPDATE rfe_flights SET bookingstatus = 2 WHERE id=".$flightid;
										$query = mysqlexec($sqlconn,$query);
?>
								<div class="alert alert-success"><h4>Booking Confirmed!</h4><br/>The booking below has been confirmed.</div>
								<table width="100%" border=0 cellpadding=0>
									<tr style="border-bottom: 1px solid #444">
										<td><b>Flight</b></td>
										<td><b>Departure</b></td>
										<td><b>Arrival</b></td>
									</tr>
									<tr height="60px">
										<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo mysql_result($querymodal,0,'flightnumber'); ?></span><br/><span style="font-size: 10px;"><?php echo airlinename(mysql_result($querymodal,0,'flightnumber')); ?></span></td>
										<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($querymodal,0,'origin'),"alt")." ".mysql_result($querymodal,0,'origin'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($queryorig,0,'Name'); ?></span>
										<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($querymodal,0,'destination'),"alt")." ".mysql_result($querymodal,0,'destination'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($querydest,0,'Name'); ?></span>
									</tr>
									<tr style="border-bottom: 1px solid #444">
										<td><b>Aircraft</b> <a href="http://www.airliners.net/search/photo.search?q=<?php echo str_ireplace(" ","+",aircraftname(mysql_result($querymodal,0,'acft'))); ?>+<?php echo str_ireplace(" ","+",airlinename(mysql_result($querymodal,0,'flightnumber'),"name")); ?>" target="_blank" style="color: #333;" onMouseOver="this.style.color='#F00'" onMouseOut="this.style.color='#333'"><i class="icon-camera" title="Click here to see pictures of this aircraft"></i></a></td>
										<td><b>Departure Time</b></td>
										<td><b>Arrival Time</b></td>
									</tr>
									<tr height="60px">
										<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo aircraftname(mysql_result($querymodal,0,'acft')); ?></span><br/><span style="font-size: 10px;"><?php echo aircraftname(mysql_result($querymodal,0,'acft'),"name"); ?></span></td>
										<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if (mysql_result($querymodal,0,'deptime')!="----") { echo mysql_result($querymodal,0,'deptime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($querymodal,0,'arrtime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"diff"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if (mysql_result($querymodal,0,'deptime')!="----") { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span>
										<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if (mysql_result($querymodal,0,'arrtime')!="----") { echo mysql_result($querymodal,0,'arrtime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($querymodal,0,'deptime'),flighttime(mysql_result($querymodal,0,'origin'),mysql_result($querymodal,0,'destination'),mysql_result($querymodal,0,'acft')),"add"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if (mysql_result($querymodal,0,'arrtime')!="----") { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span>
									</tr>
									<tr style="border-bottom: 1px solid #444">
										<td><b>Gate</b></td>
										<td colspan="2"><b>Route</b> <span style="font-size: 12px;">(extracted from FlightAware - double-check it)</span></td>
									</tr>
									<tr height="50px">
										<td style="vertical-align: middle;"><span style="font-size: 30px; font-weight: bold;background-color: #F2EF30; padding: 0 10px;"><?php echo mysql_result($querymodal,0,'gate'); ?></span></td>
										<td style="vertical-align: middle;" colspan=2><span style="font-size: 15px;"><?php echo mysql_result($querymodal,0,'route'); ?></span></td>
									</tr>
								</table><br/>
								
								<table width="100%" border=0 cellpadding=0>
									<tr style="border-bottom: 1px solid #444">
										<td><b>Flight booked to</b></td>
										<td><b>VID</b></td>
									</tr>
									<tr height="40px">
										<td style="vertical-align: middle;"><span style="font-size: 20px;"><?php echo mysql_result($querymodal,0,'name'); ?></span></td>
										<td style="vertical-align: middle;"><span style="font-size: 20px;"><a href="http://www.ivao.aero/members/person/details.asp?ID=<?php echo mysql_result($querymodal,0,'vid'); ?>" target="_blank"><?php echo mysql_result($querymodal,0,'vid'); ?></a></td>
									</tr>
									<tr style="border-bottom: 1px solid #444">
										<td><b>Pilot Rating</b></td>
										<td><b>Division</b></td>
									</tr>
									<tr height="40px">
										<td style="vertical-align: middle;"><img src="https://www.ivao.aero/data/images/ratings/pilot/<?php echo mysql_result($querymodal,0,'ratingpilot'); ?>.gif"></td>
										<td style="vertical-align: middle;"><img src="flags/48/<?php echo mysql_result($querymodal,0,'division'); ?>.png"</td>
									</tr>
								</table><br/>
								<center><img src="phpinc/boardingpass.php?id=<?php echo mysql_result($querymodal,0,'id'); ?>"></center>
<?php
							} else {
?>
								<div class="alert alert-danger"><h4>Error!</h4><br/>Wrong validation key.</div>
<?php
							}
?>

							</div>
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