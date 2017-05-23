<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 20, 2016,
Project Number : Assignment 3 !-->
<!DOCTYPE html>
<html>
	<head>
		<title>CSE5335 - Project3</title>
		<link rel="icon" href="http://cdn.mysitemyway.com/etc-mysitemyway/icons/legacy-previews/icons/glossy-black-3d-buttons-icons-alphanumeric/070542-glossy-black-3d-button-icon-alphanumeric-letter-aa.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
		<?php require("basic.php"); ?>
		<style type="text/css">
			body{
				padding-left: 0px;
				width:100%;
			}
		</style>
	</head>
	<body>
		<section class="jumbotron">
      		<section class="container">
		        <h1>Welcome to Project #3</h1>
		        <p>This is the third assignment in Web Data Management for Chandru, Jeyanth for CSE5335</p>
	      	</section>
    	</section>
    	<section class="row">
	        <section class="col-sm-2">
  	          <h2><span class="glyphicon glyphicon-info-sign"></span> About us</h2>
	          <p>What this is all about and other stuff</p>
	          <p><a class="btn btn-default" href="AboutUs.php" role="button"><span class="glyphicon glyphicon-link"></span> Visit Page</a></p>
	        </section>
	        <section class="col-sm-2">
	          <h2><span class="glyphicon glyphicon-list"></span> Artist List</h2>
	          <p>Displays a list of artist names as links </p>
				<p><a class="btn btn-default" href="Part01_ArtistsDataList.php" role="button"><span class="glyphicon glyphicon-link"></span> Visit Page</a></p>
	       </section>
	        <section class="col-sm-2">
	          <h2><span class="glyphicon glyphicon-user"></span> Single Artist</h2>
	          <p>Displays information for a single artist</p>
				<p><a class="btn btn-default" href="Part02_SingleArtist.php" role="button"><span class="glyphicon glyphicon-link"></span> Visit Page</a></p>
	        </section>
	        <section class="col-sm-2">
	          <h2><i class="fa fa-image" style="font-size:24px"></i> Single Work</h2>
	          <p>Displays information for a single work</p>
				<p><a class="btn btn-default" href="Part03_SingleWork.php" role="button"><span class="glyphicon glyphicon-link"></span> Visit Page</a></p>
	        </section>
	        <section class="col-sm-2">
	          <h2><i class="fa fa-search" style="font-size:24px"></i> Search</h2>
	          <p>Perform search on ArtWorks tables</p>
				<p><a class="btn btn-default" href="Part04_Search.php" role="button"><span class="glyphicon glyphicon-link"></span> Visit Page</a></p>
	        </section>
      </section>
	</body>
</html>
