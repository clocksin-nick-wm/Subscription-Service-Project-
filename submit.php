<?php
include('connect.php');
if (isset($_POST['submit'])) {
// Grab the score data from the POST
$name = $_POST['name'];
$product = $_POST['product'];
$screenshot = $_FILES['screenshot']['name'];
$screenshot_size = $_FILES['screenshot']['size'];
$screenshot_type = $_FILES['screenshot']['type'];

if (!empty($name) && !empty($product) && !empty($screenshot)) {
if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png')) &&
($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
if ($_FILES['file']['error'] == 0) {

$target = GW_UPLOADPATH . $screenshot;

if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
$name = $_POST['name'];
$product = $_POST['product'];

if (!empty($name) && !empty($product)) {
// Connect to the database
$dbh = new PDO('mysql:host=localhost;dbname=gwdb', 'root', 'root');

// Write the data to the database
$query = "INSERT INTO product_ideas VALUES ( 0, NOW(), :name, :product, :screenshot)";

$stmt = $dbh->prepare($query);
$result = $stmt->execute(
array(
'name' => $name,
'product' => $product,
'screenshot' => $screenshot
)
);

// Confirm success with the user
echo '<p>Thanks for adding your new high score!</p>';
echo '<p><strong>Name:</strong> ' . $name . '<br />';
    echo '<strong>Score:</strong> ' . $score . '</p>';
echo '<img src="' . GW_UPLOADPATH . $screenshot . '" alt="Score image" /></p>';
echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';

// Clear the score data to clear the form
$name = "";
$product = "";

}
else {
echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
}
}
}
else {
echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no ' .
    'greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
}
// Try to delete the temporary screen shot image file
@unlink($_FILES['screenshot']['tmp_name']);
}
else {
echo '<p class="error">Please enter all of the information to add your product concept.</p>';
}
}
}
?>