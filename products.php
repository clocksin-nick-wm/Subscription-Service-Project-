<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue-yellow.min.css" />
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" type="text/css" href="productstyle.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<?php
include('nav.php');
include ('appvars.php');
$dbh = new PDO('mysql:host=localhost;dbname=eagleink', 'root', 'root');
$query = "SELECT id, product, product_img, price FROM products ORDER BY id ASC";
$stmt = $dbh->prepare($query);
$stmt -> execute();
$results = $stmt->fetchAll();
echo '<h1 style="text-align: center">Products</h1>';
echo '<table>';
foreach($results as $row) {
    if (is_file(MM_UPLOADPATH . $row['product_img']) && filesize(MM_UPLOADPATH . $row['product_img']) > 0) {
        echo '<tr><td><img src="' . MM_UPLOADPATH . $row['product_img'] . '" alt="' . $row['product'] . $row['price'] .'" /></td>';
    }
    echo '<td>'. $row['product'] . $row['price'] .'</td></tr>';
}
echo '</table>';
?>
</body>
</html>