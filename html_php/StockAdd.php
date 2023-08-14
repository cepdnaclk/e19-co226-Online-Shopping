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

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$ProductID = $_POST["ProductID"];
$SupplierID = $_POST["SupplierID"];
$Date = $_POST["Date"];
$Quantity = filter_input(INPUT_POST, "Quantity", FILTER_VALIDATE_INT);
$TotalPrice = filter_input(INPUT_POST, "TotalPrice", FILTER_VALIDATE_INT);

// Check if the product already exists in Stock
$sqlCheckExisting = "SELECT Quantity FROM Stock WHERE ProductID=?";
$stmtCheckExisting = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmtCheckExisting, $sqlCheckExisting);
mysqli_stmt_bind_param($stmtCheckExisting, "i", $ProductID);
mysqli_stmt_execute($stmtCheckExisting);
mysqli_stmt_store_result($stmtCheckExisting);

if (mysqli_stmt_num_rows($stmtCheckExisting) > 0) {
    // Product exists in Stock, update the quantity
    $sqlUpdateStock = "UPDATE Stock SET Quantity=Quantity+? WHERE ProductID=?";
    $stmtUpdateStock = mysqli_stmt_init($conn);
    
    mysqli_stmt_prepare($stmtUpdateStock, $sqlUpdateStock);
    mysqli_stmt_bind_param($stmtUpdateStock, "ii", $Quantity, $ProductID);
    mysqli_stmt_execute($stmtUpdateStock);
    
    mysqli_stmt_close($stmtUpdateStock);
} else {
    // Product doesn't exist in Stock, insert a new record
    $sqlInsertStock = "INSERT INTO Stock(ProductID, Quantity) VALUES (?, ?)";
    $stmtInsertStock = mysqli_stmt_init($conn);
    
    mysqli_stmt_prepare($stmtInsertStock, $sqlInsertStock);
    mysqli_stmt_bind_param($stmtInsertStock, "ii", $ProductID, $Quantity);
    mysqli_stmt_execute($stmtInsertStock);
    
    mysqli_stmt_close($stmtInsertStock);
}

// Insert supply information
$sqlSupply = "INSERT INTO Supply (SupplierID, ProductID, Date, Total, Quantity) VALUES (?,?,?,?,?)";
$stmtSupply = mysqli_stmt_init($conn);

if ($TotalPrice === null) {
    $TotalPrice = 0;
}

mysqli_stmt_prepare($stmtSupply, $sqlSupply);
mysqli_stmt_bind_param($stmtSupply, "iisdi", $SupplierID, $ProductID, $Date, $TotalPrice, $Quantity);
mysqli_stmt_execute($stmtSupply);

echo "Changes Successful";

mysqli_stmt_close($stmtSupply);
mysqli_close($conn);
?>

    <br><br>
    
 
    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka </p>
    </footer>
    </body>
</html>


