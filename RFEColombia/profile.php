<?php
include("phpinc/config.inc.php");
?>
        <!--################ WRAP START ################-->

        <div id="wrap">

            <!--################ HEADER START ################-->

            <header class="page-title">
                <div class="container">
                    <h2>My Profile</h2>
                </div>
            </header>
					
            <section class="services-page">
				<div class="container">
				
				<div id="ajaxinfo"></div>
				
<?php
					$querysel = "SELECT * FROM rfe_members WHERE vid = ".$IVAO_Info->vid;
					$querysel = mysqlexec($sqlconn,$querysel);
					$queryselatc = "SELECT ratingatc FROM nav_ratings WHERE id = ".mysql_result($querysel,0,"ratingatc");
					$queryselatc = mysqlexec($sqlconn,$queryselatc);
					$queryselplt = "SELECT ratingpilot FROM nav_ratings WHERE id = ".mysql_result($querysel,0,"ratingpilot");
					$queryselplt = mysqlexec($sqlconn,$queryselplt);
?>
				
					<div class="row">
						<div class="span12">
							<h3>Personal Data</h3>
							<div id="personaldata">
								<table align="center" class="table" id="tabledata">
									<tr>
										<th style='width: 15%'><center>Name</center></th>
										<td><input type="text" value="<?php echo mysql_result($querysel,0,"name"); ?>" name="name" id="name" style="width: 80%;font-weight: bold;" disabled/></td>
									</tr>
									<tr>
										<th style='width: 15%'><center>E-mail</center></th>
										<td><input type="text" value="<?php echo mysql_result($querysel,0,"email"); ?>" name="emailtext" id="emailtext" style="width: 80%;"/></td>
									</tr>
									<tr>
										<th style='width: 15%'><center>Privacy</center></th>
										<td><form id="privacyForm"><input type="radio" name="privacy" value="1" <?php echo (mysql_result($querysel,0,"privacy")==1?"checked":""); ?>> Yes, I allow this site to publish my name.<br><input type="radio" name="privacy" value="0" <?php echo (mysql_result($querysel,0,"privacy")==0?"checked":""); ?>> No, I don't allow this site to publish my name.</form></td>
									</tr>
								</table>
							</div>
							
							<h3>IVAO Data</h3>
							<div id="personaldata">
								<table align="center" class="table" id="tabledata">
									<tr>
										<th style='width: 15%'><center>VID</center></th>
										<td><input type="text" value="<?php echo mysql_result($querysel,0,"vid"); ?>" name="vid" id="vid" style="width: 80%;font-weight: bold;" disabled/></td>
									</tr>
									<tr>
										<th style='width: 15%'><center>Ratings</center></th>
										<td><input type="text" value="<?php echo mysql_result($queryselatc,0,"ratingatc"); ?>" name="ratingatc" id="ratingatc" style="width: 80%;font-weight: bold;" disabled/><input type="text" value="<?php echo mysql_result($queryselplt,0,"ratingpilot"); ?>" name="ratingpilot" id="ratingpilot" style="width: 80%;font-weight: bold;" disabled/></td>
									</tr>
									<tr>
										<th style='width: 15%'><center>Division</center></th>
										<td><input type="text" value="<?php echo mysql_result($querysel,0,"division"); ?>" name="division" id="division" style="width: 80%;font-weight: bold;" disabled/></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					
					<button name="singlebutton" class="btn btn-success" onClick="updateProfile(<?php echo mysql_result($querysel,0,"id"); ?>);">Update Profile</button>
					
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
		function updateProfile(id) {
			var email   = $("#emailtext").val();
			var privacy = $('input[name=privacy]:checked', '#privacyForm').val();
			
			$.ajax({
				type    : "GET",
				url     : "phpinc/ajax_updateprofile.php",
				dataType: "html",
				contentType: 'application/x-www-form-urlencoded',
				beforeSend: function(jqXHR) {
					jqXHR.overrideMimeType('text/html;charset=iso-8859-1');
				},
				data    : { id: id, email: email, privacy: privacy },
			});
			
			$("#ajaxinfo").hide();
			$("#ajaxinfo").html('<div class="alert alert-success"><h5>Your details have been updated successfully!</h5></div>');
			$("#ajaxinfo").slideDown(1000).delay(2000).slideUp(2000);
		}
		</script>
 </body>

</html>