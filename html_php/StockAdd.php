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
            </div>            Online Shopping
        </title>
        <link rel = "icon" href = Logo.jpg type = "image/x-icon">
        <link rel="stylesheet" type="text/css" href="test.css" />
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>

    <body>
    <div class="header">
            <div class="logocontainer">
            <a href="Home.php">
              <img class="logoimg" src="LogoFinal.jpg" alt="Logo">
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

$ProductID = $_POST["ProductID"];
$SupplierID = $_POST["SupplierID"];
$Date = $_POST["Date"];
$Quantity = filter_input(INPUT_POST, "Quantity", FILTER_VALIDATE_INT);
$TotalPrice = filter_input(INPUT_POST, "TotalPrice", FILTER_VALIDATE_INT);
$BranchID = $_POST["BranchID"];

$host = "localhost";
$dbname = "project_database";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO Supply (SupplierID, ProductID, Date, Total) VALUES (?,?,?,?)";
$stmt = mysqli_stmt_init($conn);

if ($TotalPrice === null) {
    $TotalPrice = 0; // Assign a default value if TotalPrice is null
}

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "iisd", $SupplierID, $ProductID, $Date, $TotalPrice);
mysqli_stmt_execute($stmt);

$sql = "INSERT INTO Stock(BranchID, ProductID, Quantity) VALUES (?,?,?)";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "iis", $BranchID, $ProductID, $Quantity);
mysqli_stmt_execute($stmt);

echo "Changes Successful";

mysqli_close($conn);
?>


    <br><br>
    
    </body>
    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka </p>
    </footer>

</html>


