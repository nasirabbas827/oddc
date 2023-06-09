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

// Add category
if (isset($_POST['add_category'])) {
    $categoryName = $_POST['category_name'];
    $query = "INSERT INTO diagnostic_categories (category_name) VALUES ('$categoryName')";
    mysqli_query($conn, $query);
    // Redirect or display success message
}

// Edit category
if (isset($_POST['edit_category'])) {
    $categoryId = $_POST['category_id'];
    $newCategoryName = $_POST['category_name'];
    $query = "UPDATE diagnostic_categories SET category_name = '$newCategoryName' WHERE category_id = $categoryId";
    mysqli_query($conn, $query);
    // Redirect or display success message
}

// Delete category
if (isset($_GET['delete_category'])) {
    $categoryId = $_GET['delete_category'];
    $categoryId = mysqli_real_escape_string($conn, $categoryId); // Sanitize the input
    $query = "DELETE FROM diagnostic_categories WHERE category_id = '$categoryId'";
    mysqli_query($conn, $query);
    // Redirect or display success message

    // Add a redirection after deleting the category
    header("Location: manager_test.php");
    exit(); // Important to prevent further execution of the script
}

// Display categories
$query = "SELECT * FROM diagnostic_categories";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Diagnostic Test Categories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php include('manager_navbar.php'); ?>

<div class="container mt-5">
    <h2>Diagnostic Test Categories</h2>

    <!-- Add category form -->
    <h3>Add Category</h3>
    <form method="POST" action="">
        <div class="form-group">
            <input type="text" name="category_name" placeholder="Category Name" class="form-control">
        </div>
        <button type="submit" name="add_category" class="btn btn-primary">Add</button>
    </form>

    <!-- Edit/Delete categories -->
    <h3>Edit/Delete Categories</h3>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td>
                        <a href="edit_category.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-secondary">Edit</a>
                        <a href="?delete_category=<?php echo $row['category_id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
