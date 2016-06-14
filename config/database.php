<?php
// used to connect to the database
$host = getenv("MYSQL_SERVICE_HOST");
$port = getenv("MYSQL_SERVICE_PORT");
$db_name = getenv("MYSQL_DATABASE");
$username = getenv("MYSQL_USER");
$password = getenv("MYSQL_PASSWORD");

try {
	$con = new PDO("mysql:host={$host};dbname={$db_name};port={$port}", $username, $password);
}

// to handle connection error
catch(PDOException $exception){
	echo "Connection error: " . $exception->getMessage();
}
?>
