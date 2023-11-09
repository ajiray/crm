<?php
session_start();
include "db.php";
$totalPrice = 0;
$customer_id = $_SESSION['customer_id'];
$quantities = $_POST["quantity"];

// Assuming you have established a database connection
$userSql = "SELECT name, emailadd, address FROM user WHERE customer_id = ?";
$stmt = mysqli_prepare($mysqli, $userSql);

// Bind the parameter value
mysqli_stmt_bind_param($stmt, "i", $customer_id);

// Execute the query
mysqli_stmt_execute($stmt);

// Fetch the result
$result2 = mysqli_stmt_get_result($stmt);


// Prepare the SQL statement to retrieve products from the cart
$sql = "SELECT cart.cart_item_id, product.name, product.color, product.size, product.price, product.image, product.stock
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

// Calculate the total price
$totalPrice = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $productPrice = $row['price'];
    $cartItemId = $row['cart_item_id'];
    $quantity = isset($quantities[$cartItemId]) ? $quantities[$cartItemId] : 0;

    $quantity = intval($quantity); // Convert the quantity to an integer

    // Calculate the subtotal for each product
    $subtotal = $productPrice * $quantity;

    // Add the subtotal to the total price
    $totalPrice += $subtotal;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Summary</title>
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
    background-color: var(--secondary-color); /* Set background color to #fbd1a2 */
    font-family: Arial, sans-serif;
    font-size: 18px;
    overflow: hidden;
}

.card button {
    padding: 10px 20px;
    font-size: 18px;
    background-color: whitesmoke;
    color: black;
    border: none;
    cursor: pointer;
    display: block;
    position: absolute;
    right: 30px;
    margin-top: 30px;
    border-radius: 10px;
}

.card button:hover {
    background-color: var(--secondary-color);
}

.card {
    min-width: 600px;
    min-height: 300px;
    padding: 20px;
    border-radius: 30px;
    background: #212121;
    box-shadow: 15px 15px 30px rgb(25, 25, 25),
    -15px -15px 30px rgb(60, 60, 60);
    position: relative;   
}

hr.glow {
    border: none;
    height: 5px;
    background-color: #fff;
    position: relative;
    animation: glowing 1.5s ease-in-out infinite;
}

@keyframes glowing {
    0% {
        box-shadow: 0 0 5px #fff;
    }
    50% {
        box-shadow: 0 0 10px #fff;
    }
    100% {
        box-shadow: 0 0 5px #fff;
    }
}

h1 {
    color: whitesmoke;
    text-align: center;
    margin: 0;
}

.summary-info {
    display: flex;
    align-items: right;
    margin-bottom: 10px;
}

.summary-info-label {
    flex-basis: 250px;
    font-weight: bold;
    color: whitesmoke;
}

.summary-info-value {
    flex-grow: 1;
    color: white;
    text-align: center;
}
.home-link {
    position: absolute;
    top: 13px;
    left: 15px;
}

.home-link img {
    width: 100px;
    height: 50px;
}

</style>
<body>

    <div class="card" id="summary-container">
    <div class="home-link">
        <a href="shop.php"><img src="./home.png" alt=""></a>
    </div>
        <?php
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $name = $row2['name'];
            $email = $row2['emailadd'];
            $address = $row2['address'];
        }
        ?>
        
        <h1>Clothing Apparel</h1>
        <hr class="glow">
        <div class="summary-info">
            <div class="summary-info-label">Name</div>
            <div class="summary-info-value"><?php echo strtoupper($name); ?></div>
        </div>
        <div class="summary-info">
            <div class="summary-info-label">Email</div>
            <div class="summary-info-value"><?php echo strtoupper($email); ?></div>
        </div>
        <div class="summary-info">
            <div class="summary-info-label">Address</div>
            <div class="summary-info-value"><?php echo strtoupper($address); ?></div>
        </div>
        <div class="summary-info">
            <div class="summary-info-label">Payment Method</div>
            <div class="summary-info-value">Cash on Delivery</div>
        </div>
        <div class="summary-info">
            <div class="summary-info-label">Total Amount</div>
            <div class="summary-info-value">₱<?php echo number_format($totalPrice, 2); ?></div>
        </div>
        <form action="process_order.php" method="POST">
            <?php
            // Add hidden input fields for each quantity in the array
            foreach ($quantities as $cartItemId => $quantity) {
                echo '<input type="hidden" name="quantity[' . $cartItemId . ']" value="' . $quantity . '">';
            }
            ?>
            <button type="submit">Proceed</button>
        </form>
    </div>
</body>
</html>
