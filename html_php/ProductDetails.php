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
                <li ><a href=Home.php> Home </a></li>
                <li ><a href=cart.php> Cart </a></li>
                <li ><a href=orderNow.php> Order Now </a></li>
                <li ><a href=Track_order.html> Track the Order </a></li>
                <li ><a href=contacts.html> Contacts Us </a></li>
                <li ><a href=Rating.html> Rate Us </a></li>
                <li ><a href=Aboutus.html> About Us </a></li>   
            </ul>    
        </div>

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

    // Check if the product ID is provided in the URL
    if (isset($_GET['id'])) {
        $productID = $_GET['id'];

        // Query to retrieve the product details from the database based on the provided product ID
        $query = "SELECT * FROM product WHERE ProductID = '$productID'";
        $result = mysqli_query($conn, $query);

        // Check if a matching product is found
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Display the product details
            echo '<div align="middle">';
            echo '<h1>' . $row['ProductName'] . '</h1>';
            echo '<img src="' . $row['image'] . '" alt="Product Image">';
            echo '<p class="offer"><strong>Price : </strong> LKR ' . number_format($row['Tag_Price'], 2) . '</p>';
            echo '<p class="price"><strong>Price : </strong> LKR ' . number_format($row['Selling_Price'], 2) . '</p>';
            echo '<p><strong>Description:</strong> ' . $row['Description'] . '</p>';
            echo '</div>';
            // Add other product details as necessary
        } else {
            // Display a message when the product is not found
            echo '<p>Product not found.</p>';
        }
    } else {
        // Display a message when the product ID is not provided
        echo '<p>Invalid product ID.</p>';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <br><br>
</body>
<footer>
    <p>&copy; 2023 Online Shopping, Sri Lanka </p>
</footer>

</html>
