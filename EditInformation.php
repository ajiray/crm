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
    <title>Edit Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta property="twitter:card" content="summary_large_image" />

    <style data-tag="reset-style-sheet">
      html {  line-height: 1.15;}body {  margin: 0;}* {  box-sizing: border-box;  border-width: 0;  border-style: solid;}p,li,ul,pre,div,h1,h2,h3,h4,h5,h6,figure,blockquote,figcaption {  margin: 0;  padding: 0;}button {  background-color: transparent;}button,input,optgroup,select,textarea {  font-family: inherit;  font-size: 100%;  line-height: 1.15;  margin: 0;}button,select {  text-transform: none;}button,[type="button"],[type="reset"],[type="submit"] {  -webkit-appearance: button;}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner {  border-style: none;  padding: 0;}button:-moz-focus,[type="button"]:-moz-focus,[type="reset"]:-moz-focus,[type="submit"]:-moz-focus {  outline: 1px dotted ButtonText;}a {  color: inherit;  text-decoration: inherit;}input {  padding: 2px 4px;}img {  display: block;}html { scroll-behavior: smooth  }
    </style>
    <style data-tag="default-style-sheet">
      html {
        font-family: Inter;
        font-size: 16px;
      }

      body {
        font-weight: 400;
        font-style:normal;
        text-decoration: none;
        text-transform: none;
        letter-spacing: normal;
        line-height: 1.15;
        color: var(--dl-color-gray-black);
        background-color: var(--dl-color-gray-white);

      }
    </style>
    <script>
      function goBack() {
        window.close();
      }
    </script>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
      data-tag="font"
    />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
      data-tag="font"
    />
    <link rel="stylesheet" href="./styleeditinfo.css" />
  </head>
  <body>
    <div>
      <link href="./editinfo.css" rel="stylesheet" />
      <form action="process-edit-profile.php" method="post" id="signup" autocomplete="off">
      <div class="editinfo-container">
        <div class="editinfo-editinfo">
          <span class="editinfo-text"><span>Edit profile</span></span>
          <div class="editinfo-firstname">
            <span class="editinfo-text02"><span>Name</span></span>
          </div>
          <div class="editinfo-address">
            <span class="editinfo-text04"><span>Address</span></span>
          </div>
          <div class="editinfo-address1">
            <span class="editinfo-text06"><span>Contact Number</span></span>
          </div>
          <div class="editinfo-lastname">
            <span class="editinfo-text08"><span>Birthday</span></span>
          </div>
          <img
            src="public/external/vector1023-ptc.svg"
            alt="Vector1023"
            class="editinfo-vector"
          />
          <input type="text" placeholder="placeholder" name="name" value="<?php echo $row['name']; ?>" class="editinfo-textinput input"
          />
          <input type="text" placeholder="placeholder" name="cnumber" value="<?php echo $row['contactnum']; ?>" class="editinfo-textinput1 input"
          />
          <input type="text" placeholder="placeholder" name="address" value="<?php echo $row['address']; ?>" class="editinfo-textinput2 input"
          />
          <input type="date" placeholder="placeholder" name="bday" value="<?php echo $row['birthday']; }}?>" class="editinfo-textinput3 input"
          />
          <button name="Save"  class="editinfo-save button">Save</button>
          <button name="Save" class="editinfo-save1 button" onclick="goBack()">Cancel</button>
    </form>
        </div>
      </div>
    </div>
  </body>
</html>
