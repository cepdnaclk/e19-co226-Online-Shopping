<?php
$customerID = $_POST["customerID"];

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

$response = array();

if (mysqli_num_rows($result) > 0) {
    // CustomerID already exists
    $response["available"] = false;
    $response["message"] = "CustomerID already taken. Please choose a different CustomerID.";
} else {
    // CustomerID is available
    $response["available"] = true;
    $response["message"] = "CustomerID is available.";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

echo json_encode($response);
?>
