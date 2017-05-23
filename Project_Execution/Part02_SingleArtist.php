<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 20, 2016,
Project Number : Assignment 3 !-->
<!DOCTYPE html>
<html>
<head>
	<?php require("basic.php") ?>
</head>
<body>
<?php
if (isset($_GET['id'])) {
$artist_id= isset($_GET['id']) ? $_GET['id'] : '';
require("connect.php");
$sql = "SELECT * FROM artists WHERE ArtistID = $artist_id";
$result = $pdo -> prepare($sql);
$result -> execute();
$data_exists = $result->fetch();
if($data_exists > 0)
{
	$FullName = $data_exists['FirstName']. " " . $data_exists['LastName'];
	$artist_img = "images/art/artists/medium/".$artist_id.".jpg";
	echo "<div class=col-md-12><h2>".$FullName. "</h2></div>";
	echo "<div class='col-sm-4 col-md-4'><img src=".$artist_img." class = 'img-thumbnail'></div>";
	echo "<div class='col-sm-4 col-md-6'><p class='text-justify'>". $data_exists['Details']. "</p>";
	echo "<a class='btn btn-default blueLinks' href='#' role='button'><span class='glyphicon glyphicon-heart blueLinks'></span> Add to Favorites List</a>";
	echo "<br/></br><div class='panel panel-default'><table class='table table-bordered-custom'>
			<thead>
				<tr>
					<th colspan='2'>Artist Details</th>
				</tr>
			</thead>
			<tr>
				<td><strong>Date:</strong></td>
				<td>".$data_exists['YearOfBirth']." - ".$data_exists['YearOfDeath']."</td>
			</tr>
			<tr>
				<td><strong>Nationality:</strong></td>
				<td>".$data_exists['Nationality']."</td>
			</tr>
			<tr>
				<td><strong>More Info:</strong></td>
				<td><a href=".$data_exists['ArtistLink'].">".$data_exists['ArtistLink']."</a></td>
			</tr>
		</table>
		</div>
		</div>";
	echo "<div class=col-md-12><h3>Art by ".$FullName."</h3></div>";
$sql_art = "SELECT * FROM artworks WHERE ArtistID = ".$artist_id;
$result = $pdo -> prepare($sql_art);
$result -> execute();
while ($row = $result -> fetch()) {
	$url = "Part03_SingleWork.php?artid=".$row['ArtWorkID'];
	echo "<div class='thumbnail col-xs-12 col-sm-6 col-md-2 singlePaintingByArtist overFlow'>";
	echo "<a href = ".$url."><img class ='thumbnail' src=images/art/works/square-medium/".$row['ImageFileName'].".jpg></a>";
	echo "<a href = ".$url.">".$row['Title'].", ".$row['YearOfWork']."</a><br/>";
	echo "<a href = ".$url." role = 'button' class='btn btn-primary btn-xs margin-padding'> <span class='glyphicon glyphicon-info-sign'></span> View </a>";
	echo "<a href = # role = 'button' class='btn btn-success btn-xs margin-padding'> <span class='glyphicon glyphicon-gift'></span> Wish </a>";
	echo "<a href = # role = 'button' class='btn btn-info btn-xs margin-padding'> <span class='glyphicon glyphicon-shopping-cart'></span> Cart </a>";
	echo "</div>";
}

}
else{
header('Location:error.php');
}
$pdo = null;
}
else{
header('Location:error.php');
}
?>

</body>
</html>