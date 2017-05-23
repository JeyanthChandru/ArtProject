SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `cheapbooks` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cheapbooks`;
CREATE TABLE `author` (
  `ssn` bigint(20) NOT NULL,
  `name` mediumtext NOT NULL,
  `address` longtext NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `author` (`ssn`, `name`, `address`, `phone`) VALUES
(1111222233334444, 'Vakali, Athena', 'Aristotle University of Thessaloniki, Greece', 5555555555),
(2222333344445555, 'Tiziana Catarci', 'England', 3067724007),
(3333444455556666, 'Stephen Kimani', 'Las Vegas', 3435243654),
(4444555566667777, 'Alan Dix', 'San Antonio', 7685434753),
(5555666677778888, 'Alex Berson', 'Texas', 4574563845),
(6666777788889999, 'Lars George', 'Oklahoma', 3284327584);

CREATE TABLE `book` (
  `isbn` bigint(20) NOT NULL,
  `title` mediumtext NOT NULL,
  `year` year(4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `publisher` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `book` (`isbn`, `title`, `year`, `price`, `publisher`) VALUES
(9780071744584, 'Master Data Management And Data Governance / Edition 2', 2010, '34.07', 'McGraw-Hill Professional Publishing'),
(9780133887648, 'Web and Network Data Science: Modeling Techniques in Predictive Analytics', 2014, '64.48', 'FT Press'),
(9781449315221, 'HBase: The Definitive Guide: Random Access to Your Planet-Size Data', 2011, '31.99', 'O''Reilly Media, Inc.'),
(9781599042305, 'Web Data Management Practices: Emerging Techniques and Technologies: Emerging Techniques and Technologies', 2001, '69.79', 'IGI Global'),
(9781608452811, 'User-centered Data Management', 2010, '14.85', 'Morgan & Claypool Publishers\r\n');

CREATE TABLE `contains` (
  `isbn` bigint(20) NOT NULL,
  `basketID` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `customer` (
  `username` varchar(14) NOT NULL,
  `address` longtext NOT NULL,
  `email` mediumtext NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `customer` (`username`, `address`, `email`, `phone`, `password`) VALUES
('admin', 'Arlington', 'xyz@gmail.com', 9999999999, '21232f297a57a5a743894a0e4a801fc3'),
('Jeyanth', '1515 Shamrock Bend Lane, #Apt 3222', 'jeyanth.c2008@gmail.com', 5129552698, '3b777b775721dfa8d36de2a320a03e53');

CREATE TABLE `shippingorder` (
  `isbn` bigint(20) NOT NULL,
  `warehouseCode` int(11) NOT NULL,
  `username` varchar(14) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `shippingorder` (`isbn`, `warehouseCode`, `username`, `number`) VALUES
(9781599042305, 1001, 'Jeyanth', 1),
(9781608452811, 1001, 'admin', 1);

CREATE TABLE `shoppingbasket` (
  `basketID` int(11) NOT NULL,
  `username` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `stocks` (
  `isbn` bigint(20) NOT NULL,
  `warehouseCode` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `stocks` (`isbn`, `warehouseCode`, `number`) VALUES
(9780071744584, 1001, 50),
(9780071744584, 1002, 50),
(9780071744584, 1003, 50),
(9781449315221, 1002, 50),
(9781599042305, 1001, 49),
(9781599042305, 1002, 50),
(9781599042305, 1003, 50),
(9781608452811, 1001, 49),
(9781608452811, 1002, 50),
(9781449315221, 1001, 50),
(9780133887648, 1001, 0);

CREATE TABLE `warehouse` (
  `warehouseCode` int(11) NOT NULL,
  `name` mediumtext NOT NULL,
  `address` longtext NOT NULL,
  `phone` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `warehouse` (`warehouseCode`, `name`, `address`, `phone`) VALUES
(1001, 'Main Warehouse', 'Texas', 8237721435),
(1002, 'Warehouse 2', 'San Fransisco', 3432534352),
(1003, 'Store House', 'Arlington', 2352476345);

CREATE TABLE `writtenby` (
  `ssn` bigint(20) NOT NULL,
  `isbn` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `writtenby` (`ssn`, `isbn`) VALUES
(1111222233334444, 9781599042305),
(2222333344445555, 9781608452811),
(3333444455556666, 9781608452811),
(4444555566667777, 9781608452811),
(5555666677778888, 9780071744584),
(6666777788889999, 9781449315221);

ALTER TABLE `author`
  ADD PRIMARY KEY (`ssn`);

ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`);

ALTER TABLE `contains`
  ADD PRIMARY KEY (`basketID`),
  ADD KEY `Contains_fk0` (`isbn`);

ALTER TABLE `customer`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `shippingorder`
  ADD KEY `ShippingOrder_fk0` (`isbn`),
  ADD KEY `ShippingOrder_fk1` (`warehouseCode`),
  ADD KEY `ShippingOrder_fk2` (`username`);

ALTER TABLE `shoppingbasket`
  ADD KEY `ShoppingBasket_fk0` (`basketID`),
  ADD KEY `ShoppingBasket_fk1` (`username`);

ALTER TABLE `stocks`
  ADD KEY `Stocks_fk0` (`isbn`),
  ADD KEY `Stocks_fk1` (`warehouseCode`);

ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouseCode`);

ALTER TABLE `writtenby`
  ADD KEY `WrittenBy_fk0` (`ssn`),
  ADD KEY `WrittenBy_fk1` (`isbn`);

ALTER TABLE `contains`
  ADD CONSTRAINT `Contains_fk0` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);

ALTER TABLE `shippingorder`
  ADD CONSTRAINT `ShippingOrder_fk0` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `ShippingOrder_fk1` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`),
  ADD CONSTRAINT `ShippingOrder_fk2` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

ALTER TABLE `shoppingbasket`
  ADD CONSTRAINT `ShoppingBasket_fk0` FOREIGN KEY (`basketID`) REFERENCES `contains` (`basketID`),
  ADD CONSTRAINT `ShoppingBasket_fk1` FOREIGN KEY (`username`) REFERENCES `customer` (`username`);

ALTER TABLE `stocks`
  ADD CONSTRAINT `Stocks_fk0` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`),
  ADD CONSTRAINT `Stocks_fk1` FOREIGN KEY (`warehouseCode`) REFERENCES `warehouse` (`warehouseCode`);

ALTER TABLE `writtenby`
  ADD CONSTRAINT `WrittenBy_fk0` FOREIGN KEY (`ssn`) REFERENCES `author` (`ssn`),
  ADD CONSTRAINT `WrittenBy_fk1` FOREIGN KEY (`isbn`) REFERENCES `book` (`isbn`);


------------------------------------

<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 30, 2016,
Project Number : Assignment 4 !-->
<!DOCTYPE html>
<html>
<head>
<?php require("basic.php"); ?>
<nav class="navbar">
<form class='navbar-form navbar-right' method="POST">
<?php 
  session_start();
  echo "<h3 style='display:inline-block'><span class='label label-default'>Welcome, ".$_SESSION['username']."</h3></span> <button type='submit' style='display:inline-block' class='btn btn-primary form-group' name='shoppingcart'>Shopping Basket <span class='badge'>".getCartValue1()."</span></button> <input type='submit' style='display:inline-block' class='btn btn-primary form-group' name='buy' value='Buy'> <input type='submit' style='display:inline-block' class='btn btn-primary form-group' name='logout' value='Logout'></form></nav>";
  require("connect.php");
  if(isset($_POST['logout'])){  
  $sql_query = "DELETE FROM shoppingbasket";
  $res = $pdo -> prepare($sql_query);
  $res -> execute();
  $sql = "DELETE FROM contains";
  $result = $pdo -> prepare($sql);
  $result -> execute();
    session_destroy();
    session_start();
  }
    if(!isset($_SESSION['username'])){
    header('Location: customer.php');}
    if(!isset($_SESSION['basket']) || empty($_SESSION['basket'])){
    echo "<script language='javascript'> alert('Add Some Items First'); </script>";}
    if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=array();}
    if(isset($_POST['shoppingcart'])){
    header('Location: cart.php');}
    $values=implode(",",$_SESSION['basket']);
    if(isset($_SESSION['basket']) && !empty($_SESSION['basket'])){
  if(isset($_POST['buy'])){
      require("connect.php");
      $sql_display= "SELECT * FROM book WHERE book.isbn IN ($values)";
      $result = $pdo -> prepare($sql_display);
      $result -> execute();
      $session = getSession();
      while($row = $result->fetch()){
        $isb = $row['isbn'];
        $quan = getQuantity($session[$isb]);
        $warehouseCode = 1001;
        $username = $_SESSION['username'];
        $sql_insert = "INSERT INTO shippingorder VALUES($isb,$warehouseCode,'$username',$quan)";
        $result1 = $pdo -> prepare($sql_insert);
        $result1 -> execute();
        $sql_update = "UPDATE stocks SET number = number - $quan WHERE isbn = $isb AND warehouseCode=$warehouseCode";
        $result2 = $pdo -> prepare($sql_update);
        $result2 -> execute();
      }
      if($result1){
      $sql_query = "DELETE FROM shoppingbasket";
      $res = $pdo -> prepare($sql_query);
      $res -> execute();
      $sql = "DELETE FROM contains";
      $result = $pdo -> prepare($sql);
      $result -> execute();
    }
      unset($_SESSION['basket']);
      unset($_SESSION['cart']);
      unset($_SESSION['count']);
      echo "<script language='javascript' type='text/javascript'> alert('Items Bought'); window.location = 'search.php';</script>";
  }
  $sql_display= "SELECT * FROM book WHERE book.isbn IN ($values)";
  executeQuery($sql_display);
}
    function getCartValue1(){
      $siz=$_SESSION['basket'];
      $size = isset($siz) ? sizeof($siz) : 0;
      return $size;
    }
    function getTotal($result){
      $totalprice = isset($totalprice) ? $totalprice : 0;
      $session = getSession();
      while ($row = $result->fetch()) {
        $quan = getQuantity($session[$row['isbn']]);
        $row['price'] = $row['price'] * $quan;
        $_SESSION['cart'][$row['isbn']]=$row;
      }
      foreach($_SESSION['cart'] as $row){
      $totalprice = $totalprice + $row['price'];
      }
      return $totalprice;
    }

    function executeQuery($sql)
    {
      require("connect.php");
      $result = $pdo -> prepare($sql);
      $result -> execute();
      $session = getSession();
      echo "<table class='table text-justify'>
          <thead>
            <tr><th>ISBN</th>
            <th>Title</th>
            <th>Price</th>
            <th>Publisher</th>
            <th>Quantity</th></tr>
            </thead>
            <tbody>";
      while($row = $result->fetch()){
        $isb = $row['isbn'];
        echo"
        <tr>
        <td>".$isb."</td>
        <td>".$row['title']."</td>
        <td>&#36;".$row['price']."</td>
        <td>".$row['publisher']."</td>
        <td>".getQuantity($session[$isb])."</td></tr>";
        $pdo='';
      }
      $result -> execute();
      echo "</tbody>
      <tfoot>
          <tr>
          <td></td>
          <td>Total Price</td>
          <td>&#36;".getTotal($result)."</td>
          </tr>
      </tfoot></table>";
    }
    function getSession(){
      $session = isset($_SESSION['basket']) ? $_SESSION['basket'] : '';
      $session = array_count_values($session);
      return $session;
    }

    function getQuantity($ses){
        $quantity = $ses;
      return $quantity;
    }
  ?>
</head>
<body>
</body>
</html>

-----------------------------------------

<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 30, 2016,
Project Number : Assignment 4 !-->
<?php
require('basic.php');
session_start();  
require('connect.php');
if(isset($_SESSION['username'])){
        header('Location: search.php');}
 if(isset($_POST['username']) && isset($_POST['password'])){
    $username=stripslashes($_POST['username']);
    $password=stripslashes($_POST['password']);
    $password_md5 = md5($password);
    $sql = "SELECT * FROM customer WHERE username='$username' AND password='$password_md5'";
    $result = $pdo -> query($sql);
    while($row = $result -> fetch()){
        $_SESSION['username']=$row['username'];
    if(isset($_SESSION['username'])) {
        echo "<script language='javascript'> alert('Login Successfull'); window.location='search.php'; </script>";
       }
 }
 if(!isset($_SESSION['username'])){
    echo "<script language='javascript'> alert('Incorrect Username/Password'); </script>";
 }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <script type='text/javascript' src='js.js'></script>
    <style type="text/css" src="css.css"></style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue to CheapBooks.com</h1>
            <div class="account-wall">
                <form class="form-signin" method="POST">
                <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
                </div>
                <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                </div>
            </div>
            <div class="form-group">
            <a class='btn btn-lg btn-primary btn-block' href="newuser.php" class="text-center new-account">Register User</a>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

---------------------------------------------

<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 30, 2016,
Project Number : Assignment 4 !-->
<!DOCTYPE html>
<html>
<head>
<?php require("basic.php"); ?>
  <title>Register A New User</title>
  <style type="text/css" src="css.css"></style>
</head>
<body class="body-class">
<div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title centered">Register for a New User</h3>
            </div>
            <div class="panel-body">
              <form role="form" method="POST">
                <div class="form-group">
                      <input type="text" name="user_name" id="user_name" class="form-control input-sm" placeholder="User Name" required>
                </div>
                <div class="form-group">
                  <input type="text" name="address" id="address" class="form-control input-sm" placeholder="Address" required>
                </div>
                <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
                </div>
                <div class="form-group">
                  <input type="tel" name="phone_num" id="phone_num" class="form-control input-sm" placeholder="Mobile Number" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
                </div>                
                <input type="submit" name="submit_btn" id="submit_btn" value="Register" class="btn btn-info btn-block">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
<?php 
require("connect.php");
    if (isset($_POST['submit_btn'])){
        $username = $_POST['user_name'];    
        $password = $_POST['password'];    
        $address = $_POST['address'];    
    $phone_no = $_POST['phone_num'];  
        $email = $_POST['email'];    
    try {
        $sql = 'INSERT INTO customer VALUES("' . $username .'", "'.$address.'","'.$email.'","'.$phone_no.'","'.md5($password).'")';
    $result = $pdo -> query($sql);
    $Excep = 0;
    } catch(PDOException $e) { 
        if ($e->errorInfo[1] == 1062) {
          $Excep = 1062;
    }
  }
        if($Excep == 1062){
          echo "<script language='javascript'>";
          echo "alert('Username already taken, please try a different username and register')";
          echo "</script>";        
        }
        else{
          echo "<script language='javascript'>";
          echo "alert('Registered Successfully')";
          echo "</script>";
        }
}
?>

--------------------------------------------------

function open_script(){
   window.location.assign('http://localhost/WDM/Project4/newuser.php');
}
-------------------------------------------------

<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 30, 2016,
Project Number : Assignment 4 !-->
<!DOCTYPE html>
<html>
<head>
<?php   require("basic.php"); 
  require("connect.php"); ?>
<nav class="navbar">
<form class='navbar-form navbar-right' method="POST">
  <?php 
  session_start();
  echo "<h3 style='display:inline-block'><span class='label label-default'>Welcome, ".$_SESSION['username']."</h3></span> <input type='submit' style='display:inline-block' class='btn btn-primary form-group' name='logout' value='Logout'> <button type='submit' style='display:inline-block' class='btn btn-primary form-group' name='shoppingcart'>Shopping Basket <span class='badge'>".getCartValue1()."</span></button></form></nav>";
  if(isset($_POST['logout'])){  
  $sql_query = "DELETE FROM shoppingbasket";
  $res = $pdo -> prepare($sql_query);
  $res -> execute();
  $sql = "DELETE FROM contains";
  $result = $pdo -> prepare($sql);
      $result -> execute();
    session_destroy();
    session_start();
  }
  if(!isset($_SESSION['username'])){
    header('Location: customer.php');}
    if(!isset($_SESSION['basket'])){
    $_SESSION['basket']=array();
  header("Location:search.php");
  }
    if(!isset($_SESSION['cart'])){
    $_SESSION['cart']=array();}
    if(!isset($_SESSION['count'])){
    $_SESSION['count']=1;}
    if(!isset($_SESSION['cartValue'])){
    $_SESSION['cart']=array();}
    if(isset($_POST['shoppingcart'])){
      if(!isset($_SESSION['basket']) || empty($_SESSION['basket'])){
    echo "<script language='javascript'> alert('Add Some Items First'); </script>";
      }
      else if(isset($_SESSION['basket']) && !empty($_SESSION['basket'])){
    header('Location: cart.php');}}
  ?>
  <script type="text/javascript" src="js.js">
  </script>
</head>
<body class="textHighlight">
  <?php
  function getValue(){
    if(isset($_GET['title'])){
    $value= isset($_GET['title']) ? $_GET['title'] : '';
    return $value;
  }
  }
  function getAuthor(){
    if(isset($_GET['author'])){
    $author= isset($_GET['author']) ? $_GET['author'] : '';
    return $author;
  }
  } 
      function getCartValue(){
      $isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';
      if(isset($_GET['isbn'])){
      array_push($_SESSION['basket'],$isbn);
      $_SESSION['basket']=array_diff($_SESSION['basket'], array(''));
      $siz=$_SESSION['basket'];
    }
      $size = isset($siz) ? sizeof($siz) : 0;
      return $size;
    }

    function getCartValue1(){
      $siz = isset($_SESSION['basket']) ? $_SESSION['basket'] : 0;
      $size = isset($siz) ? sizeof($siz) : 0;
      return $size;
    }

    function getCopies($isbn){
      require("connect.php");
      $query = "SELECT * FROM book,stocks,warehouse WHERE book.isbn = $isbn AND book.isbn = stocks.isbn AND warehouse.warehousecode = stocks.warehousecode";
      $res = $pdo -> prepare($query);
      $res -> execute();
      $num = 0;
      while($cont = $res->fetch()){
        $num = $num + $cont['number'];
      }
      return $num;
    }
  ?>
  <div class='col-lg-12'>
    <h1>Search Results</h1><hr>
    <div class="highlight">
      <form method="GET">
        <fieldset>
        <input type="radio" id="search_value" name="search_radio"> 
        <label for="search_value">Filter by Title</label><br>
        <input class="form-control" type="text" id="value_text_search" name="value_text_search" value="<?php echo getValue(); ?>"><br>
        <input type="radio" id="search_description" name="search_radio"> 
        <label for="search_description">Filter by Author</label><br>
        <input class="form-control" type="text" id="desc_text_search" name="desc_text_search" value="<?php echo getAuthor();?>"><br>
        <input type="radio" id="display_all" name="search_radio"> 
        <label for="display_all">No Filter (show all books)</label><br>
        <input type="submit" id="filter_button" name="filter_button" class="btn btn-primary" value="Filter">
        </fieldset>
        <script>hideAll();</script>
      </form>
    </div>
    <?php
    if(isset($_SESSION['username'])){
    if(isset($_GET['filter_button'])){
      $value= isset($_GET['value_text_search']) ? $_GET['value_text_search'] : '';
      $author= isset($_GET['desc_text_search']) ? $_GET['desc_text_search'] : '';
        if($value!='' && $author==''){
          $redirect = "search.php?title=".$value;
          echo "<script>window.location.href = '$redirect';</script>";
        }
        if($value=='' && $author!=''){
          $redirect = "search.php?author=".$author;
          echo "<script>window.location.href = '$redirect';</script>";
        }
        if($author=='' && $value==''){
          $redirect = "search.php?displayAll=true";
          echo "<script>window.location.href = '$redirect';</script>";
        }
    }
    function executeQuery($sql)
    {
      require("connect.php");
      $result = $pdo -> prepare($sql);
      $result -> execute();
      echo "<table class='table text-justify'>
          <thead>
            <tr><th>ISBN</th>
            <th>Title</th>
            <th>Price</th>
            <th>Copies</th>
            <th>Cart</th>
            </thead>";
      while($row = $result->fetch()){
        $isb = $row['isbn'];
        $copy = getCopies($row['isbn']);
        if($copy == 0){
          continue;
        }
        echo"
        <tr>
        <td>".$isb."</td>
        <td>".$row['title']."</td>
        <td>&#36;".$row['price']."</td>
        <td>".$copy."</td>
        <td><a href='search.php?isbn=$isb' role='button' class='btn btn-primary' name='addcart' id='addcart'>Add to Cart</a>";
        $pdo='';
      }
      echo "</tr></table>";
    }

    if(isset($_GET['title'])){
      $value= isset($_GET['title']) ? '%'.$_GET['title'].'%' : '';
      $val = $_GET['title'];
      $sql = "SELECT * FROM book WHERE title LIKE '$value'";
      echo "<script type='text/javascript'> showValue(); </script>";
      executeQuery($sql);
      echo "<script type='text/javascript'> $('.textHighlight *').highlight('".$val."', 'highlight1');</script>";

    }

    else if(isset($_GET['author'])){
      $author = isset($_GET['author']) ? '%'.$_GET['author'].'%' : '';
      $des = $_GET['author'];
      $sql = "SELECT * FROM author,book,writtenby WHERE author.ssn = writtenby.ssn AND book.isbn = writtenby.isbn AND name LIKE '$author'";
      echo "<script type='text/javascript'> showAuthor(); </script>";
      executeQuery($sql);
      echo "<script type='text/javascript'> $('.textHighlight *').highlight('".$des."', 'highlight1');</script>";
    }

    else if(isset($_GET['displayAll'])){
      $sql = "SELECT * FROM book";
      echo "<script type='text/javascript'> showAll(); </script>";
      executeQuery($sql);
    }

    else if(isset($_GET['isbn'])){
      $isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';
      if(isset($_SESSION['count'])){
        $count = $_SESSION['count'];
        $_SESSION['count']++;
      }
      $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
      $size = getCartValue();
      $sql = "INSERT INTO contains VALUES($isbn,$count,1)";
      require("connect.php");
      $result = $pdo -> prepare($sql);
      $result -> execute();
      if($result){
        $redirect = "search.php?displayAll=true";
        $sql_query="INSERT INTO shoppingbasket VALUES($count,'$username')";
        $res = $pdo -> prepare($sql_query);
        $res -> execute();
        if($res){
        echo "<script language='javascript'>
        alert('Added to Cart Successfully');
        window.location.href = '$redirect';
        </script>";     
      }
      }
    }
}
    ?>
  </div>
</body>
</html>