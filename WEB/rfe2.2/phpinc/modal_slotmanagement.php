<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal showing the slot management.
   Author: Filipe Fonseca    14/06/2014
Revisions: 
========================================================================*/
// INCLUDES
include("func_mysqlexec.php");
include("func_general.php");

// GLOBAL VARIABLES
global $navdatabase, $rfedatabase, $sqlconn;

// Get all programmed slots
$query = "SELECT DATE_FORMAT(slottime, '%H%i') AS slottime, slottime AS slottimeorig FROM rfe_private ORDER BY slottime ASC";
$query = mysqlexec($sqlconn,$query);
$slotnbr = mysql_num_rows($query);

// Get Information of the Flight from the Database
$queryapt = "SELECT apticao FROM rfe_config";
$queryapt = mysqlexec($sqlconn,$queryapt);
?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Private Slot Management</h3>
	</div>
	<div id="modalbody" class="modal-body">

		<div class="accordion" id="detailsaccordion">
<?php	
		for ($i=0;$i<$slotnbr;$i++) {
			$queryreqnbr = "SELECT IFNULL(COUNT(*),0) AS slotrequests FROM rfe_privatependent WHERE slottime = '". mysql_result($query,$i,'slottimeorig')."'";
			$queryreqnbr = mysqlexec($sqlconn,$queryreqnbr);
			$reqnbr = mysql_result($queryreqnbr,0,'slotrequests');
?>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#detailsaccordion" href="#slot<?php echo $i; ?>">
						Slot <?php echo mysql_result($query,$i,'slottime'); ?>Z (Requests: <?php echo mysql_result($queryreqnbr,0,'slotrequests'); ?>)
					</a>
				</div>
<?php	
				if ($reqnbr == 0) { 
?>
				</div>
<?php
					continue;
				}
?>
				<div id="slot<?php echo $i; ?>" class="accordion-body collapse">
					<div class="accordion-inner">
						<div class="accordion" id="detailsaccordion<?php echo $i; ?>">
<?php	
						$queryprvdet = "SELECT p.id, p.flightnumber, p.origin, p.destination, IFNULL(DATE_FORMAT(p.slottime, '%H%i'),'----') AS slottime, p.acft,
											 IFNULL(p.route,'TBD') AS route, p.vid, m.name, DATE_FORMAT(CONVERT_TZ(p.requesttimestamp, @@session.time_zone, '+00:00'),'<b>%a, %d %b %Y</b> at <b>%H:%i:%s UTC</b>') AS requesttimestamp
											 FROM rfe_privatependent AS p
											 LEFT JOIN rfe_members AS m ON m.vid = p.vid
											 WHERE p.slottime = '".mysql_result($query,$i,'slottimeorig')."'
											 ORDER BY p.requesttimestamp ASC";
						$queryprvdet = mysqlexec($sqlconn,$queryprvdet);
						for ($j=0;$j<mysql_num_rows($queryprvdet);$j++) {
							$queryactive = "SELECT pp.id AS activeid FROM rfe_private AS p LEFT JOIN rfe_privatependent AS pp ON p.vid = pp.vid WHERE (p.slottime = '".mysql_result($query,$i,'slottimeorig')."' AND p.vid =  '".mysql_result($queryprvdet,$j,'vid')."') AND p.flightnumber = '".mysql_result($queryprvdet,$j,'flightnumber')."'";
							$queryactive = mysqlexec($sqlconn,$queryactive);
							if (mysql_num_rows($queryactive) > 0) {
								$active    = true;
								$id_active = mysql_result($queryactive,0,'activeid');
							} else {
								$active    = false;
								$id_active = '';
							}
							$querybook = "SELECT id FROM rfe_flights WHERE vid = '".mysql_result($queryprvdet,$j,'vid')."'";
							$querybook = mysqlexec($sqlconn,$querybook);
							if (mysql_num_rows($querybook) > 0) {
								$book = true;
							} else {
								$book = false;
							}							
?>
								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" style="cursor: default;" data-toggle="collapse" data-parent="#detailsaccordion<?php echo $i; ?>" href="#slotrequest<?php echo $i.$j; ?>">
											<?php echo "#".($j+1) ." ".mysql_result($queryprvdet,$j,'name')." (".mysql_result($queryprvdet,$j,'vid').")"; ?>
											<span class="label label-inverse pull-right" style="margin: 0 2px 0 2px;cursor: pointer;" onClick="toggleMailForm('<?php echo mysql_result($queryprvdet,$j,'id'); ?>');">Send e-mail</span>
<?php
											if ($active) {
?>
											<span class="label label-success pull-right" onMouseOver="$(this).addClass('label-important').removeClass('label-success');$(this).html('Revoke slot');" onMouseOut="$(this).addClass('label-success').removeClass('label-important');$(this).html('Slot active');" onClick="revokeSlot('<?php echo mysql_result($queryprvdet,$j,'id'); ?>','<?php echo mysql_result($query,$i,'slottimeorig'); ?>');" style="margin: 0 2px 0 2px; cursor: pointer;">Slot Active</span>
<?php
											} else {
?>
												<span class="label label-important pull-right" onClick="grantSlot('<?php echo mysql_result($queryprvdet,$j,'id'); ?>','<?php echo mysql_result($query,$i,'slottimeorig'); ?>');" style="margin: 0 2px 0 2px;cursor: pointer;">Grant this slot</span>
<?php
											}
?>
<?php
											if ($book) {
?>
												<span class="label label-info pull-right" style="margin: 0 2px 0 2px;">Booked a flight</span>
<?php
											}
?>
										</a>
									</div>
									<div id="slotrequest<?php echo $i.$j; ?>" class="accordion-body collapse">
										<div class="accordion-inner">
<?php
										if (mysql_result($queryprvdet,$j,'origin') == mysql_result($queryapt,0,'apticao')) {
											$movement = "dep";
										} else if (mysql_result($queryprvdet,$j,'destination') == mysql_result($queryapt,0,'apticao')) {
											$movement = "arr";
										} else {
											$movement = "unk";
										}
										
										change_db($sqlconn,$navdatabase);
										$queryorig  = "SELECT Name FROM airports WHERE ICAO='".mysql_result($queryprvdet,$j,"origin")."'";
										$queryorig  = mysqlexec($sqlconn,$queryorig);
										$querydest = "SELECT Name FROM airports WHERE ICAO='".mysql_result($queryprvdet,$j,"destination")."'";
										$querydest = mysqlexec($sqlconn,$querydest);
										change_db($sqlconn,$rfedatabase);
?>
										
										<table width="100%" border=0 cellpadding=0>
											<tr style="border-bottom: 1px solid #444">
												<td><b>Flight</b></td>
												<td><b>Departure</b></td>
												<td><b>Arrival</b></td>
											</tr>
											<tr height="60px">
												<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo mysql_result($queryprvdet,$j,'flightnumber'); ?></span></td>
												<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($queryprvdet,$j,'origin'))." ".mysql_result($queryprvdet,$j,'origin'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($queryorig,0,'Name'); ?></span>
												<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php echo getCountry(mysql_result($queryprvdet,$j,'destination'))." ".mysql_result($queryprvdet,$j,'destination'); ?></span><br/><span style="font-size: 10px;"><?php echo mysql_result($querydest,0,'Name'); ?></span>
											</tr>
											<tr style="border-bottom: 1px solid #444">
												<td><b>Aircraft</b></td>
												<td><b>Departure Time</b></td>
												<td><b>Arrival Time</b></td>
											</tr>
											<tr height="60px">
												<td style="vertical-align: middle;"><span style="font-size: 30px;"><?php echo aircraftname(mysql_result($queryprvdet,$j,'acft')); ?></span><br/><span style="font-size: 10px;"><?php echo aircraftname(mysql_result($queryprvdet,$j,'acft'),"name"); ?></span></td>
												<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if ($movement == 'dep') { echo mysql_result($queryprvdet,$j,'slottime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($queryprvdet,$j,'slottime'),flighttime(mysql_result($queryprvdet,$j,'origin'),mysql_result($queryprvdet,$j,'destination'),mysql_result($queryprvdet,$j,'acft')),"diff"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if ($movement == 'dep') { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span></td>
												<td style="vertical-align: middle;"><span style="font-size: 30px; margin-top: 10px;"><?php if ($movement == 'arr') { echo mysql_result($queryprvdet,$j,'slottime'); } else { ?> <span style="color: red;"><?php echo timeOperation(mysql_result($queryprvdet,$j,'slottime'),flighttime(mysql_result($queryprvdet,$j,'origin'),mysql_result($queryprvdet,$j,'destination'),mysql_result($queryprvdet,$j,'acft')),"add"); ?></span><?php } ?></span><br/><span style="font-size: 10px;"><?php if ($movement == 'arr') { echo "ZULU"; } else {?><span style="color: red;">ZULU (AUTOMATICALLY ESTIMATED)</span><?php }?></span></td>
											</tr>
											<tr style="border-bottom: 1px solid #444">
												<td><b>Gate</b></td>
												<td colspan="2"><b>Route</b> <span style="font-size: 12px;">(filled by the pilot)</span></td>
											</tr>
											<tr height="50px">
												<td style="vertical-align: middle;"><span style="font-size: 30px; font-weight: bold;background-color: #F2EF30; padding: 0 10px;">-</span></td>
												<td style="vertical-align: middle;" colspan=2><span style="font-size: 15px;"><?php echo mysql_result($queryprvdet,$j,'route'); ?></span></td>
											</tr>
											<tr>
												<td style="vertical-align: top;" colspan=3><span style="font-size: 10px; float: right; line-height: 12px;">Slot requested on <?php echo mysql_result($queryprvdet,$j,'requesttimestamp'); ?>.</span></td>
											</tr>
										</table><br/>
											
										</div>									
									</div>
								</div>
<?php	
						}
?>
						</div>						
					</div>
				</div>
			</div>
<?php
		}
?>
		</div>
		
		<table border="0" cellspacing="0" cellpadding="3">
			<tr>
				<th style="vertical-align: middle; width: 10%;">Create new slot</th>
				<td style="vertical-align: middle; width: 30%">
					<input type="time" name="newslot" id="newslot" style="width: 30%;" />
					<button name="singlebutton" class="btn btn-success" style="width: 40%; vertical-align: middle;" onClick="addSlot();">Add slot</button>
				</td>
			</tr>
		</table>
		
	</div>
	<div id="modalmail" class="modal-body">
	
<?php	
	$query = "SELECT aptname,sendermail FROM rfe_config";
	$query = mysqlexec($sqlconn,$query);
?>
	
	<b>Sender:</b> <span id="sender"><?php echo mysql_result($query,0,"sendermail"); ?></span><br>
	<b>Destination:</b> <span id="mailaddress"></span><br>
	<b>Subject:</b> <span id="subject">RFE <?php echo  mysql_result($query,0,"aptname"); ?> - Your booking slot</span><br>
	<textarea id="mailbody" style="width: 97%; margin-top: 10px;" rows="10" required>Write your message here</textarea><br>
	<button name="singlebutton" class="btn btn-success" style="vertical-align: middle;float: right;margin: 0 2px 0 2px;" onClick="sendMail(memb_id);">Send Mail</button>
		<button name="singlebutton" class="btn btn-inverse" style="vertical-align: middle;float: right;margin: 0 2px 0 2px;" onClick="toggleMailForm();">Back</button>
	</div>
	
		<script>
		$(document).ready(function(){
			$("#modalmail").hide();
		});
		
		 editor = CKEDITOR.replace( 'mailbody', {
			toolbar : [
				['Font','FontSize'],
				['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','-','Outdent','Indent'],
				['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
				['Image','Table','-','Link','TextColor','BGColor']
			]
		 });
		
		mail = '';
		memb_id = '';
		
		function toggleMailForm(id) {
			if ( mail ) {
				$("#modalmail").hide();
				$("#modalbody").show();
				memb_id = '';
				mail = false;
			} else if ( !mail ) {
				$("#modalmail").show();
				$("#modalbody").hide();
				$("#mailaddress").load('phpinc/getweather.php', {'icao': id, 'wx': 'mail' });
				memb_id = id;
				mail = true;
			}		
		}	
		
		function sendMail(id) {
		
			var subject = $('#subject').html();
			var body    = editor.getData();
			
			$("#modalmail").prepend('<div id="ldg"><center><br/><img src="images/loading.gif"/><br><br></center></div>');
			$.ajax({
				type    : "GET",
				url     : "phpinc/sendmail.php",
				dataType: "html",
				contentType: 'application/x-www-form-urlencoded',
				beforeSend: function(jqXHR) {
					jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
				},
				data    : { id: id, action: 'freemsg', subject: subject, body: body, },
			}).done(function (result) {
				$("#ldg").html('<div class="alert alert-success"><h4>Well Done!</h4><br/>The mail has been sent.</div>');
				window.location.reload(true);
			});
		
		}
		</script>
			
