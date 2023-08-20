<!DOCTYPE html>

<html>
    <head>
        <title>
            Online Shopping
        </title>
        <link rel = "icon" href = Logo.jpg type = "image/x-icon">
        <link rel="stylesheet" type="text/css" href="../css/test.css" />
        <link rel="stylesheet" type="text/css" href="../css/styles.css" />
        <link rel="stylesheet" type="text/css" href="../css/php.css" />
        
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


<h1 class="signupphp">


<?php
    session_start();

    // Check if the user is logged in (has a `CustomerID` in the session)
    if (isset($_SESSION['CustomerID'])) {
        $host = "localhost";
        $dbname = "project_database";
        $username = "root";
        $password = "";

        // Establish a database connection
        $conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the logged-in customer's ID
        $loggedID = $_SESSION['CustomerID'];

        // Retrieve form data
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Comments = $_POST["Comments"];
            $Rating = $_POST["Rating"];

            // Prepare and execute the INSERT query
            $sql = "INSERT INTO Rating (Customer_ID, Comment, Rating) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);


            if ($stmt) {
                $stmt->bind_param("ssi", $loggedID, $Comments, $Rating);
                if ($stmt->execute()) {
                    echo "<script>alert ('Your Rating is submitted.') </script>";
                    header('Location: Home.php');
                    exit; // Make sure to exit after the header redirection

                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $conn->error;
            }
        }

        $conn->close();
    } else {
        // User is not logged in, redirect to login page
        header("Location: login.html");
        exit; // Always exit after a header redirect
    }
?>


</h1>
    <br>
    <br>        
    </body>

    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka </p>
    </footer>

</html>






