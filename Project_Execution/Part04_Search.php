<!-- Last Name : Chandru, First Name : Jeyanth, Due Date : November 20, 2016,
Project Number : Assignment 3 !-->
<!DOCTYPE html>
<html>
<head>
	<?php require("basic.php") ?>
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
	function getDesc(){
		if(isset($_GET['desc'])){
		$desc= isset($_GET['desc']) ? $_GET['desc'] : '';
		return $desc;
	}
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
				<label for="search_description">Filter by Description</label><br>
				<input class="form-control" type="text" id="desc_text_search" name="desc_text_search" value="<?php echo getDesc();?>"><br>
				<input type="radio" id="display_all" name="search_radio"> 
				<label for="display_all">No Filter (show all art works)</label><br>
				<input type="submit" id="filter_button" name="filter_button" class="btn btn-primary" value="Filter">
				</fieldset>
				<script>hideAll();</script>
			</form>
		</div>
		<?php
		if(isset($_GET['filter_button'])){
			$value= isset($_GET['value_text_search']) ? $_GET['value_text_search'] : '';
			$desc= isset($_GET['desc_text_search']) ? $_GET['desc_text_search'] : '';
				if($value!='' && $desc==''){
					header('Location:Part04_Search.php?title='.$value);
				}
				if($value=='' && $desc!=''){
					header('Location:Part04_Search.php?desc='.$desc);
				}
				if($desc=='' && $value==''){
					header('Location:Part04_Search.php?displayAll=true');
				}
		}
		function executeQuery($sql)
		{
			require("connect.php");
			$result = $pdo -> prepare($sql);
			$result -> execute();
			
			while($row = $result->fetch()){
				$img_src = "images/art/works/square-medium/".$row['ImageFileName'].".jpg";
				$url = "Part03_SingleWork.php?artid=".$row['ArtWorkID'];
				echo "
				<table class='table text-justify'>
				<tr>
				<td class='adjust-width'><a href=".$url."><img src=".$img_src." class='thumbnail'></a></td>
				<td><a href=".$url.">".$row['Title']."</a><br>".$row['Description']."</td></tr></table>";
			}
		}
		
		if(isset($_GET['title'])){
			$value= isset($_GET['title']) ? '%'.$_GET['title'].'%' : '';
			$val = $_GET['title'];
			$sql = "SELECT * FROM artworks WHERE Title LIKE '$value'";
			echo "<script type='text/javascript'> showValue(); </script>";
			executeQuery($sql);
			echo "<script type='text/javascript'> $('.textHighlight *').highlight('".$val."', 'highlight1');</script>";

		}

		else if(isset($_GET['desc'])){
			$desc = isset($_GET['desc']) ? '%'.$_GET['desc'].'%' : '';
			$des = $_GET['desc'];
			$sql = "SELECT * FROM artworks WHERE Description LIKE '$desc'";
			echo "<script type='text/javascript'> showDesc(); </script>";
			executeQuery($sql);
			echo "<script type='text/javascript'> $('.textHighlight *').highlight('".$des."', 'highlight1');</script>";
		}

		else if(isset($_GET['displayAll'])){
			$sql = "SELECT * FROM artworks ORDER BY Title";
			echo "<script type='text/javascript'> showAll(); </script>";
			executeQuery($sql);
		}

		?>
	</div>
</body>
</html>