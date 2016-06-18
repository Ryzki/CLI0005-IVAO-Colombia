<?php
include("phpinc/config.inc.php");
?>
        <!--################ WRAP START ################-->

        <div id="wrap">

            <!--################ HEADER START ################-->

            <header class="page-title">
                <div class="container">
                    <h2>About the airport</h2>
                </div>
            </header>
					
            <section class="services-page">
				<div class="container">
				
				<div id="ajaxinfo"></div>
				
<?php
					$querysel = "SELECT * FROM rfe_about";
					$querysel = mysqlexec($sqlconn,$querysel);
?>
				
					<div class="row">
						<div class="span12">
							<h3 >Aserca de <?php if ($is_admin) echo '<i id="abouticon" class="fa fa-edit icon-small pull-right editicon" title="Edit this text" data-toggle="tooltip" data-placement="right" onClick="toggleEditor('.@mysql_result($querysel,0,"id").');"></i>'; ?></h3>
							<div id="editor"></div>
							<div id="abouttext">
<?php							echo @mysql_result($querysel,0,"description"); ?>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="span12">
							<h3>Escenarios <?php if ($is_admin) echo '<i id="sceneryicon" class="fa fa-edit icon-small pull-right editicon" title="Edit links" data-toggle="tooltip" data-placement="right" onClick="toggleScenery('.@mysql_result($querysel,0,"id").');"></i>'; ?></h3>
							<div id="scenerytext">
								<table align="center" class="table table-striped" id="tablescenery">
									<thead>
										<tr>
											<th style="width: 20%;">&nbsp;</th>
											<th style="width: 40%;"><center>FREEWARE</center></th>
											<th style="width: 40%;"><center>PAYWARE</center></th>
										</tr>
									</thead>
									<tr>
										<th><center>FS9</center></th>
<?php
										echo (mysql_result($querysel,0,"fs9free") ? '<td id="fs9free"><center><button type="button" style="width:400px;" class="btn btn-info" onclick="window.location.href=\''.mysql_result($querysel,0,"fs9free").'\'">FS9 Freeware</button></center></td>' : '<td id="fs9free"><center>(none)</center></td>');
										echo (mysql_result($querysel,0,"fs9pay") ? '<td id="fs9pay"><center><button type="button" style="width:400px;" class="btn btn-info" onclick="window.location.href=\''.mysql_result($querysel,0,"fs9pay").'\'">FS9 Payware</button></center></td>' : '<td id="fs9pay"><center>(none)</center></td>');
?>
									</tr>
									<tr>
										<th><center>FSX</center></th>
<?php
										echo (mysql_result($querysel,0,"fsxfree") ? '<td id="fsxfree"><center><button type="button" style="width:400px;" class="btn btn-success" onclick="window.location.href=\''.mysql_result($querysel,0,"fsxfree").'\'">FSX Freeware</button></center></td>' : '<td id="fsxfree"><center>(none)</center></td>');
										echo (mysql_result($querysel,0,"fsxpay") ? '<td id="fsxpay"><center><button type="button" style="width:400px;" class="btn btn-success" onclick="window.location.href=\''.mysql_result($querysel,0,"fsxpay").'\'">FSX Payware</button></center></td>' : '<td id="fsxpay"><center>(none)</center></td>');
?>
									</tr>
									<tr>
										<th><center>Prepar3D</center></th>
<?php
										echo (mysql_result($querysel,0,"p3dfree") ? '<td id="p3dfree"><center><button type="button" style="width:400px;" class="btn btn-danger" onclick="window.location.href=\''.mysql_result($querysel,0,"p3dfree").'\'">Prepar3D Freeware</button></center></td>' : '<td id="p3dfree"><center>(none)</center></td>');
										echo (mysql_result($querysel,0,"p3dpay") ? '<td id="p3dpay"><center><button type="button" style="width:400px;" class="btn btn-danger" onclick="window.location.href=\''.mysql_result($querysel,0,"p3dpay").'\'">Prepar3D Payware</button></center></td>' : '<td id="p3dpay"><center>(none)</center></td>');
?>
									</tr>
									<tr>
										<th><center>X-Plane</center></th>
<?php
										echo (mysql_result($querysel,0,"xplanefree") ? '<td id="xplanefree"><center><button type="button" style="width:400px;" class="btn btn-warning" onclick="window.location.href=\''.mysql_result($querysel,0,"xplanefree").'\'">X-Plane Freeware</button></center></td>' : '<td id="xplanefree"><center>(none)</center></td>');
										echo (mysql_result($querysel,0,"xplanepay") ? '<td id="xplanepay"><center><button type="button" style="width:400px;" class="btn btn-warning" onclick="window.location.href=\''.mysql_result($querysel,0,"xplanepay").'\'">X-Plane Payware</button></center></td>' : '<td id="xplanepay"><center>(none)</center></td>');
?>
									</tr>
								</table>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="span12">
							<h3>Charts <?php if ($is_admin) echo '<i id="chartsicon" class="fa fa-edit icon-small pull-right editicon" title="Edit link" data-toggle="tooltip" data-placement="right" onClick="toggleChartLink('.@mysql_result($querysel,0,"id").');"></i>'; ?></h3>
							<div id="chartstext">
<?php
								echo (mysql_result($querysel,0,"charts") ? 'You can find them <a href="'.mysql_result($querysel,0,"charts").'">here</a>.' : 'Not currently available.');
?>
							</div>
						</div>
					</div>
					
<?php
				if ($is_admin) {
?>
					<div class="row">
						<div class="span12">
							<h3>Briefing <?php echo '<i id="briefingicon" class="fa fa-edit icon-small pull-right editicon" title="Edit link" data-toggle="tooltip" data-placement="right" onClick="toggleBriefing('.@mysql_result($querysel,0,"id").');"></i>'; ?></h3>
							<div id="briefingtext">
<?php
								echo "<b>ATC Brief</b>: ".(mysql_result($querysel,0,"briefatc") ? 'filled.' : 'not filled.')."<br>";
								echo "<b>Pilot Brief</b>: ".(mysql_result($querysel,0,"briefpilots") ? 'filled.' : 'not filled.');
?>
							</div>
						</div>
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
	
		<script>
		var editor,scenery,charts,briefing = '';

		function toggleEditor(id) {
			if ( editor ) {
				var newoutput = editor.getData();
				editor.destroy();
				
				$("#abouticon").toggleClass('icon-ok-sign');
				$("#abouttext").html('<center><img src="images/updating.gif"/></center>');
				$.ajax({
					type    : "POST",
					url     : "phpinc/ajax_updateabout.php",
					dataType: "html",
					contentType: 'application/x-www-form-urlencoded',
					beforeSend: function(jqXHR) {
						jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
					},
					data    : { id: id, type: 'text', text: newoutput },
				});
				
				$("#abouttext").effect('highlight',3000);
				$("#ajaxinfo").html('<div class="alert alert-success"><h5>The about text has been updated successfully!</h5></div>');
				$("#ajaxinfo").effect('shake',{ direction: "left", times: 5, distance: 6},2000);
				$("#ajaxinfo").slideUp(2000);
				$("#abouttext").html(newoutput);
				editor = null;
			} else if ( !editor ) {
				var config = {height: '500'};
				$("#abouticon").toggleClass('icon-ok-sign');
				editor = CKEDITOR.appendTo( 'editor', config ,$("#abouttext").html() );
				$("#abouttext").html('');
			}		
		}
		
		function toggleScenery(id) {
			if ( scenery ) {
				$("#sceneryicon").toggleClass('icon-ok-sign');
				
				var fs9free    = encodeURIComponent($("#fs9freetext").val());
				var fs9pay     = encodeURIComponent($("#fs9paytext").val());
				var fsxfree    = encodeURIComponent($("#fsxfreetext").val());
				var fsxpay     = encodeURIComponent($("#fsxpaytext").val());
				var p3dfree    = encodeURIComponent($("#p3dfreetext").val());
				var p3dpay     = encodeURIComponent($("#p3dpaytext").val());
				var xplanefree = encodeURIComponent($("#xplanefreetext").val());
				var xplanepay  = encodeURIComponent($("#xplanepaytext").val());
				
				$.ajax({
					type    : "POST",
					url     : "phpinc/ajax_updateabout.php",
					dataType: "html",
					contentType: 'application/x-www-form-urlencoded',
					beforeSend: function(jqXHR) {
						jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
					},
					data    : { id: id, type: 'scenery', fs9free: fs9free, fs9pay: fs9pay, fsxfree: fsxfree, fsxpay: fsxpay, p3dfree: p3dfree, p3dpay: p3dpay, xplanefree: xplanefree, xplanepay: xplanepay },
				});
				
				if ($('#fs9freetext').val()) {
					$("#fs9free").html('<center><button type="button" style="width:400px;" class="btn btn-info" onclick="window.location.href=\''+$('#fs9freetext').val()+'\'">FS9 Freeware</button></center>');
				} else {
					$("#fs9free").html('<center>(none)</center>');
				}
				if ($('#fs9paytext').val()) {
					$("#fs9pay").html('<center><button type="button" style="width:400px;" class="btn btn-info" onclick="window.location.href=\''+$('#fs9paytext').val()+'\'">FS9 Payware</button></center>');
				} else {
					$("#fs9pay").html('<center>(none)</center>');
				}
				if ($('#fsxfreetext').val()) {
					$("#fsxfree").html('<center><button type="button" style="width:400px;" class="btn btn-success" onclick="window.location.href=\''+$('#fsxfreetext').val()+'\'">FSX Freeware</button></center>');
				} else {
					$("#fsxfree").html('<center>(none)</center>');
				}
				if ($('#fsxpaytext').val()) {
					$("#fsxpay").html('<center><button type="button" style="width:400px;" class="btn btn-success" onclick="window.location.href=\''+$('#fsxpaytext').val()+'\'">FSX Payware</button></center>');
				} else {
					$("#fsxpay").html('<center>(none)</center>');
				}
				if ($('#p3dfreetext').val()) {
					$("#p3dfree").html('<center><button type="button" style="width:400px;" class="btn btn-danger" onclick="window.location.href=\''+$('#p3dfreetext').val()+'\'">Prepar3D Freeware</button></center>');
				} else {
					$("#p3dfree").html('<center>(none)</center>');
				}
				if ($('#p3dpaytext').val()) {
					$("#p3dpay").html('<center><button type="button" style="width:400px;" class="btn btn-danger" onclick="window.location.href=\''+$('#p3dpaytext').val()+'\'">Prepar3D Payware</button></center>');
				} else {
					$("#p3dpay").html('<center>(none)</center>');
				}
				if ($('#xplanefreetext').val()) {
					$("#xplanefree").html('<center><button type="button" style="width:400px;" class="btn btn-warning" onclick="window.location.href=\''+$('#xplanefreetext').val()+'\'">X-Plane Freeware</button></center>');
				} else {
					$("#xplanefree").html('<center>(none)</center>');
				}
				if ($('#xplanepaytext').val()) {
					$("#xplanepay").html('<center><button type="button" style="width:400px;" class="btn btn-warning" onclick="window.location.href=\''+$('#xplanepaytext').val()+'\'">X-Plane Payware</button></center>');
				} else {
					$("#xplanepay").html('<center>(none)</center>');
				}
				
				$("#scenerytext").effect('highlight',3000);
				$("#ajaxinfo").html('<div class="alert alert-success"><h5>The scenery list has been updated successfully!</h5></div>');
				$("#ajaxinfo").effect('shake',{ direction: "left", times: 5, distance: 6},2000);
				$("#ajaxinfo").slideUp(2000);
								
				scenery = false;
			} else if ( !scenery ) {
				$("#sceneryicon").toggleClass('icon-ok-sign');
				$("#fs9free").html('<input id="fs9freetext" type="text" value="<?php echo mysql_result($querysel,0,"fs9free"); ?>" style="width: 90%;" placeholder="Enter a link to FS9 freeware scenery">');
				$("#fs9pay").html('<input id="fs9paytext" type="text" value="<?php echo mysql_result($querysel,0,"fs9pay"); ?>" style="width: 90%;" placeholder="Enter a link to FS9 payware scenery">');
				$("#fsxfree").html('<input id="fsxfreetext" type="text" value="<?php echo mysql_result($querysel,0,"fsxfree"); ?>" style="width: 90%;" placeholder="Enter a link to FSX freeware scenery">');
				$("#fsxpay").html('<input id="fsxpaytext" type="text" value="<?php echo mysql_result($querysel,0,"fsxpay"); ?>" style="width: 90%;" placeholder="Enter a link to FSX payware scenery">');
				$("#p3dfree").html('<input id="p3dfreetext" type="text" value="<?php echo mysql_result($querysel,0,"p3dfree"); ?>" style="width: 90%;" placeholder="Enter a link to Prepar3D freeware scenery">');
				$("#p3dpay").html('<input id="p3dpaytext" type="text" value="<?php echo mysql_result($querysel,0,"p3dpay"); ?>" style="width: 90%;" placeholder="Enter a link to Prepar3D payware scenery">');
				$("#xplanefree").html('<input id="xplanefreetext" type="text" value="<?php echo mysql_result($querysel,0,"xplanefree"); ?>" style="width: 90%;" placeholder="Enter a link to X-Plane freeware scenery">');
				$("#xplanepay").html('<input id="xplanepaytext" type="text" value="<?php echo mysql_result($querysel,0,"xplanepay"); ?>" style="width: 90%;" placeholder="Enter a link to X-Plane payware scenery">');
				scenery = true;
			}		
		}
		
		function toggleChartLink(id) {
			if ( charts ) {
				$("#chartsicon").toggleClass('icon-ok-sign');
				$.ajax({
					type    : "POST",
					url     : "phpinc/ajax_updateabout.php",
					dataType: "html",
					contentType: 'application/x-www-form-urlencoded',
					beforeSend: function(jqXHR) {
						jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
					},
					data    : { id: id, type: 'charts', charts: $("#chartstextinput").val() },
				});
				
				if ($('#chartstextinput').val()) {
					$("#chartstext").html('You can find them <a href="'+$("#chartstextinput").val()+'">here</a>.');
				} else {
					$("#chartstext").html('Not currently available.');
				}
				
				$("#chartstext").effect('highlight',3000);
				$("#ajaxinfo").html('<div class="alert alert-success"><h5>The charts\' link has been updated successfully!</h5></div>');
				$("#ajaxinfo").effect('shake',{ direction: "left", times: 5, distance: 6},2000);
				$("#ajaxinfo").slideUp(2000);
				charts = false;
			} else if ( !charts ) {
				$("#chartsicon").toggleClass('icon-ok-sign');
				$("#chartstext").html('<input id="chartstextinput" type="text" value="<?php echo mysql_result($querysel,0,"charts"); ?>" style="width: 90%;" placeholder="Enter the link where we can find charts">');
				charts = true;
			}		
		}	
		
		function toggleBriefing(id) {
			if ( briefing ) {
				$("#briefingicon").toggleClass('icon-ok-sign');
				$.ajax({
					type    : "POST",
					url     : "phpinc/ajax_updateabout.php",
					dataType: "html",
					contentType: 'application/x-www-form-urlencoded',
					beforeSend: function(jqXHR) {
						jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
					},
					data    : { id: id, type: 'briefing', briefatc: $("#briefatctext").val(), briefpilots: $("#briefpilotstext").val() },
				});
				
				if ($('#briefatctext').val()) {
					if ($('#briefpilotstext').val()) {
						$("#briefingtext").html('<b>ATC Brief</b>: filled ('+$("#briefatctext").val()+')<br><b>Pilot Brief</b>: filled ('+$("#briefpilotstext").val()+')');
					} else {
						$("#briefingtext").html('<b>ATC Brief</b>: filled ('+$("#briefatctext").val()+')<br><b>Pilot Brief</b>: not filled');
					}
				} else {
					if ($('#briefpilotstext').val()) {
						$("#briefingtext").html('<b>ATC Brief</b>: not filled<br><b>Pilot Brief</b>: filled ('+$("#briefpilotstext").val()+')');
					} else {
						$("#briefingtext").html('<b>ATC Brief</b>: not filled<br><b>Pilot Brief</b>: not filled');
					}
				}
				
				$("#briefingtext").effect('highlight',3000);
				$("#ajaxinfo").html('<div class="alert alert-success"><h5>The charts\' link has been updated successfully!</h5></div>');
				$("#ajaxinfo").effect('shake',{ direction: "left", times: 5, distance: 6},2000);
				$("#ajaxinfo").slideUp(2000);
				briefing = false;
			} else if ( !briefing ) {
				$("#briefingicon").toggleClass('icon-ok-sign');
				$("#briefingtext").html('<input id="briefatctext" type="text" value="<?php echo mysql_result($querysel,0,"briefatc"); ?>" style="width: 90%;" placeholder="Enter the link where the ATC Briefing is"><br><input id="briefpilotstext" type="text" value="<?php echo mysql_result($querysel,0,"briefpilots"); ?>" style="width: 90%;" placeholder="Enter the link where the Pilot Briefing is">'); 
				briefing = true;
			}		
		}
		</script>
 </body>

</html>