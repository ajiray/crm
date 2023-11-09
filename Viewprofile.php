<?php
session_start();
include "db.php";
$customer_id = $_SESSION['customer_id'];
$userSql = "SELECT * FROM user WHERE customer_id = $customer_id";
$result = mysqli_query($mysqli, $userSql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
<!DOCTYPE html>
<html lang="english">
  <head>
    <title>View Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

   
    <style>

      body {
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
         :root {
      --primary-color: #7dcfb6;
      --secondary-color: #00b2ca;
      --tertiary-color: #fbd1a2;
    }
        body {
            background-color: var(--secondary-color);
        }

        .container {
            margin-top: 30px;
            margin-left: 50px;
        }
      
    .menu-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    height: 70px;
    border-radius: 10px;
    position: relative;
    width: 94.5%;
    margin-top: 20px;
    margin-left: 40px;
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

    h1 {
        margin-left: 280px;
    }
    .popup-message {
        position: absolute;
        top: 16%;
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
        margin-left: 50%;
    }

  .header-container {
    display: flex;
    align-items: center;
    width: 100%;
  }
  .header-container button {
    margin-left: 480px;
  }

  h1 {
    margin-left: 42%;
  }
  .up {
    margin-right: 10%;
  }
  .slide1691-button {
    top: 650px;
  left: 770px;
  color: #ffffff;
  width: 150px;
  height: 50px;
  position: absolute;
  border-color: #17c5fc;
  background-color: #17c5fc;
  cursor:pointer;
  border-radius: 10px;
}
.slide1691-button:hover {
  background-color:#10ADC6;
}
table {
     
      width: 20%;
      margin-top:200px;
      margin-left:500px;
      border-color:#999999;
    }

     td {
      padding: 8px;
      border: 1px solid black;
      text-align:left;
      border-radius:10px;
    }
    th{
        text-align:left;
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
  </style>
   <script>
    function redirectToOption() {
  var selectElement = document.getElementById("settings-dropdown");
  var selectedValue = selectElement.value;

  if (selectedValue === "profile") {
    window.location.href = "Viewprofile.php";
  } else if (selectedValue === "feedback") {
    window.location.href = "feedback.html";
  }
}
    </script>
<div class="menu-bar">
    <div class="logo">
      <img src="logo.png" alt="Logo">
    </div>
    <div class="menu-items">
      <div class="shopping-cart">
        <a href="shop.php"><img src="home.png" alt="Home"></a>
      </div>
    <div class="settings">
      <ul>
        <li>
          <a href="#">Settings ↓</a>
          <ul class="dropdown">
            <li><a href="Viewprofile.php">View Profile</a></li>
            <li><a href="./helpdesk-system./ticket.php">Ticket</a></li>
            <li><a href="index.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
    <link rel="stylesheet" href="./styleprofile.css" />
  </head>
  <script>
    function openWebsite() {
      var windowFeatures = "width=1720,height=800,resizable,scrollbars";
      window.open('EditInformation.php', '_blank', windowFeatures);
    }
  </script>
  <body>
    <div>
      <link href="./vectordesign.css" rel="stylesheet" />

      <div class="vector-container">
        <div class="vector-dummy-container">
          <img
            src="public/external/vector24-9sqh.svg"
            alt="Vector24"
            class="vector-vector"
          />
          <table>
    <tr class="table-heading">
      <th>Email</th>
    </tr>
    <tr>
      <td><?php echo $row['emailadd']; ?></td>
    </tr>
    <tr class="table-heading">
      <th>Name</th>
    </tr>
    <tr>
      <td><?php echo $row['name']; ?></td>
    </tr>
    <tr class="table-heading">
      <th>Birthday</th>
    </tr>
    <tr>
      <td><?php echo $row['birthday']; ?></td>
    </tr>
    <tr class="table-heading">
      <th>Address</th>
    </tr>
    <tr>
      <td><?php echo $row['address']; ?></td>
    </tr>
    <tr class="table-heading">
      <th>Contact Number</th>
    </tr>
    <tr>
      <td><?php echo $row['contactnum']; }}?></td>
    </tr>
  </table>
        </div>
        <span class="vector-text">Profile</span>
      </div>
    </div>
    <input type="submit" class="slide1691-button" value="Edit Profile" name="Editprofile" onclick="openWebsite()">
  </body>
</html>
