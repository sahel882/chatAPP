<?php
session_start();
$conn = new mysqli("localhost", "root", "saheldesilva12345", "chat_ap", "3306");

if(!isset($_SESSION['user']) || !isset($_GET['id'])){
    echo "Unauthorized access";
}

$email = $_SESSION['user']['email'];
$reciver_id = $_GET['id'];

$query1 = "SELECT `id` FROM `users` WHERE `email` = '".$email."'";
$result = $conn->query($query1);

if($result->num_rows > 0){
    $user = $result->fetch_assoc();
    $user_id = $user['id'];

    $query2 = "SELECT * FROM `messages` WHERE 
    (`sender_id` = '".$user['id']."' AND `reciver_id` = '".$reciver_id."') 
    OR 
    (`sender_id` = '".$reciver_id."' AND `reciver_id` = '".$user['id']."') 
    ORDER BY `date_time` ASC";

    $result2 = $conn->query($query2);

    if ($result2->num_rows > 0) {
        while ($message = $result2->fetch_assoc()) {
            if ($message['sender_id'] == $user_id) {
                echo '<div class="d-flex flex-column align-items-end">';
                echo '<div class="bg-dark text-white p-2 mb-2 shadow-sm rounded" style="max-width: 60%">';
                echo '<small>' . $message['message'] . '</small>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="d-flex flex-column align-items-start">';
                echo '<div class="bg-light text-dark p-2 mb-2 shadow-sm rounded" style="max-width: 60%">';
                echo '<small>' . $message['message'] . '</small>';
                echo '</div>';
                echo '</div>';
            }
        }
    }     else {
        echo '<p class="text-muted text-center">No messages yet. Start conversation!</p>';
    }

} else {
    echo "User Not Found";
}

?>

