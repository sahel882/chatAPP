<?php

session_start();

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

$conn = new mysqli("localhost", "root", "saheldesilva12345", "chat_ap", "3306");

if(empty($fname)){
    echo "Please Fill First Name";
}else if(empty($lname)){
    echo "Please Fill Last Name";
}else if(empty($email)){
    echo "Please Fill Email";
}else if(empty($password)){
    echo "Please Fill Password";
}else{

    $query1 = "SELECT * FROM `users` WHERE `email` = '".$email."'";
    $result1 = $conn->query($query1);

    if($result1->num_rows > 0){
        echo "Email Already Exist";
    }else{

        $encreypt_password = md5($password);

        $query2 = "INSERT INTO `users`(`fname`,`lname`,`email`,`password`) 
        VALUES ('".$fname."','".$lname."','".$email."','".$encreypt_password."');";

        $result2 = $conn->query($query2);
        
        echo 'success';
    }

}

?>