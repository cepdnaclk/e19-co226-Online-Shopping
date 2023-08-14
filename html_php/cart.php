<!DOCTYPE html>
<html>
<head>
    <title>Online Shopping</title>
    <link rel="icon" href="Logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/test.css" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container pt-2 pb-2">
        <div class="row">
            <div class="col-sm-1"> <img class="logoimg" src="../images/LogoFinal.jpg" alt="Logo"> </div>
            <div class="col-sm-8 text-danger"> <h2>The largest online shopping platform in Sri Lanka.</h2> </div>
        <?php
        session_start();

        if (isset($_SESSION['CustomerID'])) {
            // User is logged in
            echo '<div class="col-sm-1"> </div>';
            echo '<div class="col-sm-1">  </div>';
            echo '<div class="col-sm-1"> <a href="Logout.php"> <button type="button" class="btn btn-outline-primary"> Log out </button> </a> </div>';
            
        } else {
            // User is not logged in
            echo '<div class="col-sm-1"> <a href="Login.html"> <button type="button" class="btn btn-outline-primary"> Log in </button> </a> </div>';
            echo '<div class="col-sm-1"> <a href="Signup.html"><button type="button" class="btn btn-outline-primary"> Sign up </button></a> </div>';
            echo '<div class="col-sm-1"> <a href="admin.html"> <button type="button" class="btn btn-outline-primary"> Admin </button></a> </div>';
        }
        ?>
        </div>
    </div>

    <div>
    <ul class="NavigationBar">
        <li><a href="Home.php">Home</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="orderHistory.php">Order History</a></li>
        <li><a href="Track_order.html">Track the Order</a></li>
        <li><a href="contacts.html">Contacts Us</a></li>
        <li><a href="RatingForm.php">Rate Us</a></li>
        <li><a href="Aboutus.html">About Us</a></li>
    </ul>
</div>

    <div class="container pt-2">
    <?php
    


    // Establish a database connection
    $host = "localhost";
    $dbname = "project_database";
    $username = "root";
    $passwordHost = "";

    

    $conn = mysqli_connect($host, $username, $passwordHost, $dbname);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

if (isset($_GET["del"])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['productID'] == $_GET['del']) {
            unset($_SESSION["cart"][$key]);
        }
    }
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // Initialize the cart array if it doesn't exist
}

if (isset($_POST['add_to_cart'])) {
    // Retrieve the product details from the form
    $productID = $_POST['productID'];
    $productName = $_POST['productName'];
    $sellingPrice = $_POST['sellingPrice'];
    $quantity = $_POST['quantity'];

    $productID_array = array_column($_SESSION["cart"], "productID");
    if (!in_array($productID, $productID_array)) {
        // Create an associative array for the cart item
        $cartItem = array(
            'productID' => $productID,
            'productName' => $productName,
            'sellingPrice' => $sellingPrice,
            'quantity' => $quantity
        );

        // Add the cart item to the cart array in the session
        $_SESSION['cart'][] = $cartItem;
    } else {
        echo "<script>alert ('Already Added..') </script>";
    }
}

        echo '<form action="ordernow.php" method="post">';
        echo '<table class="table table-striped">';
        echo '<tr><th>Product ID</th><th>Product Name</th><th>Price</th><th>Quantity</th><th>Available</th><th>Action</th></tr>';

        $totalAmount = 0;
        foreach ($_SESSION['cart'] as $index => $cartItem) {
            $productID = $cartItem['productID'];
            $query = "SELECT Quantity FROM stock WHERE ProductID = ?";
            
            // Prepare and execute the query
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $productID);
            $stmt->execute();
            $result = $stmt->get_result();
            
            // Fetch the available quantity
            $row = $result->fetch_assoc();
            $availableQuantity = $row['Quantity'];
        
            echo '    <tr>';
            echo '        <td>' . $cartItem['productID'] . '</td>';
            echo '        <td>' . $cartItem['productName'] . '</td>';
            echo '        <td>' . $cartItem['sellingPrice'] . '</td>';

            if ($availableQuantity <= 0) {
                echo '        <td></td>';
                echo '        <td><span style="color: red;">Out of Stock</span></td>';
            } else {
                echo '        <td><input type="number" name="quantity[' . $index . ']" value="' . $cartItem['quantity'] . '" min="1"  max="' . $availableQuantity . '" style="width: 60px;" required></td>';
                echo '        <td>' . $availableQuantity . '</td>';
            }
        
            
            echo '        <td><a href="cart.php?del=' . $cartItem['productID'] . '">Remove</a></td>';
            echo '        <input type="hidden" name="productID[' . $index . ']" value="' . $cartItem['productID'] . '">';
            echo '    </tr>';
        }
        
        echo '</table>';

        echo '<div>';
        echo '<br><br>';
        echo '<label> Delivey Address : </label>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<input name="DeliveryAddress1" type="text" placeholder="No." style="width: 80px;" required></input>&nbsp;';
        echo '<input name="DeliveryAddress2" type="text" placeholder="Road/Street" style="width: 200px;" required></input>&nbsp;';
        echo '<input name="DeliveryAddress3" type="text" placeholder="City" style="width: 170px;" required></input>';
        
        echo '<br><br>';
        echo '<label> Payment Method :</label>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<input name="Payment_Method" type="radio" value="Cash_Payment" required> Cash Payment </input>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<input name="Payment_Method" type="radio" value="Card_Payment" required> Card Payment </input>';
        
        echo '<br><br><br>';
        echo '</div>';
        echo '    <button type="submit" name="order_now" class="ordernow"> Buy Now </button>';
        echo '</form>';
        ?>
    </div>

    <br><br>

    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka, All rights reserved.</p>
    </footer>
</body>
</html>
