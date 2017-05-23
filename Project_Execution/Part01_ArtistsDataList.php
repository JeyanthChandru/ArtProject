<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 20, 2016,
Project Number : Assignment 3 !-->
<!DOCTYPE html>
<html>
<head>
	<?php require("basic.php") ?>
	<title>Artist Data List</title>
</head>
<body>
<h1>Artist Data List (Part 1)</h1><hr>
<?php
try{
require("connect.php");
$sql = "SELECT * FROM artists ORDER BY LastName";
$result = $pdo -> query($sql);
while($row = $result -> fetch()){
	echo "<a href=Part02_SingleArtist.php?id=".$row['ArtistID'].">".$row['FirstName']. " ".$row['LastName']." (".$row['YearOfBirth']. " - " .$row['YearOfDeath']. ")</a><br/>";
}
$pdo = null;
}
catch(PDOException $e){
	die($e -> getMessage());
}
?>
</body>
</html>