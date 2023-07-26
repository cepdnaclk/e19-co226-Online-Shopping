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
                <li ><a href=Home.php> Home </a></li>
                <li ><a href=cart.php> Cart </a></li>
                <li ><a href=orderNow.php> Order Now </a></li>
                <li ><a href=Track_order.html> Track the Order </a></li>
                <li ><a href=contacts.html> Contacts Us </a></li>
                <li ><a href=Rating.html> Rate Us </a></li>
                <li ><a href=Aboutus.html> About Us </a></li>   
            </ul>    
        </div>


<h1 class="signupphp">


<?php

$Comments = $_POST["Comments"];
$Rating = $_POST["Rating"];


$host = "localhost";
$dbname = "project_database";
$username = "root";
$password = "";

$conn = mysqli_connect(
    $host, 
    $username,
    $password,
    $dbname
);


if (mysqli_connect_errno()){
    die("Connection error: ". mysqli_connect_error());
}


$sql = "INSERT INTO Rating(Comment, Rating) VALUES (?,?)";

$stmt = mysqli_stmt_init($conn);

if (! mysqli_stmt_prepare($stmt, $sql)){
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt, "si",
    $Comments,
    $Rating
);

mysqli_stmt_execute($stmt);

echo "Hello".", ".$_POST["FirstName"]." ".$_POST["LastName"]." !";
echo "<br>"."<br>";
echo "Thank you for sign up our website"; 

?>

</h1>


    <br>
    <br>
              

    </body>


    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka </p>
    </footer>

</html>






