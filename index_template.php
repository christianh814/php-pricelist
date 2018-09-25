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
	echo "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eu elit viverra, consequat dui eget, rhoncus nisl. Maecenas posuere a enim a dignissim. Aliquam maximus metus imperdiet, imperdiet erat quis, cursus nulla. Mauris nisi tortor, ultrices vel condimentum tempor, facilisis sed nibh. Vestibulum ornare elit diam. Nulla facilisi. Mauris sed scelerisque elit. Vivamus cursus lacus nec auctor laoreet. Nam nisl ipsum, condimentum sit amet diam vitae, ornare consectetur erat. Nunc ex nibh, lobortis quis tellus quis, bibendum ultrices sem.";

	echo "";
	echo "Fusce sodales, enim a consequat dictum, risus massa convallis lacus, ac dictum mauris erat eu ante. In ultrices, augue et convallis cursus, tortor leo scelerisque velit, a mollis purus magna vel felis. Etiam dolor diam, hendrerit nec neque vel, mollis maximus ipsum. Cras convallis mauris ullamcorper nisl sagittis ornare. Suspendisse sit amet suscipit risus. Pellentesque fermentum fermentum egestas. Aenean aliquet in turpis at tincidunt. Nunc vehicula, elit et gravida tempor, felis magna suscipit mauris, sed blandit felis arcu sit amet elit. Aenean ac vehicula massa. Vestibulum rhoncus lacus diam, quis rhoncus nibh sagittis et. Morbi non nibh condimentum, ultricies nisi vitae, feugiat odio. Fusce vestibulum turpis velit, non pulvinar dolor lacinia a. In in sodales nulla. Suspendisse ac tortor erat. Curabitur a urna in justo scelerisque vehicula mollis euismod sem.";
echo "</div>";
?>
