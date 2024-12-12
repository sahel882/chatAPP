<?php

session_start();

if(isset($_SESSION['user'])){

    $conn = new mysqli("localhost", "root", "saheldesilva12345", "chat_ap", "3306");

    if($conn->connect_error){
        echo "Database Connection failed";
        exit;
    }

    $userId = $_SESSION['user']['id'];

    $query1 = "UPDATE `users` SET `status` = 'INACTIVE' WHERE `id` = '".$userId."'";
    $result1 = $conn->query($query1);

    if($result1){
        session_destroy();
        echo 'success';
    }else{
        echo 'fail';
    }
        
        
}else{
    echo "User is not Logged In";
}

?>