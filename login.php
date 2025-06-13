<?php
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Start session
    session_start();

    // DB connection
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

                    // Get email and password from form
                    $email = $_POST['email'] ?? '';
                    $password = $_POST['password'] ?? '';

                    // Validate input
                    if (!empty($email) && !empty($password)) {
                        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
                        $stmt->bind_param("ss", $email, $password); // if password is stored in plain text
                        $stmt->execute();
                        $result = $stmt->get_result();

                    if ($result->num_rows === 1) {
                        // Login success
                        $user = $result->fetch_assoc();
                        $_SESSION["logged_in"] = true;
                        $_SESSION["email"] = $email;
                        $_SESSION["role"] = $user['role'];

                        if($user['role'] == 'admin'){
                            header("Location: admin.php");
                        } else {
                            header("Location: home.php");
                        }
                        exit;
                    } else {
                        $error = "Invalid email or password.";
                    }
                        $stmt->close();

                    }
                    $conn->close();

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
                    <h1>Login To GetMore</h1>
                </div>
            
                <form class="login-form" method="POST" action="login.php">
                    <label id="email_label" for="email">Email: </label>
                    <input type="text" id="email" class="email" name="email" placeholder="Email" required>

                    <label id="password_label" for="password">Password: </label>
                    <input type="password" id="password" class="password" name="password" required>

                    <div class="btn_container">
                        <button type="submit" class="btnLogin">Login</button>
                    </div>
                </form>

                <?php
                    // Show error message if set
                    if (!empty($error)) {
                        echo "<p class='error'>$error</p>";
                    }
                ?>
                
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