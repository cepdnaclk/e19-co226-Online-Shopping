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
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $address = $_POST["Address"];
    $mobileNumber = $_POST["MobileNumber"];
    $salary = $_POST["Salary"];
    $jobType = $_POST["JobType"];
    $branch = $_POST["Branch"];

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

    // Prepare and execute the SQL query to retrieve the BranchID based on BranchName
    $branchQuery = "SELECT BranchID FROM branches WHERE BranchName = '$branch'";
    $result = $conn->query($branchQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $branchID = $row["BranchID"];
    } else {
        echo "Error: Branch not found";
        // You may consider redirecting the user back to the form or showing an appropriate error message
        exit;
    }

    // Prepare and execute the SQL query to insert the employee details
    $sql = "INSERT INTO employee (FirstName, LastName, Address, ContactNo, Salary , JobType, BranchID)
            VALUES ('$firstName', '$lastName', '$address', '$mobileNumber', '$salary', '$jobType', '$branchID')";

    if ($conn->query($sql) === TRUE) {
        echo "Employee added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


 
    <br><br>
    
    </body>
    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka </p>
    </footer>

</html>


