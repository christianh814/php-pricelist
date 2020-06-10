<?php
// include core configuration
include 'config/core.php';
 
// action variable
$action = isset($_GET['action']) ? $_GET['action'] : "";

// page header
$page_title="PHP Pricelist";
include_once "layout_head.php";

// to identify page for paging
$page_url="do500.php?";

// send back 500 code
http_response_code(500);

// include the read template
include_once "error_template.php";

// page footer
include_once "layout_foot.php";
?>
