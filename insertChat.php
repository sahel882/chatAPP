<?php

session_start();
$conn = new mysqli("localhost", "root", "saheldesilva12345", "chat_ap", "3306");
if(!isset($_SESSION['user'])){
    header('location: index.php');
}
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $msg = $_POST['msg'];
    $reciver_id = $_POST['reciver_id'];
    $sender_id = $_SESSION['user']['id'];

    date_default_timezone_set("Asia/Colombo");
    $current_time = date("Y-m-d H:i:s");

    $query = "INSERT INTO `messages` (`sender_id`, `reciver_id`, `message`, `date_time`)
    VALUES('".$sender_id."', '".$reciver_id."', '".$msg."', '".$current_time."')";

    if($conn->query($query)){
        echo 'success';
    }else{
        echo 'failed to send. please try again';
    }

}else{
    header("location: users.php");
}

?>