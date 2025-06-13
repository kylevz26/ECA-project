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
                <nav class="navbar">
                    <ul>
                        <li><a href="admin.php">Home</a></li>    
                        <li><a href="index.php">Logout</a></li>
                    </ul>
                </nav>
            </header>

            <main class="admin-main">
                <h2>Users:</h2>

                <?php
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } else {

                        //Query to fetch users
                        $sql = "SELECT id, first_name, last_name, role, email FROM user";
                        $result = $conn->query($sql);

                        if($result && $result->num_rows > 0){

                            //creating table to show users
                            //table formatting
                            echo "<table style='margin: 20px auto; border-collapse: collapse; width: 80%; border: 1px solid #ccc;'>"; 
                            
                            //adding table rows and headings
                            echo "  <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                    </tr>"; 

                            while($row = $result->fetch_assoc()){
                                echo    "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['first_name']}</td>
                                            <td>{$row['last_name']}</td>
                                            <td>{$row['role']}</td>
                                            <td>{$row['email']}</td>
                                        </tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p>No users found in the database!</p>";
                        }

                        $conn->close();
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