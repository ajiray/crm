<?php
session_start();
include "db.php";
$customer_id = $_SESSION['customer_id'];

if (isset($_POST['Add-to-Cart'])) {
  $color = mysqli_real_escape_string($mysqli, $_POST["color"]); // Escape the color value
  $size = mysqli_real_escape_string($mysqli, $_POST["size"]); // Escape the size value
  $name = mysqli_real_escape_string($mysqli, $_POST["name"]); // Escape the size value

  // Prepare the SQL statement with placeholders
  $sql = "SELECT * FROM product WHERE color = ? AND size = ? AND name = ?";

  // Prepare and bind the parameters
  $stmt = mysqli_prepare($mysqli, $sql);
  mysqli_stmt_bind_param($stmt, "sss", $color, $size, $name);

  // Execute the prepared statement
  mysqli_stmt_execute($stmt);

  // Fetch the results
  $result = mysqli_stmt_get_result($stmt);

  if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the row from the result set
    $row = mysqli_fetch_assoc($result);

    // Assign the column values to variables
    $prodId = $row['product_id'];

    // Check if the product is already in the cart for the current user
    $sql2 = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt2 = mysqli_prepare($mysqli, $sql2);
    mysqli_stmt_bind_param($stmt2, "ii", $customer_id, $prodId);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);

    if ($result2 && mysqli_num_rows($result2) > 0) {
      // Product already exists in the cart, handle it accordingly (e.g., display an error message)
      header("Location: shop.php?error=This item is already in your cart");
    } else {
      // Insert the product into the cart
      $sql3 = "INSERT INTO cart (user_id, product_id) VALUES (?, ?)";
      $stmt3 = mysqli_prepare($mysqli, $sql3);
      mysqli_stmt_bind_param($stmt3, "ii", $customer_id, $prodId);
      $result3 = mysqli_stmt_execute($stmt3);

      if ($result3) {
        // Cart item added successfully, redirect to index.php
        header("Location: shop.php?add=Item added to your cart");
        exit();
      } else {
        // Handle the insertion error
        echo "Failed to add item to cart: " . mysqli_error($mysqli);
      }
      mysqli_stmt_close($stmt3); // Close the statement
    }
    mysqli_stmt_close($stmt2); // Close the statement
  } else {
    // No matching product found
    echo "No product found with the specified color and size.";
  }

  // Close the statements and database connection
  mysqli_stmt_close($stmt);
  mysqli_close($mysqli);
} elseif (isset($_POST['Buy-Now'])) {
  $color = mysqli_real_escape_string($mysqli, $_POST["color"]); // Escape the color value
  $size = mysqli_real_escape_string($mysqli, $_POST["size"]); // Escape the size value
  $name = mysqli_real_escape_string($mysqli, $_POST["name"]); // Escape the size value

  // Prepare the SQL statement with placeholders
  $sql = "SELECT * FROM product WHERE color = ? AND size = ? AND name = ?";

  // Prepare and bind the parameters
  $stmt = mysqli_prepare($mysqli, $sql);
  mysqli_stmt_bind_param($stmt, "sss", $color, $size, $name);

  // Execute the prepared statement
  mysqli_stmt_execute($stmt);

  // Fetch the results
  $result = mysqli_stmt_get_result($stmt);

  if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the row from the result set
    $row = mysqli_fetch_assoc($result);

    // Assign the column values to variables
    $prodId = $row['product_id'];

    // Check if the product is already in the cart for the current user
    $sql2 = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt2 = mysqli_prepare($mysqli, $sql2);
    mysqli_stmt_bind_param($stmt2, "ii", $customer_id, $prodId);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);

    if ($result2 && mysqli_num_rows($result2) > 0) {
      // Product already exists in the cart, handle it accordingly (e.g., display an error message)
      header("Location: shop.php?error=This item is already in your cart");
    } else {
      // Insert the product into the cart
      $sql3 = "INSERT INTO cart (user_id, product_id) VALUES (?, ?)";
      $stmt3 = mysqli_prepare($mysqli, $sql3);
      mysqli_stmt_bind_param($stmt3, "ii", $customer_id, $prodId);
      $result3 = mysqli_stmt_execute($stmt3);

      if ($result3) {
        // Cart item added successfully, redirect to cart.php
        header("Location: cart.php");
        exit();
      } else {
        // Handle the insertion error
        echo "Failed to add item to cart: " . mysqli_error($mysqli);
      }
      mysqli_stmt_close($stmt3); // Close the statement
    }
    mysqli_stmt_close($stmt2); // Close the statement
  } else {
    // No matching product found
    echo "No product found with the specified color and size.";
  }

  // Close the statements and database connection
  mysqli_stmt_close($stmt);
  mysqli_close($mysqli);
} else {
  echo "test";
  die();
}
?>
