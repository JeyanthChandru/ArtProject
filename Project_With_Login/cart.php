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