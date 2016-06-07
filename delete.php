<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'config/database.php';
 
	// delete query
	$query = "DELETE FROM products WHERE id = ?";
	$stmt = $con->prepare($query);
	$stmt->bindParam(1, $_POST['object_id']);
	
	if($stmt->execute()){
		// redirect to read records page and 
		// tell the user record was deleted
		echo "Record was deleted.";
	}else{
		echo "Unable to delete record.";
	}
}
?>