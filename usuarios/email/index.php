<?php
//define variables
define('cookie_name', 'ivao_token');
define('login_url', 'http://login.ivao.aero/index.php');
define('api_url', 'http://login.ivao.aero/api.php');
define('url', 'http://www.ivaocol.com.co/');

//redirect function
function redirect() {
	setcookie(cookie_name, '', time()-3600);
	header('Location: '.url);
	exit;
}

//if the token is set in the link
if($_GET['IVAOTOKEN'] && $_GET['IVAOTOKEN'] !== 'error') {
	setcookie(cookie_name, $_GET['IVAOTOKEN'], time()+3600);
	header('Location: '.url);
	exit;
} elseif($_GET['IVAOTOKEN'] == 'error') {
	die('This domain is not allowed to use the Login API! Contact the System Adminstrator!');
}

//check if the cookie is set and/or is correct
if($_COOKIE[cookie_name]) {
	$user_array = json_decode(file_get_contents(api_url.'?type=json&token='.$_COOKIE[cookie_name]));
	if($user_array->result) {
		//Success! A user has been found!
		
	} else {
		redirect();
    }
} else {
	redirect();
}

?>

<!DOCTYPE html>
<html lang="en-us" class="no-js">

	<head>
		<meta charset="utf-8">
        <title>IVAO Colombia | Usuario</title>
        <meta name="description" content="The description should optimally be between 150-160 characters.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Madeon08">

        <!-- ================= Favicon ================== -->
        <!-- Standard -->
       <link rel="icon" type="image/png" href="../assets/img/favicon.ico">

        <!-- ============== Resources style ============== -->
        <link rel="stylesheet" href="css/style.css" />

		<!-- Modernizr runs quickly on page load to detect features -->
		<script src="js/modernizr.custom.js"></script>
	</head>
	
	<body>
	
	<!-- Page preloader -->
		<div id="loading">
			<div id="preloader">
				<span></span>
				<span></span>
			</div>
		</div>

		<!-- YouTube link -->
		<a id="bgndVideo" class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=EYYESBCbxkk',containment:'body',autoPlay:true, mute:false, startAt:20, stopAt:101, opacity:1}"></a>

		

		<!-- Overlay and Star effect -->
		<div class="global-overlay">
			<div class="overlay skew-part">

				
			</div>
		</div>

		<!-- START - Home/Left Part -->
		<section id="left-side">

			<!-- Your logo -->
			<img src="img/logo.png" alt="" class="brand-logo" />

			<div class="content">

				<h1 class="text-intro opacity-0">Buen día <?php echo utf8_decode($user_array->firstname) . '!'; ?></h1>
                <h2 class="text-intro opacity-0">Términos de Uso y Condición</h2>

				<h2 class="text-intro opacity-0">REGISTRE SU CORREO:</h2>
				<p>Es requisito obligatorio si deseas usar los servicios de IVAO Colombia, registrar su correo oficial. <b>BENEFICIOS</b><br>
				<li>Recibir respuestas del Staff a través del buzón de mensajes.</li>
				<li>Recibir información acerca de reservas ATC y el estado de solicitud.</li>
				</p>
<br>
				<nav>
					<ul>
						<li>
							<a href="../../" id="open-more-info" data-target="right-side" class="light-btn text-intro opacity-0">No Acepto.</a>
						</li>
						<li>
							<a data-dialog="somedialog" class="action-btn trigger text-intro opacity-0">Acepto!</a>
						</li>
					</ul>
				</nav>

			</div>

			

		</section>
		<!-- END - Home/Left Part -->



		
		<!-- START - More Informations/Right Part -->

		<!-- Button Cross to close the More Informations/Right Part -->
		<button id="close-more-info" class="hide-close"><i class="icon ion-ios-close-outline"></i></button>

		<!-- START - Newsletter Popup -->
		<div id="somedialog" class="dialog">

			<div class="dialog__overlay"></div>
					
			<div class="dialog__content">
						
				<div class="dialog-inner">
							
					<h4>Quieres obtener todos los beneficios?</h4>
							
					<p>Registra ahora mismo tu correo y <strong>comienza a disfrutar de grandiosas funciones hechas por IVAO Colombia!</strong></p>

					<!-- Newsletter Form -->
					<div id="subscribe">

		                <form action="./php/notify-me.php"  method="POST">

		                    <div class="form-group" >

		                        <div class="controls">
		                            <?php $infos = $user_array->vid; ?>
		                        	<!-- Field  -->
		                        	<input type="text" id="mail-sub" name="email" placeholder="Click acá para escribir tu correo" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Click acá para escribir tu correo'" class="form-control email srequiredField" />
<input type="hidden"  name="vid" value="<?php echo $infos; ?>"/>
		                        	<!-- Spinner top left during the submission -->
		                        	<i class="fa fa-spinner opacity-0"></i>
<br>
		                            <!-- Button -->
		                            <button class="btn btn-lg submit"><font color="red">Registrar</font></button>

		                            <div class="clear"></div>

		                        </div>

		                    </div>

		                </form>

						<!-- Answer for the newsletter form is displayed in the next div, do not remove it. -->
						<div class="block-message">

							<div class="message">

								<p class="notify-valid"></p>

							</div>

						</div>

        			</div>
        			<!-- /. Newsletter Form -->

				</div>
				<!-- /. dialog-inner -->

				<!-- Button Cross to close the Newsletter Popup -->
				<button class="close-newsletter" data-dialog-close><i class="icon ion-close-round"></i></button>

			</div>
			<!-- /. dialog__content -->
						
		</div>
		<!-- END - Newsletter Popup -->

		<!-- Root element of PhotoSwipe, the gallery. Must have class pswp. -->
		<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

		    <!-- Background of PhotoSwipe. 
	        	It's a separate element as animating opacity is faster than rgba(). -->
		    <div class="pswp__bg"></div>

		    <!-- Slides wrapper with overflow:hidden. -->
		    <div class="pswp__scroll-wrap">

		        <!-- Container that holds slides. 
		            PhotoSwipe keeps only 3 of them in the DOM to save memory.
		            Don't modify these 3 pswp__item elements, data is added later on. -->
		        <div class="pswp__container">
		            <div class="pswp__item"></div>
		            <div class="pswp__item"></div>
		            <div class="pswp__item"></div>
		        </div>

		        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
		        <div class="pswp__ui pswp__ui--hidden">

		            <div class="pswp__top-bar">

		                <!--  Controls are self-explanatory. Order can be changed. -->

		                <div class="pswp__counter"></div>

		                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

		                <button class="pswp__button pswp__button--share" title="Share"></button>

		                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

		                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

		                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
		                <!-- element will get class pswp__preloader--active when preloader is running -->
		                <div class="pswp__preloader">
		                    <div class="pswp__preloader__icn">
		                      <div class="pswp__preloader__cut">
		                        <div class="pswp__preloader__donut"></div>
		                      </div>
		                    </div>
		                </div>

		            </div>

		            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
		                <div class="pswp__share-tooltip"></div> 
		            </div>

		            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
		            </button>

		            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
		            </button>

		            <div class="pswp__caption">
		                <div class="pswp__caption__center"></div>
		            </div>

		        </div>

		    </div>

		</div>
		<!-- /. Root element of PhotoSwipe. Must have class pswp. -->

	<!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** Resources jQuery ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->
	
	<!-- * Libraries jQuery, Easing and Bootstrap - Be careful to not remove them * -->
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easings.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<!-- PhotoSwipe Core JS file -->
	<script src="js/velocity.min.js"></script> 

	<!-- PhotoSwipe UI JS file -->
	<script src="js/velocity.ui.min.js"></script> 

	<!-- Newsletter plugin -->
	<script src="js/notifyMe.js"></script>

	<!-- Contact form plugin -->
	<script src="js/contact-me.js"></script>

	<!-- Slideshow/Image plugin -->
	<script src="js/vegas-youtube-mobile.js"></script>

	<!-- YouTube plugin -->
	<script src="js/jquery.mb.YTPlayer.js"></script>

	<!-- Scroll plugin -->
	<script src="js/jquery.mousewheel.js"></script>

	<!-- Custom Scrollbar plugin -->
	<script src="js/jquery.mCustomScrollbar.js"></script>

	<!-- Popup Newsletter Form -->
	<script src="js/classie.js"></script>
	<script src="js/dialogFx.js"></script>

	<!-- PhotoSwipe Core JS file -->
	<script src="js/photoswipe.js"></script> 

	<!-- PhotoSwipe UI JS file -->
	<script src="js/photoswipe-ui-default.js"></script> 

	<!-- Main JS File -->
	<script src="js/main.js"></script>
	
	<!--[if lt IE 10]><script type="text/javascript" src="js/placeholder.js"></script><![endif]-->

	</body>

</html>