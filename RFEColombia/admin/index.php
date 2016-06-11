<?php
// INCLUSÃO GERAL DE ARQUIVOS
include("php/func_mysqlexec.php");   // Execução do MySQL
include("php/func_general.php");   // Execução do MySQL

//if the token is set in the link
if($_GET['IVAOTOKEN'] && $_GET['IVAOTOKEN'] !== 'error') {
	setcookie(cookie_name, $_GET['IVAOTOKEN'], time()+3600);
	header('Location: '.url);
	exit;
} elseif($_GET['IVAOTOKEN'] == 'error') {
	die('This domain is not allowed to use the Login API! Contact the System Administrator!');
}

/*if($_COOKIE[cookie_name]) {
	$IVAO_Info = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
} else {
	header('Location: ../');
}*/

$query = "SELECT vid FROM rfe_admins WHERE vid='".$IVAO_Info->vid."'";
$query = mysqlexec($sqlconn,$query);
$queryn = mysql_num_rows($query);

/*if($queryn == 0) {
	header('Location: ../');
}*/

$querysel = "SELECT aptname FROM rfe_config";
$querysel = mysqlexec($sqlconn,$querysel);

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>RFE <?php echo mysql_result($querysel,0,0); ?> - Admin</title>
	
<style type="text/css">
		@import url("css/style.css");
		@import url("css/forms.css");
		@import url("css/forms-btn.css");
		@import url("css/menu.css");
		@import url('css/style_text.css');
		@import url("css/datatables.css");
		@import url("css/fullcalendar.css");
		@import url("css/pirebox.css");
		@import url("css/modalwindow.css");
		@import url("css/statics.css");
		@import url("css/tabs-toggle.css");
		@import url("css/system-message.css");
		@import url("css/tooltip.css");
		@import url("css/wizard.css");
		@import url("css/wysiwyg.css");
		@import url("css/wysiwyg.modal.css");
		@import url("css/wysiwyg-editor.css");
</style>
	
	<!--[if lte IE 8]>
		<script type="text/javascript" src="js/excanvas.min.js"></script>
	<![endif]-->
	
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.backgroundPosition.js"></script>
	<script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
	<script type="text/javascript" src="js/jquery.jCombo.min.js"></script>
	<script type="text/javascript" src="js/jquery.ui.1.8.17.js"></script>
	<!--<script type="text/javascript" src="js/jquery.ui.select.js"></script>-->
	<script type="text/javascript" src="js/jquery.ui.spinner.js"></script>
	<script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript" src="js/supersubs.js"></script>
	<script type="text/javascript" src="js/jquery.datatables.js"></script>
	<script type="text/javascript" src="js/fullcalendar.min.js"></script>
	<script type="text/javascript" src="js/jquery.smartwizard-2.0.min.js"></script>
	<script type="text/javascript" src="js/pirobox.extended.min.js"></script>
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="js/jquery.elastic.source.js"></script>
	<script type="text/javascript" src="js/jquery.customInput.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/jquery.metadata.js"></script>
	<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="js/jquery.filestyle.mini.js"></script>
	<script type="text/javascript" src="js/jquery.filter.input.js"></script>
	<script type="text/javascript" src="js/jquery.flot.js"></script>
	<script type="text/javascript" src="js/jquery.flot.pie.min.js"></script>
	<script type="text/javascript" src="js/jquery.flot.resize.min.js"></script>
	<script type="text/javascript" src="js/jquery.graphtable-0.2.js"></script>
	<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
	<script type="text/javascript" src="js/controls/wysiwyg.image.js"></script>
	<script type="text/javascript" src="js/controls/wysiwyg.link.js"></script>
	<script type="text/javascript" src="js/controls/wysiwyg.table.js"></script>
	<script type="text/javascript" src="js/plugins/wysiwyg.rmFormat.js"></script>
	<script type="text/javascript" src="js/costum.js"></script>
	
</head>

<body>

<div id="wrapper">
	<div id="container">
	
		<div class="hide-btn top"></div>
		<div class="hide-btn center"></div>
		<div class="hide-btn bottom"></div>
		
		<div id="top">
			<h1 id="logo"><a href="./"></a></h1>
			<div id="labels">
				<ul>
					<li><a href="../" class="logout" onclick="$(this).hide('slow');"></a></li>
				</ul>
			</div>
			<div id="menu">
				<ul> 
					<li><a href="#">Flights</a>
					<ul> 
						<li><a href="flights.add">Add Flight</a></li>
						<li><a href="flights.edit">Edit Flight</a></li>
						<li><a href="flights.remove">Remove Flight</a></li>
					</ul>
					</li> 				
						
					<li><a href="#">ATCs</a>
					<ul> 
						<li><a href="atcs.add">Add ATC Position</a></li>
						<li><a href="atcs.edit">Edit ATC Position</a></li>
						<li><a href="atcs.remove">Remove ATC Position</a></li>
					</ul>
					</li> 
				</ul>
			</div>
		</div>
		
		<div id="left">
<!--		
			<div class="box statics">
				<div class="content">
					<ul>
						<li><h2>Estatísticas</h2></li>
<?php
$query = "SELECT COUNT(id) FROM bco_congregacoes";
$query = mysqlexec($sqlconn,$query);
?>
						<li>Congregações <div class="info red"><span>1</span></div></li>
<?php
$query = "SELECT COUNT(id) FROM bco_membros";
$query = mysqlexec($sqlconn,$query);
?>
						<li>Membros <div class="info blue"><span><?php echo mysql_result($query,0,0); ?></span></div></li>
					</ul>
				</div>
			</div>
-->
		</div>
		
		<div id="right">
		
<?php
$departamento = $_GET["d"];
$pagina       = $_GET["p"];
	if (isset($departamento) AND isset($pagina)) {
		@include_once("php/".$departamento.".".$pagina.".php");
	} else if (isset($departamento) AND !isset($pagina)) {
		@include_once("php/".$departamento.".php");
	}

?>
		
		</div>
		
	</div>
</div>

</body>

</html>  