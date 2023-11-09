<?php
session_start();
include "db.php";
$customer_id = $_SESSION['customer_id'];

// Assuming you have established a database connection

if (isset($_GET['cart_item_id'])) {
    $cartItemId = $_GET['cart_item_id'];

    // Prepare the SQL statement to delete the item from the cart for a specific user
    $sql = "DELETE FROM cart WHERE cart_item_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($mysqli, $sql);

    // Bind the parameter values
    mysqli_stmt_bind_param($stmt, "ii", $cartItemId, $customer_id);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    // Close the database connection
    mysqli_close($mysqli);

    // Set a session variable to indicate successful removal
    $_SESSION['item_removed'] = true;

    // Redirect back to the shopping cart page
    header("Location: cart.php");
    exit();
}
?>
