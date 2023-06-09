<?php
// Your database connection code
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

$email = $_SESSION['email']; // Get the user's email from the session

// Include database connection and retrieve statistics
include('connection.php');

// Add test detail
if (isset($_POST['add_test'])) {
    $testName = $_POST['test_name'];
    $testCategory = $_POST['test_category'];
    $cost = $_POST['cost'];
    $reportingTime = $_POST['reporting_time'];

    // Retrieve category name
    $categoryQuery = "SELECT category_name FROM diagnostic_categories WHERE category_id = $testCategory";
    $categoryResult = mysqli_query($conn, $categoryQuery);
    $categoryRow = mysqli_fetch_assoc($categoryResult);
    $categoryName = $categoryRow['category_name'];

    $query = "INSERT INTO test_details (test_name, category_id, category_name, cost, reporting_time) VALUES ('$testName', $testCategory, '$categoryName', '$cost', '$reportingTime')";
    mysqli_query($conn, $query);
    // Redirect or display success message
}

// Edit test detail
if (isset($_POST['edit_test'])) {
    $testId = $_POST['test_id'];
    $testName = $_POST['test_name'];
    $testCategory = $_POST['test_category'];
    $cost = $_POST['cost'];
    $reportingTime = $_POST['reporting_time'];

    // Retrieve category name
    $categoryQuery = "SELECT category_name FROM diagnostic_categories WHERE category_id = $testCategory";
    $categoryResult = mysqli_query($conn, $categoryQuery);
    $categoryRow = mysqli_fetch_assoc($categoryResult);
    $categoryName = $categoryRow['category_name'];

    $query = "UPDATE test_details SET test_name = '$testName', category_id = $testCategory, category_name = '$categoryName', cost = '$cost', reporting_time = '$reportingTime' WHERE test_id = $testId";
    mysqli_query($conn, $query);
    // Redirect or display success message
}

// Delete test detail
if (isset($_GET['delete_test'])) {
    $testId = $_GET['delete_test'];
    $query = "DELETE FROM test_details WHERE test_id = $testId";
    mysqli_query($conn, $query);
    // Redirect or display success message
}

// Display test details
$query = "SELECT * FROM test_details";
$result = mysqli_query($conn, $query);

// Fetch diagnostic test categories
$categoryQuery = "SELECT * FROM diagnostic_categories";
$categories = mysqli_query($conn, $categoryQuery);
?>
<?php
include('manager_navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Test Details</h2>

        <!-- Add test detail form -->
        <h3>Add Test Detail</h3>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" class="form-control" name="test_name" placeholder="Test Name">
            </div>
            <div class="form-group">
                <select class="form-control" name="test_category">
                    <?php while ($category = mysqli_fetch_assoc($categories)) { ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="cost" placeholder="Cost">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="reporting_time" placeholder="Reporting Time">
            </div>
            <button type="submit" name="add_test" class="btn btn-primary">Add</button>
        </form>

        <!-- Edit/Delete test details -->
        <h3>Edit/Delete Test Details</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Test ID</th>
                    <th>Test Name</th>
                    <th>Category</th>
                    <th>Cost</th>
                    <th>Reporting Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['test_id']; ?></td>
                        <td><?php echo $row['test_name']; ?></td>
                        <td><?php echo $row['category_name']; ?></td>
                        <td><?php echo $row['cost']; ?></td>
                        <td><?php echo $row['reporting_time']; ?></td>
                        <td>
                            <a href="edit_test.php?test_id=<?php echo $row['test_id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="?delete_test=<?php echo $row['test_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
