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
$host = "localhost";
$dbname = "project_database";
$username = "root";
$password = "";

// Establish a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted ProductID from the form
    $ProductID = $_POST["ProductID"];

    // Retrieve other submitted form data
    $ProductID = $_POST["ProductID"];
    $ProductName = $_POST["ProductName"];
    $Price = $_POST["Price"];
    $tagPrice = $_POST["tagPrice"];
    $SellingPrice = $_POST["SellingPrice"];
    
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

    $description = $_POST["description"];

    // Construct the SQL query to update the Product information in the database
    $sql = "UPDATE Product SET 
                ProductID = '$ProductID',
                ProductName = '$ProductName',
                Price = '$Price',
                image_url = '$new_img_name',
                TagPrice_percentage = '$tagPrice',
                SellingPrice_percentage = '$SellingPrice',
                Description = '$description'
            WHERE ProductID = '$ProductID'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Product information updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
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


