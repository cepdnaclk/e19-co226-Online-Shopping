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
    // Retrieve the submitted SupplierID from the form
    $SupplierID = $_POST["SupplierID"];

    // Retrieve other submitted form data
    $Name = $_POST["Name"];
    $ContactNo = $_POST["ContactNo"];
    $Address = $_POST["Address"];


    // Construct the SQL query to update the Supplier information in the database
    $sql = "UPDATE Supplier SET 
                Name = '$Name',
                Contact_No = '$ContactNo',
                Address = '$Address'
            WHERE SupplierID = '$SupplierID'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Supplier information updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
