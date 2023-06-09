<?php
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

$email = $_SESSION['email']; // Get the user's email from the session

// Include database connection and retrieve statistics
include('connection.php');

// Retrieve total patients count
$sqlTotalPatients = "SELECT COUNT(*) AS total_patients FROM members";
$resultTotalPatients = $conn->query($sqlTotalPatients);
$totalPatients = $resultTotalPatients->fetch_assoc()['total_patients'];

// Retrieve total invoices count
$sqlTotalInvoices = "SELECT COUNT(*) AS total_invoices FROM billing_invoices";
$resultTotalInvoices = $conn->query($sqlTotalInvoices);
$totalInvoices = $resultTotalInvoices->fetch_assoc()['total_invoices'];

// Retrieve total test requests count
$sqlTotalTestRequests = "SELECT COUNT(*) AS total_test_requests FROM test_requests";
$resultTotalTestRequests = $conn->query($sqlTotalTestRequests);
$totalTestRequests = $resultTotalTestRequests->fetch_assoc()['total_test_requests'];

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }
        
        .card-title {
            color: #333;
            font-weight: bold;
        }
        
        .card-text {
            font-size: 24px;
            color: #777;
        }
        
        .container {
            padding-top: 20px;
        }
        
        .navbar {
            background-color: #333;
            color: #fff;
        }
        
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }
        
        .navbar .nav-link {
            color: #fff;
        }
        
        .navbar .nav-link:hover {
            color: #ccc;
        }
    </style>
</head>
<body>
    <?php include('manager_navbar.php'); ?>

    <div class="container">
        <h2>Statistics Dashboard</h2>

        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Patients</h5>
                        <p class="card-text text-light"><?php echo $totalPatients; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Invoices</h5>
                        <p class="card-text text-light"><?php echo $totalInvoices; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Total Test Requests</h5>
                        <p class="card-text text-light"><?php echo $totalTestRequests; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
