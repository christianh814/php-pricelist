<?php
// include core configuration
include 'config/core.php';
 
// Comment out database for testing
///include 'config/database.php';

// action variable
$action = isset($_GET['action']) ? $_GET['action'] : "";

// page header
$page_title="PHP Pricelist";
include_once "layout_head.php";

// if it was redirected from delete.php
if($action=='deleted'){
	echo "<div class='alert alert-info'>Record was deleted.</div>";
}

// to identify page for paging
$page_url="index.php?";

// include the read template
include_once "read_template.php";

// page footer
include_once "layout_foot.php";
?>
