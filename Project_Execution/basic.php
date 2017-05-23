<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 20, 2016,
Project Number : Assignment 3 !-->
<!DOCTYPE html>
<html>
<head>
		<link rel="icon" href="http://cdn.mysitemyway.com/etc-mysitemyway/icons/legacy-previews/icons/glossy-black-3d-buttons-icons-alphanumeric/070542-glossy-black-3d-button-icon-alphanumeric-letter-aa.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	</head>
<body>
<nav class="navbar navbar-fixed-top navbar-inverse">
			<section class="container">
				<section class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            			<span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
          			</button>
					<a class="navbar-brand" href="#">Project 3</a>
		        </section>
		        <form class='navbar-form navbar-right' method="POST">
		        	<input class="form-control" type="text" name="title_search" id="title_search" placeholder="Search Paintings">
		        	<input type="submit" class="btn btn-primary" name="search_start" value="Search">
		        </form>
		        <?php
				if(isset($_POST['search_start'])){
				$value= isset($_POST['title_search']) ? $_POST['title_search'] : '';
				if($value!=''){
					header('Location:Part04_Search.php?title='.$value);
				}
				}
				?>
		        <section id="navbar" class="collapse navbar-collapse">
			        <ul class="nav navbar-nav">
			            <li class="active"><a href="default.php">Home</a></li>
			            <li><a href="AboutUs.php">About Us</a></li>
						<li class="dropdown">
			              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
			              <ul class="dropdown-menu">
			                <li><a href="Part01_ArtistsDataList.php">Artists Data List (Part 1)</a></li>
			                <li><a href="Part02_SingleArtist.php">Single Artist (Part 2)</a></li>
			                <li><a href="Part03_SingleWork.php">Single Work (Part 3)</a></li>
			                <li><a href="Part04_Search.php">Search (Part 4)</a></li>
			              </ul>
			            </li>			        
			        </ul>
		        </section>
		    </section>
		</nav>
				
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    	<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
</body>
</html>