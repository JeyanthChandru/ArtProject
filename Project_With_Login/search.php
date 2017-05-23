<!DOCTYPE html>
<html>
<head>
	<?php 	require("basic.php"); 
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