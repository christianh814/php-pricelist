	</div>
	<!-- /container -->

<!-- jQuery library -->
<script src="libs/js/jquery.js"></script>

<!-- bootstrap JavaScript -->
<script src="libs/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="libs/js/bootstrap/docs-assets/js/holder.js"></script>

<script type='text/javascript'>
$(document).ready(function() {
	//check/uncheck script
	$(document).on('click', '#checker', function(){
		$('.checkboxes').prop('checked', $(this).is(':checked'));
	});
		
	// delete selfie record
	$(document).on('click', '.delete-object', function(){
	 
		var id = $(this).attr('delete-id');
		var q = confirm("Are you sure?");
	 
		if (q == true){
	 
			$.post('delete.php', {
				object_id: id
			}, function(data){
				location.reload();
			}).fail(function() {
				alert('Unable to delete.');
			});
	 
		}
		return false;
	});

	// delete selected records	
	$(document).on('click', '#delete-selected', function(){

		var at_least_one_was_checked = $('.checkboxes:checked').length > 0;
			
		if(at_least_one_was_checked){
		
			var answer = confirm('Are you sure?');
			if ( answer ){
				//if user clicked ok, pass the id to delete.php and execute the delete query
				// window.location = 'delete.php?id=' + id;
				
					//get converts it to an array
					var del_checkboxes = $('.checkboxes:checked').map(function(i,n) {
						return $(n).val();
					}).get();

					if(del_checkboxes.length==0) {
						del_checkboxes = "none"; 
					}  
					
					$.post("delete_selected.php", {'del_checkboxes[]': del_checkboxes}, 
						function(response) {
						
						// tell the user
						alert(response);
						
						// refresh
						location.reload();
					});

			}
		}
		
		else{
			alert('Please select at least one record to delete.');
		}
	});
});
</script>
<a href='index.php' class='btn btn-info pull-right margin-bottom-1em margin-right-1em'> <span class='glyphicon glyphicon-download'></span>Home</a>
</body>
</html>
