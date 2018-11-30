<?php
  session_start();
  require_once('dbconfig/config.php');
  //phpinfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login design/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login design/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login design/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login design/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login design/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login design/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login design/css/util.css">
	<link rel="stylesheet" type="text/css" href="login design/css/main.css">
<!--===============================================================================================-->
</head>
<body style="background-image: url(background.jpg); background-repeat: no-repeat; background-size: 100%;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<a href="login.php"><img src="login design/images/img-01.png" alt="IMG"></a>
				</div>

				<form class="login100-form validate-form" action="login.php" method="post" role="form">
					<span class="login100-form-title">
						Log In
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" placeholder="Enter Username" name="username" autocomplete="off" required size="20">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input  class="input100" type="password" placeholder="Enter Password" name="password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="register.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
	<?php
      if(isset($_POST['login']))
      {
        @$username=$_POST['username'];
        @$password=$_POST['password'];
        $query = "SELECT * FROM client WHERE username='$username' AND password='$password' ";
        //echo $query;
        $query_run = mysqli_query($connect,$query);
        //echo mysql_num_rows($query_run);
        if($query_run)
        {
          if(mysqli_num_rows($query_run)>0)
          {
          $row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
          
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          header( "Location: index.php");
          }
          else
          {
            echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
          }
        }
        else
        {
          echo '<script type="text/javascript">alert("Database Error")</script>';
        }
      }
      else
      {
      }
    ?>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="login design/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login design/vendor/bootstrap/js/popper.js"></script>
	<script src="login design/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login design/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login design/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="login design/js/main.js"></script>

</body>
</html>