<?php
/*========================================================================
© 2014 IVAO United States Division
ALL RIGHTS RESERVED. THE USAGE OF THIS SCRIPT IS NOT ALLOWED WITHOUT THE
CONSENSE OF DIVISIONAL HQ, EVENTS DEPARTMENT AND WEB DEPARTMENT.
==========================================================================
Objective: Contains the logout script.
   Author: Filipe Fonseca    18/08/2014
Revisions:
========================================================================*/
include("phpinc/func_general.php");

setcookie(cookie_name,false,time()-3600);

?>