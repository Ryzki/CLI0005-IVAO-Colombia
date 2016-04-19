<?php
/*========================================================================
© 2015 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal showing the admin control.
   Author: Filipe Fonseca    10/03/2015
Revisions: 
========================================================================*/
// INCLUDES
include("func_mysqlexec.php");

// Get admin details
$query = "SELECT id, vid, level FROM rfe_admins WHERE id = ".$_REQUEST["id"];
$query = mysqlexec($sqlconn,$query);

?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Edit Privileges</h3>
	</div>
	<div id="modalbody" class="modal-body">

	<table class="table table-striped" width="100%">
		<tr>
			<th style="vertical-align: middle; width: 20%;">VID</th>
			<th style="vertical-align: middle; width: 60%;">Privileges</th>
		</tr>
		<tr>
			<td style="vertical-align: middle; width: 20%;"><?php echo mysql_result($query,0,'vid'); ?></td>
			<td style="vertical-align: middle; width: 60%;">
				<select name="privileges" id="privileges">
					<option value="0" <?php if(mysql_result($query,0,'level') == 0) {echo "selected";} ?>>Editor</option>
					<option value="1" <?php if(mysql_result($query,0,'level') == 1) {echo "selected";} ?>>Admin</option>
					<option value="2" <?php if(mysql_result($query,0,'level') == 2) {echo "selected";} ?>>Super Admin</option>
				</select>
			</td>
			
		</tr>
	</table>
		
	</div>
	
	<div class="modal-footer">
		<button class="btn btn-inverse" onClick="loadAdminEdit()">Back</button>
		<button name="singlebutton" class="btn btn-info" onClick="editAdmin(<?php echo mysql_result($query,0,'id'); ?>);">Update admin</button>
	</div>