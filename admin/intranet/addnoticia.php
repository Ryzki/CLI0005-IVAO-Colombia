
			$db = new mysqli($db_host , $db_username , $db_password , $db_database);
			$db->set_charset("utf8");
			if ($db->connect_errno > 0) {
				die('Unable to connect to database [' . $db->connect_error . ']');
			}
		

<script>