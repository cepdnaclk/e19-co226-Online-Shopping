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
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $Name = $_POST["Name"];
    $ContactNo = $_POST["ContactNo"];
    $Address = $_POST["Address"];

    // Establish a connection to the database
    $host = "localhost";
    $dbname = "project_database";
    $username = "root";
    $password = "";
    
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert the employee details
    $sql = "INSERT INTO Supplier (Name, Contact_No, Address)
            VALUES ('$Name', '$ContactNo', '$Address')";

    if ($conn->query($sql) === TRUE) {
        echo "Supplier added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

    </body>

    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka </p>
    </footer>

</html>



