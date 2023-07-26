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
            <li><a href="Home.php"> Home </a></li>
            <li><a href="cart.php"> Cart </a></li>
            <li><a href="orderNow.php"> Order Now </a></li>
            <li><a href="Track_order.html"> Track the Order </a></li>
            <li><a href="contacts.html"> Contacts Us </a></li>
            <li><a href="Rating.html"> Rate Us </a></li>
            <li><a href="Aboutus.html"> About Us </a></li>
        </ul>
    </div>

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

    // Retrieve the AdminID and password from the database based on the provided AdminID
    $AdminID = $_POST['AdminID']; // Assuming the AdminID is submitted via POST method
    $query = "SELECT Password FROM Admin WHERE AdminID = '$AdminID'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // AdminID exists in the database, so check the password
            $row = mysqli_fetch_assoc($result);
            $storedPassword = $row['Password'];
            $providedPassword = $_POST['password']; // Assuming the password is submitted via POST method

            // Compare the stored password with the provided password
            if ($providedPassword === $storedPassword) {
                // Passwords match, authentication successful
                // echo "Authentication successful!";
                ?>
                <div class="middle">
                    <ul>
                        <li ><a href="EmployeeView.php" class="selection">View Employee Details</a></li><br><br>
                        <li ><a href="EmployeeAdd.html" class="selection">Add an Employee</a></li><br><br>
                        <li ><a href="EmployeeRemove.html" class="selection">Remove an Employee</a></li><br><br>
                        <li ><a href="EmployeeModify.html" class="selection">Modify Employee Details</a></li><br><br>

                        <li ><a href="Stockview.php" class="selection">View Stock Details</a></li><br><br>
                        <li ><a href="Supplyview.php" class="selection">View Supply Details</a></li><br><br>
                        <li ><a href="StockAdd.html" class="selection">Add a Product to Stock</a></li><br><br>
                        <li ><a href="StockRemove.html" class="selection">Remove a Product from Stock</a></li><br><br>

                        <li ><a href="SupplierView.php" class="selection">View Supplier Details</a></li><br><br>
                        <li ><a href="SupplierAdd.html" class="selection">Add a Supplier</a></li><br><br>
                        <li ><a href="SupplierRemove.html" class="selection">Remove a Supplier</a></li><br><br>
                        <li ><a href="SupplierModify.html" class="selection">Modify Supplier Details</a></li><br><br>

                        <li ><a href="ProductView.php" class="selection">View Product Details</a></li><br><br>
                        <li ><a href="ProductAdd.html" class="selection">Add a Product</a></li><br><br>
                        <li ><a href="ProductRemove.html" class="selection">Remove a Product</a></li><br><br>
                        <li ><a href="ProductModify.html" class="selection">Modify Product Details</a></li><br><br>

                        <li ><a href="package_status.html" class="selection">Modify Package Status</a></li><br><br>
                    </ul>
                </div>
                <?php
            } else {
                // Passwords do not match
                echo "Invalid password!";
            }
        } else {
            // AdminID does not exist in the database
            echo "Invalid AdminID!";
        }
    } else {
        // Error executing the query
        echo "Error: " . mysqli_error($conn);
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
