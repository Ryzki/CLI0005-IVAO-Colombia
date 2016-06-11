<div class="span4 steps">
<h4>Installing Steps</h4>
	<ol>
		<li>About this system</li>
		<li>Initial files</li>
		<li class="active">Database Configuration</li>
		<li>Data filling</li>
		<li>Navdata</li>
		<li>Initial configuration</li>
		<li>Ready to use!</li>
	</ol>
</div>

<div class="span7 text">
	<h3><img src="../images/divlogous-sm.png"> Database Configuration</h3>
	
	<p>Please, fill the SQL data needed below:</p>
	
	<form action="4" method="post">
	
	<table align="center" class="table" id="tabledata" style='width: 100%'>
		<tr>
			<th style='width: 25%'><center>Host</center></th>
			<td style='width: 85%'><input type="text" name="host" id="host" style="width: 90%;" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Port</center></th>
			<td style='width: 85%'><input type="text" name="port" id="port" style="width: 90%;"/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>RFE Database</center></th>
			<td style='width: 85%'><input type="text" name="rfedatabase" id="rfedatabase" style="width: 90%;" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Navdata Database</center></th>
			<td style='width: 85%'><input type="text" name="navdatabase" id="navdatabase" style="width: 90%;" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Database Login</center></th>
			<td style='width: 85%'><input type="text" name="login_db" id="login_db" style="width: 90%;" required/></td>
		</tr>
		<tr>
			<th style='width: 25%'><center>Database Password</center></th>
			<td style='width: 85%'><input type="text" name="pass_db" id="pass_db" style="width: 90%;" required/></td>
		</tr>
		
	</table>

	<button name="step3" class="btn btn-success">Proceed >></button></form>

</div>