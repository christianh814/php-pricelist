<?php 
// include core configuration
include 'config/core.php';

// include database connection
include 'config/database.php';

// search term variable
$search_term = isset($_GET['s']) ? htmlspecialchars(strip_tags($_GET['s'])) : "";

// page header
$page_title="Search \"{$search_term}\"";
include_once "layout_head.php";

//select all data
$query = "SELECT p.id, p.name, p.description, p.price, c.name as category_name 
			FROM products p 
				LEFT JOIN categories c 
					ON p.category_id=c.id 
			WHERE p.name LIKE :name OR p.description LIKE :description 
			ORDER BY id DESC 
			LIMIT :from_record_num, :records_per_page";
	
$stmt = $con->prepare($query);

$search_term_for_query = "%{$search_term}%";
$stmt->bindParam(':name', $search_term_for_query);
$stmt->bindParam(':description', $search_term_for_query);
$stmt->bindParam(":from_record_num", $from_record_num, PDO::PARAM_INT);
$stmt->bindParam(":records_per_page", $records_per_page, PDO::PARAM_INT);

$stmt->execute();

// this is how to get number of rows returned
$num = $stmt->rowCount();

// to identify page for paging
$page_url="search.php?s={$search_term}&";

// include the read template
include_once "read_template.php";

// page footer
include_once "layout_foot.php";
?>