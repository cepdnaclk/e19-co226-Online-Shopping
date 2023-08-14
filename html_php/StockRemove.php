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
$host = "localhost";
$dbname = "project_database";
$username = "root";
$password = "";

// Establish a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted ProductID and Quantity from the form
    $ProductID = $_POST["ProductID"];
    $Quantity = $_POST["Quantity"];

    // Retrieve the current available quantity from the database
    $sqlGetAvailableQuantity = "SELECT Quantity FROM stock WHERE ProductID=?";
    $stmtAvailableQuantity = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmtAvailableQuantity, $sqlGetAvailableQuantity);
    mysqli_stmt_bind_param($stmtAvailableQuantity, "i", $ProductID);
    mysqli_stmt_execute($stmtAvailableQuantity);
    mysqli_stmt_bind_result($stmtAvailableQuantity, $availableQuantity);
    mysqli_stmt_fetch($stmtAvailableQuantity);
    mysqli_stmt_close($stmtAvailableQuantity);

    if ($availableQuantity >= $Quantity) {
        // Update the available quantity in the stock table
        $newAvailableQuantity = $availableQuantity - $Quantity;
        $sqlUpdateStock = "UPDATE stock SET Quantity=? WHERE ProductID=?";
        $stmtUpdateStock = mysqli_stmt_init($conn);

        mysqli_stmt_prepare($stmtUpdateStock, $sqlUpdateStock);
        mysqli_stmt_bind_param($stmtUpdateStock, "ii", $newAvailableQuantity, $ProductID);
        mysqli_stmt_execute($stmtUpdateStock);
        mysqli_stmt_close($stmtUpdateStock);

        echo "Product quantity updated successfully.";
    } else {
        echo "Insufficient quantity in stock.";
    }
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



