<?php
session_start();
include "db.php";

// Check if the form is submitted and the start_date and end_date values are set
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    // Retrieve top 10 products based on sold count within the date range
   // Retrieve top 10 products based on sold count within the date range
   $query = "SELECT p.name, p.product_id, p.color, p.size, p.image, t.total_sold, t.date
    FROM product p
    INNER JOIN (
    SELECT product_id, MAX(sold) AS total_sold, date
    FROM transaction
    WHERE date >= '$start_date' AND date <= '$end_date'
    GROUP BY product_id
    ) t ON p.product_id = t.product_id
    ORDER BY t.total_sold DESC LIMIT 10";


    $result = mysqli_query($mysqli, $query);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} 


if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
$query2 = "SELECT p.product_id, MAX(t.profit) AS maxProfit
FROM product AS p
INNER JOIN transaction AS t ON p.product_id = t.product_id
WHERE t.date >= '$start_date' AND t.date <= '$end_date'
GROUP BY p.product_id";
$result2 = mysqli_query($mysqli, $query2);
$totalProfit = 0;
while ($row2 = mysqli_fetch_assoc($result2)) {
    $totalProfit += $row2['maxProfit'];
}
}

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
$query3 = "SELECT COUNT(*) AS totalOrders FROM transaction WHERE date >= '$start_date' AND date <= '$end_date'";
$result3 = mysqli_query($mysqli, $query3);
$row3 = mysqli_fetch_assoc($result3);
$totalOrders = $row3['totalOrders'];
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" data-tag="font"/>
    <style>
        :root {
            --primary-color: #fff8f0;
            --secondary-color: #92140c;
            --black: #1e1e24;
        }
        
        html {
            scroll-behavior: smooth;
            
        }
        
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: Inter;
            background-color: var(--secondary-color);
        }

        .container {
            width: 57%;
            background-color: var(--primary-color);
            padding: 25px;
            position: sticky;
            top: 0;
            z-index: 999;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            margin: auto;
        }

        .menu {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: var(--black);
        }

        .menu ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
    }

    .menu ul li {
        margin-right: 25px;
        flex-grow: 0;
    }

    .menu ul li a {
        text-decoration: none;
        color: var(--black);
        padding: 5px 10px;
        transition: background-color 0.3s ease;
    }
        .menu ul li a.active {
            background-color: var(--secondary-color);
            color: var(--primary-color);
            padding: 10px;
            border-radius: 5px;
        }

        .section {
            height: 100vh;
            margin: 0;
        }

        #section1 h1 {
            margin-top: -210px;
            font-size: 50px;
        }
        #section1 h1, p{
            color: var(--primary-color);
        }
        #section1 {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        }
      
        #section1 p {
            font-size: 25px;
        }

        #section2 {
            width: 100vw;
            height: 100vh;
            display: grid;
            grid-template: 50px 1fr 1fr 100px / repeat(3, 1fr);
            gap: 10px;
            padding: 10px;
            box-sizing: border-box;
        }
        .trending h1 {
            margin-left: 120px;
        }

        #section2 table {
    width: 80%;
    margin: auto;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

#section2 th {
    background-color: #92140c;
    color: #fff;
    font-weight: bold;
    padding: 12px;
    text-align: center;
}
#section2 td {
    text-align: center;
}
#section2 tr:nth-child(even) {
    background-color: rgba(0, 0, 0, 0.05);
}

#section2 tr:hover {
    background-color: rgba(0, 0, 0, 0.1);
}

#section2 img {
    width: 40px;
    height: 40px;
}
        #section2 div {
            padding: 10px;       
        }
        .header {
            margin-top: 130px;
            grid-column-start: 1;
            grid-column-end: 4;
            text-align: center;
            font-size: 34px;
        }
        .trending {
            margin-top: 130px;
            grid-row-start: 2;
            grid-row-end: span 2;
            grid-column-start: 1;
            grid-column-end: 3;
        }

        .profit {
            margin-top: 130px;
        }

        .order {
            margin-top: 130px;
        }
        .profitcontainer {
    min-width: 80%;
    max-width: 80%;
    height: 80%;
    border-radius: 50px;
    background: linear-gradient(135deg, #03C04A, #29FF7D);
    box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.2),
                -20px -20px 60px rgba(255, 255, 255, 0.8);
    margin-top: 15%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #000;
}

.ordercontainer {
    min-width: 80%;
    max-width: 80%;
    height: 80%;
    border-radius: 50px;
    background: linear-gradient(135deg, #0075FF, #00B4FF);
    box-shadow: 20px 20px 60px rgba(0, 0, 0, 0.2),
                -20px -20px 60px rgba(255, 255, 255, 0.8);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: #000;
}

.profitcontainer h1,
.ordercontainer h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.profitcontainer p,
.ordercontainer p {
    font-size: 36px;
    font-weight: bold;
    margin: 0;
}
.date-filter {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .date-filter label {
            margin-right: 10px;
            color: var(--black);
            font-weight: bold;
            font-size: 20px;
        }

        .date-filter input[type="date"] {
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .date-filter input[type="submit"] {
            padding: 5px 10px;
            border-radius: 5px;
            background-color: var(--secondary-color);
            color: var(--primary-color);
            border: none;
            cursor: pointer;
        }
        .customerborder {

  display: flex;
  justify-content: center;
  align-items: center;
}

.grid-container {

  display: grid;
  width: 80%;
  height: 800px;
  grid-template-columns: 2fr 1fr 1fr;
  grid-gap: 20px;
  max-height: 400px; 
}

.grid-item {

  color: var(--primary-color);
  padding: 20px;
  text-align: center;
  margin-top: 200px;
  overflow:auto;
  background-color: #f1f1f1;
        border-radius: 8px;
    width:1000px;

}
.grid-item1{
background-color: #f1f1f1;
  color: var(--primary-color);
  padding: 20px;
  text-align: center;
  margin-top: 200px;
  height:250px;
  border-radius: 8px;
  margin-right:-249px;
}
.grid-item2{
    background-color: #f1f1f1;
  color: var(--primary-color);
  padding: 20px;
  text-align: center;
  margin-top: 510px;
  margin-left:-249px;
  height:250px;
  border-radius: 8px;
}
.headergrid{
    font-size:30px;
    text-align:left;
    color:black;
}
.tbl {
        width: 100%;
        border:1px solid black;
        margin-top: 20px;
        color:black;
    }

    .tbl th,
    .tbl td {
        padding: 8px;
        text-align: left;
        border:1px solid black;
    }

    .tbl th {
        background-color: #ddd;
    }

    .tdtbl {
        border-bottom: 1px solid #ddd;
    }
    .search-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .search-bar input[type="text"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 300px;
        max-width: 100%;
    }
    .form {
  background-color: var(--primary-color);
  display: block;
  margin: auto;
  padding: 2rem;
  max-width: 350px;
  border-radius: 0.5rem;
  border: 1px solid rgba(0, 0, 0, 0.1);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
  position: relative;
  animation: professionalAnimation 1s ease-out;
}

@keyframes professionalAnimation {
  0% {
    transform: scale(0.9);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
      .form-title {
        font-size: 1.25rem;
        line-height: 1.75rem;
        font-weight: 600;
        text-align: center;
        color: var(--black);
      }

      .input-container {
        position: relative;
      }

      .input-container input,
      .form button {
        outline: none;
        border: 1px solid #e5e7eb;
        margin: 8px 0;
      }

      .input-container input {
        background-color: var(--primary-color);
        padding: 1rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        width: 300px;
        border-radius: 0.5rem;
        box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.1);
      }

      .input-container span {
        display: grid;
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        padding-left: 1rem;
        padding-right: 1rem;
        place-content: center;
      }

      .input-container span svg {
        color: #9ca3af;
        width: 1rem;
        height: 1rem;
      }

      .submit {
        display: block;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        background-color: var(--secondary-color);
        color: #ffffff;
        font-size: 0.875rem;
        line-height: 1.25rem;
        font-weight: 500;
        width: 100%;
        border-radius: 0.5rem;
        text-transform: uppercase;
        cursor: pointer;
      }

      .signup-link {
        color: var(--black);
        font-size: 0.875rem;
        line-height: 1.25rem;
        text-align: center;
      }
      .error {
	color: #ff0000;
  background-color: #ffeaea;
  border: 1px solid #ff0000;
	padding: 5px;
	text-align: center;
	width: 20%;
	border-radius: 5px;;
	position: absolute;
  margin-top: -20%;
  animation: fade-in 0.5s, fade-out 0.5s 2.5s forwards;
  -webkit-animation: fade-in 2s, fade-out 1.5s 2.5s forwards;
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

      #section5 {
        display: flex;
        align-items: center;
        justify-content: space-between;
      }
    </style>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll(".section");
            const menuLinks = document.querySelectorAll(".menu ul li a");

            function changeLinkState() {
                let index = sections.length;

                while (--index && window.scrollY + 50 < sections[index].offsetTop) {}

                menuLinks.forEach((link) => link.classList.remove("active"));
                menuLinks[index].classList.add("active");
            }

            changeLinkState();
            window.addEventListener("scroll", changeLinkState);
        });
        
    </script>
</head>
<body>
    <div class="container">
        <div class="menu">
            <ul>
                <li><a href="#section1">Home</a></li>
                <li><a href="#section2">Sales Performance</a></li>
                <li><a href="#section3">Customer Support</a></li>
                <li><a href="#section4">Customer Analytics</a></li>
                <li><a href="#section5">Admin Accounts</a></li>
                <li><a href="./adminlogin.php">Logout</a></li>
            </ul>
        </div>
    </div>


    <!--Section 1-->
    <div id="section1" class="section" style="background-color: var(--secondary-color);">
    <h1>CUSTOMER RELATIONSHIP MANAGEMENT</h1>
    <p>Thread-Edge Clothing</p>
    </div>
    
    <!--Section 2-->
<div id="section2" class="section" style="background-color: var(--primary-color);">
    <div class="header">
    <div class="date-filter">
    <form method="GET" action="admindashboard.php?#section2">
    <label for="start-date">Start Date:</label>
    <input type="date" id="start-date" name="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">

    <label for="end-date">End Date:</label>
    <input type="date" id="end-date" name="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">

    <input type="submit" value="Filter">
</form>

</div>

    </div>
    
    <div class="trending">
        <h1>Trending Products</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Color</th>
                <th>Size</th>
                <th>Sold</th>
                <th>Image</th>
            </tr>
            <?php if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
                foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['color']; ?></td>
                <td><?php echo $product['size']; ?></td>
                <td><?php echo $product['total_sold']; ?></td>
                <td><img src="data:image/png;base64,<?php echo base64_encode($product['image']); ?>" alt="Product Image"></td>
            </tr>
            <?php endforeach; }?>
            
        </table>
    </div>
    <div class="profit">
    <div class="profitcontainer">
    <h1>Gross Profit</h1>
    <p>₱<?php if (isset($_GET['start_date']) && isset($_GET['end_date'])) {echo $totalProfit; }?></p>
    </div>
    </div>
    <div class="order">
        <div class="ordercontainer">
    <h1>Total Orders </h1>
    <p><?php if (isset($_GET['start_date']) && isset($_GET['end_date'])) { echo $totalOrders; }?></p>
    </div>
    </div>
</div>


    <!--Section 3--------------------------------------------------------------------------------------------------------------------------------->

<style>
.button-ticket {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Adjust this if needed */
}

.container1 .btn {
	position: relative;
	top: 0;
	left: 0;
	width: 250px;
	height: 50px;
	margin: 0;
	display: flex;
	justify-content: center;
	align-items: center;
}
.container1 .btn a {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	background: rgba(255, 255, 255, 0.05);
	box-shadow: 0 15px 15px rgba(0, 0, 0, 0.3);
	border-bottom: 1px solid rgba(255, 255, 255, 0.1);
	border-top: 1px solid rgba(255, 255, 255, 0.1);
	border-radius: 30px;
	padding: 10px;
	letter-spacing: 1px;
	text-decoration: none;
	overflow: hidden;
	color: #fff;
	font-weight: 400px;
	z-index: 1;
	transition: 0.5s;
	backdrop-filter: blur(15px);
}
.container1 .btn:hover a {
	letter-spacing: 3px;
}
.container1 .btn a::before {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	width: 50%;
	height: 100%;
	background: linear-gradient(to left, rgba(255, 255, 255, 0.15), transparent);
	transform: skewX(45deg) translate(0);
	transition: 0.5s;
	filter: blur(0px);
}
.container1 .btn:hover a::before {
	transform: skewX(45deg) translate(200px);
}
.container1 .btn::before {
	content: "";
	position: absolute;
	left: 50%;
	transform: translatex(-50%);
	bottom: -5px;
	width: 30px;
	height: 10px;
	background: #f00;
	border-radius: 10px;
	transition: 0.5s;
	transition-delay: 0.5;
}
.container1 .btn:hover::before /*lightup button*/ {
	bottom: 0;
	height: 50%;
	width: 80%;
	border-radius: 30px;
}

.container1 .btn::after {
	content: "";
	position: absolute;
	left: 50%;
	transform: translatex(-50%);
	top: -5px;
	width: 30px;
	height: 10px;
	background: #f00;
	border-radius: 10px;
	transition: 0.5s;
	transition-delay: 0.5;
}
.container1 .btn:hover::after /*lightup button*/ {
	top: 0;
	height: 50%;
	width: 80%;
	border-radius: 30px;
}
.container1 .btn:nth-child(1)::before, /*chnage 1*/
.container1 .btn:nth-child(1)::after {
	background: #ff1f71;
	box-shadow: 0 0 5px #ff1f71, 0 0 15px #ff1f71, 0 0 30px #ff1f71,
		0 0 60px #ff1f71;
}
.container1 .btn:nth-child(2)::before, /* 2*/
.container1 .btn:nth-child(2)::after {
	background: #2db2ff;
	box-shadow: 0 0 5px #2db2ff, 0 0 15px #2db2ff, 0 0 30px #2db2ff,
		0 0 60px #2db2ff;
}
.container1 .btn:nth-child(3)::before, /* 3*/
.container1 .btn:nth-child(3)::after {
	background: #1eff45;
	box-shadow: 0 0 5px #1eff45, 0 0 15px #1eff45, 0 0 30px #1eff45,
		0 0 60px #1eff45;
}


</style>

<script>
    function openTicket() {
      window.open("helpdesk-system-admin/ticket.php", "_blank");
    }
</script>

<div class="container1">
    <div id="section3" class="section" style="background-color: var(--secondary-color);">
        <div class="button-ticket">
        <div class="btn"><a href="#" onclick="openTicket()">Open Ticket</a></div>
        </div>
    </div>
</div>

    <!--End of Section 3-------------------------------------------------------------------------------------------------------------------------------->   
   <!--Section 4-->
<div id="section4" class="section" style="background-color: var(--primary-color);">
    <div class="customerborder">
        <div class="grid-container">
            <div class="grid-item">
                <?php
                // Assuming you have already established a database connection
                include "db.php";

                $search = ""; // Initialize the search query

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $search = $_POST["search"];
                }

                // Fetch data from the database based on the search query
                $query = "SELECT emailadd, name, birthday, address,age,gender, contactnum FROM user";

                // Append the WHERE clause if a search query is provided
                if (!empty($search)) {
                    $query .= " WHERE emailadd LIKE '%$search%' OR name LIKE '%$search%'";
                }

                $result = mysqli_query($mysqli, $query);

                // Get the total number of users
                $totalUsers = mysqli_num_rows($result);

                echo '<p class="headergrid">Customer Profile (Total Customer Accounts: ' . $totalUsers . ')</p>';
                
                // Check if any rows were returned
                if ($totalUsers > 0) {
                    echo '<div class="search-bar">';
                    echo '<form method="post">';
                    echo '<input type="text" name="search" id="searchInput" placeholder="Search by email or name">';
                    echo '<input type="submit" value="Search">';
                    echo '</form>';
                    echo '</div>';

                    echo '<table class="tbl">';
                    echo '<tr><th>Email Address</th><th>Name</th><th>Birthday</th><th>Address</th><th>Age</th><th>Gender</th><th>Contact Number</th></tr>';

                    // Initialize gender counts
                    $femaleCount = 0;
                    $maleCount = 0;

                    // Initialize user counts for age ranges
                    $age15to30Count = 0;
                    $age30to60Count = 0;
                    $age60plusCount = 0;

                    // Loop through each row of data
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td class="tdtbl">' . $row['emailadd'] . '</td>';
                        echo '<td class="tdtbl">' . $row['name'] . '</td>';
                        echo '<td class="tdtbl">' . $row['birthday'] . '</td>';
                        echo '<td class="tdtbl">' . $row['address'] . '</td>';
                        echo '<td class="tdtbl">' . $row['age'] . '</td>';
                        echo '<td class="tdtbl">' . $row['gender'] . '</td>';
                        echo '<td class="tdtbl">' . $row['contactnum'] . '</td>';
                        echo '</tr>';

                        // Increment gender counts
                        if ($row['gender'] == 'Female') {
                            $femaleCount++;
                        } elseif ($row['gender'] == 'Male') {
                            $maleCount++;
                        }

                        // Increment user counts based on age ranges
                        if ($row['age'] >= 15 && $row['age'] <= 30) {
                            $age15to30Count++;
                        } elseif ($row['age'] > 30 && $row['age'] <= 60) {
                            $age30to60Count++;
                        } elseif ($row['age'] > 60) {
                            $age60plusCount++;
                        }
                    }

                    echo '</table>';
                } else {
                    echo 'No records found.';
                }
                ?>
            </div>
            <div class="grid-item1">
                <p class="headergrid">Gender</p>
                <p class="headergrid">Females: <?php echo $femaleCount; ?></p>
                <p class="headergrid">Males: <?php echo $maleCount; ?></p>
            </div>
            <div class="grid-item2">
            <p class="headergrid">Average Age</p>
                <p class="headergrid">15-30 Years: <?php echo $age15to30Count; ?></p>
                <p class="headergrid">30-60 Years: <?php echo $age30to60Count; ?></p>
                <p class="headergrid">60+ Years: <?php echo $age60plusCount; ?></p>
            </div>
        </div>
    </div>
</div>

<!--Section 5-->
<div id="section5" class="section" style="background-color: var(--secondary-color);">
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
    <form class="form" action="signupadmin-process.php" method="POST">
      <p class="form-title">Sign up an Account</p>
      <div class="input-container">
        <input placeholder="Enter username" type="text" name="username" autocomplete="off">
        <span>
          <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
          </svg>
        </span>
      </div>
      <div class="input-container">
        <input placeholder="Enter password" type="password" name="confirmpassword" autocomplete="off">
        <span>
          <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
          </svg>
        </span>
      </div>
      <div class="input-container">
        <input placeholder="Confirm Password" type="password" name="password" autocomplete="off">
        <span>
          <svg stroke="currentColor" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
            <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
          </svg>
        </span>
      </div>
      <button class="submit" type="submit">
        Sign Up
      </button>
    </form>
</div>


</body>
</html>
