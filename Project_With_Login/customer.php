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
