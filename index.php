<?php
// include core configuration
include 'config/core.php';
 
// include database connection
//include 'config/database.php';

// action variable
$action = isset($_GET['action']) ? $_GET['action'] : "";

// page header
$page_title="Pricelist";
include_once "layout_head.php";
?>
<h2 class="pull-left">Please select an Action</h2>
<a href='create.php' class='btn btn-primary pull-right margin-bottom-1em'>
<span class='glyphicon glyphicon-plus'></span> Create Record
</a>
&nbsp;&nbsp;
<a href='read.php' class='btn btn-primary pull-right margin-bottom-1em'>
        <span class='glyphicon glyphicon-list'></span> Read Records
</a>

<?php
// include the read template
//include_once "read_template.php";

// page footer
include_once "layout_foot.php";
?>
