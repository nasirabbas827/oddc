<?php
// Get the request ID, test name, category name, date requested, patient name, patient email, cost, and reporting time from the URL parameters
$requestId = isset($_GET['request_id']) ? $_GET['request_id'] : '';
$testName = isset($_GET['test_name']) ? $_GET['test_name'] : '';
$categoryName = isset($_GET['category_name']) ? $_GET['category_name'] : '';
$dateRequested = isset($_GET['date_requested']) ? $_GET['date_requested'] : '';
$patientName = isset($_GET['patient_name']) ? $_GET['patient_name'] : '';
$patientEmail = isset($_GET['patient_email']) ? $_GET['patient_email'] : '';
$cost = isset($_GET['cost']) ? $_GET['cost'] : '';
$reportingTime = isset($_GET['reporting_time']) ? $_GET['reporting_time'] : '';

// Company information
$companyName = "Online Diagnostic Center";

// Generate the invoice content
$invoiceContent = "
    <h2>Invoice</h2>
    <p>Request ID: $requestId</p>
    <p>Patient Name: $patientName</p>
    <p>Patient Email: $patientEmail</p>
    <p>Category Name: $categoryName</p>
    <p>Test Name: $testName</p>
    <p>Date Requested: $dateRequested</p>
    <p>Cost: RS $cost</p>
    <p>Reporting Time: $reportingTime Hours</p>
    <p>Additional invoice details and billing information can be added here.</p>
    <hr>
    <p>Thank you for choosing $companyName!</p>
    <p>If you have any inquiries, please contact our customer support.</p>
";

// Output the invoice content
echo $invoiceContent;
?>

<script>
    // Print the invoice window
    window.onload = function() {
        window.print();
    };
</script>
