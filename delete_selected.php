<?php
// check if value was posted
if($_POST){
 
	$ins="";
	foreach($_POST['del_checkboxes'] as $id){
		$ins.="{$id},";
	}

	$ins=trim($ins, ",");

    // include database and object file
    include_once 'config/database.php';
 
	// query to delete multiple records
	$query = "DELETE FROM products WHERE id IN ({$ins})";
	 
	$stmt = $con->prepare($query);
 
	if($stmt->execute()){
		echo "Records were deleted.";
	}else{
		echo "Unable to delete records.";
	}
}
?>