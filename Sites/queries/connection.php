<?php
	try {
		$db_name = "grupo23e2";
		$user = "grupo23";
		$password = "RinkuFry";
		$db = new PDO("pgsql:dbname=$db_name;host=localhost;port=5432;user=$user;password=$password");
	} catch (Exception $e) {
		echo "No se pudo conectar a la db: $e";
	}
?>
