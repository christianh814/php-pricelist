<?php
// include configuration file
include 'config/core.php';

// include database connection
include 'config/database.php';

// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

// page header
$page_title="Update a Record";
include_once "layout_head.php";

// check if form was submitted
if($_POST){

	try{

		//write query
		//in this case, it seemed like we have so many fields to pass and
		//its kinda better if we'll label them and not use question marks
		//like what we used here
		$query = "UPDATE products SET name=:name, description=:description, price=:price, category_id=:category_id WHERE id=:id";

		//prepare query for excecution
		$stmt = $con->prepare($query);

		// sanitize
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $price=htmlspecialchars(strip_tags($_POST['price']));
		$category_id=htmlspecialchars(strip_tags($_POST['category_id']));
        $id=htmlspecialchars(strip_tags($_POST['id']));

		// bind the parameters
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':category_id', $category_id);
		$stmt->bindParam(':id', $id);

		// Execute the query
		if($stmt->execute()){
			echo "<div class='alert alert-success'>";
				echo "Record was updated.";
			echo "</div>";
		}else{
			echo "<div class='alert alert-danger'>";
				echo 'Unable to update record. Please try again.';
			echo "</div>";
		}

	}

	// show errors, if any
	catch(PDOException $exception){
		die('ERROR: ' . $exception->getMessage());
	}
}

// read current record's data
try {

	// prepare 'select' query
	$query = "SELECT id, name, description, price, category_id FROM products WHERE id=? limit 0,1";
	$stmt = $con->prepare( $query );

	// this is the first question mark
	$stmt->bindParam(1, $id);

	// execute our query
	$stmt->execute();

	// store retrieved row to a variable
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	// values to fill up our form
	$name = $row['name'];
	$description = $row['description'];
	$price = $row['price'];
	$category_id = $row['category_id'];
}

// show error
catch(PDOException $exception){
	die('ERROR: ' . $exception->getMessage());
}


?>
<!-- to go back to records list -->
<a href='read.php' class='btn btn-primary pull-right margin-bottom-1em'>
	<span class='glyphicon glyphicon-list'></span> Read Records
</a>

<!--we have our html form here where new user information will be entered-->
<form action='update.php?id=<?php echo htmlspecialchars($id); ?>' method='post' border='0'>
    <table class='table table-bordered table-hover'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>' class='form-control' required /></td>
        </tr>
        <tr>
            <td>Description</td>
            <td>
			<textarea type='text' name='description' class='form-control' required ><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea>
			</td>
        </tr>
        <tr>
            <td>Price (&#36;)</td>
            <td>
				<!-- step="0.01" was used so that it can accept number with two decimal places -->
				<input type='number' step="0.01" name='price' value='<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>' class='form-control' required />
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

					// auto select category of this record
					echo $id==$category_id ? "<option value='{$id}' selected>" : "<option value='{$id}'>";
						echo "{$name}";
					echo "</option>";
				}

			echo "</select>";
			?>
			</td>
		</tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
            </td>
        </tr>
    </table>
</form>

<?php
// page footer
include_once "layout_foot.php";
?>
