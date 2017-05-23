<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 20, 2016,
Project Number : Assignment 3 !-->
<!DOCTYPE html>
<html>
<head>
	<?php require("basic.php") ?>
</head>
<body>
<?php
if (isset($_GET['artid'])) {
$artwork_id= isset($_GET['artid']) ? $_GET['artid'] : '';
require("connect.php");
$sql = "SELECT * FROM artworks, artists WHERE artworks.ArtWorkID = $artwork_id AND artworks.ArtistID = artists.ArtistID";
$sql_genre = "SELECT g.GenreName FROM genres g, artworkgenres a WHERE a.ArtWorkID = $artwork_id AND g.GenreID = a.GenreID";
$sql_subjects = "SELECT s.SubjectName FROM subjects s,artworksubjects ar WHERE ar.ArtWorkID= $artwork_id AND s.SubjectId = ar.SubjectID";
$sql_sales = "SELECT o.DateCreated FROM orders o,orderdetails od WHERE od.ArtWorkID=$artwork_id AND od.OrderID=o.OrderID";
$result = $pdo -> prepare($sql);
$result -> execute();
$data_exists = $result->fetch();
if($data_exists > 0)
{
	$url = "Part02_SingleArtist.php?id=".$data_exists['ArtistID'];
	$FullName = $data_exists['FirstName']. " " . $data_exists['LastName'];
	echo "<h2>".$data_exists['Title']."</h2>";
	echo "<p>By <a href=".$url.">".$FullName."</a></p>";
	echo "<div class='col-md-4'>";
	$img_src = "images/art/works/medium/".$data_exists['ImageFileName'].".jpg";
	echo "<img src=".$img_src." class='thumbnail img-responsive' data-toggle='modal' data-target='#imgView'>";
	echo "<div class='modal fade' id='imgView' role='dialog'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal'>&times;</button>
					".$data_exists['Title']. " (".$data_exists['YearOfWork'].") by ".$FullName."
					</div>
					<div class='modal-body'>
						<center><img src=".$img_src." class='img-responsive'></center>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default'data-dismiss='modal'>Close</button>
					</div>
				</div>
			</div>
		</div>
		</div>";
	echo "<div class='col-md-6'>";
	echo "<p class='text-justify'>".$data_exists['Description']."</p>";
	echo "<p class= 'price-tag'>&#36;".number_format((float)$data_exists['MSRP'], 2, '.', '')."</p>";
	echo "<div class='btn-group'>
			<a href='#' role='button' class='btn btn-default blueLinks'><span class='glyphicon glyphicon-gift blueLinks'></span> Add to Wish List</a>
			<a href='#' role='button' class='btn btn-default blueLinks'><span class='glyphicon glyphicon-shopping-cart blueLinks'></span> Add to Shopping Cart</a>
			</div>";
	echo "<br/><br/><div class='panel panel-default'><table class='table table-bordered-custom'>
			<thead>
				<tr>
					<th colspan='2'>Product Details</th>
				</tr>
			</thead>
			<tr>
				<td><strong>Date:</strong></td>
				<td>".$data_exists['YearOfWork']."</td>
			</tr>
			<tr>
				<td><strong>Medium:</strong></td>
				<td>".$data_exists['Medium']."</td>
			</tr>
			<tr>
				<td><strong>Dimensions:</strong></td>
				<td>".$data_exists['Width']."cm x ".$data_exists['Height']."cm</td>
			</tr>
			<tr>
				<td><strong>Home:</strong></td>
				<td>".$data_exists['OriginalHome']."cm</td>
			</tr>
			<tr>
				<td><strong>Genres:</strong></td><td>";
					$result_genre = $pdo -> prepare($sql_genre);
					$result_genre -> execute();
					while($row = $result_genre->fetch())
					{
						echo "<a href='#'>".$row['GenreName']."</a><br>";
					}
				echo"</td>
			</tr>
			<tr>
				<td><strong>Subjects:</strong></td><td>";
					$result_subjects = $pdo -> prepare($sql_subjects);
					$result_subjects -> execute();
					while($row1 = $result_subjects -> fetch())
					{
						echo "<a href='#'>".$row1['SubjectName']."</a><br>";
					}
				echo"</td>
			</tr>
		</table>
		</div>";
	echo "</div>";
	echo "<div class='col-md-2'>";
	echo "<div class='panel panel-default'>
			<table class='table table-bordered-custom'>
				<thead>
					<tr>
						<th>Sales</th>
					</tr>
				</thead>";
					$result_sales = $pdo -> prepare($sql_sales);
					$result_sales -> execute();
					while($row2 = $result_sales -> fetch())
					{
						$date = new DateTime($row2['DateCreated']);
						echo "<tr><td><a href='#'>".$date->format('n-j-y')."</a></td></tr>";
					}
				echo "</table></div>";
}
else{
header('Location:error.php');
}
}
else{
header('Location:error.php');
}
?>
</body>
</html>