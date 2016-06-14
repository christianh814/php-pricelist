<?php
// used to connect to the database
$host = getenv("MYSQL_SERVICE_HOST");
$port = getenv("MYSQL_SERVICE_PORT");
$db_name = getenv("MYSQL_DATABASE");
$username = getenv("MYSQL_USER");
$password = getenv("MYSQL_PASSWORD");

try {
	$con = new PDO("mysql:host={$host};dbname={$db_name};port={$port}", $username, $password);

	// set the PDO error mode to exception
    	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// sql to create the the tables
	$pricelist_sql = " CREATE TABLE IF NOT EXISTS `products` (
  	`id` int(11) NOT NULL auto_increment,
  	`name` varchar(32) NOT NULL,
  	`description` text NOT NULL,
  	`price` int(11) NOT NULL,
  	`category_id` int(11) NOT NULL,
  	`created` datetime NOT NULL,
  	`modified` timestamp NOT NULL default CURRENT_TIMESTAMP,
  	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;
	INSERT INTO `products` VALUES(1, 'LG P880 4X HD', 'My first awesome phone!', 336, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
	INSERT INTO `products` VALUES(2, 'Google Nexus 4', 'The most awesome phone of 2013!', 299, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
	INSERT INTO `products` VALUES(3, 'Samsung Galaxy S4', 'How about no?', 600, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
	INSERT INTO `products` VALUES(6, 'Bench Shirt', 'The best shirt!', 29, 1, '2014-06-01 01:12:26', '2014-05-31 10:12:21');
	INSERT INTO `products` VALUES(7, 'Lenovo Laptop', 'My business partner.', 399, 2, '2014-06-01 01:13:45', '2014-05-31 10:13:39');
	INSERT INTO `products` VALUES(8, 'Samsung Galaxy Tab 10.1', 'Good tablet.', 259, 2, '2014-06-01 01:14:13', '2014-05-31 10:14:08');
	INSERT INTO `products` VALUES(9, 'Spalding Watch', 'My sports watch.', 199, 1, '2014-06-01 01:18:36', '2014-05-31 10:18:31');
	INSERT INTO `products` VALUES(10, 'Sony Smart Watch', 'The coolest smart watch!', 300, 2, '2014-06-06 17:10:01', '2014-06-06 02:09:51');
	INSERT INTO `products` VALUES(11, 'Huawei Y300', 'For testing purposes.', 100, 2, '2014-06-06 17:11:04', '2014-06-06 02:10:54');
	INSERT INTO `products` VALUES(12, 'Abercrombie Lake Arnold Shirt', 'Perfect as gift!', 60, 1, '2014-06-06 17:12:21', '2014-06-06 02:12:11');
	INSERT INTO `products` VALUES(13, 'Abercrombie Allen Brook Shirt', 'Cool red shirt!', 70, 1, '2014-06-06 17:12:59', '2014-06-06 02:12:49');
	CREATE TABLE IF NOT EXISTS `categories` (
  	`id` int(11) NOT NULL auto_increment,
  	`name` varchar(256) NOT NULL,
  	`created` datetime NOT NULL,
  	`modified` timestamp NOT NULL default CURRENT_TIMESTAMP,
  	PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
	INSERT INTO `categories` VALUES(1, 'Fashion', '2014-06-01 00:35:07', '2014-05-31 09:34:33');
	INSERT INTO `categories` VALUES(2, 'Electronics', '2014-06-01 00:35:07', '2014-05-31 09:34:33');
	INSERT INTO `categories` VALUES(3, 'Motors', '2014-06-01 00:35:07', '2014-05-31 09:34:54');
	INSERT INTO `categories` VALUES(4, 'Miscellaneous', '2014-06-01 00:35:07', '2014-05-31 09:34:54');
	";
}

// to handle connection error
catch(PDOException $exception){
	echo "Connection error: " . $exception->getMessage();
}
?>
