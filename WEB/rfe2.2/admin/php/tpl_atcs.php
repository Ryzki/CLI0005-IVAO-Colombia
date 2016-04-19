<?php
$id = $_GET["ide"];
if (strlen($id) == 7) {
	$id = substr($id,0,4)."_".substr($id,4,3);
} else if (strlen($id) == 8) {
	$id = substr($id,0,4)."_".substr($id,4,1)."_".substr($id,5,3);
} else if (strlen($id) == 9) {
	$id = substr($id,0,4)."_".substr($id,4,2)."_".substr($id,6,3);
} else if (strlen($id) == 10) {
	$id = substr($id,0,4)."_".substr($id,4,3)."_".substr($id,7,3);
}

if (isset($id)) {
	$querysel = "SELECT id,position,timestart,timeend,vid,name,vid2,name2 FROM rfe_atc
	WHERE position='".$id."' ORDER BY timestart";
	$querysel = mysqlexec($sqlconn,$querysel);
	$queryn = mysql_num_rows($querysel);
	
	for ($i=0;$i<$queryn;$i++) {
	
?>

<div class="row">
	<p><b><?php echo $id." - ".substr(str_replace(":","",mysql_result($querysel,$i,'timestart')),0,4)."Z - ".substr(str_replace(":","",mysql_result($querysel,$i,'timeend')),0,4)."Z"; ?></b></p>
</div>
<input type="hidden" value="<?php echo mysql_result($querysel,$i,"id"); ?>" name="id[]"/>
<div class="row">
	<label>VID</label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,$i,"vid") : ""); ?>" name="vid[]" placeholder="Fill the VID."/></div>
</div>
<div class="row">
	<label>Name</label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,$i,"name") : ""); ?>" name="name[]" placeholder="Fill the name of the member."/></div>
</div>
<?php
	}
}
?>