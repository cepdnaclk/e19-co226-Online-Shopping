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
        <li><a href="orderHistory.php">Order History</a></li>
        <li><a href="Track_order.html">Track the Order</a></li>
        <li><a href="contacts.html">Contacts Us</a></li>
        <li><a href="RatingForm.php">Rate Us</a></li>
        <li><a href="Aboutus.html">About Us</a></li>
    </ul>
</div>
    <br><br>

    <?php
    // Establish a database connection
    $host = "localhost";
    $dbname = "project_database";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the Order No is provided in the form submission
    if (isset($_POST['OrderNo'])) {
        $orderNo = $_POST['OrderNo'];
        $status = $_POST['Status'];

        // Update the status of the order in the database
        $query = "UPDATE `Order` SET Status = '$status' WHERE OrderNo = '$orderNo'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Query to retrieve the modified order details from the database
            $query = "SELECT * FROM `Order` WHERE OrderNo = '$orderNo'";
            $result = mysqli_query($conn, $query);

            // Check if a matching order is found
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Display the modified order details
                echo '<div align="middle">';
                echo '<h1>' . $row['OrderNo'] . '</h1>';
                echo '<p><strong>Payment Method: </strong>' . $row['Payment_Method'] . '</p>';
                echo '<p><strong>Order Date: </strong>' . $row['Order_Date'] . '</p>';
                echo '<p><strong>Expected Delivery Date: </strong>' . $row['Expected_Delivery_Date'] . '</p>';
                echo '<p><strong>Status: </strong>' . $row['Status'] . '</p>';
                echo '</div>';
            } else {
                // Display a message when the order is not found
                echo '<p>Order Details not found.</p>';
            }
        } else {
            // Display an error message when the update fails
            echo '<p>Failed to update the status.</p>';
        }
    } else {
        // Display a message when the Order No is not provided
        echo '<p>Invalid Order Number.</p>';
    }

    // Close the database connection
    mysqli_close($conn);
?>

    <br><br>
    </body>

    <footer>  
    <p>&copy; 2023 Online Shopping, Sri Lanka, All rights reserved.</p>
    </footer>

</html>


