<?php 
	
	// Display Message
	$msg = "";

	// ADD ADMIN
	if(isset($_POST["add-admin"])){
		//echo "add admin";
		$errorFlag = 0;
		$formData = array();

		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["username"])){

			$getUname = new RecordSet('SELECT id FROM `admin` WHERE username="'.$_POST["username"].'"');
			if($getUname->totalRows > 0){
				$msg = "username already in use";
				$errorFlag = 1;
			}
			else{ $formData["username"] = $_POST["username"]; }
			
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["email"])){
			$getEmail = new RecordSet('SELECT id FROM `admin` WHERE email="'.$_POST["email"].'"');
			if($getEmail->totalRows > 0){
				$msg = "email already in use";
				$errorFlag = 1;
			}
			else{ $formData["email"] = $_POST["email"]; }
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["phone"])){
			$getPhone = new RecordSet('SELECT id FROM `admin` WHERE phone_no='.$_POST["phone"]);
			if($getPhone->totalRows > 0){
				$msg = "phone no. already in use";
				$errorFlag = 1;
			}
			else{ $formData["phone_no"] = $_POST["phone"]; }
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["password"])){
			$formData["password"] = md5($_POST["password"]);
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["status"])){
			$formData["status"] = 1;
		}else{ $formData["status"] = 0; }

		$formData["cby"] = 1;
		$formData["cip"] = "";
		$formData["cdate"] = date("Y:m:d h:i:s");

		if(!$errorFlag){
			$insert = new RowInsert('admin', $formData);
			if($insert->id > 0){
				$msg = 'Admin added.';
				$loc = LOCAL_HOME_URL.'?page=view-admin&msg='.$msg;
				//ReDirect($loc);
			}
			else{
				$msg = 'Error adding admin.';
				//$loc = LOCAL_HOME_URL.'?page=add-admin&msg='.$msg;
			}
		}else{
			$msg = 'Error adding admin.';
			//$loc = LOCAL_HOME_URL.'?page=add-admin&msg='.$msg;
		}
	}

	// UPDATE ADMIN
	if(isset($_POST["update-admin"])){
		$admin_id = $_GET["id"];

		$errorFlag = 0;
		$formData = array();

		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["username"])){

			$getUname = new RecordSet('SELECT id FROM `admin` WHERE username="'.$_POST["username"].'" AND id!='.$admin_id);
			if($getUname->totalRows > 0){
				$msg = "username already in use";
				$errorFlag = 1;
			}
			else{ $formData["username"] = $_POST["username"]; }
			
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["email"])){
			$getEmail = new RecordSet('SELECT id FROM `admin` WHERE email="'.$_POST["email"].'" AND id!='.$admin_id);
			if($getEmail->totalRows > 0){
				$msg = "email already in use";
				$errorFlag = 1;
			}
			else{ $formData["email"] = $_POST["email"]; }
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["phone"])){
			$getPhone = new RecordSet('SELECT id FROM `admin` WHERE phone_no='.$_POST["phone"].' AND id!='.$admin_id);
			if($getPhone->totalRows > 0){
				$msg = "phone no. already in use";
				$errorFlag = 1;
			}
			else{ $formData["phone_no"] = $_POST["phone"]; }
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["status"])){
			$formData["status"] = 1;
		}else{ $formData["status"] = 0; }

		$formData["cby"] = 1;
		$formData["cip"] = "";
		$formData["cdate"] = date("Y:m:d h:i:s");

		if(!$errorFlag){
			$update = new RowUpdate('admin', $formData, ' WHERE id='.$admin_id);
			if($update->updated == true){
				$msg = "Admin updated";
				$loc = LOCAL_HOME_URL.'?page=view-admin&msg='.$msg;
				ReDirect($loc);
			}else{
				$msg = "Error updating admin";
				//$loc = LOCAL_HOME_URL.'?page=add-admin&id='.$admin_id.'&msg='.$msg;
			}
		}else{
			$msg = "Error updating admin";
			//$loc = LOCAL_HOME_URL.'?page=add-admin&id='.$admin_id.'&msg='.$msg;
		}
	}

	//FETCH ADMIN
	if(!empty($_GET["id"])){
		$admin_id = $_GET["id"];

		$adminData = new RecordSet('SELECT id, name, username, email, phone_no, status FROM `admin` WHERE id='.$admin_id);
		if($adminData->totalRows){
			$rowData = $adminData->result->fetch_assoc();
			$admin_name = $rowData["name"];
			$admin_username = $rowData["username"];
			$admin_email = $rowData["email"];
			$admin_phone_no = $rowData["phone_no"];
			$admin_status = $rowData["status"];
			// $admin_name = $rowData["name"];
		}
	}
?>

<style>
	#error-msg{
		color:red;
	}
</style>


<!--PAGE HEADER -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">
					<?php if(isset($_GET["id"])){
							echo "Update Admin";
						}else{echo "Add Admin";}?>
				</h1>
			</div>
		</div>
	</div>
</div>

<!-- SECTION BODY -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<!-- CARD HEADER -->
					<div class="card-header"
					style="display: flex;
					   align-items: center; 
					   justify-content: space-between;">

						<h3 class="card-title" style="flex:0.9"><b> 
							<?php if(isset($_GET["id"])){
								echo "UPDATE ADMIN";
							}else{echo "ADD ADMIN";}?>
						</b></h3>

						<!-- View Admin Table -->
						<h3 class="card-title" style="flex:0.1">
							<a href="?page=view-admin" class="btn btn-info">View All</a>
						</h3>
					</div>

					<!-- ADD ADMIN FORM -->
					<form action="#" method="POST" enctype="multipart/form-data" 
						<?php if(!empty($_GET["id"])){ ?>
								onsubmit="return updateForm()"
							<?php }else{?>
								onsubmit="return submitForm()"
							<?php }?>
					>
						<!-- CARD BODY -->
						<div class="card-body">
							
							<div class="row">

								<!-- ADMIN ID -->
								<input type="hidden" name="userType" value="<?php //echo $_GET["id"];?>">

								<!-- Admin Name -->
								<div class="col-md-6">
									<div class="form-group">
										<label>Admin Name</label>
										<input type="text" name="name" id="name" class="form-control" placeholder="Name" 
										value="<?php if(isset($admin_name)){echo $admin_name;}?>">
									</div>
								</div>

								<!-- Username -->
								<div class="col-md-6">
									<div class="form-group">
										<label>Username</label>
										<input type="text" name="username" id="username" class="form-control" placeholder="admin_123" value="<?php if(isset($admin_username)){echo $admin_username;}?>"/>
									</div>
								</div>

								<!-- Email -->
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" id="email" class="form-control" placeholder="xyz@yahoo.com" value="<?php if(isset($admin_email)){echo $admin_email;}?>"/>
									</div>
								</div>

								<!-- Phone no. -->
								<div class="col-md-3">
									<div class="form-group">
										<label>Phone no.</label>
										<input type="number" name="phone" id="phone" class="form-control" placeholder="7999945555" value="<?php if(isset($admin_phone_no)){echo $admin_phone_no;}?>"/>
									</div>
								</div>


								<!-- Password -->
								<div class="col-md-3">
									<div class="form-group">
										<label>Password</label>
										<input type="password" name="password" id="password" class="form-control" placeholder="****"
											<?php if(isset($_GET["id"])){
												echo "disabled";
											}?>
										/>
									</div>
								</div>

								<!-- Status -->
								<div class="col-md-3">
									<div class="form-group">
										<label>Status</label>
										<select class="form-control" name="status" id="status">
											<?php $stat = Status();
											foreach($stat as $key=> $val){ ?>
												<option value="<?php echo $key;?>" 
												<?php if(isset($admin_status) && $admin_status==1){echo "selected";}?>
												><?php echo $val;?></option>
											<?php }?>
										</select>
									</div>
								</div>


								<?php /*
								<!-- Display Picture -->
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleInputFile">Display Picture</label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" name="dp" class="custom-file-input" id="dp">
												<label class="custom-file-label" for="exampleInputFile">Choose file</label>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Gender -->
								<div class="col-md-3">
									<div class="form-group">
										<label>Gender</label>
										<select class="form-control" id="gender">
											<!-- <option value="0">Select</option> -->
											<?php $gen = Gender();
											foreach($gen as $key => $val){?> 
												<option value="<?php echo $key;?>"><?php echo $val;?></option>
											<?php }?>
										</select>
									</div>
								</div>

								<!-- DOB -->
								<div class="col-md-3">
									<div class="form-group">
										<label>Date of Birth</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
											</div>
											<input id="dob" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
										</div>
									</div>
								</div>

								<!-- Address -->
								<div class="col-md-8">
									<div class="form-group">
										<label>Address</label>
										<textarea rows="5" name="address" id="address" class="form-control" placeholder="address..."></textarea>
									</div>
								</div>
								*/?>
								
							</div>

						</div>

						<!-- CARD FOOTER -->
						<div class="card-footer"
							 style="display: flex;
								   justify-content: space-between;">
							<?php if(!empty($_GET["id"])){ ?>
								<button class="btn btn-info" name="update-admin"> UPDATE </button>
							<?php }else{?>
								<button class="btn btn-info" name="add-admin"> ADD </button>
							<?php }?>

							<!-- Error Message -->
							<span id="error-msg"> <?php echo $msg; ?> </span>
						</div>

					</form>

				</div>
			</div>

		</div>
	</div>
</section>

<script>
	//var usernameFlag = 0, emailFlag = 0, phone_noFlag = 0;

	//VALIDATION FOR UPDATE ADMIN
	function updateForm(){
		//alert("update form");
		let formData = {
			name: document.getElementById("name").value.trim(),
			username: document.getElementById("username").value.trim(),
			email: document.getElementById("email").value.trim(),
			phone_no: document.getElementById("phone").value,
			status: document.getElementById("status").value,
		};

		if(formData.name.length <=0 || formData.name.length > 50){
			alert("Enter valid name");
			return false;
		}
		
		if(formData.username.length <=0 || formData.username.length > 20){
			alert("Enter valid username");
			return false;
		}

		if(formData.email.length <=0 || formData.email.length > 50){
			alert("Enter valid email");
			return false;
		}
		
		if(formData.phone_no.length <=0 || formData.phone_no.length > 10){
			alert("Enter valid phone number");
			return false;
		}
		//alert(formData.status);
	}


	//VALIDATION FOR ADD ADMIN
	function submitForm(){
		//alert("add form");
		let formData = {
			name: document.getElementById("name").value.trim(),
			username: document.getElementById("username").value.trim(),
			email: document.getElementById("email").value.trim(),
			phone_no: document.getElementById("phone").value,
			password: document.getElementById("password").value.trim(),
			status: document.getElementById("status").value,
		};

		if(formData.name.length <=0 || formData.name.length > 50){
			alert("Enter valid name");
			return false;
		}
		
		if(formData.username.length <=0 || formData.username.length > 20){
			alert("Enter valid username");
			return false;
		}

		if(formData.email.length <=0 || formData.email.length > 50){
			alert("Enter valid email");
			return false;
		}
		
		if(formData.phone_no.length <=0 || formData.phone_no.length > 10){
			alert("Enter valid phone number");
			return false;
		}

		if(formData.password.length <=0 || formData.password.length > 20){
			alert("Enter valid password");
			return false;
		}
	}

	// function validateUsername(){
	// 	let errorMsg = document.getElementById("error-msg");

	// 	fetchData = {
	// 		username: document.getElementById("username").value,
	// 		action: "check-username"
	// 	}
	// 	//errorMsg.innerHTML = fetchData.username;
	// 	let usernameExists = AJAX(fetchData, "admin-api.php");
	// 	errorMsg.innerHTML = usernameExists ? "*Username already in use." : "";
	// 	return usernameExists;
	// }

	// function validateEmail(){
	// 	let errorMsg = document.getElementById("error-msg");

	// 	fetchData = {
	// 		email: document.getElementById("email").value,
	// 		action: "check-email"
	// 	}
	// 	//errorMsg.innerHTML = fetchData.email;
	// 	let emailExists = AJAX(fetchData, "admin-api.php");
	// 	console.log(emailExists);
	// 	errorMsg.innerHTML = emailExists ? "*Email already in use." : "";

	// 	return emailExists;
	// }

	// function validatePhoneNo(){
	// 	let errorMsg = document.getElementById("error-msg");

	// 	fetchData = {
	// 		phone_no: document.getElementById("phone").value,
	// 		action: "check-phone-no"
	// 	}
	// 	//errorMsg.innerHTML = fetchData.phone_no;
	// 	let phoneExists = AJAX(fetchData, "admin-api.php");
	// 	errorMsg.innerHTML = phoneExists ? "*Phone no. already in use." : "";
	// 	return phoneExists;
	// }


	// function AJAX(fetchData, fetchApi){
	// 	var resultObj = {
	// 		exists: false
	// 	};
	// 	let xhr = new XMLHttpRequest();
	// 	xhr.open('POST', fetchApi, true);

	// 	xhr.onreadystatechange = function(resultObj){
	// 		//console.log('state: '+this.readyState+' & status:'+this.status);
	// 		if(this.readyState == 4 && this.status == 200){
	// 			// console.log(this.responseText);
	// 			resultObj.exists = JSON.parse(this.responseText).exists;
	// 			//console.log(result);
	// 			//document.getElementById("load-record").innerHTML = result.dat;
	// 		}
	// 	}
	// 	xhr.setRequestHeader("Content-Type", "application/json");
	// 	xhr.send(JSON.stringify(fetchData));
	// 	//return resultObj.exists; //MAKE THIS WORK
	// }

</script>