<?php
session_start();
if (!isset($_SESSION['adminlogin']) || !$_SESSION['adminlogin']) {
    header('location: adminlogin.php');
    exit();
}

// Include database connection and retrieve statistics
include('config.php');

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

// Retrieve pending manager requests count
$sqlPendingManagerRequests = "SELECT COUNT(*) AS pending_manager_requests FROM managers WHERE status = 'pending'";
$resultPendingManagerRequests = $conn->query($sqlPendingManagerRequests);
$pendingManagerRequests = $resultPendingManagerRequests->fetch_assoc()['pending_manager_requests'];

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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
    <?php include('admin_navbar.php'); ?>

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
            <div class="col-md-3">
                <div class="card bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Pending Manager Requests</h5>
                        <p class="card-text text-dark"><?php echo $pendingManagerRequests; ?></p>
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
