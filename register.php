<?php
	session_start();
	include('dbconfig/config.php');
	//phpinfo();
?>
<?php
			if(isset($_POST['register']))
			{
				@$username=$_POST['username'];
				@$password=$_POST['password'];
				@$cpassword=$_POST['cpassword'];
				@$email=$_POST['email'];
				@$firstname=$_POST['firstname'];
				@$lastname=$_POST['lastname'];
				@$phone_number=$_POST['phone_number'];
				@$address_line=$_POST['address_line'];
				@$city=$_POST['city'];
				@$province=$_POST['province'];
				@$postal_code=$_POST['postal_code'];

				if($password==$cpassword)
				{
				$query = "select * from client where username ='$username'";
				//echo $query;
				$query_run = mysqli_query($connect, $query);
				//echo mysql_num_rows($query_run);
				if($query_run)
					{
						if(mysqli_num_rows($query_run)>0)
						{
							echo '<script type="text/javascript">alert("This Username Already exists.. Please try another username!")</script>';
						}
						else
						{
							$stmt = $connect->prepare("INSERT INTO client (username, password, email, firstname, lastname, phone_number, address_line, city, province, postal_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
							$stmt->bind_param('ssssssssss', $username, $password, $email, $firstname, $lastname, $phone_number, $address_line, $city, $province, $postal_code);
							$username = $username;
							$password = $password;
							$email = $email;
							$firstname = $firstname;
							$lastname = $lastname;
							$phone_number = $phone_number;
							$address_line = $address_line;
							$city = $city;
							$province = $province;
							$postal_code = $postal_code;
							$stmt->execute();
							if($query_run)
							{
								echo '<script type="text/javascript">alert("User Registered.. Welcome")</script>';
								$_SESSION['username'] = $username;
								$_SESSION['password'] = $password;
								$_SESSION['email'] = $email;
								$_SESSION['firstname'] = $firstname;
								$_SESSION['lastname'] = $lastname;
								$_SESSION['phone_number'] = $phone_number;
								$_SESSION['address_line'] = $address_line;
								$_SESSION['city'] = $city;
								$_SESSION['province'] = $province;
								$_SESSION['postal_code'] = $postal_code;
								header( "Location: index.php");
							}
							else
							{
								echo '<p class="bg-danger msg-block">Registration Unsuccessful due to server error. Please try later</p>';
							}
						}
					}
					else
					{
						echo '<script type="text/javascript">alert("DB error")</script>';
					}
				}
				else
				{
					echo '<script type="text/javascript">alert("Password and Confirm Password do not match")</script>';
				}
			}
			else
			{
			}
?>		
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<!--===============================================================================================-->
</head>
<body style="background-image: url(background.jpg); background-repeat: no-repeat; background-size: 100%;">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login101">
				<div class="login101-pic js-tilt" data-tilt>
					<a href="index.php"><img src="login design/images/img-01.png" alt="IMG"></a>
				</div>

				<form class="login100-form validate-form" action="register.php" method="post">
					<span class="login101-form-title">
						Registration
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input101" type="text" placeholder="Email" name="email" autocomplete="off" required>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input101" type="text" placeholder="Enter Username" name="username" autocomplete="off" required>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fas fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input101" type="text" placeholder="Firstname" name="firstname" autocomplete="off" required>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fas fa-address-card" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input101" type="text" placeholder="Lastname" name="lastname" autocomplete="off" required>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="far fa-address-card" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input101" type="number" placeholder="Phone Number" name="phone_number" autocomplete="off" required>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fas fa-phone" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input101" type="text" placeholder="Address" name="address_line" autocomplete="off" required>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fas fa-map-marker" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<select class="input101" name="province" id="province" required>
						<option value="">Select province</option>
					</select>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fas fa-university" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<select class="input101" name="city" id="city" required>
						<option value="">Select city</option>
					</select>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fas fa-city" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input101" type="number" placeholder="Postal Code" name="postal_code" autocomplete="off" required>
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fas fa-podcast" aria-hidden="true"></i>
						</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input101" type="password" placeholder="Enter Password" name="password" required minlength="8">
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input101" type="password" placeholder="Re-Enter Password" name="cpassword" required minlength="8">
						<span class="focus-input101"></span>
						<span class="symbol-input101">
							<i class="fas fa-unlock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login101-form-btn">
						<button class="login101-form-btn" name="register" type="submit" href="index.php">
							Sign Up
						</button>
					</div>
					<div class="text-center p1t-136">
						<a class="txt2" href="login.php">
							Back To Login
							<i class="fas fa-arrow-circle-right" aria-hidden="true"></i>
						</a>
					</div>
					
				</form>

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

<script>
$(document).ready(function(){

 load_json_data('province');

 function load_json_data(id, parent_id)
 {
  var html_code = '';
  $.getJSON('prov_city.json', function(data){

   html_code += '<option value="">Select '+id+'</option>';
   $.each(data, function(key, value){
    if(id == 'province')
    {
    	if(value.parent_id == '0')
     {
      html_code += '<option value="'+value.id+'">'+value.name+'</option>';
     }
    }
    else
    {
     if(value.parent_id == parent_id )
     {
      html_code += '<option value="'+value.id+'">'+value.name+'</option>';
     }
    }
   });
   $('#'+id).html(html_code);
  });

 }

 $(document).on('change', '#province', function(){
  var province_id = $(this).val();
  if(province_id != '')
  {
   load_json_data('city', province_id);
  }
  else
  {
   $('#city').html('<option value="">Select city</option>');
  }
 });
});
</script>