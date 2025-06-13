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
                        <li><a href="home.php">Home</a></li>
                        <li><a class="active" href="sell.php">Sell Products</a></li>
                        <li><a href="index.php">Logout</a></li>
                    </ul>
                </nav>
            </header>

            <main>
                <form class="sell-form" method="POST" enctype="multipart/form-data">                    
                    <label id="title_label" for="title">Title</label>
                    <input type="text" id="title" class="title" name="title" required>
                    
                    <label id="price_label" for="price">Price</label>
                    <input type="text" id="price" class="price" name="price" required>

                    <label id="category_label" for="category">Category</label>
                    <select id="category" name="category" required> 
                        <option></option>            
                        <option value="clothing">Clothing</option>
                        <option value ="electronics">Electronics</option>
                        <option value ="books">Books</option>
                        <option value ="home">Home</option>
                        <option value ="other">Other</option>
                    </select>

                    <label id="description_label" for="description">Description</label>
                    <input type="text" id="description" class="description" name="description">

                    <label for="images">Upload Images:</label>
                    <input type="file" id="images" name="images" accept="image/*" multiple>

                    <div class="btn_container">
                        <button type="submit" class="btnPublish">Publish</button>
                    </div>
                </form>

                <?php
                    // Check Connection
                    if ($conn->connect_error){
                        die("Connection Failed: " . $conn->connect_error);
                    }

                    // Add Product to DB
                    if ($_SERVER["REQUEST_METHOD"] == "POST"){
                        $title = $conn->real_escape_string($_POST['title']);
                        $price = $conn->real_escape_string($_POST['price']);
                        $category = $conn->real_escape_string($_POST['category']);
                        $description = $conn->real_escape_string($_POST['description']);

                        $images = "";   // default

                        if (isset($_FILES['images']) && $_FILES['images']['error'] == UPLOAD_ERR_OK) {
                            $uploadDir = "uploads/";
                            $filename = basename($_FILES["images"]["name"]);
                            $targetPath = $uploadDir . $filename;

                            // create upload folder if needed
                            if (!file_exists($uploadDir)){
                                mkdir($uploadDir, 0777, true);
                            }

                            // move uploaded file
                            if (move_uploaded_file($_FILES["images"]["tmp_name"], $targetPath)){
                                $imagePath = $targetPath;
                            }
                        }

                        $sql = "INSERT INTO `products` (`title`, `price`, `category`, `description`, `image`) 
                                VALUES ('$title', '$price', '$category', '$description', '$imagePath')";

                        // trying to execute the SQL INSERT query
                        if ($conn->query($sql) === TRUE) {
                            echo "<p style='color: green;'>Product successfully published!</p>";    // success message if successful
                        } else {
                            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";  // error message if failure
                        }
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