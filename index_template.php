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

// Body of Index Page
echo "<div class='well well-lg'>";
	echo "Testing WELLNESS hhaha";
echo "</div>";
?>
