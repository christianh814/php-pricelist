<?php 
// *************** <PAGING_SECTION> ***************
echo "<nav class='overflow-hidden'>";
	echo "<ul class='pagination pull-left margin-zero'>";

	// ***** for 'first' and 'previous' pages
	if($page>1){
		 
		// ********** show the previous page
		$prev_page = $page - 1;
		echo "<li>";
			echo "<a href='{$page_url}page={$prev_page}'>";
				echo "<span style='margin:0 .5em;'>&laquo;</span>";
			echo "</a>";
		echo "</li>";
	}
	 
	 
	// ********** show the number paging

	// find out total pages
	$total_pages = ceil($total_rows / $records_per_page);

	// range of num links to show
	$range = 1;

	// display links to 'range of pages' around 'current page'
	$initial_num = $page - $range;
	$condition_limit_num = ($page + $range)  + 1;

	for ($x=$initial_num; $x<$condition_limit_num; $x++) {
		 
		// be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
		if (($x > 0) && ($x <= $total_pages)) {
		 
			// current page
			if ($x == $page) {
				echo "<li class='active'>";
					echo "<a href='javascript::void();'>{$x}</a>";
				echo "</li>";
			} 
			 
			// not current page
			else {
				echo "<li>";
					echo " <a href='{$page_url}page={$x}'>{$x}</a> ";
				echo "</li>";
			}
		}
	}
	 
	 
	// ***** for 'next' and 'last' pages
	if($page<$total_pages){
		// ********** show the next page
		$next_page = $page + 1;
		
		echo "<li>";
			echo "<a href='{$page_url}page={$next_page}'>";
				echo "<span style='margin:0 .5em;'>&raquo;</span>";
			echo "</a>";
		echo "</li>";
	}
 
	echo "</ul>";

// ***** allow user to enter page number
?>
<form action="<?php echo $page_url; ?>" method='GET'>	
	<div class="input-group col-md-3 pull-right">
		<input type="hidden" name="s" value="<?php echo isset($search_term) ? $search_term : ""; ?>" />
		<input type="number" class="form-control" name="page" min='1' required placeholder='Type page number...' />
		<div class="input-group-btn">
			<button class="btn btn-primary" type="submit">Go</button>
		</div>
	</div>
</form>
<?php 

echo "</nav>";
// *************** </PAGING_SECTION> ***************
?>