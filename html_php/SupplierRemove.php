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

    // Construct the SQL query to delete the employee from the database
    $sql = "DELETE FROM supplier WHERE SupplierID = '$SupplierID'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Employee removed successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
