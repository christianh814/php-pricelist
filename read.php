<!DOCTYPE HTML>
<html>
    <head>
        <title>PDO Read Records - code from codeofaninja.com</title>
  
    </head>
<body>
 
<!-- dynamic content will be here -->
<!-- just a header label -->
<h1>PDO: Read Records</h1>
 
<?php
// include database connection
include 'config/database.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div>Record was deleted.</div>";
}
 
// select all data
$query = "SELECT id, name, description, price FROM products";
$stmt = $con->prepare($query);
$stmt->execute();
 
// this is how to get number of rows returned
$num = $stmt->rowCount();
 
// link to create record form
echo "<div>";
    echo "<a href='create.php'>Create New Record</a>";
echo "</div>";
 
//check if more than 0 record found
if($num>0){
 
    echo "<table>";//start table
     
        //creating our table heading
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Description</th>";
            echo "<th>Price</th>";
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
             
            // creating new table row per record
            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$description}</td>";
                echo "<td>&#36;{$price}</td>";
                echo "<td>";
                    // we will use this links on next part of this post
                    echo "<a href='update.php?id={$id}'>Edit</a>";
                    echo " / ";
                    // we will use this links on next part of this post
                    echo "<a href='#' onclick='delete_user({$id});'>Delete</a>";
                echo "</td>";
            echo "</tr>";
        }
     
    // end table
    echo "</table>";
     
}
 
// if no records found
else{
    echo "<div>No records found.</div>";
}
?>

<script type='text/javascript'>
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?id=' + id;
    } 
}
</script>
 
</body>
</html>
