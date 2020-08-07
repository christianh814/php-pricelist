<?php
// Define configfile path
$db_config_file = "/data/db.php";
//
if (file_exists($db_config_file)) {
	// include config file if we have found it
	require_once($db_config_file);
	$using_config_file = "yes";
} else {
	// If file isn't there, we'll assume you want env vars
	$host = getenv("MYSQL_SERVICE_HOST");
	$port = getenv("MYSQL_SERVICE_PORT");
	$db_name = getenv("MYSQL_DATABASE");
	$username = getenv("MYSQL_USER");
	$password = getenv("MYSQL_PASSWORD");
	$using_config_file = "no";
}

try {
	$sql = "CREATE TABLE IF NOT EXISTS `products` (
                `id` int(11) NOT NULL auto_increment,
                `name` varchar(32) NOT NULL,
                `description` text NOT NULL,
                `price` int(11) NOT NULL,
                `category_id` int(11) NOT NULL,
                `created` datetime NOT NULL,
                `modified` timestamp NOT NULL default CURRENT_TIMESTAMP,
                PRIMARY KEY  (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;
                            
                CREATE TABLE IF NOT EXISTS  `categories` (
                  `id` int(11) NOT NULL auto_increment,
                  `name` varchar(256) NOT NULL,
                  `created` datetime NOT NULL,
                  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP,
                  PRIMARY KEY  (`id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
                INSERT IGNORE INTO `categories` VALUES(1, 'Fashion', '2014-06-01 00:35:07', '2014-05-31 09:34:33');
                INSERT IGNORE INTO `categories` VALUES(2, 'Electronics', '2014-06-01 00:35:07', '2014-05-31 09:34:33');
                INSERT IGNORE INTO `categories` VALUES(3, 'Motors', '2014-06-01 00:35:07', '2014-05-31 09:34:54');
                INSERT IGNORE INTO `categories` VALUES(4, 'Miscellaneous', '2014-06-01 00:35:07', '2014-05-31 09:34:54');";
	$ndb = new PDO("mysql:host={$host};dbname={$db_name};port={$port}", $username, $password);
	$ndb->exec($sql) or die(print_r($ndb->errorInfo(), true));
}

// to handle connection error
catch(PDOException $exception){
	echo "DB Error: " . $exception->getMessage();
	http_response_code(500);
}
?>
