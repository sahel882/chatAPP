<?php

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email)) {
    echo "Please Fill Email.";
} else if (empty($password)) {
    echo "Please Fill Password.";
}

$conn = new mysqli("localhost", "root", "saheldesilva12345", "chat_ap", "3306");

if ($conn->connect_error) {
    echo ("Connection failed:" . $conn->connect_error);
}

$query1 = "SELECT * FROM `users` WHERE `email` = '" . $email . "'";
$result1 = $conn->query($query1);

if ($result1->num_rows > 0) {

    $row = $result1->fetch_assoc();

    $verify_password = md5($password);

    if ($verify_password == $row['password']) {

        $_SESSION['user'] = $row;

        $query2 = "UPDATE `users` SET `status` = 'ACTIVE' WHERE `id` = '".$row['id']."'";
        $result2 = $conn->query($query2);

        echo "success";

    } else {
        echo "   Password Incorrect";
    }
} else {
    echo "   Account not found for this email";
}

?>