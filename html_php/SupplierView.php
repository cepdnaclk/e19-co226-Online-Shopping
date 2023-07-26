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
        <link rel="stylesheet" type="text/css" href="../css/AdminStyle.css" />
        
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

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve all employee details
$sql = "SELECT * FROM Supplier";
$result = mysqli_query($conn, $sql);

// Check if any results were returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each row and print employee details
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Supplier ID: " . $row["SupplierID"] . "<br>";
        echo "Name: " . $row["Name"] . "<br>";
        echo "Contact_No: " . $row["Contact_No"] . "<br>";
        echo "Address: " . $row["Address"] . "<br>";
        echo "<br>";
    }
} else {
    echo "No Supplier found.";
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









