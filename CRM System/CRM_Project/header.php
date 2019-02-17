<?php 
  
  session_start(); //start a session
  //get database connection
  require('connect.php');
  //connect to functions page
  require('functions.php');
 

  
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  
  <link rel="stylesheet" href="css/styles-mf.css">
  <link rel="stylesheet" href="css/bootstrap.css">
 

  <!--link for 'source sans pro' font-->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  
  
  <title>Mr. Edge</title>

</head>

<body>
<div class="container">


    <header>
      <h1 class="title">Mr. Edge</h1>
    </header>

    <main class="main-content">

      <nav class="nav-bar">
        <ul>
  <?php if (isset($_SESSION['un']) && !empty($_SESSION['un']) && $_SESSION['admin'] == 'a'){ ?>
          <li class="nav-li"><a href="index.php">Home</a></li>
          <li class="nav-li"><a href="customer_search.php">Search Customers</a></li>
          <li class="nav-li"><a href="customers_county.php">Customers by County</a></li>
          
          <li class="nav-li"><a href="customer_add.php">Add Customer</a></li>
          <li class="nav-li"><a href="user_add.php">Add User</a></li>
          <li class="nav-li"><a href="logout.php">Logout</a></li>
    <?php }else if($_SESSION['admin'] == 'n'){
          
          echo "<li class='nav-li'><a href='customer_search.php'>Search Customers</a></li>
                <li class='nav-li'><a href='logout.php'>Logout</a></li>";
                }    ; ?>
                
        </ul>
      </nav>