<?php
$name = $_POST['name'];
$order = $_POST['order'];
$size = $_POST['size'];
$address = $_POST['address'];
$email = $_POST['email'];
include('connect.php');
if(isset($_POST['formSubmit'])) {

    $query = "INSERT INTO orders VALUES (0, :name, :address, :email, :size, :order)";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'size' => $size,
            'order' => $order
        )
    );
    echo 'Thank You ' . $name . ' for ordering ' . $order .  ' We apperciate your help';
    echo '<br><a href="index.php">Return Home</a>';
}
    ?>