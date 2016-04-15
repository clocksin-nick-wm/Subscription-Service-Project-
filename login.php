<?php
include_once('appvars.php');
include_once('connect.php');
$name = $_POST['name'];
$product = $_POST['product'];
$screenshot = $_FILES['screenshot']['name'];
$screenshot_size = $_FILES['screenshot']['size'];
$screenshot_type = $_FILES['screenshot']['type'];
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if (!empty($name) && !empty($score) && !empty($screenshot)) {
if ((($screenshot_type == 'image/gif') || ($screenshot_type == 'image/jpeg') || ($screenshot_type == 'image/pjpeg') || ($screenshot_type == 'image/png')) &&
($screenshot_size > 0) && ($screenshot_size <= GW_MAXFILESIZE)) {
if ($_FILES['file']['error'] == 0) {

    $target = GW_UPLOADPATH . $screenshot;

    if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {
        if (!empty($product) && !empty($name)) {
            $query = "INSERT INTO products VALUES (0, :name, :product, :product_img)";
            $stmt = $dbh->prepare($query);
            $test = $stmt->execute(
                array(
                    'product' => $product,
                    'product_img' => $screenshot,
                    'name' => $name
                )

            );


            var_dump($test);
            echo '<p>Thank you ' . $name . ' for submitting ' . $product . '</p>';
            echo '<p> Submit more content to be featured on our products page.</p>';// Clear the score data to clear the form
            $name = "";
            $product = "";

        } else {
            echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
        }
    } else {
        echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no ' .
            'greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
    }
}
    // Try to delete the temporary screen shot image file
    @unlink($_FILES['screenshot']['tmp_name']);
}
else {
    echo '<p class="error">Please enter all of the information to add your high score.</p>';
}
}
 ?>