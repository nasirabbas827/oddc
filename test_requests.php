<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Your database connection code
include('connection.php');


// Retrieve logged-in patient details (replace with your authentication mechanism)
$patientId = $_SESSION['id'];
$query = "SELECT Username, Email, contactno FROM members WHERE id = $patientId";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$patientName = $row['Username'];
$patientEmail = $row['Email'];
$patientContactNo = $row['contactno'];

// Add test request
if (isset($_POST['submit_request'])) {
    $testId = $_POST['test_id'];
    $categoryId = $_POST['category_id'];
    $categoryName = $_POST['category_name'];

    // Fetch the test details including test name, cost, and reporting time
    $testQuery = "SELECT test_name, cost, reporting_time FROM test_details WHERE test_id = $testId";
    $testResult = mysqli_query($conn, $testQuery);
    $testRow = mysqli_fetch_assoc($testResult);
    $testName = $testRow['test_name'];
    $cost = $testRow['cost'];
    $reportingTime = $testRow['reporting_time'];

    $dateRequested = date('Y-m-d'); // Get the current date
    $query = "INSERT INTO test_requests (patient_name, test_id, patient_email, patient_contactno, status, date_requested, test_name, cost, reporting_time, category_id, category_name) VALUES ('$patientName', $testId, '$patientEmail', '$patientContactNo', 'pending', '$dateRequested', '$testName', $cost, '$reportingTime', $categoryId, '$categoryName')";
    mysqli_query($conn, $query);

    // Display success message
    $successMessage = "Test request submitted successfully!";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Request</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<?php
include('navbar.php');
?>
    <div class="container mt-4">
        <!-- Select test category -->
        <h3>Select Test Category</h3>
        <form method="POST" action="">
            <div class="form-group">
                <select class="form-control" name="category_id" id="category_id">
                    <?php
                    // Fetch test categories
                    $categoryQuery = "SELECT * FROM diagnostic_categories";
                    $categories = mysqli_query($conn, $categoryQuery);
                    while ($category = mysqli_fetch_assoc($categories)) {
                        ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" name="select_category" class="btn btn-primary">Select Category</button>
        </form>

        <?php
        if (isset($_POST['select_category'])) {
            $categoryId = $_POST['category_id'];
            // Fetch category name
            $categoryNameQuery = "SELECT category_name FROM diagnostic_categories WHERE category_id = $categoryId";
            $categoryNameResult = mysqli_query($conn, $categoryNameQuery);
            $categoryNameRow = mysqli_fetch_assoc($categoryNameResult);
            $categoryName = $categoryNameRow['category_name'];

            // Fetch test details based on selected category
            $testQuery = "SELECT * FROM test_details WHERE category_id = $categoryId";
            $tests = mysqli_query($conn, $testQuery);
            if (mysqli_num_rows($tests) > 0) {
                ?>
                <!-- Select test -->
                <h3 class="mt-4">Select Test</h3>
                <form method="POST" action="">
                    <input type="hidden" name="category_id" value="<?php echo $categoryId; ?>">
                    <input type="hidden" name="category_name" value="<?php echo $categoryName; ?>">

                    <div class="form-group">
                        <label for="test_id">Select Test</label>
                        <select class="form-control" name="test_id">
                            <?php
                            while ($test = mysqli_fetch_assoc($tests)) {
                                ?>
                                <option value="<?php echo $test['test_id']; ?>"><?php echo $test['test_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="add_request" class="btn btn-primary">Choose</button>
                </form>
        <?php
            } else {
                echo "<p>No tests available for this category.</p>";
            }
        }
        ?>

        <!-- Test Request Form -->
        <?php
        if (isset($_POST['add_request'])) {
            $categoryId = $_POST['category_id']; // Retrieve the category ID from the form submission
            $categoryName = $_POST['category_name']; // Retrieve the category name from the form submission
            $testId = $_POST['test_id'];

            // Fetch the test details including test name, cost, and reporting time
            $testQuery = "SELECT test_name, cost, reporting_time FROM test_details WHERE test_id = $testId";
            $testResult = mysqli_query($conn, $testQuery);
            $testRow = mysqli_fetch_assoc($testResult);
            $testName = $testRow['test_name'];
            $cost = $testRow['cost'];
            $reportingTime = $testRow['reporting_time'];

            ?>
            <h3 mt-3>Test Request Form</h3>
            <form method="POST" action="">
                <input type="hidden" name="category_id" value="<?php echo $categoryId; ?>">
                <input type="hidden" name="category_name" value="<?php echo $categoryName; ?>">
                <input type="hidden" name="test_id" value="<?php echo $testId; ?>">

                <div class="form-group">
                    <label for="patient_name">Patient Name</label>
                    <input type="text" name="patient_name" value="<?php echo $patientName; ?>" readonly class="form-control">
                </div>

                <div class="form-group">
                    <label for="patient_email">Patient Email</label>
                    <input type="email" name="patient_email" value="<?php echo $patientEmail; ?>" readonly class="form-control">
                </div>

                <div class="form-group">
                    <label for="patient_contact">Contact No</label>
                    <input type="text" name="patient_contact" value="<?php echo $patientContactNo; ?>" readonly class="form-control">
                </div>

                <div class="form-group">
                    <label for="test_category">Test Category</label>
                    <input type="text" name="test_category" value="<?php echo $categoryName; ?>" readonly class="form-control">
                </div>

                <div class="form-group">
                    <label for="test_name">Test Name</label>
                    <input type="text" name="test_name" value="<?php echo $testName; ?>" readonly class="form-control">
                </div>

                <div class="form-group">
                    <label for="test_cost">Cost</label>
                    <input type="text" name="test_cost" value="<?php echo $cost; ?>" readonly class="form-control">
                </div>

                <div class="form-group">
                    <label for="reporting_time">Reporting Time</label>
                    <input type="text" name="reporting_time" value="<?php echo $reportingTime; ?>" readonly class="form-control">
                </div>

                <button type="submit" name="submit_request" class="btn btn-primary mb-4">Submit Request</button>
            </form>
        <?php
        }
        ?>

        <!-- Success message -->
        <?php
        if (isset($successMessage)) {
            echo "<p class='mt-3 alert alert-success'>$successMessage</p>";
        }
        ?>
    </div>
</body>

</html>
