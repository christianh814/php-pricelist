<?php
// include core configuration
include 'config/core.php';
 
// include database connection
include 'config/database.php';

// action variable
$action = isset($_GET['action']) ? $_GET['action'] : "";

// page header
$page_title="Read Records";
include_once "layout_head.php";

// if it was redirected from delete.php
if($action=='deleted'){
	echo "<div class='alert alert-info'>Record was deleted.</div>";
}

//select all data
$query = "SELECT p.id, p.name, p.description, p.price, c.name as category_name 
			FROM products p 
				LEFT JOIN categories c 
					ON p.category_id=c.id 
			ORDER BY id DESC
			LIMIT :from_record_num, :records_per_page";

$stmt = $con->prepare($query);
$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);
$stmt->execute();

//this is how to get number of rows returned
$num = $stmt->rowCount();

// to identify page for paging
$page_url="read.php?";

// include the read template
include_once "read_template.php";

// page footer
include_once "layout_foot.php";
?>