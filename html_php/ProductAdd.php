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

    // Establish a connection to the database
    $host = "localhost";
    $dbname = "project_database";
    $username = "root";
    $password = "";
    
    $conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
$ProductName = $_POST["ProductName"];


$img_name = $_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];
$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
$img_ex_lc = strtolower($img_ex);
$allowed_ex = array("jpg", "jpeg", "png");

if (in_array($img_ex_lc, $allowed_ex)){
    $new_img_name = uniqid("IMG-",true).'.'.$img_ex_lc;
    $img_upload_path = '../uploads/'.$new_img_name;
    move_uploaded_file($tmp_name, $img_upload_path);
}
else{
    echo 'File is not image file...';
}



$Price = $_POST["Price"];
$tagPrice = $_POST["tagPrice"];
$SellingPrice = $_POST["SellingPrice"];
$description = mysqli_real_escape_string($conn, $_POST["description"]);




    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to insert the Product details
    $sql = "INSERT INTO Product (ProductName, Price, image_url, tagPrice_percentage, SellingPrice_percentage,Description)
            VALUES ('$ProductName', '$Price', '$new_img_name', $tagPrice, $SellingPrice, '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully";
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