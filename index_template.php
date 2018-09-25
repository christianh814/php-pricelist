<?php 
echo "<div class='overflow-hidden'>";
	?>
	<form role="search" action='search.php'>
		<div class="input-group col-md-3 pull-left">
			<input type="text" class="form-control" placeholder="Type a name..." name="s" id="srch-term" required <?php echo isset($search_term) ? "value='$search_term'" : ""; ?> />
			<div class="input-group-btn">
				<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
			</div>
		</div>
	</form>
	<?php 
	echo "<a href='create.php' class='btn btn-primary pull-right margin-bottom-1em'>";
		echo "<span class='glyphicon glyphicon-plus'></span> Create Record";
	echo "</a>";
	
	echo "<a href='export_csv.php' class='btn btn-info pull-right margin-bottom-1em margin-right-1em'>";
		echo "<span class='glyphicon glyphicon-download'></span> Export CSV";
	echo "</a>";
	
	echo "<a href='read.php' class='btn btn-primary pull-right margin-bottom-1em margin-right-1em'>";
		echo "<span class='glyphicon glyphicon-list'></span> Read Records";
	echo "</a>";
	
echo "</div>";

//check if more than 0 record found
if($num>0){

    echo "<table class='table table-bordered table-hover'>";//start table
    
        //creating our table heading
        echo "<tr>";
			echo "<th class='text-align-center'><input type='checkbox' id='checker' /></th>";
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th>Price</th>";
			echo "<th>Category</th>";
			echo "<th>Action</th>";
        echo "</tr>";
        
        // retrieve our table contents
		// fetch() is faster than fetchAll()
		// http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['firstname'] to
            // just $firstname only
            extract($row);
            
            //creating new table row per record
            echo "<tr>";
				echo "<td class='text-align-center'><input type='checkbox' name='item[]' class='checkboxes' value='{$id}' /></td>";
                echo "<td>{$name}</td>";
                echo "<td>{$description}</td>";
                echo "<td>&#36;" . number_format($price, 2) . "</td>";
				echo "<td>{$category_name}</td>";
				echo "<td>";
					
					// update record
					echo "<a href='update.php?id={$id}' class='btn btn-info margin-right-1em'>";
						echo "<span class='glyphicon glyphicon-edit'></span> Edit";
					echo "</a>";
					
					// delete record
					echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
						echo "<span class='glyphicon glyphicon-remove'></span> Delete";
					echo "</a>";

				echo "</td>";
            echo "</tr>";
        }
	
	//end table
    echo "</table>";
    
	// needed for paging
	if($page_url=="read.php?"){
		$query = "SELECT COUNT(*) as total_rows FROM products";
		$stmt = $con->prepare($query);
	}

	// it is the search page
	else if($page_url=="search.php?s={$search_term}&"){
		
		$query = "SELECT COUNT(*) as total_rows 
					FROM products 
					WHERE name LIKE :name OR description LIKE :description";
					
		$stmt = $con->prepare($query);

		$search_term_for_query = "%{$search_term}%";
		$stmt->bindParam(':name', $search_term_for_query);
		$stmt->bindParam(':description', $search_term_for_query);

	}
	
	$stmt->execute();
	
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$total_rows = $row['total_rows'];
	
	// paginate records
	include_once "paging.php";
}

//if no records found
else{
	echo "<div class='alert alert-danger'>";
		echo "No records found.";
	echo "</div>";
}
?>
