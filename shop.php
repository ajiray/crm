<?php
session_start(); 
include "db.php";
$customer_id = $_SESSION['customer_id'];

?>


<!DOCTYPE html>
<html>
<head>
  <title>Product Shop</title>
  
  <style>

    :root {
      --primary-color: #7dcfb6;
      --secondary-color: #00b2ca;
      --tertiary-color: #fbd1a2;
    }
    body {
      margin: 20px 50px; /* Increased side margins to 50px */
      background-color: var(--secondary-color);
      font-family: "Daisy Wheel", sans-serif;
    }

    .grid-container {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr)); /* Updated grid-template-columns */
    grid-gap: 20px;
    margin: 0 200px; /* Added negative margin to remove space between grids */
    }


    .product-box:hover {
      transform: scale(1.1);
    }

    .product-image {
      min-width: 200px;
      max-width: 200px;
      max-height: 200px;
      min-height: 200px;
      margin-bottom: 10px;
      
    }

    .product-name {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .product-price {
      position: absolute;
      bottom: 10px;
      left: 10px;
      color: green;
      margin-bottom: 5px;
    }

    .product-sold {
      position: absolute;
      bottom: 10px;
      right: 10px;
      color: red;
      margin-bottom: 5px;
    }

    .dropdown,
    .button-container {
      display: none;
      margin-bottom: 10px;
    }

    .button-container {
      display: none;
      justify-content: center;
      
    }

    .button {
      padding: 10px 20px;
      margin: 5px;
      cursor: pointer;
    }

    .button.add-to-cart {
      background-color: #4CAF50;
      color: white;
      margin-right: 15px;
    }

    .button.buy-now {
      background-color: #008CBA;
      color: white;
    }

    .product-box:hover .dropdown,
    .product-box:hover .button-container {
      display: block;
    }

    .product-box:hover .product-price,
    .product-box:hover .product-sold {
      display: block;
    }

    .product-box:hover .add-to-cart,
    .product-box:hover .buy-now {
      display: inline-block;
    }
    .product-box {
  
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 20px;
  border: 1px solid black;
  border-radius: 10px;
  background-color: white;
  transition: transform 0.3s;
  min-height: 320px;
  max-height: 320px;
  max-width: 400px;
  min-width: 400px;
  margin-left: 10px;
  margin-top: 30px;
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


.error {
	color: #ff0000;
  background-color: #ffeaea;
  border: 1px solid #ff0000;
	padding: 5px;
	text-align: center;
	width: 10%;
	border-radius: 5px;
	margin-top: 55px;
  margin-left: -20px;
	position: absolute;
  animation: fade-in 0.5s, fade-out 0.5s 2.5s forwards;
  -webkit-animation: fade-in 0.5s, fade-out 1.5s 2.5s forwards;
  z-index: 9999;
 }
 .add {
  color: #008000;
  background-color: #eafae8;
  border: 1px solid #008000;
	padding: 5px;
	text-align: center;
	width: 10%;
	border-radius: 5px;
	margin-top: 55px;
  margin-left: -20px;
	position: absolute;
  animation: fade-in 0.5s, fade-out 0.5s 2.5s forwards;
        -webkit-animation: fade-in 0.5s, fade-out 1.5s 2.5s forwards;
        z-index: 9999;
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
  .fixed-btn{
    position: fixed;
    background: #57b846;
    width: 180px;
    height: 65px;
    line-height: 45px;
    bottom: 10%;
    right: 3%;
    border-radius: 3px;
    text-align: center;
    box-shadow: 4px 4px 4px #3a7c2e;
    cursor: pointer;

}

.fixed-btn p{
    text-transform: uppercase;
    font-family: arial;
    font-weight: 900;
    color: rgb(241, 236, 236);
    position: fixed;
    right: 85px;
    bottom: 82px;
    font-size: 22px;
}

.fixed-btn:hover{
    box-shadow: 0 0;
}

a{
    text-decoration: none;
}
  </style>
</head>
<script>
    function openTicket() {
      window.open("helpdesk-system/ticket.php", "_blank");
    }
  </script>
<body>
  <!-- FEEDBACK FORM, BAKA MAWAL TO KAYA SA TAAS KO NILAGAY-->
<div class="fixed-btn">
            <a href="feedbackform.html"><p>FEEDBACK</p></a>
        </div>
  
<div class="menu-bar">
    <div class="logo">
      <img src="./logo.png" alt="Logo">
    </div>
    <div class="menu-items">
      <div class="shopping-cart">
        <a href="./cart.php"><img src="./shopping_cart.png" alt="Shopping Cart"></a>
      </div>
    <div class="settings">
      <ul>
        <li>
          <a href="#">Settings ↓</a>
          <ul class="dropdown">
            <li><a href="Viewprofile.php">View Profile</a></li>
            <li><a href="#" onclick="openTicket()">Ticket</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
  <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['add'])) { ?>     
        <p class="add"><?php echo $_GET['add']; ?></p>
        <?php } ?>

        
   
     		
  <form action="process_add_to_cart.php" method="post">
  <div class="grid-container">
    <div class="product-box">
      <img class="product-image" id="product-image1" src="yellowT.PNG" alt="Product 1">
      <div class="product-name">T - SHIRT</div>
      <div class="product-price">₱10.00</div>
      <div class="dropdown">
        <label for="style-select1">Color:</label>
        <select id="style-select1" onchange="changeImage1('product-image1')" name="color">
          <option value="yellow">Yellow</option>
          <option value="black">Black</option>
          <option value="blue">Blue</option>
        </select>
      </div>
      <div class="dropdown">
        <label for="size-select1">Size:</label>
        <select id="size-select1" name="size">
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      
      <div class="button-container">
      <input type="hidden" name="name" value="T-Shirt">
        <input type="submit" value="Add to Cart" class="button add-to-cart" name="Add-to-Cart">
       <input type="submit" value="Buy Now" class="button buy-now" name="Buy-Now">
      </div>
    </div>
    </form>


  <form action="process_add_to_cart1.php" method="post">
    <div class="product-box">
      <img class="product-image" id="product-image2" src="SR.PNG" alt="Product 2">
      <div class="product-name">SWEATER</div>
      <div class="product-price">₱15.00</div>
      <div class="dropdown">
        <label for="style-select2">Color:</label>
        <select id="style-select2" onchange="changeImage2('product-image2')" name="color">
          <option value="red">Red</option>
          <option value="green">Green</option>
          <option value="grey">Grey</option>
        </select>
      </div>
      <div class="dropdown">
        <label for="size-select2">Size:</label>
        <select id="size-select2" name="size">
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      <div class="button-container">
      <input type="hidden" name="name" value="Sweater">
      <input type="submit" value="Add to Cart" class="button add-to-cart" name="Add-to-Cart">
       <input type="submit" value="Buy Now" class="button buy-now" name="Buy-Now">
      </div>
    </div>
    </form>


  <form action="process_add_to_cart2.php" method="post">
    <div class="product-box">
      <img class="product-image" id="product-image3" src="HB.PNG" alt="Product 3">
      <div class="product-name">HOODIE</div>
      <div class="product-price">₱12.00</div>
      <div class="dropdown">
        <label for="style-select3">Color:</label>
        <select id="style-select3" onchange="changeImage3('product-image3')" name="color"> 
          <option value="blue">Blue</option>
          <option value="grey">Grey</option>
          <option value="purple">Purple</option>
        </select>
      </div>
      <div class="dropdown">
        <label for="size-select3">Size:</label>
        <select id="size-select3" name="size">
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      <div class="button-container">
      <input type="hidden" name="name" value="Hoodie">
      <input type="submit" value="Add to Cart" class="button add-to-cart" name="Add-to-Cart">
       <input type="submit" value="Buy Now" class="button buy-now" name="Buy-Now">
      </div>
    </div>
  </form>

  <form action="process_add_to_cart3.php" method="post">
    <div class="product-box">
      <img class="product-image" id="product-image4" src="TNG.PNG" alt="Product 4">
      <div class="product-name">TURTLENECK</div>
      <div class="product-price">₱20.00</div>
      <div class="dropdown">
        <label for="style-select4">Color:</label>
        <select id="style-select4" onchange="changeImage4('product-image4')" name="color">
          <option value="green">Green</option>
          <option value="brown">Brown</option>
          <option value="grey">Grey</option>
        </select>
      </div>
      <div class="dropdown">
        <label for="size-select4">Size:</label>
        <select id="size-select4" name="size">
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      <div class="button-container">
      <input type="hidden" name="name" value="Turtle Neck">
      <input type="submit" value="Add to Cart" class="button add-to-cart" name="Add-to-Cart">
       <input type="submit" value="Buy Now" class="button buy-now" name="Buy-Now">
      </div>
    </div>
  </form>


  <form action="process_add_to_cart4.php" method="post">
    <div class="product-box">
      <img class="product-image" id="product-image5" src="JP.PNG" alt="Product 5">
      <div class="product-name">JACKET</div>
      <div class="product-price">₱18.00</div>
      <div class="dropdown">
        <label for="style-select5">Color:</label>
        <select id="style-select5" onchange="changeImage5('product-image5')" name="color">
          <option value="purple">Purple</option>
          <option value="orange">Orange</option>
          <option value="green">Green</option>
        </select>
      </div>
      <div class="dropdown">
        <label for="size-select5">Size:</label>
        <select id="size-select5" name="size">
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      <div class="button-container">
      <input type="hidden" name="name" value="Jacket">
      <input type="submit" value="Add to Cart" class="button add-to-cart" name="Add-to-Cart">
       <input type="submit" value="Buy Now" class="button buy-now" name="Buy-Now">
      </div>
    </div>
  </form>


  <form action="process_add_to_cart5.php" method="post">
    <div class="product-box">
      <img class="product-image" id="product-image6" src="PB.PNG" alt="Product 6">
      <div class="product-name">POLO</div>
      <div class="product-price">₱25.00</div>
      <div class="dropdown">
        <label for="style-select6">Color:</label>
        <select id="style-select6" onchange="changeImage6('product-image6')" name="color">
          <option value="beige">Beige</option>
          <option value="grey">Grey</option>
          <option value="green">Green</option>
        </select>
      </div>
      <div class="dropdown">
        <label for="size-select6">Size:</label>
        <select id="size-select6" name="size">
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="large">Large</option>
        </select>
      </div>
      <div class="button-container">
      <input type="hidden" name="name" value="Polo">
      <input type="submit" value="Add to Cart" class="button add-to-cart" name="Add-to-Cart">
       <input type="submit" value="Buy Now" class="button buy-now" name="Buy-Now">
      </div>
    </div>
  </div>
  </form>
  <script>
  function changeImage1() {
    var selectBox = document.getElementById("style-select1");
    var selectedColor = selectBox.options[selectBox.selectedIndex].value;
    var productImage = document.getElementById("product-image1");
    updateProductImage1(selectedColor, productImage);
  }

  function changeImage2() {
    var selectBox = document.getElementById("style-select2");
    var selectedColor = selectBox.options[selectBox.selectedIndex].value;
    var productImage = document.getElementById("product-image2");
    updateProductImage2(selectedColor, productImage);
  }
  function changeImage3() {
    var selectBox = document.getElementById("style-select3");
    var selectedColor = selectBox.options[selectBox.selectedIndex].value;
    var productImage = document.getElementById("product-image3");
    updateProductImage3(selectedColor, productImage);
  }
  function changeImage4() {
    var selectBox = document.getElementById("style-select4");
    var selectedColor = selectBox.options[selectBox.selectedIndex].value;
    var productImage = document.getElementById("product-image4");
    updateProductImage4(selectedColor, productImage);
  }
  function changeImage5() {
    var selectBox = document.getElementById("style-select5");
    var selectedColor = selectBox.options[selectBox.selectedIndex].value;
    var productImage = document.getElementById("product-image5");
    updateProductImage5(selectedColor, productImage);
  }
  function changeImage6() {
    var selectBox = document.getElementById("style-select6");
    var selectedColor = selectBox.options[selectBox.selectedIndex].value;
    var productImage = document.getElementById("product-image6");
    updateProductImage6(selectedColor, productImage);
  }

  // Define separate changeImage functions for other grids (changeImage3, changeImage4, etc.)

  function updateProductImage1(selectedColor, productImage) {
    switch (selectedColor) {
      case "yellow":
        productImage.src = "yellowT.PNG";
        break;
      case "black":
        productImage.src = "blackT.PNG";
        break;
      case "blue":
        productImage.src = "blueT.PNG";
        break;
      }
  }
  function updateProductImage2(selectedColor, productImage) {
    switch (selectedColor) {
        case "red":
          productImage.src = "SR.PNG";     
          break;
        
        case "green":
          productImage.src = "SG.PNG";
          break;
        case "grey":
          productImage.src = "SGr.PNG";
          break;
          
        }
      }

      function updateProductImage3(selectedColor, productImage) {
    switch (selectedColor) {
      case "blue":
          productImage.src = "HB.PNG";
          break;
        case "grey":
          productImage.src = "HG.PNG";
          break;
        case "purple":
          productImage.src = "HP.PNG";
          break;
          
        }
      }

      function updateProductImage4(selectedColor, productImage) {
    switch (selectedColor) {
      case "green":
          productImage.src = "TNG.PNG";
          break;
        case "brown":
          productImage.src = "TNB.PNG";
          break;
        case "grey":
          productImage.src = "TNGr.PNG";
          break;
          
        }
      }

      function updateProductImage5(selectedColor, productImage) {
    switch (selectedColor) {
      case "purple":
          productImage.src = "JP.PNG";
          break;
        case "orange":
          productImage.src = "JO.PNG";
          break;
        case "green":
          productImage.src = "Jacket_Green.PNG";
          break;
          
        }
      }

      function updateProductImage6(selectedColor, productImage) {
    switch (selectedColor) {
      case "beige":
          productImage.src = "PB.PNG";
          break;
        case "grey":
          productImage.src = "Polo_Grey.PNG";
          break;
        case "green":
          productImage.src = "PG.PNG";
          break;
          
        }
      }
        
</script>

</body>
</html>