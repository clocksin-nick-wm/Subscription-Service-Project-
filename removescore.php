<?php
require_once('authenticate.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Eagle Ink Remove</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h2>Remove Subscription Eagle Ink</h2>
​
<?php
require_once('appvars.php');
require_once('connect.php');
print_r($_POST);
print_r($_GET);
if (isset($_GET['id']) && isset($_GET['address']) && isset($_GET['name']) && isset($_GET['school']) && isset($_GET['email'])) {
    // Grab the score data from the GET
    $id = $_GET['id'];
    $email = $_GET['email'];
    $name = $_GET['name'];
    $address = $_GET['address'];
    $school = $_GET['school'];
}
else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['school'])) {
    // Grab the score data from the POST
    $id = $_POST['id'];
    $name = $_POST['name'];
    $school = $_POST['school'];
    $email = $_POST['email'];
    $address = $_POST['address'];
}
else {
    echo '<p class="error">Sorry, no high score was specified for removal.</p>';
}

if (isset($_POST['submit'])) {
    if ($_POST['confirm'] == 'Yes') {


        $dbh = new PDO('mysql:host=localhost;dbname=eagleink', 'root', 'root');

        // Delete the score data from the database
        $query = "DELETE FROM subscription WHERE id = :id LIMIT 1";

        $stmt = $dbh->prepare($query);
        $stmt->execute(
            array (
                'id' => $id
            )
        );

        // Confirm success with the user
        echo '<p>The subscription of' . $name . ' was successfully removed.';
    }
    else {
        echo '<p class="error">The high score was not removed.</p>';
    }
}
else if (isset($id) && isset($name) && isset($address) && isset($email) && isset($school)) {
    echo '<p>Are you sure you want to delete the following high score?</p>';
    echo '<p><strong>Name: </strong>' . $name . '<br /><strong>Date: </strong>' . $school .
        '<br /><strong>Score: </strong>' . $email . '</p>';
    echo '<form method="post" action="removescore.php">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="Submit" name="submit" />';
    echo '<input type="hidden" name="id" value="' . $id . '" />';
    echo '<input type="hidden" name="name" value="' . $name . '" />';
    echo '<input type="hidden" name="address" value="' . $address . '" />';
    echo '<input type="hidden" name="email" value="' .$email . '"/>';
    echo '<input type="hidden" name="school" value="' .$school . '"/>';
    echo '</form>';
}

echo '<p><a href="admin.php">&lt;&lt; Back to admin page</a></p>';
?>
​
</body>
</html>