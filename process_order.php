<?php
session_start();
include "db.php";
$totalPrice = 0;
$customer_id = $_SESSION['customer_id'];
$quantities = $_POST["quantity"];

// Assuming you have established a database connection
$userSql = "SELECT name, emailadd, address FROM user WHERE customer_id = ?";
$userStmt = mysqli_prepare($mysqli, $userSql);

$stmt = mysqli_prepare($mysqli, $userSql);

// Bind the parameter value
mysqli_stmt_bind_param($stmt, "i", $customer_id);

// Execute the query
mysqli_stmt_execute($stmt);

// Fetch the result
$result2 = mysqli_stmt_get_result($stmt);

// Prepare the SQL statement to retrieve products from the cart
$sql = "SELECT cart.cart_item_id, product.product_id, product.name, product.color, product.size, product.price, product.image, product.stock, product.sold
        FROM cart
        INNER JOIN product ON cart.product_id = product.product_id
        WHERE cart.user_id = ?";
$stmt = mysqli_prepare($mysqli, $sql);

// Bind the parameter value
mysqli_stmt_bind_param($stmt, "i", $customer_id);

// Execute the query
mysqli_stmt_execute($stmt);

// Fetch the result
$result = mysqli_stmt_get_result($stmt);

// Start the transaction
mysqli_autocommit($mysqli, false);

// Variable to track if any stock is insufficient
$insufficientStock = false;

try {
    // Update the stock and calculate the total price
    while ($row = mysqli_fetch_assoc($result)) {
        $productPrice = $row['price'];
        $productId = $row['product_id'];
        $cartItemId = $row['cart_item_id'];
        $quantity = isset($quantities[$cartItemId]) ? $quantities[$cartItemId] : 0;

        $quantity = intval($quantity); // Convert the quantity to an integer

        // Calculate the subtotal for each product
        $subtotal = $productPrice * $quantity;

        // Add the subtotal to the total price
        $totalPrice += $subtotal;

        //clean cart of the user after processing order
        $emptyCartSql = "DELETE FROM cart WHERE user_id = ?";
        $emptyCartStmt = mysqli_prepare($mysqli, $emptyCartSql);
        mysqli_stmt_bind_param($emptyCartStmt, "i", $customer_id);
        mysqli_stmt_execute($emptyCartStmt);


        $updatedSold = $row['sold'] + $quantity; // Calculate the new value for the sold column
$updatedProfit = $updatedSold * $productPrice; // Calculate the new value for the profit column
$updateSoldSql = "UPDATE product SET sold = ?, profit = ? WHERE product_id = ?";
$updateSoldStmt = mysqli_prepare($mysqli, $updateSoldSql);
mysqli_stmt_bind_param($updateSoldStmt, "idi", $updatedSold, $updatedProfit, $productId);
mysqli_stmt_execute($updateSoldStmt);

// ...

$insertTransactionSql = "INSERT INTO transaction (customer_id, product_id, sold, profit, date) VALUES (?, ?, ?, ?, CURDATE())";
  $insertTransactionStmt = mysqli_prepare($mysqli, $insertTransactionSql);
  mysqli_stmt_bind_param($insertTransactionStmt, "iiii", $customer_id, $productId, $updatedSold, $updatedProfit);
  mysqli_stmt_execute($insertTransactionStmt);
  mysqli_stmt_close($insertTransactionStmt);

// ...


        // Check if stock is sufficient
        if ($row['stock'] < $quantity) {
            $insufficientStock = true;
            break;
        }

        // Update the stock in the database
        $updatedStock = $row['stock'] - $quantity;
        $updateStockSql = "UPDATE product SET stock = ? WHERE product_id = ?";
        $updateStockStmt = mysqli_prepare($mysqli, $updateStockSql);
        mysqli_stmt_bind_param($updateStockStmt, "ii", $updatedStock, $productId);
        mysqli_stmt_execute($updateStockStmt);
    }

    if ($insufficientStock) {
        throw new Exception("Insufficient stock for one or more products.");
    }

    // Commit the transaction
    mysqli_commit($mysqli);
} catch (Exception $e) {
    // Rollback the transaction on exception
    mysqli_rollback($mysqli);
    mysqli_autocommit($mysqli, true);

    // Handle the exception (e.g., display an error message)
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Processing</title>
    <script>
        setTimeout(function(){
            window.location.href = "afterprocess.php";
        }, 5000); // Redirect to shop.php after 3 seconds
    </script>
</head>
<style>
     :root {
      --primary-color: #7dcfb6;
      --secondary-color: #00b2ca;
      --tertiary-color: #fbd1a2;
    }
body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: Arial, sans-serif;
    font-size: 18px;
    overflow: hidden;
}

.processing-container {
    min-width: 400px;
    min-height: 200px;
    padding: 20px;
    text-align: center;
}

.typewriter {
  --blue: #5C86FF;
  --blue-dark: #275EFE;
  --key: #fff;
  --paper: #EEF0FD;
  --text: #D3D4EC;
  --tool: #FBC56C;
  --duration: 3s;
  position: relative;
  -webkit-animation: bounce05 var(--duration) linear infinite;
  animation: bounce05 var(--duration) linear infinite;
  margin-left: 33.5%;
}

.typewriter .slide {
  width: 92px;
  height: 20px;
  border-radius: 3px;
  margin-left: 14px;
  transform: translateX(14px);
  background: linear-gradient(var(--blue), var(--blue-dark));
  -webkit-animation: slide05 var(--duration) ease infinite;
  animation: slide05 var(--duration) ease infinite;
}

.typewriter .slide:before, .typewriter .slide:after,
.typewriter .slide i:before {
  content: "";
  position: absolute;
  background: var(--tool);
}

.typewriter .slide:before {
  width: 2px;
  height: 8px;
  top: 6px;
  left: 100%;
}

.typewriter .slide:after {
  left: 94px;
  top: 3px;
  height: 14px;
  width: 6px;
  border-radius: 3px;
}

.typewriter .slide i {
  display: block;
  position: absolute;
  right: 100%;
  width: 6px;
  height: 4px;
  top: 4px;
  background: var(--tool);
}

.typewriter .slide i:before {
  right: 100%;
  top: -2px;
  width: 4px;
  border-radius: 2px;
  height: 14px;
}

.typewriter .paper {
  position: absolute;
  left: 24px;
  top: -26px;
  width: 40px;
  height: 46px;
  border-radius: 5px;
  background: var(--paper);
  transform: translateY(46px);
  -webkit-animation: paper05 var(--duration) linear infinite;
  animation: paper05 var(--duration) linear infinite;
}

.typewriter .paper:before {
  content: "";
  position: absolute;
  left: 6px;
  right: 6px;
  top: 7px;
  border-radius: 2px;
  height: 4px;
  transform: scaleY(0.8);
  background: var(--text);
  box-shadow: 0 12px 0 var(--text), 0 24px 0 var(--text), 0 36px 0 var(--text);
}

.typewriter .keyboard {
  width: 120px;
  height: 56px;
  margin-top: -10px;
  z-index: 1;
  position: relative;
}

.typewriter .keyboard:before, .typewriter .keyboard:after {
  content: "";
  position: absolute;
}

.typewriter .keyboard:before {
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 7px;
  background: linear-gradient(135deg, var(--blue), var(--blue-dark));
  transform: perspective(10px) rotateX(2deg);
  transform-origin: 50% 100%;
}

.typewriter .keyboard:after {
  left: 2px;
  top: 25px;
  width: 11px;
  height: 4px;
  border-radius: 2px;
  box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  -webkit-animation: keyboard05 var(--duration) linear infinite;
  animation: keyboard05 var(--duration) linear infinite;
}

@keyframes bounce05 {
  85%, 92%, 100% {
    transform: translateY(0);
  }

  89% {
    transform: translateY(-4px);
  }

  95% {
    transform: translateY(2px);
  }
}

@keyframes slide05 {
  5% {
    transform: translateX(14px);
  }

  15%, 30% {
    transform: translateX(6px);
  }

  40%, 55% {
    transform: translateX(0);
  }

  65%, 70% {
    transform: translateX(-4px);
  }

  80%, 89% {
    transform: translateX(-12px);
  }

  100% {
    transform: translateX(14px);
  }
}

@keyframes paper05 {
  5% {
    transform: translateY(46px);
  }

  20%, 30% {
    transform: translateY(34px);
  }

  40%, 55% {
    transform: translateY(22px);
  }

  65%, 70% {
    transform: translateY(10px);
  }

  80%, 85% {
    transform: translateY(0);
  }

  92%, 100% {
    transform: translateY(46px);
  }
}

@keyframes keyboard05 {
  5%, 12%, 21%, 30%, 39%, 48%, 57%, 66%, 75%, 84% {
    box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  }

  9% {
    box-shadow: 15px 2px 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  }

  18% {
    box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 2px 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  }

  27% {
    box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 12px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  }

  36% {
    box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 12px 0 var(--key), 60px 12px 0 var(--key), 68px 12px 0 var(--key), 83px 10px 0 var(--key);
  }

  45% {
    box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 2px 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  }

  54% {
    box-shadow: 15px 0 0 var(--key), 30px 2px 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  }

  63% {
    box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 12px 0 var(--key);
  }

  72% {
    box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 2px 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 10px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  }

  81% {
    box-shadow: 15px 0 0 var(--key), 30px 0 0 var(--key), 45px 0 0 var(--key), 60px 0 0 var(--key), 75px 0 0 var(--key), 90px 0 0 var(--key), 22px 10px 0 var(--key), 37px 12px 0 var(--key), 52px 10px 0 var(--key), 60px 10px 0 var(--key), 68px 10px 0 var(--key), 83px 10px 0 var(--key);
  }
}

</style>
<body>
    <div class="processing-container">
    <div class="typewriter">
    <div class="slide"><i></i></div>
    <div class="paper"></div>
    <div class="keyboard"></div>
</div>
        <p>Processing your order...</p>
    </div>
</body>
</html>

