<?php
session_start();
include "db.php";
$totalAmount = 0;
$customer_id = $_SESSION['customer_id'];
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
$sql = "SELECT cart.cart_item_id, product.name, product.color, product.size, product.price, product.image, product.stock
        FROM cart
        INNER JOIN product ON cart.product_id = product.product_id
        WHERE cart.user_id = ?";
$stmt2 = mysqli_prepare($mysqli, $sql);

// Bind the parameter value
mysqli_stmt_bind_param($stmt2, "i", $customer_id);

// Execute the query
mysqli_stmt_execute($stmt2);

// Fetch the result
$result = mysqli_stmt_get_result($stmt2);

?>

<!DOCTYPE html>
<html>
<head>
    <style>
         :root {
            --primary-color: #4c8bf5;
            --secondary-color: #46d4cf;
            --tertiary-color: #333333;
        }
        body {
            margin: 20px 50px; /* Increased side margins to 50px */
      background-color: var(--secondary-color);
      font-family: "Daisy Wheel", sans-serif;
        }

        .container {
            margin-top: 30px;
            margin-left: 50px;
        }

        .table-container {
            width: 100%;
            height: 606px;
            overflow: auto;
            scrollbar-width: none; /* Hide scrollbar for Firefox */
            -ms-overflow-style: none; /* Hide scrollbar for Internet Explorer and Edge */
        }

        /* Hide the scrollbar for Chrome, Safari, and Opera */
        .table-container::-webkit-scrollbar {
            display: none;
        }

        table {
          text-align: center;
            border-collapse: collapse;
            border-radius: 10px;
            background-color: white;
            margin-left: 8%;
            width: 85%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: none;
            padding: 10px;
            font-size: 16px;
        }

        th {
          font-weight: bold;
            background-color: var(--primary-color);
            color: white;
            text-transform: uppercase;
    }
    td img {
            max-width: 100px;
            max-height: 100px;
    }
    td {
            background-color: #f2f2f2;
        }
    .menu-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    height: 70px;
    border-radius: 10px;
    position: relative;
  }
  .menu-bar::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: url(./menubg.png);
  filter: brightness(0.3); /* Adjust the brightness value as needed */
  z-index: -1;
  border-radius: 15px;
}

  .logo img {
    height: 70px;
    width: 100px;
    margin-left: 20px;
  }

  .menu-items {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .shopping-cart img {
    height: 80px;
    width: 120px;
    margin-right: 35px;
  }

  .settings img {
  height: 70px;
  width: 70px;
  margin-left: 735px;
  margin-right: 20px;
  margin-top: 5px;
  cursor: pointer;
}
    h1 {
        margin-left: 280px;
    }
    .popup-message {
        position: absolute;
        top: 18%;
        transform: translate(-50%, -50%);
        background-color: #ff5252;
        color: #ffffff;
        padding: 10px;
        width: 200px;
        border-radius: 10px;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        animation: fade-in 0.5s, fade-out 0.5s 2.5s forwards;
        -webkit-animation: fade-in 0.5s, fade-out 1.5s 2.5s forwards;
        z-index: 9999;
        margin-left: 15%;
    }
    .remove-link {
            color: red;
            text-decoration: none;
            font-size: 14px;
        }


    @keyframes fade-in {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    @keyframes fade-out {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }

    @-webkit-keyframes fade-in {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    @-webkit-keyframes fade-out {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0;
        }
    }
    .checkout-button {
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: background-color 0.4s ease;
        }

        .checkout-button:hover {
            background-color: var(--tertiary-color);
        }
        input[type="number"] {
            width: 40px;
            text-align: center;
            font-size: 24px;
            border: none;
            background-color: #f2f2f2;
            margin-left: 10px;
        }
   

  .header-container {
    display: flex;
    align-items: center;
    width: 100%;
  }
  .header-container button {
    margin-left: 500px;
    margin-top: 50px;
  }

  h1 {
    margin-left: 42%;
    margin-top: 50px;
  }
  .up {
    margin-right: 10%;
  }
  ul {
    list-style: none;
    margin-left: 600px;
  }

  ul li {
    display: inline-block;
    position: relative;
  }

  ul li a {
    display: block;
    padding: 20px 25px;
    color: #ffffff;
    text-decoration: none;
    font-size: 20px;
  }

  ul li ul.dropdown li {
    display: block;
  }

  ul li ul.dropdown {
    position: absolute;
    width: 100%;
    z-index: 999;
    display: none;
    border-radius: 10px;
  }

  ul li ul.dropdown::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url(./menubg.png);
    filter: brightness(0.3);
    border-radius: 5px;
  }

  ul li ul.dropdown li a:hover {
    filter: brightness(0.5); /* Adjust the brightness value as per your preference */
  }

  ul li a:hover {
    color: #ffffff;
  }

  ul li:hover ul.dropdown {
    display: block;
    margin-left: -30px;
  }
    </style>
      <script>
    function redirectToOption() {
  var selectElement = document.getElementById("settings-dropdown");
  var selectedValue = selectElement.value;

  if (selectedValue === "profile") {
    window.location.href = "login.html";
  } else if (selectedValue === "feedback") {
    window.location.href = "feedback.html";
  }
}
    </script>
</head>
<body>
    <?php
if (isset($_SESSION['item_removed']) && $_SESSION['item_removed']) {
    echo '<div class="popup-message">Item successfully removed from your cart</div>';
    unset($_SESSION['item_removed']); // Unset the session variable
}
    ?>
<div class="menu-bar">
    <div class="logo">
      <img src="./logo.png" alt="Logo">
    </div>
    <div class="menu-items">
      <div class="shopping-cart">
        <a href="shop.php"><img src="./home.png" alt="Home"></a>
      </div>
    <div class="settings">
      <ul>
        <li>
          <a href="#">Settings ↓</a>
          <ul class="dropdown">
            <li><a href="Viewprofile.php">View Profile</a></li>
            <li><a href="#">Ticket</a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
  <div class="header-container">
            <h1>My Shopping Cart</h1>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <form action="checkout.php" method="POST">
                    <button id="btn" class="checkout-button">Checkout</button>
            <?php endif; ?>
        </div>

        <table class="up">
            <tr>
                <th width="100px">Action</th>
                <th width="145px">Product</th>
                <th width="100px">Color</th>
                <th width="100px">Size</th>
                <th width="100px">Price</th>
                <th width="100px">Quantity</th>
                <th width="150px">Image</th>
      
            </tr>
        </table>
        <div class="table-container">
        <table class="down">
    <?php
    // Process the result as needed
    while ($row = mysqli_fetch_assoc($result)) {
        $cartItemId = $row['cart_item_id'];
        $productName = $row['name'];
        $productColor = $row['color'];
        $productSize = $row['size'];
        $productPrice = $row['price'];
        $productImage = $row['image'];
        $totalAmount += $productPrice;
        $productStock = $row['stock'];
    ?>
        <tr>
            <td width="100px"><a class="remove-link" href="delete_from_cart.php?cart_item_id=<?php echo $cartItemId; ?>">Remove</a></td>
            <td width="145"><?php echo $productName; ?></td>
            <td width="100px"><?php echo $productColor; ?></td>
            <td width="100px"><?php echo $productSize; ?></td>
            <td width="100px"><?php echo "₱". $productPrice; ?></td>
            <td width="100px"><input type="number" name="quantity[<?php echo $cartItemId; ?>]" min="1" max="<?php echo $productStock; ?>" value="1"></td>
            <td width="150px"><img src="data:image/png;base64,<?php echo base64_encode($productImage); ?>" alt="Product Image"></td>
        </tr>

    <?php
    }
    ?>
</table>
</form>
</body>
</html>



<?php
mysqli_stmt_close($stmt);
mysqli_close($mysqli);
?>
