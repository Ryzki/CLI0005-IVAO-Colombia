<?php
	
	$latitudine_centro = $_GET['ubicacion'];
	$longitudine_centro = $_GET['ubicaciondos'];
	$icaos = $_GET['icaos'];
	$airports = $_GET['freq'];
	$aeronave = $_GET['rank'];
$hdg = $_GET['hdg'];
$vidivao = $_GET['vid'];
$nombres = $_GET['name'];	
$altura = $_GET['altura'];	
$speed = $_GET['speed'];	
?>







<style type="text/css">
html { height: 100% }
body { height: 100%; margin: 0; padding: 0;}
#map-canvas { height: 100% }
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>

// definisco l’oggetto che rappresenta il centro della mappa,
// a cui passo le coordinate (variabili Php)
var centro = new google.maps.LatLng(<?php echo $latitudine_centro; ?>,<?php echo $longitudine_centro; ?>);
// definisco l’array dei punti di interesse, a cui passo la stringa costruita in Php
var puntiinteresse = [<?php echo $stringa_coords; ?>];
// definisco l’array delle descrizioni, a cui passo la stringa costruita in Php
var descrizioni = [<?php echo $stringa_descrizioni; ?>];
var markers = [];
var iterator = 0;
var map;

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var imgdeparture = './inair/<?php echo $hdg; ?>.png'
var imgarrival = './inair/<?php echo $hdg; ?>.png'

function initialize() {
directionsDisplay = new google.maps.DirectionsRenderer();
var mapOptions = {
zoom: 5,
mapTypeId: google.maps.MapTypeId.ROADMAP,
center: centro
};
map = new google.maps.Map(document.getElementById('map-canvas'),
mapOptions);
directionsDisplay.setMap(map);


var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?php echo $icaos; ?></h1>'+
      '<div id="bodyContent">'+
      '<p><b><?php echo $aeronave; ?></b><br><?php echo $vidivao; ?><br></p>'+
      '<p>(<?php echo $nombres; ?>) <?php echo $altura . ' Ft ' . $speed . ' Knts'; ?><br><?php echo $airports; ?></p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });


var originMarker = new google.maps.Marker({
position: centro,
map: map,
icon: imgdeparture,
title: 'Hello World!'
});


google.maps.event.addListener(originMarker, 'click', function() {
    infowindow.open(map,originMarker);
  });


<?php
//while ($row = $result->fetch_assoc()) {
//$stringa_coords .= "new google.maps.LatLng(" . $row["Lat"] . ",". $row["Lon"] . "),";
//$ok = $row["Lat"];
//$ok1 = $row["Lon"];

?>


	
	//var flightPlanCoordinates = [
    //new google.maps.LatLng(<?php echo $latitudine_centro; ?>, <?php echo $longitudine_centro; ?>),
	 //new google.maps.LatLng(<?php echo $ok; ?>, <?php echo $ok1; ?>)
    
  //];
  //var flightPath = new google.maps.Polyline({
    //path: flightPlanCoordinates,
    //geodesic: true,
    //strokeColor: '#FF0000',
    //strokeOpacity: 1.0,
    //strokeWeight: 1
  //});

  //flightPath.setMap(map);
  
  
  
  
markers.push(new google.maps.Marker({
position: [<?php echo $stringa_coords; ?>][iterator],
map: map,
draggable: false,
title: descrizioni[iterator],
icon: imgarrival,
animation: google.maps.Animation.DROP
}));
iterator++;	



var styles = [
  {
    stylers: [
      { hue: "#3ca0cf" },
      { saturation: -20 }
    ]
  },{
    featureType: "road",
    elementType: "geometry",
    stylers: [
      { lightness: 100 },
      { visibility: "simplified" }
    ]
  },{
    featureType: "road",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  }
];

map.setOptions({styles: styles});


	
	


}










google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, 'load', drop);


</script>
<body>
<div id="map-canvas"/>
</body>

