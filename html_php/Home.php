<!DOCTYPE html>
<html>
<head>
    <title>Online Shopping</title>
    <link rel="icon" href="Logo.jpg" type="image/x-icon">
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

    <form class="forminline" action="home.php" method="GET">
        <input type="text" name="search" class="inputsearch" placeholder="Search" required>
        <input type="submit" value="Search" class="inputsearch">
    </form> 

    <ul class="login">
        <?php
        session_start();

        if (isset($_SESSION['CustomerID'])) {
            // User is logged in
            echo '<li><a href="Logout.php">Log out</a></li>';
            
        } else {
            // User is not logged in
            echo '<li><a href="Login.html">Log in</a></li>';
            echo '<li><a href="Signup.html">Sign up</a></li>';
            echo '<li><a href="admin.html">Admin</a></li>';
        }
        ?>
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

<br><br><br>

<div class="products-container">
    <?php
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

    // Check if a search query is submitted
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        // Query to retrieve product data based on the search term
        $query = "SELECT * FROM product WHERE ProductName LIKE '%$searchTerm%'";
    } else {
        // Query to retrieve all product data from the database
        $query = "SELECT * FROM product";
    }

    $result = mysqli_query($conn, $query);

    // Check if any rows were returned
    if (mysqli_num_rows($result) > 0) {
        // Loop through the retrieved data and generate HTML for each product
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="product-block">';
            echo '<a href="ProductDetails.php?id='. $row['ProductID'] . '" class="offerlink">';
            echo '<img src="data:image/jpg;base64,' . base64_encode($row['image']) . '" alt="Product Image">';
            echo '<h3>' . $row['ProductName'] . '</h3>';
            echo '<p><p class="offer">' ."LKR ". number_format($row['Tag_Price'], 2) . '</p class="price">' ."LKR ". number_format($row['Selling_Price'], 2) . '</p></a>';

            echo '<form action="cart.php" method="POST">';
            echo '<input type="hidden" name="productID" value="' . $row['ProductID'] . '">';
            echo '<input type="hidden" name="productName" value="' . $row['ProductName'] . '">';
            echo '<input type="hidden" name="sellingPrice" value="' . $row['Selling_Price'] . '">';
            echo '<input type="hidden" name="quantity" value="1">';

            // Check if the user is logged in (has a `CustomerID` in the session)
            if (isset($_SESSION['CustomerID'])) {
                echo '<button type="submit" name="add_to_cart">Add to Cart</button>';
            } else {
                // User is not logged in, show login link
                echo '<p>Please <a href="Login.html">log in</a> to add products to your cart.</p>';
            }

            echo '</form>';
            echo '</div>';
        }
    } else {
        // Display message when no products are found
        echo '<p class="product_block_text">There are no available products for sale!</p>';
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</div>

<br><br>

<footer>
    <p>&copy; 2023 Online Shopping, Sri Lanka</p>
</footer>

</body>
</html>
