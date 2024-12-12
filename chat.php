<?php

session_start();
$conn = new mysqli("localhost", "root", "saheldesilva12345", "chat_ap", "3306");

if(!isset($_SESSION['user'])){
header("Location: index.php");
exit;
} else{         
    $email = $_SESSION['user']['email'];    
    // fetch user data

    $query1 = "SELECT * FROM `users` WHERE `email` = '".$email."'";
    $result1 = $conn->query($query1);                 
    $row1 = $result1->fetch_assoc();

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query2 = "SELECT * FROM `messages` WHERE (`sender_id` = '".$row1['id']."' AND `reciver_id` = '".$id."')
        OR (`sender_id` = '".$id."' AND `reciver_id` = '".$row1['id']."') ORDER BY `date_time` ASC";

        $result2 = $conn->query($query2);

        $query3 = "SELECT * FROM `users` WHERE `id` = '".$id."'";
        $result3 = $conn->query($query3);
        $chatUser = $result3->fetch_assoc();

    }else{
        header("Location: users.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container d-flex justify-content-center vh-100 align-items-center">
        <div class="card shadow-lg mt-5 mb-5" style="width: 450px; height: 90vh; display: flex; flex-direction: column;">
            <div class="container p-3">
                <div class="d-flex align-items-center">
                    <button class="btn btn-light me-3" onclick="history.back();"><i class="bi bi-arrow-left"></i></button>
                    <img src="IMG-2850.PNG" alt="user IMG" height="50px" class="rounded-circle me-3">
                    <div class="">
                        <h5><?php echo $chatUser['fname']." ". $chatUser['lname']?></h5>

                        <?php
                        if($chatUser['status'] == 'ACTIVE'){
                            ?>
                            <span class="badge bg-success text-white">Online</span>
                            <?php
                        }else{
                            ?>
                            <span class="badge bg-secondary text-white">Offline</span>
                            <?php
                        }
                        

                        ?>

                        
                    </div>
                </div>
            </div>

            <div id="msgbox" class="container mt-3 p-3" style="flex-grow: 1; overflow-y: auto;">

            </div>

            <div class="container p-3 rounded-bottom">
                <div class="d-flex align-items-center">
                        <p id="response"></p>

                <input type="hidden" name="" id="reciver-id" value="<?php echo $chatUser['id'];?>">
                    <input type="text" class="form-control rounded-pill me-3" placeholder="Type a message here..."
                     id="msg" onkeypress="if(event.key == 'Enter') sendmsg(<?php echo $chatUser['id']?>)">
                    <button class="btn btn-dark rounded-pill" onclick="sendmsg(<?php echo $chatUser['id']?>);"><i class="bi bi-send"></i></button>
                </div>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>