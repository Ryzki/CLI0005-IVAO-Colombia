<?php
// Get Information of the division from the Database
$query = "SELECT division,divisioniso FROM rfe_config";
$query = mysqlexec($sqlconn,$query);
?>

<footer id="footer" >
	<div class="container2" style="background: url(./img/signature.png) no-repeat;width:100%;height:90%">
		<div class="row">
			<div class="span3" style=" padding-left: 20px;  ">
				<img src="phpinc/generatelogo.php">
				<p><font color="black">Realizado por IVAO <?php echo mysql_result($query,0,'division'); ?>.</font></p>
				<p class="copyright"><font color="black">
					&copy; <?php echo gmdate("Y"); ?> - <a href="http://co.ivao.aero">IVAO Colombia</a></font>
				</p>
			</div>
<?php
// Get Contact Information of the division from the Database
$query2 = "SELECT facebook,twitter,googleplus FROM rfe_contacts";
$query2 = mysqlexec($sqlconn,$query2);

if (@mysql_result($query2,0,'facebook')) {
?>
			<div class="span2">
				<h1><i class="fa fa-facebook"></i></h1>
				<p><a href="<?php echo mysql_result($query2,0,'facebook'); ?>">Encontrar IVAO-<?php echo mysql_result($query,0,'divisioniso'); ?> en Facebook</a></p>
			</div>
<?php
}
if (@mysql_result($query2,0,'twitter')) {
?>
			<div class="span2">
				<h1><i class="fa fa-twitter"></i></h1>
				<p><a href="<?php echo mysql_result($query2,0,'twitter'); ?>">Encontrar IVAO-<?php echo mysql_result($query,0,'divisioniso'); ?> en Twitter</a></p>
			</div>
<?php
}
if (@mysql_result($query2,0,'googleplus')) {
?>
			<div class="span2">
				<h1><i class="fa fa-google-plus"></i></h1>
				<p><a href="<?php echo mysql_result($query2,0,'googleplus'); ?>">Encontrar IVAO-<?php echo mysql_result($query,0,'divisioniso'); ?> en Google+</a></p>
			</div>
<?php
}
?>
		</div>
	</div>
</footer>

<!--Modals--> 
<div id="modalLogoff" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/modernizr.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.fitvids.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/twitter.js"></script>

<script src="js/stellar.js"></script>
<script src="js/nicescroll.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-thumbs0ff5.js?v=1.0.2"></script>
<script type="text/javascript" src="js/jquery.fancybox-mediae209.js?v=1.0.0"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/retina.js"></script>
<script src="js/custom.js"></script>
<script src="js/jquery.stickytableheaders.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/rfe.functions.js"></script>

<script>
	function blink(selector){
		$(selector).fadeOut('fast', function(){
			$(this).fadeIn('slow', function(){
				blink(this);
			});
		});
	}
	$(document).ready(function(){
		$("[rel=tooltip]").tooltip();
		blink('#booklink');	
		// Hiding table for search
		$('#resulttable').hide();
		
		
	  // Custom Delay Function
	  var delay = (function(){
			var timer = 0;

			return function(callback, ms){
				 clearTimeout (timer);
				 timer = setTimeout(callback, ms);
			  };
	  })();
		$('#searchbook').keyup(function() {
			var s = $(this).val()
			delay(function(){
				//alert('abc');
				searchFlights(s);
			}, 500 );
		});
		
    $('#bgcarousel').carousel({interval: 5000});
	
	});
</script>