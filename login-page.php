<?php 
ini_set('display_errors', true);
include('function/function.class.php');
CheckLogin();
	
	if(!empty($_GET["msg"])){
		$disp_msg = $_GET["msg"]; 
	}else{
		$disp_msg = "";
	}

	// LOGIN
	if(isset($_POST["login"])){
		//echo "login";

		if(!empty($_POST["userType"]) && !empty($_POST["username"]) && !empty($_POST["password"])){

			$username = $_POST["username"];
			$password = md5($_POST["password"]);

			if($_POST["userType"] == 1){
				$tableName = "admin";
			}
			else if($_POST["userType"] == 2){
				$tableName = "doctor";
			}
			else if($_POST["userType"] == 3){
				$tableName = "staff";
			}
			else{
				//ABORT
			}

			$user = new RecordSet('SELECT id, name, email FROM `'.$tableName.'` WHERE username="'.$username.'" AND password="'.$password.'"');
			if($user->totalRows > 0){
				$rowData = $user->result->fetch_assoc();
				$_SESSION["userid"] = $rowData["id"];
	          	$_SESSION["email"] = $rowData["email"];
	          	$_SESSION["name"] = $rowData["name"];
	          	$_SESSION["userType"] = $_POST["userType"];
	          	$loc = LOCAL_HOME_URL;
			}
			else{
				$msg = "Incorrect username or password!";
				$loc = LOCAL_HOME_URL.'login-page.php?msg='.$msg;
			}
		}
		else{
			echo "locha";
		}

		ReDirect($loc);
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Renal Project | Login</title>
	
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
    		margin: 20px;
    		background-color: white;
    		border: 2px solid black;
    		border-radius: 5px;
    	}
    	.select-login > input{
    		margin: 20px;
    		padding: 15px;
    		border: 2px solid lightgrey;
    		border-radius: 5px;
    	}
    	.sign-in{
    		cursor: pointer;
    		font-size: 20px;
    		padding: 15px;
    		margin: 10px 20px;
    		color: white;
    		background-color: #0A79DF;
    		border: 1px solid #0A79DF !important;
    		border-radius: 5px;
		}
		.sign-in:hover{
			background-color: #2475B0;
			transition: 0.5s background-color;
		}

    	.form-footer{
    		display: flex;
    		justify-content: space-between;
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
		<h1>Login</h1>

		<!-- Login Form -->
		<form action="#" method="post" onsubmit="return validate()">
			<div class="select-login">
				<!-- Select User -->
				<!-- <label>User Type</label> -->
				<select name="userType" id="userType">
					<option value=0>Select</option>
					<option value=1>Admin</option>
					<option value=2>Doctor</option>
					<option value=3>Staff</option>
				</select>

				<!-- Username -->
				<input type="text" name="username" id="username" placeholder="Username" autocomplete="off"/>

				<!-- Password -->
				<input type="password" name="password" id="password" placeholder="Password" />

				<!-- Sign-in -->
				<button type="submit" name="login" class="sign-in">Sign In</button>

				<!-- Footer -->
				<div class="form-footer">
					<a href="#">Forgot Passowrd?</a> <br />	
					<a href="<?php echo LOCAL_HOME_URL.'register-page.php';?>">Create New Account</a>
					
				</div>
				<span class="error-msg"><?php echo $disp_msg;?></span>
			</div>
		</form>

	</div>

	

</body>
</html>

<script>
	
	function validate(){
		let userType = document.getElementById('userType').value;
		let username = document.getElementById('username').value;
		let password = document.getElementById('password').value;

		if(userType <= 0){
			alert("select user type");
			return false;
		}
		if(username.length <= 0){
			alert("Enter username");
			return false;
		}
		if(password.length <= 0){
			alert("Enter password");
			return false;
		}

		if(username.length > 50){
			alert("Invalid username");
			return false;
		}
		if(password.length > 50){
			alert("Invalid password");
			return false;
		}
	}

	function LOG(str){
		console.log(str);
	}
</script>

<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->

<!-- Bootstrap 4 -->
<!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->