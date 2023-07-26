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
$customerID = $_POST['customerID'];
$fname = $_POST["FirstName"];
$lname = $_POST["LastName"];
$address = $_POST["Address"];
$mobile = filter_input(INPUT_POST, "MobileNumber", FILTER_VALIDATE_INT);
$password = $_POST["Password"];
$gender = $_POST["Gender"];

$host = "localhost";
$dbname = "project_database";
$username = "root";
$dbpassword = "";

$conn = mysqli_connect($host, $username, $dbpassword, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

// Check if the CustomerID already exists
$checkQuery = "SELECT * FROM customer WHERE Customer_ID = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $checkQuery)) {
    die(mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, "s", $customerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    // CustomerID already exists
    echo "CustomerID already taken. Please choose a different CustomerID.";
    exit;
}

// Proceed with inserting the new customer into the database
$sql = "INSERT INTO customer (Customer_ID, First_Name, Last_Name, Address, Contact_Number, Password, Gender) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssssiss", $customerID, $fname, $lname, $address, $mobile, $password, $gender);
if (!mysqli_stmt_execute($stmt)) {
    die(mysqli_error($conn));
}
mysqli_stmt_close($stmt);

// Print the message with the link
echo "Hello, " . $_POST["FirstName"] . " " . $_POST["LastName"] . "!";
echo "<br><br><strong>" . "Your CustomerID is " . $customerID . "</strong>";
echo "<br><br>";
echo "Thank you for signing up on our website";
echo "<br><br>";
echo '<a href="Home.php?id=' . $customerID . '">';
echo '<p class="offerlink">Click here</p>';
echo '</a>';

mysqli_close($conn);
?>

    <br><br>
    </body>

    <footer>  
    <p>&copy; 2023 Online Shopping, Sri Lanka, All rights reserved.</p>
    </footer>

</html>
