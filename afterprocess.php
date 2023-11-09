<?php
include "db.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title></title>
    
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400');
        :root {
      --primary-color: #7dcfb6;
      --secondary-color: #00b2ca;
      --tertiary-color: #fbd1a2;
    }
        * {
            margin: 0;
            padding: 0;

        }

        body {
            background-color: #00b2ca;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Roboto Condensed', sans-serif;
        }
        .notifications-container {
  width: 500px;
  height: 300px;
  line-height: 1.50rem;
  display: flex;
  flex-direction: column;
  font-family: "Daisy Wheel", sans-serif;
}

.flex {
  display: flex;
}

.flex-shrink-0 {
  flex-shrink: 0;
}

.success {
  padding: 1rem;
  border-radius: 0.375rem;
  background-color: rgb(240 253 244);
}

.succes-svg {
  color: rgb(74 222 128);
  width: 1.25rem;
  height: 1.25rem;
}

.success-prompt-wrap {
  margin-left: 0.75rem;
}

.success-prompt-heading {
  font-weight: bold;
  color: rgb(22 101 52);
}

.success-prompt-prompt {
  margin-top: 0.5rem;
  color: rgb(21 128 61);
}

.success-button-container {
  display: flex;
  margin-top: 0.875rem;
  margin-bottom: -0.375rem;
  margin-left: -0.5rem;
  margin-right: -0.5rem;
}

.success-button-main {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  background-color: #ECFDF5;
  color: rgb(22 101 52);
  font-size: 0.875rem;
  line-height: 1.25rem;
  font-weight: bold;
  border-radius: 0.375rem;
  border: none
}

.success-button-main:hover {
  background-color: #D1FAE5;
}

.success-button-secondary {
  padding-top: 0.375rem;
  padding-bottom: 0.375rem;
  padding-left: 0.5rem;
  padding-right: 0.5rem;
  margin-left: 0.75rem;
  background-color: #ECFDF5;
  color: #065F46;
  font-size: 0.875rem;
  line-height: 1.25rem;
  border-radius: 0.375rem;
  border: none;
}
ul {
  position:absolute;
  top:75%;
  left:50%;
  transform:translate(-50%, -50%);
  display:flex;
  margin:0;
  padding:0;
}

ul li {
  list-style:none;
  margin:0 5px;
}

ul li a .fa {
  font-size: 40px;
  color: #262626;
  line-height:80px;
  transition: .5s;
  padding-right: 14px;
}

ul li a span {
  padding:0;
  margin:0;
  position:absolute;
  top: 30px;
  color: #262626;
  letter-spacing: 4px;
  transition: .5s;
}

ul li a {
  text-decoration: none;
  display:absolute;
  display:block;
  width:210px;
  height:80px;
  background: #fff;
  text-align:left;
  padding-left: 20px;
  transform: rotate(-30deg) skew(25deg) translate(0,0);
  transition:.5s;
  box-shadow: -20px 20px 10px rgba(0,0,0,.5);
}
ul li a:before {
  content: '';
  position: absolute;
  top:10px;
  left:-20px;
  height:100%;
  width:20px;
  background: #b1b1b1;
  transform: .5s;
  transform: rotate(0deg) skewY(-45deg);
}
ul li a:after {
  content: '';
  position: absolute;
  bottom:-20px;
  left:-10px;
  height:20px;
  width:100%;
  background: #b1b1b1;
  transform: .5s;
  transform: rotate(0deg) skewX(-45deg);
}

ul li a:hover {
  transform: rotate(-30deg) skew(25deg) translate(20px,-15px);
  box-shadow: -50px 50px 50px rgba(0,0,0,.5);
}

ul li:hover .fa {
  color:#fff;
}

ul li:hover span {
  color:#fff;
}

ul li:hover:nth-child(1) a{
  background: #3b5998;
}
ul li:hover:nth-child(1) a:before{
  background: #365492;
}
ul li:hover:nth-child(1) a:after{
  background: #4a69ad;
}

ul li:hover:nth-child(2) a{
  background: #00aced;
}
ul li:hover:nth-child(2) a:before{
  background: #097aa5;
}
ul li:hover:nth-child(2) a:after{
  background: #53b9e0;
}

ul li:hover:nth-child(3) a{
  background: #dd4b39;
}
ul li:hover:nth-child(3) a:before{
  background: #b33a2b;
}
ul li:hover:nth-child(3) a:after{
  background: #e66a5a;
}

ul li:hover:nth-child(4) a{
  background: #e4405f;
}
ul li:hover:nth-child(4) a:before{
  background: #d81c3f;
}
ul li:hover:nth-child(4) a:after{
  background: #e46880;
}
p {
    font-size: 21px;
}
    </style>
</head>
<body>
<div class="notifications-container">
  <div class="success">
    <div class="flex">
      <div class="flex-shrink-0">
        
        <svg class="succes-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
      </div>
      <div class="success-prompt-wrap">
        <p class="success-prompt-heading">Order completed
        </p><div class="success-prompt-prompt">
          <p>Thank you for choosing to shop on our website. We greatly appreciate your support. We value your trust and look forward to serving you again in the future.</p>
        </div>
          <div class="success-button-container">
            <a href="./shop.php"><button type="button" class="success-button-main">Back to Shop</button></a>    
          </div>
      </div>
    </div>
  </div>
</div>
</div>
<ul>
  <li>
    <a href="https://www.facebook.com/ajiraydiegodeleon">
      <i class="fa fa-facebook" aria-hidden="true"></i>
      <span> - Facebook</span>
    </a>
  </li>
  <li>
    <a href="https://twitter.com/Ajiraydeleon">
      <i class="fa fa-twitter" aria-hidden="true"></i>
      <span> - Twitter</span>
    </a>
  </li>
  <li>
    <a href="https://gifdb.com/gif/dancing-monkey-in-tub-qo51iu1uhitab328.html">
      <i class="fa fa-google-plus" aria-hidden="true"></i>
      <span> - Google</span>
    </a>
  </li>
  <li>
    <a href="https://www.instagram.com/ajiraydeleon/">
      <i class="fa fa-instagram" aria-hidden="true"></i>
      <span> - Instagram</span>
    </a>
  </li>
</ul>
</body>
</html>