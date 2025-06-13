<?php
    // Enable error reporting for debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Start session
    session_start();

    // DB connection
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
                        <li><a class="active" href="home.php">Home</a></li>
                        <li><a href="#" id="openCart">Cart</a></li>
                        <li><a href="sell.php">Sell Products</a></li>
                        <li><a href="index.php">Logout</a></li>
                    </ul>
                </nav>
            </header>

            <main>
                <div class="centre">
                    <h1>Welcome To GetMore</h1>
                    <div class="productContainer">
                        <?php
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            
                            $sql = "SELECT * FROM products";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="productCard">';
                                    echo '<img src="' . $row["image"] . '" alt="' . $row["title"] . '">';
                                    echo '<h3>' . $row["title"] . '</h3>';
                                    echo '<p>R' . $row["price"] . '</p>';
                                    echo '<br>';
                                    echo '  <button 
                                                class="btnAddToCart"
                                                data-title="' .htmlspecialchars($row["title"]).'"
                                                data-price="' .$row["price"].'"
                                                data-image="' .$row["image"].'">
                                                Add To Cart
                                            </button>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<p>No products available.</p>';
                            }

                            $conn->close();
                        ?>
                    </div>
                </div>

                <div class="shopping-cart">
                    <h1>Shopping Cart</h1>
                    <div class="listCart">
                        
                    </div>
                    <div class="btn">
                        <button class="btnClose">CLOSE</button>
                        <button class="btnCheckout">CHECKOUT</button>
                    </div>
                </div>
            </main>
            <footer class="footer">
                <p>
                    GetMore - Buy & Sell Direct |
                    Contact: <a href="mailto:support@getmore.co.za">support@getmore.co.za</a> |
                    © 2025 GetMore. All rights reserved.
                </p>
            </footer>
        </div>
        <script src="app.js"></script>
    </body>
</html>