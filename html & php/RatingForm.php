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


        
<?php

session_start();

    // Connect to your MySQL database
    $host = "localhost";
    $dbname = "project_database";
    $username = "root";
    $password = "";



// Check if the user is logged in (has a `CustomerID` in the session)
if (isset($_SESSION['CustomerID'])) {
    // Establish a database connection (replace with your database configuration)
    $conn = new mysqli($host, $username, $password, $dbname);
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

echo '<form action="rating.php" method=post>

<div class="form" >    
    <label for="Comments" >Share Your Feedback : </label>     <br><br>
    <textarea name="Comments" rows="12" cols="50"></textarea><br>           
    <br><br><br>

    <label for="Rating" >Rate us : </label>
    <input type="radio" name="Rating" value="1"> 1 &nbsp;
    <input type="radio" name="Rating" value="2"> 2 &nbsp;
    <input type="radio" name="Rating" value="3"> 3 &nbsp;
    <input type="radio" name="Rating" value="4"> 4 &nbsp;
    <input type="radio" name="Rating" value="5"> 5 &nbsp;
    <br><br><br>

    <input type="submit" value=" Submit " > <br>
</div>

</form>';

    $conn->close();
} else {
    // User is not logged in, redirect to login page
    header("Location: login.html");
    exit; // Always exit after a header redirect
}
?>

    <br><br>
    </body>

    <footer>  
    <p>&copy; 2023 Online Shopping, Sri Lanka, All rights reserved.</p>
    </footer>

</html>









