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
                    </ul>
                </nav>
            </header>

            <main>
                <div class="centre">
                    <h1>Payment Method:</h1>
                </div>

                <form>
                    <label id="fname2_label" for="fname2">First Name: </label>
                    <input type="text" id="fname2" class="fname2" name="fname2" required>

                    <label id="lname2_label" for="lname2">Last Name: </label>
                    <input type="text" id="lname2" class="lname2" name="lname2" required>

                    <label id="cardNum_label" for="cardNum">Card Number: </label>
                    <input type="text" id="cardNum" class="cardNum" name="cardNum" placeholder="1111-2222-3333-4444" required>

                    <label id="expDate_label" for="expDate">Expiration Date: </label>
                    <input type="month" id="expDate" class="expDate" name="expDate" required>

                    <label id="cvv_label" for="cvv">CVV: </label>
                    <input type="password" id="cvv" class="cvv" name="cvv" required>

                    <div class="btn_container">
                        <button type="submit" class="btnPurchase">Purchase</button>
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