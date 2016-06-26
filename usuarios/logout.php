
<?php
    session_start();
    session_destroy(); 
    unset($_COOKIE['ivao_token']); 
    header ("Location: http://www.ivaocol.com.co/"); 
    exit;
?>