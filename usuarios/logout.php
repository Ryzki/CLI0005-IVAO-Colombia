<?php
//define variables
define('cookie_name', 'ivao_token');
define('login_url', 'http://login.ivao.aero/index.php');
define('api_url', 'http://login.ivao.aero/api.php');
define('url', 'http://www.ivaocol.com.co/usuarios/index.php');


setcookie($_COOKIE[cookie_name],false,time()-3600);

?>
<script type="text/javascript">
window.location="http://www.ivaocol.com.co";
</script>