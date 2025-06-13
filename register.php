<?php

    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Start session
    session_start();

    // DB connection
    $servername = "sql201.infinityfree.com";
    $username = "if0_39173347";
    $password = "UGmk3ILeYKRjQXz";
    $database = "if0_39173347_getmore_db";
 
    $conn = new mysqli($servername, $username, $password, $database);

    // Check Connection
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    // INSERT User
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $role = $_POST['role'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPass = $_POST['ConfirmPass'];

        if ($password !== $confirmPass){
            echo "<script>alert('Passwords do not match');</script>";
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `user`(`first_name`, `last_name`, `role`, `email`, `password`) 
                VALUES  ('$fname', '$lname', '$role', '$email', '$password')";
                
        if ($conn->query($sql)) {
            $_SESSION["logged_in"] = true;
            header("Location: login.php");    //redirect to home.php
            echo "<script>alert('User added successfully!')</script>";
            exit();
        } else {
            echo    "<script>
                        alert('Error: " . $conn->error . "')
                    </script>";
        }
    }
?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GetMore</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="wrapper">
            <header>
                
            </header>

            <main>
                <div class="centre">
                    <h1>Register To GetMore</h1>
                </div>
            
                <form class="register-form" method="POST" enctype="multipart/form-data">
                    <label id="fname_label" for="fname">First Name: </label>
                    <input type="text" id="fname" class="fname" name="fname" placeholder="First Name" required>

                    <label id="lname_label" for="lname">Last Name: </label>
                    <input type="text" id="lname" class="lname" name="lname" placeholder="Last Name" required>
                    
                    <label id="role_label" for="role">Role: </label>
                    <select id="role" name="role" required>
                        <option></option>
                        <option value ="user">User</option>
                        <option value ="admin">Admin</option>
                    </select>

                    <label id="email_label" for="email">Email: </label>
                    <input type="text" id="email" class="email" name="email" placeholder="Email" required>

                    <label id="password_label" for="password">Password: </label>
                    <input type="password" id="password" class="password" name="password" required>

                    <label id="confirmPass_label" for="ConfirmPass">Confirm Password: </label>
                    <input type="password" id="ConfirmPass" class="ConfirmPass" name="ConfirmPass" required>

                    <div class="btn_container">
                    <button type="submit" class="btnRegister">Register</button>
                </div>
                </form>
                
            </main>
            <footer class="footer">
                <p>
                    GetMore - Buy & Sell Direct |
                    Contact: <a href="mailto:support@getmore.co.za">support@getmore.co.za</a> |
                    © 2025 GetMore. All rights reserved.
                </p>
            </footer>
        </div>
    </body>
</html>