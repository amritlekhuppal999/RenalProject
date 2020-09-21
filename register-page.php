<?php 
ini_set('display_errors', true);
include('function/function.class.php');
CheckLogin();
	
	if(!empty($_GET["msg"])){
		$disp_msg = $_GET["msg"]; 
	}else{
		$disp_msg = "";
	}

	// REGISTER
	if(isset($_POST["register"])){
		//echo "REGISTER";
		//$formData = array();
		if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["phone-no"]) && !empty($_POST["password"])){

			//WRITE CONDITION TO CHECK SAME EMAIL/USERNAME.

			$formData = array(
				"name" => $_POST["name"],
				"username" => $_POST["email"],
				"email" => $_POST["email"],
				"password" => md5($_POST["password"]),
				"phone_no" => $_POST["phone-no"],
				
				"status" => 1,
				"cby" => 1,
				"cip" => "",
				"cdate" => date("Y:m:d h:i:s")
			);


			$insert = new RowInsert("admin", $formData);
			if(!!$insert->id){
			  	$_SESSION["userid"] = $insert->id;
	          	$_SESSION["email"] = $formData["email"];
	          	$_SESSION["name"] = $formData["name"];
	          	$_SESSION["userType"] = 1;
	          	$loc = LOCAL_HOME_URL;
	        }
	        else{
	        	$msg = 'Unable to add user.';
          		$loc = LOCAL_HOME_URL.'register-page.php?msg='.$msg;
	        }
		}
		ReDirect($loc);
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Login|Register</title>
	
	<!-- Tell the browser to be responsive to screen width -->
  	<meta name="viewport" content="width=device-width, initial-scale=1">

  	<!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"> -->

    <!-- Select2 -->
    <!-- <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->

    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->

    <style>
    	body{
    		/*text-align:center;*/
    		display: flex;
  			justify-content: center;
  			/*min-width:550px;*/
    	}

    	.container{
    		/*margin:50px 100px;*/
    	}
    	.select-login{
    		display:flex;
    		flex-direction: column;

    		background-color: white;
    		width:500px;
    		/*height: 200px;*/
    		border: 2px solid lightgrey;
    		box-shadow: 1px 2px 5px 1px #888888;
    		border-radius: 5px;
    	}
    	.select-login > select{
    		width:100px;
    		padding:10px;
    		margin: 20px 20px 15px 20px;
    		background-color: white;
    		border: 2px solid lightgrey;
    		border-radius: 5px;
    	}
    	.select-login > input{
    		margin: 15px 20px;
    		padding: 15px;
    		border: 2px solid lightgrey;
    		border-radius: 5px;
    	}
    	.sign-up{
    		cursor: pointer;
    		font-size: 20px;
    		padding: 15px;
    		margin: 10px 20px;
    		color: white;
    		background-color: #0A79DF;
    		border: 1px solid #0A79DF !important;
    		border-radius: 5px;
		}
		.sign-up:hover{
			background-color: #2475B0;
			transition: 0.5s background-color;
		}

    	.form-footer{
    		display: flex;
    		align-items: center;
    		/*justify-content: space-between;*/
    		margin: 20px;
    	}
    	.form-footer > a{
    		text-decoration: none;
    		color: #2475B0;
    	}

    	.error-msg{
    		color:red;
    		font-size: 20px;
    	}

    </style>
</head>
<body>

	<div class="container">
		<h1>Sign Up</h1>

		<!-- Login Form -->
		<form action="#" method="post" onsubmit="return validate()">
			<div class="select-login">
				<!-- Select User -->
				<!-- <label>User Type</label> -->
				<!-- <select name="userType" id="userType">
					<option value=0>Select</option>
					<option value=1>Admin</option>
					<option value=2>Doctor</option>
					<option value=3>Staff</option>
				</select> -->

				<!-- Name -->
				<input type="text" name="name" id="name" placeholder="Name" autocomplete="off"/>

				<!-- Email-id -->
				<input type="email" name="email" id="email" placeholder="Email-id" autocomplete="off"/>

				<!-- Phone No -->
				<input type="number" name="phone-no" id="phone-no" placeholder="Phone No" autocomplete="off"/>

				<!-- Username -->
				<!-- <input type="text" name="username" id="username" placeholder="Username" autocomplete="off"/> -->

				<!-- Password -->
				<input type="password" name="password" id="password" placeholder="Password" />

				<!-- Sign-in -->
				<button type="submit" name="register" class="sign-up">Sign Up</button>

				<!-- Footer -->
				<div class="form-footer">
					<a href="<?php echo LOCAL_HOME_URL.'login-page.php';?>">Sign In</a>
					<span class="error-msg"><?php echo $disp_msg;?></span>
				</div>
			</div>
		</form>

	</div>

	

</body>
</html>

<script>
	
	function validate(){
		let userType = document.getElementById('userType').value;
		let name = document.getElementById('name').value;
		let email_id = document.getElementById('email').value;
		let phone_no = document.getElementById('phone-no').value;
		let password = document.getElementById('password').value;

		if(userType <=0){
			alert("Select User Type");
			return false;
		}
		if(name.length <=0){
			alert("Enter your name");
			return false;
		}
		if(name.length > 50){
			alert("Name character limit 50");
			return false;
		}

		if(email_id.length <=0){
			alert("Enter email-id");
			return false;
		}
		if(email_id.length > 50){
			alert("Use a valid email id");
			return false;
		}

		if(phone_no.length != 10){
			alert("Enter valid phone no");
			return false;
		}

		//|| password.length <8
		if(password.length <=0 || password.length > 20){
			alert("Password must be 8-20 characters long.");
			return false;
		}
		// if(password.length > 20){
		// 	alert("Enter a reasonable password.");
		// 	return false;
		// }
	}

	function LOG(str){
		console.log(str);
	}
</script>

<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->

<!-- Bootstrap 4 -->
<!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->