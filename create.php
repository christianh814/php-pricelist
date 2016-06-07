<?php
// include configuration file
include 'config/core.php';

// include database connection
include 'config/database.php';

// page header
$page_title="Create a Record";
include_once "layout_head.php";

// if the form was submitted
if($_POST){

	try{

		// insert query
		$query = "INSERT INTO products SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created";

		// prepare query for execution
		$stmt = $con->prepare($query);

		// sanitize
		$name=htmlspecialchars(strip_tags($_POST['name']));
		$description=htmlspecialchars(strip_tags($_POST['description']));
		$price=htmlspecialchars(strip_tags($_POST['price']));
		$category_id=htmlspecialchars(strip_tags($_POST['category_id']));

		// bind the parameters
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':category_id', $category_id);

		// we need the created variable to know when the record was created
		// also, to comply with strict standards: only variables should be passed by reference
		$created=date('Y-m-d H:i:s');
		$stmt->bindParam(':created', $created);

		// Execute the query
		if($stmt->execute()){
			echo "<div class='alert alert-success'>";
				echo "Record was saved.";
			echo "</div>";
		}else{
			echo "<div class='alert alert-success'>";
				echo "Unable to save record. Please try again.";
			echo "</div>";
		}

	}

	// show error if any
	catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
}

?>

<a href='read.php' class='btn btn-primary pull-right margin-bottom-1em'>
	<span class='glyphicon glyphicon-list'></span> Read Records
</a>

<!--we have our html form here where user information will be entered-->
<form action='create.php' method='post'>
    <table class='table table-bordered table-hover'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' required /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea type='text' name='description' class='form-control' required></textarea></td>
        </tr>
        <tr>
            <td>Price (&#36;)</td>
            <td>
				<!-- step="0.01" was used so that it can accept number with two decimal places -->
				<input type='number' step="0.01" name='price' class='form-control' required />
			</td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
			<?php
			// read the categories from the database

			// select all categories
			$query = "SELECT id, name FROM categories ORDER BY name";

			// prepare query statement and execute
			$stmt = $con->prepare( $query );
			$stmt->execute();

			// put them in a select drop-down
			echo "<select class='form-control' name='category_id'>";
				echo "<option>Select category...</option>";

				// loop through the caregories
				while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
					extract($row_category);
					echo "<option value='{$id}'>{$name}</option>";
				}

			echo "</select>";
			?>
			</td>
		</tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
            </td>
        </tr>
    </table>
</form>

<?php
// page footer
include_once "layout_foot.php";
?>
