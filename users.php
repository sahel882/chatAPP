<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
} else {
    $email = $_SESSION['user']['email'];
    $conn = new mysqli("localhost", "root", "saheldesilva12345", "chat_ap", "3306");

    $query1 = "SELECT * FROM `users` WHERE `email` = '" . $email . "'";
    $result1 = $conn->query($query1);
    $row1 = $result1->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App | Users</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <style>
        .status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: green;
        }

        .user-row {
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        .user-row:hover {
            background-color: #a1d7da;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg" style="width: 450px;">
        <div class="card-body">

            <div class="d-flex p-3">
                <img src="IMG-2850.PNG" height="50px" alt="User IMG" class="rounded-circle me-3">
                <div class="flex-grow-1">
                    <h6><?php echo $row1['fname'] . " " . $row1['lname'] ?></h6>
                    <small class="text-success">Active now</small>
                </div>
                <button class="btn btn-dark btn-sm" onclick="return confirm('Are you sure?') && logout();">Logout</button>
            </div>
            <hr>

            <div class="">
                <p>Select a user</p>
            </div>
            <hr>

            <!-- chat profile -->
            <?php

            $query2 = "SELECT * FROM `users` WHERE NOT `email` = '" . $email . "' ORDER BY `id` DESC";
            $result2 = $conn->query($query2);

            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
            ?>

                    <div class="d-flex algin-items-center p-3 user-row" onclick="chat(<?php echo $row2['id']?>);">
                        <img src="IMG-2850.PNG" alt="user IMG" height="50px" class="rounded-circle me-3">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <h6><?php echo $row2['fname'] ?></h6>
                                <span class="status" style="background-color: <?php echo ($row2['status'] == 'ACTIVE') ? 'green' : 'red' ?>;"></span>
                            </div>

                            <?php

                            $query3 = "SELECT * FROM `messages` 
                            WHERE `sender_id` = '" . $row2['id'] . "' OR `reciver_id` = '" . $row2['id'] . "'ORDER BY `id` DESC LIMIT 1";
                            $result3 = $conn->query($query3);

                            if ($result3->num_rows > 0) {
                                $lastmsg = $result3->fetch_assoc();
                            ?>
                                <small><?php echo $lastmsg['message'] ?></small>
                            <?php
                            } else {
                            ?>
                                <small></small>
                            <?php
                            }

                            ?>
                            <small></small>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>