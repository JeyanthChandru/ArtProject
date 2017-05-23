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
