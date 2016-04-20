<?php
$id = $_GET["ide"];

if (isset($id)) {
	$querysel = "SELECT flightnumber,origin,destination,deptime,arrtime,gate,acft,route,vid
	FROM rfe_flights
	WHERE id=".$id."";
	$querysel = mysqlexec($sqlconn,$querysel);
}

?>

<div class="row">
	<label>Flight Number<span style="color: red;">*</span></label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,0,"flightnumber") : ""); ?>" name="flightnumber" id="flightnumber" class="{validate:{required:true, messages:{required:'Mandatory field!'}}}" placeholder="Fill the flight number and airline within the ICAO format."/></div>
</div>
<div class="row">
	<label>Origin<span style="color: red;">*</span></label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,0,"origin") : ""); ?>" name="origin" class="{validate:{required:true, messages:{required:'Mandatory field!'}}}" placeholder="Fill the ICAO code of the origin." maxlength="4"/></div>
</div>
<div class="row">
	<label>Destination<span style="color: red;">*</span></label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,0,"destination") : ""); ?>" name="destination" class="{validate:{required:true, messages:{required:'Mandatory field!'}}}" placeholder="Fill the ICAO code of the destination." maxlength="4"/></div>
</div>
<div class="row">
	<label>Departure Time</label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,0,"deptime") : ""); ?>" name="deptime" id="deptime" class="onlynum" placeholder="Insert the departure time."/></div>
</div>
<div class="row">
	<label>Arrival Time</label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,0,"arrtime") : ""); ?>" name="arrtime" id="arrtime" class="onlynum" placeholder="Insert the Arrival time."/></div>
</div>
<div class="row">
	<label>Gate</label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,0,"gate") : ""); ?>" name="gate" placeholder="Fill the gate where the flight originates." maxlength="4"/></div>
</div>
<div class="row">
	<label>Aircraft<span style="color: red;">*</span></label>
	<div class="right"><input type="text" value="<?php echo (isset($id) ? mysql_result($querysel,0,"acft") : ""); ?>" name="acft" class="{validate:{required:true, messages:{required:'Mandatory field!'}}}" placeholder="Fill the ICAO code of the aircraft." maxlength="4"/></div>
</div>
<div class="row">
	<label onClick="getRoute(document.getElementById('flightnumber').value,'routefield');">Route</label>
	<div class="right"><textarea name="route" id="routefield" placeholder="Insert the route for this flight"><?php echo (isset($id) ? mysql_result($querysel,0,"route") : ""); ?></textarea></div>
</div>

<script type="text/javascript">
function getRoute(flt,place) {
	if (window.XMLHttpRequest) {
		xmlhttp=new XMLHttpRequest();
	} else {
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById(place).value=xmlhttp.responseText;
			//document.getElementById(place).value=document.getElementById('flightnumber').value;
		}
	}
	
	xmlhttp.open("GET","php/getRoute.php?flt="+flt,true);
	xmlhttp.send();

}
</script>