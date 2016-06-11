<?php
/*========================================================================
© 2015 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Creates the modal showing the admin control.
   Author: Filipe Fonseca    05/03/2015
Revisions: 
========================================================================*/
// INCLUDES
include("func_mysqlexec.php");
include("func_general.php");

// GLOBAL VARIABLES
global $navdatabase, $rfedatabase, $sqlconn;

// Privileges
function privilegeName($id) {
	switch ($id) {
		case 2:
			return "Super Admin";
			break;
		case 1:
			return "Admin";
			break;
		case 0:
			return "Editor";
			break;
		default:
			return "Error";
			break;
	}
}

// Get all programmed slots
$query = "SELECT id, vid, level FROM rfe_admins";
$query = mysqlexec($sqlconn,$query);
$admnbr = mysql_num_rows($query);

?>

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Admin Control</h3>
	</div>
	<div id="modalbody" class="modal-body">

	<table class="table table-striped table-hover" width="100%">
		<tr>
			<th style="vertical-align: middle; width: 20%;">VID</th>
			<th style="vertical-align: middle; width: 60%;">Privileges</th>
			<th style="vertical-align: middle; width: 20%;">Controls</th>
		</tr>
<?php	
		for ($i=0;$i<$admnbr;$i++) {
?>
		<tr>
			<td style="vertical-align: middle; width: 20%;"><?php echo mysql_result($query,$i,'vid'); ?></td>
			<td style="vertical-align: middle; width: 60%;"><?php echo privilegeName(mysql_result($query,$i,'level')); ?></td>
			<td style="vertical-align: middle; width: 20%;"><img src="images/edit.png" class="bookingadmin" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.33);" onClick="loadEditAdminMenu(<?php echo mysql_result($query,$i,'id'); ?>)" data-toggle="tooltip" data-placement="left" title="Edit admin"> <img src="images/del.png" class="bookingadmin" onMouseOver="$(this).fadeTo(200,1);" onMouseOut="$(this).fadeTo(200,0.33);" onClick="deleteAdmin(<?php echo mysql_result($query,$i,'id'); ?>)" data-toggle="tooltip" data-placement="right" title="Delete admin"></td>
		</tr>
<?php		
		}
?>
	</table>
		
	<table border="0" cellspacing="0" cellpadding="3">
		<tr>
			<th style="vertical-align: middle; width: 10%;">Add new admin</th>
			<td style="vertical-align: middle; width: 30%">
				<input type="text" name="newadmin" id="newadmin" style="width: 30%;" maxlength="6" />
				<button name="singlebutton" class="btn btn-success" style="width: 40%; vertical-align: middle;" onClick="addAdmin();">Add admin</button>
			</td>
		</tr>
	</table>
		
	</div>