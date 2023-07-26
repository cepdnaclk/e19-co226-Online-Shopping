<!DOCTYPE html>
<html>
<head>
<title>
            Online Shopping
        </title>
        <link rel = "icon" href = Logo.jpg type = "image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/test.css" />
        <link rel="stylesheet" type="text/css" href="../css/styles.css" />
    </head>

    <body>

        <div class="header">
            <div class="logocontainer">
            <a href="Home.php">
              <img class="logoimg" src="../images/LogoFinal.jpg" alt="Logo">
            </a>
              <h2>The largest online shopping platform in Sri Lanka.</h2>
            </div>

        <ul class="login">
            <li><a href="Login.html">Log in</a></li>
            <li><a href="Signup.html">Sign up</a></li>
            <li><a href="admin.html">Admin</a></li>
        </ul>
    </div>

    <div>
        <ul class="NavigationBar">
            <li><a href="Home.php">Home</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="orderNow.php">Order Now</a></li>
            <li><a href="Track_order.html">Track the Order</a></li>
            <li><a href="contacts.html">Contacts Us</a></li>
            <li><a href="Rating.html">Rate Us</a></li>
            <li><a href="Aboutus.html">About Us</a></li>
        </ul>
    </div>

    <?php
    session_start();

    if (isset($_POST['order_now'])) {
        // Retrieve the cart data from the session
        $cartItems = $_SESSION['cart'];

        // Connect to your MySQL database
        $host = "localhost";
        $dbname = "project_database";
        $username = "root";
        $password = "";

        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Generate the order number (you can use any logic to generate a unique order number)
        $orderNumber = generateOrderNumber();

        // Calculate the total amount
        $totalAmount = calculateTotalAmount($cartItems);

        // Get the customer ID from your authentication system or form input
        if (isset($_SESSION['CustomerID'])) {
            $customerID = $_SESSION['CustomerID'];
            // ... Use the $userid for your logic on this page
        } else {
            // User is not logged in, handle accordingly (e.g., redirect to login page)
            header("Location: Login.html");
            exit();
        }

        // Get the payment method and expected delivery date from the form
        $paymentMethod = $_POST['Payment_Method'];
        $expectedDeliveryDate = date('Y-m-d', strtotime('+2 days'));

        // Insert the order details into the database using prepared statements
        $stmt = $conn->prepare("INSERT INTO `order` (OrderNo, Total_Amount, Payment_Method, Order_Date, Expected_Delivery_Date, Customer_ID) 
                                VALUES (?, ?, ?, CURDATE(), ?, ?)");
        $stmt->bind_param("sdsds", $orderNumber, $totalAmount, $paymentMethod, $expectedDeliveryDate, $customerID);
        $stmt->execute();

        // Insert the order items into the database using prepared statements
        $stmt = $conn->prepare("INSERT INTO contain (OrderNo, ProductID, No_of_Product) 
                                VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $orderNumber, $productID, $quantity);

        foreach ($cartItems as $cartItem) {
            $productID = $cartItem['productID'];
            $quantity = $cartItem['quantity'];

            $stmt->execute();
        }

        // Redirect to a success page or display a success message
        echo "Order placed successfully!<br><br>";
        echo "Order Number           : " . $orderNumber . "<br><br>";
        echo "Total Amount           : " . $totalAmount . "<br><br>";
        echo "Payment Method         : " . $paymentMethod . "<br><br>";
        echo "Order Date             : " . date('Y-m-d') . "<br><br>";
        echo "Expected Delivery Date : " . $expectedDeliveryDate . "<br><br>";
        echo "Customer ID            : " . $customerID . "<br><br>";

        // Clear the cart
        $_SESSION['cart'] = array();

        // Close the database connection
        $stmt->close();
        mysqli_close($conn);
    }

    // Function to generate a unique order number
    function generateOrderNumber()
    {
        $prefix = 'ORD'; // Prefix for the order ID (optional)
        $randomNumberLength = 4; // Length of the random number (adjust as needed)

        // Generate a unique order ID by combining timestamp and random number
        $orderNumber = $prefix . time() . mt_rand(1000, 9999);

        return $orderNumber;
    }

    // Function to calculate the total amount of the order
    function calculateTotalAmount($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $cartItem) {
            $sellingPrice = $cartItem['sellingPrice'];
            $quantity = $cartItem['quantity'];

            $total += $sellingPrice * $quantity;
        }

        return $total;
    }
    ?>

    <br><br>

    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka, All rights reserved.</p>
    </footer>

</body>
</html>
