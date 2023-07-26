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
                <li><a href="Home.php"> Home </a></li>
                <li><a href="cart.php"> Cart </a></li>
                <li><a href="orderNow.php"> Order Now </a></li>
                <li><a href="Track_order.html"> Track the Order </a></li>
                <li><a href="contacts.html"> Contacts Us </a></li>
                <li><a href="Rating.html"> Rate Us </a></li>
                <li><a href="Aboutus.html"> About Us </a></li>   
            </ul>    
        </div>

        <?php
        $host = "localhost";
        $username = "root";
        $dbpassword = "";
        $dbname = "project_database";

        $conn = mysqli_connect($host, $username, $dbpassword, $dbname);

        if (mysqli_connect_errno()) {
            die("Connection error: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $CustomerID = $_POST["CustomerID"];
            $password = $_POST["password"];
            
            $checkQuery = "SELECT * FROM customer WHERE Customer_ID = ? AND password = ?";
            $stmt = mysqli_stmt_init($conn);
            
            if (mysqli_stmt_prepare($stmt, $checkQuery)) {
                mysqli_stmt_bind_param($stmt, "ss", $CustomerID, $password);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                if (mysqli_num_rows($result) == 1) {
                    // Login successful, redirect to home page with CustomerID
                    session_start();
                    $_SESSION['CustomerID'] = $CustomerID;
                    header("Location: Home.php?CustomerID=$CustomerID");
                    exit();
                } else {
                    echo "Invalid CustomerID or password";
                }
            }
        }
        ?>

    </body>

    <footer>  
        <p>&copy; 2023 Online Shopping, Sri Lanka, All rights reserved.</p>
    </footer>
</html>
