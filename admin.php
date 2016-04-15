<?php
require_once('authenticate.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Eagle Ink Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue-yellow.min.css" />
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
</head>
<style>
    table {
        border: double;
    }
    table > tr > th {
        border: double;
    }
</style>
<body>
<h2>Eagle Ink Subscribers</h2>
<p>Below is a list of all Eagle Ink Subscribers. Use this page to remove users as needed.</p>
<hr />
<?php
include('connect.php');

$query = "SELECT * FROM subscription ORDER BY id DESC";
$stmt = $dbh->prepare($query);
$stmt ->execute();
$users = $stmt->fetchAll();
echo '<table class="mdl-data-table mdl-js-data-table">';
echo '<tr><th>Name</th><th>Email</th><th>Address</th><th>School</th><th>Remove User</th></tr>';
foreach($users as $row){
    echo '<tr class="scorerow"><td>' . $row['name'] . '</td>';
    echo '<td>' . $row['email'] . '</td>';
    echo '<td>' . $row['address'] . '</td>';
    echo '<td>' . $row['school'] . '</td>';
    echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;address=' . $row['address'] .
        '&amp;name=' . $row['name'] . '&amp;email=' . $row['email'] .
        '&amp;address=' . $row['address'] . '&amp;school=' . $row['school'] .'">Remove</a></td>';

}
echo '</table>'
?>
<h2>Eagle Ink Product Submissions</h2>
<hr />
<?php

$querys = "SELECT FROM product_ideas ORDER BY id DESC";
$stmt = $dbh -> prepare($querys);
$stmt ->execute();
$ideas = $stmt -> fetchAll();
echo'<table>';
echo'<tr><th>Product Name</th><th>Product Image</th><th>Remove</th><th>Approve</th>';
foreach($ideas as $rows){
    echo'<tr><td>'. $rows['product'] .'</td>';
    echo '<td>'. $rows['name'] .'</td></tr>';

    print_r($rowse);
}
echo '</table>';

?>
</body>
</html>
