<?php
include('connect.php');
if(isset($_POST['formSubmit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $school = $_POST['school'];
    $query = "INSERT INTO subscription VALUES (0, :name, :address, :email, :school)";
    $stmt = $dbh->prepare($query);
    $result = $stmt->execute(
        array(
            'name' => $name,
            'address' => $address,
            'email' => $email,
            'school' => $school
        )
    );
    echo "There is a new emil in your inbox";
    $to = $email;
    $subject = "You are now Subscribed";
    $from = "eagleink@yahoo.com";
    $msg = "Thank you $name for subscribing to Eagle Ink. We will emaail you weekly news on trending designs and ideas from the Moe classroom.";
    mail($to, $subject, $msg, 'From:' . $from);
}
?>