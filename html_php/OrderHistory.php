<!DOCTYPE html>
<html>
<head>
    <title>Online Shopping</title>
    <link rel="icon" href="Logo.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../css/test.css" />
    <link rel="stylesheet" type="text/css" href="../css/styles.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container pt-2 pb-2">
        <div class="row">
            <div class="col-sm-1"> <img class="logoimg" src="../images/LogoFinal.jpg" alt="Logo"> </div>
            <div class="col-sm-8 text-danger"> <h2>The largest online shopping platform in Sri Lanka.</h2> </div>
        <?php
        session_start();

        if (isset($_SESSION['CustomerID'])) {
            // User is logged in
            echo '<div class="col-sm-1"> </div>';
            echo '<div class="col-sm-1">  </div>';
            echo '<div class="col-sm-1"> <a href="Logout.php"> <button type="button" class="btn btn-outline-primary"> Log out </button> </a> </div>';
            
        } else {
            // User is not logged in
            echo '<div class="col-sm-1"> <a href="Login.html"> <button type="button" class="btn btn-outline-primary"> Log in </button> </a> </div>';
            echo '<div class="col-sm-1"> <a href="Signup.html"><button type="button" class="btn btn-outline-primary"> Sign up </button></a> </div>';
            echo '<div class="col-sm-1"> <a href="admin.html"> <button type="button" class="btn btn-outline-primary"> Admin </button></a> </div>';
        }
        ?>
        </div>
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

    <div class="container pt-2">
    <?php

        // Check if the user is logged in (has a `CustomerID` in the session)
        if (isset($_SESSION['CustomerID'])) {

            $host = "localhost";
            $dbname = "project_database";
            $username = "root";
            $password = "";

            $conn = mysqli_connect($host, $username, $password, $dbname);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            $loggedInCustomerID = $_SESSION['CustomerID'];

            $sql = "SELECT `o`.`OrderNo`,`o`.`Customer_ID`, `o`.`Delivery_Address_No`, `o`.`Delivery_Address`, `o`.`Delivery_Address_city`, `o`.`Status`, `c`.`ProductID`, `c`.`No_of_Product`
                    FROM `order` AS `o`
                    JOIN `contain` AS `c` ON `o`.`OrderNo` = `c`.`OrderNo`
                    WHERE `o`.`Customer_ID` = '$loggedInCustomerID'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo '<table class="table table-striped">';
                echo '<tr>
                        <th>Order No.</th>
                        <th>Delivery Address</th>
                        <th>Status</th>
                        <th>Contained Products ID</th>
                        <th>Quantity</th>
                      </tr>';

                $currentOrderNo = null;

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row["OrderNo"] . '</td>';
                    echo '<td>' . $row["Delivery_Address_No"] . ' ' . $row["Delivery_Address"] . ' ' . $row["Delivery_Address_city"] . '</td>';
                    echo '<td>' . $row["Status"] . '</td>';
                    echo '<td>' . $row["ProductID"] . '</td>';
                    echo '<td>' . $row["No_of_Product"] . '</td>';
                    echo '</tr>';

                    $currentOrderNo = $row["OrderNo"];
                }

                echo '</table>';
            } else {
                echo "No orders yet";
            }
        } else {
            // User is not logged in, redirect to login page
            echo "<script>alert ('Please, log in to see order History.') </script>";
            header("Location: login.html");
            exit; // Always exit after a header redirect
        }
        ?>
    </div>

    <br><br>

    <footer>
        <p>&copy; 2023 Online Shopping, Sri Lanka, All rights reserved.</p>
    </footer>
</body>
</html>