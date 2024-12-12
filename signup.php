<?php

session_start();
if(isset($_SESSION['user'])){
header("Location: users.php");
exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat App</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <style>
        body {
            background-image: url('IMG-2849.JPG');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-3" style="width: 400px;">
            <h1 class="text-center mb-3">Chat App</h1>
            <div class="card-body">

                <p id="response"></p>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fname" class="form-label">First Name</label>
                        <input type="text" id="fname" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="lname" class="form-label">Last Name</label>
                        <input type="text" id="lname" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="emial" class="form-label">Enter Your Email</label>
                    <input type="email" id="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Enter Your Password</label>
                    <input type="password" id="password" class="form-control">
                </div>

                <div class="mb-3">
                    <button class="btn btn-primary w-100" onclick="signup();">signUp</button>
                </div>
                <p class="text-center">Do you have an Account? <a href="index.php" class="text-decoration-none">SignIn</a></p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>