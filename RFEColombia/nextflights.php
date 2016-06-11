<?php
include("phpinc/config.inc.php");
?>

<!--################ WRAP START ################-->

<div id="wrap">

	<!--################ HEADER START ################-->

	<header class="page-title">
		 <div class="container">
			  <h2>Upcoming flights</h2>
		 </div>
	</header>

	<section class="services-page">
			
		<div class="container">
		
			<table class="table table-striped table-hover">
				<thead>
					<tr align="center"><th class="col-sm-1">&nbsp;</th><th class="col-sm-1">&nbsp;</th><th class="col-sm-1">Flight</th><th class="col-sm-3">Aircraft</th><th class="col-sm-1" style="text-align:center;">Dir</th><th class="col-sm-3">Orgn/Dest</th><th class="col-sm-1">Time</th><th class="col-sm-1">Gate</th><th class="col-sm-1">Pilot</th><th class="col-sm-1">Status</th></tr>
				</thead>
				<tbody>	
<?php							
					change_db($sqlconn,$rfedatabase);
					$query = "SELECT f.id, f.flightnumber, f.origin, f.destination, IFNULL(DATE_FORMAT(f.deptime, '%H%i'),'----') AS deptime,
                         IFNULL(DATE_FORMAT(f.arrtime, '%H%i'),'----') AS arrtime, IFNULL(DATE_FORMAT(deptime, '%H%i'),DATE_FORMAT(arrtime, '%H%i')) AS opstime, IFNULL(f.gate,'TBD') AS gate, f.acft, IFNULL(f.route,'TBD') AS route, f.vid, m.name
                         FROM rfe_flights AS f
					          LEFT JOIN rfe_members AS m ON m.vid = f.vid
							    WHERE (f.origin='".mysql_result($querysel,0,"apticao")."' OR f.destination='".mysql_result($querysel,0,"apticao")."') AND (f.deptime > '17:00:00' OR f.arrtime > '17:00:00')
							    AND f.vid IS NOT NULL
								 ORDER BY ABS(opstime)";
								 //echo $query;
					$query = mysqlexec($sqlconn,$query);
					$queryn = mysql_num_rows($query);

						
					for ($i=0;$i<$queryn;$i++) {
						change_db($sqlconn,$navdatabase);
						$queryorig = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"origin")."'";
						$queryorig = mysqlexec($sqlconn,$queryorig);
						$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($query,$i,"destination")."'";
						$querydest = mysqlexec($sqlconn,$querydest);
						change_db($sqlconn,$rfedatabase);
?>
					<tr>
					<td style="vertical-align:middle"><?php if (mysql_result($query,$i,'arrtime')=="----") { ?> <img src="images/dep.png"/> <?php } else { ?> <img src="images/arr.png"/> <?php } ?></td>
					<td style="vertical-align:middle"><?php if (file_exists("logos/".substr(mysql_result($query,$i,'flightnumber'),0,3).".gif")) { ?><img src="logos/<?php echo substr(mysql_result($query,$i,'flightnumber'),0,3); ?>.gif"/><?php } ?></td>
					<td style="vertical-align:middle"><?php echo mysql_result($query,$i,'flightnumber'); ?></td>
					<td style="vertical-align:middle"><?php echo aircraftname(mysql_result($query,$i,'acft')); ?></td>
					<td style="vertical-align:middle;text-align:center;"><?php if (mysql_result($query,$i,'deptime')=="----") { echo "FROM"; } else { echo "TO"; } ?></td>
					<td style="vertical-align:middle"><?php if (mysql_result($query,$i,'deptime')=="----") { echo getCountry(mysql_result($query,$i,'origin'),"alt","24")." ".mysql_result($query,$i,'origin')." - ".mysql_result($queryorig,0,'Name'); } else { echo getCountry(mysql_result($query,$i,'destination'),"alt","24")." ".mysql_result($query,$i,'destination')." - ".mysql_result($querydest,0,'Name'); } ?></td>
					<td style="vertical-align:middle"><?php echo mysql_result($query,$i,'opstime'); ?>Z</td>
					<td style="vertical-align:middle"><?php echo mysql_result($query,$i,'gate'); ?></td>
					<td><?php echo mysql_result($query,$i,'name').' (<a href="http://www.ivao.aero/members/person/details.asp?ID='.mysql_result($query,$i,'vid').'">'.mysql_result($query,$i,'vid').'</a>)'; ?></td>
					<td data-toggle="modal" href="#modalFlights" onClick="loadModal(<?php echo mysql_result($query,$i,'id'); ?>)" style="cursor: pointer;"><?php echo getOnlinePos(mysql_result($query,$i,'vid'),mysql_result($query,$i,'flightnumber')); ?></td>
					</tr>
<?php
				}
?>
				</tbody>
			</table>
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

<!--Modals--> 

<?php

$query = "SELECT id
					FROM rfe_flights
					ORDER BY id";
$query = mysqlexec($sqlconn,$query);
$queryn = mysql_num_rows($query);

/*				for ($i=0;$i<$queryn;$i++) {
	echo modalCreation(mysql_result($query,$i,'id'));
}*/

?>
	<div id="modalFlights" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	</div>


<script>
		function loadModal(id) {
			$("#modalFlights").html('<center><br/><img src="images/loading.gif"/><br/><h4>Loading Online Details</h4></br></center>');
			$("#modalFlights").load('phpinc/modal_online.php', {'id': id});
		};
</script>

 </body>

</html>