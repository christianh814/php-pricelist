<?php 
// include core configuration
include 'config/core.php';
 
// include database connection
include 'config/database.php';

//select all data
$query = "SELECT p.id, p.name, p.description, p.price, p.category_id, c.name as category_name, p.created, p.modified 
			FROM products p 
				LEFT JOIN categories c 
					ON p.category_id=c.id 
			ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();

//this is how to get number of rows returned
$num = $stmt->rowCount();

$out = "ID,Name,Description,Price,Category ID,Category Name,Created,Modified\n";

if($num>0){
	//retrieve our table contents
	//fetch() is faster than fetchAll()
	//http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		//extract row
		//this will make $row['firstname'] to
		//just $firstname only
		extract($row);
		$out.="{$id},\"{$name}\",\"{$description}\",{$price},{$category_id},{$category_name},{$created},{$modified}\n";
	}
}

header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=all_products_" . date('Y-m-d_H-i-s') . ".csv");
echo $out;
?>