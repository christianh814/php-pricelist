<?php
// show error reporting
// ** ini_set('display_errors', 1);
// ** ini_set('display_startup_errors', 1);
// ** error_reporting(E_ALL);

// set your default time-zone
//** date_default_timezone_set('America/Los_Angeles');

// page is the current page, if there's nothing set, default is page 1
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set records or rows of data per page
$records_per_page = 10;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>
