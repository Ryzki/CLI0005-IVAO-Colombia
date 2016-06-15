<?php
$success = true;
?>

<div class="span4 steps">
<h4>Installing Steps</h4>
	<ol>
		<li>About this system</li>
		<li class="active">Initial files</li>
		<li>Database Configuration</li>
		<li>Data filling</li>
		<li>Navdata</li>
		<li>Initial configuration</li>
		<li>Ready to use!</li>
	</ol>
</div>

<div class="span7 text">
	<h3><img src="../images/divlogous-sm.png"> Initial Files and Needed Modules</h3>
	<p>Checking for main files...</p>
	
	<ul>
		<li>Main SQL File: 
<?php
		if (file_exists("../sql/rfe.sql")) {
			echo '<span style="font-weight: bold; color: green;">YES</span>';
		} else {
			echo '<span style="font-weight: bold; color: red;">NO</span>';
			$success = false;
		}
?>	
		</li>
		<li>Main NavData Files: 
<?php
		if (file_exists("../sql/navdata1.sql") && file_exists("../sql/navdata2.sql") && file_exists("../sql/navdata3.sql") && file_exists("../sql/navdata4.sql") && file_exists("../sql/navdata5.sql") && file_exists("../sql/navdata6.sql") && file_exists("../sql/navdata7.sql") && file_exists("../sql/navdata8.sql") && file_exists("../sql/navdata9.sql")) {
			echo '<span style="font-weight: bold; color: green;">YES</span>';
		} else {
			echo '<span style="font-weight: bold; color: red;">NO</span>';
			$success = false;
		}
?>	
		</li>
	</ul>
	
	<p>Checking for main modules...</p>
	
	<ul>
		<li>PHP/GD: 
<?php
		if (extension_loaded('gd') && function_exists('gd_info')) {
			echo '<span style="font-weight: bold; color: green;">INSTALLED</span>';
		}
		else {
			echo '<span style="font-weight: bold; color: orange;">RECOMMENDED</span>';
		}
?>
		</li>
	</ul>
	
<?php
	if ($success) {
?>
	<form action="3" method="post"><button name="step3" class="btn btn-success">Proceed >></button></form>
<?php
	} else {
?>
	<p>Solve the issues above and try to run this installer again.</p>
<?php
	}
?>
</div>