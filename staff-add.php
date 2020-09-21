<?php 
	
	// Display Message
	$msg = "";

	// ADD STAFF
	if(isset($_POST["add-staff"])){
		//echo "add admin";
		$errorFlag = 0;
		$formData = array();

		if(!empty($_POST["branch_id"])){
			$formData["branch_id"] = $_POST["branch_id"];
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["username"])){

			$getUname = new RecordSet('SELECT id FROM `staff` WHERE username="'.$_POST["username"].'"');
			if($getUname->totalRows > 0){
				$msg = "username already in use";
				$errorFlag = 1;
			}
			else{ $formData["username"] = $_POST["username"]; }
			
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["email"])){
			$getEmail = new RecordSet('SELECT id FROM `staff` WHERE email="'.$_POST["email"].'"');
			if($getEmail->totalRows > 0){
				$msg = "email already in use";
				$errorFlag = 1;
			}
			else{ $formData["email"] = $_POST["email"]; }
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["phone"])){
			$getPhone = new RecordSet('SELECT id FROM `staff` WHERE phone_no='.$_POST["phone"]);
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
			$insert = new RowInsert('staff', $formData);
			if($insert->id > 0){
				$msg = 'Staff added.';
				$loc = LOCAL_HOME_URL.'?page=view-staff&msg='.$msg;
				ReDirect($loc);
			}
			else{
				$msg = 'Error adding staff.'; //SQL
				//$loc = LOCAL_HOME_URL.'?page=add-staff&msg='.$msg;
			}
		}
		// else{ $msg = 'Error adding staff.';
		// 	//$loc = LOCAL_HOME_URL.'?page=add-staff&msg='.$msg;
		// }
	}

	// UPDATE STAFF
	if(isset($_POST["update-staff"])){
		$staff_id = $_GET["id"];

		$errorFlag = 0;
		$formData = array();

		//BRANCH TRANSFER COMING SOON
		// if(!empty($_POST["branch_id"])){
		// 	$formData["branch_id"] = $_POST["branch_id"];
		// }else{
		// 	$errorFlag = 1;
		// }

		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["username"])){

			$getUname = new RecordSet('SELECT id FROM `staff` WHERE username="'.$_POST["username"].'" AND id!='.$staff_id);
			if($getUname->totalRows > 0){
				$msg = "username already in use";
				$errorFlag = 1;
			}
			else{ $formData["username"] = $_POST["username"]; }
			
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["email"])){
			$getEmail = new RecordSet('SELECT id FROM `staff` WHERE email="'.$_POST["email"].'" AND id!='.$staff_id);
			if($getEmail->totalRows > 0){
				$msg = "email already in use";
				$errorFlag = 1;
			}
			else{ $formData["email"] = $_POST["email"]; }
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["phone"])){
			$getPhone = new RecordSet('SELECT id FROM `staff` WHERE phone_no='.$_POST["phone"].' AND id!='.$staff_id);
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
			$update = new RowUpdate('staff', $formData, ' WHERE id='.$staff_id);
			if($update->updated == true){
				$msg = "Staff updated";
				$loc = LOCAL_HOME_URL.'?page=view-staff&msg='.$msg;
				ReDirect($loc);
			}else{
				$msg = "Error updating staff";
				//$loc = LOCAL_HOME_URL.'?page=add-staff&id='.$staff_id.'&msg='.$msg;
			}
		}else{
			$msg = "Error updating admin";
			//$loc = LOCAL_HOME_URL.'?page=add-staff&id='.$staff_id.'&msg='.$msg;
		}
	}

	//FETCH ADMIN
	if(!empty($_GET["id"])){
		$staff_id = $_GET["id"];

		$staffData = new RecordSet('SELECT id, branch_id, name, username, email, phone_no, status FROM `staff` WHERE id='.$staff_id);
		if($staffData->totalRows){
			$rowData = $staffData->result->fetch_assoc();
			$staff_branch_id = $rowData["branch_id"];
			$staff_name = $rowData["name"];
			$staff_username = $rowData["username"];
			$staff_email = $rowData["email"];
			$staff_phone_no = $rowData["phone_no"];
			$staff_status = $rowData["status"];
			// $admin_name = $rowData["name"];
		}
	}

	if(!empty($_GET["branch-id"])){
		$branch_id = $_GET["branch-id"];

		$getBranch = new RecordSet('SELECT id, name FROM `branch` WHERE id='.$branch_id);
		if($getBranch->totalRows){
			$rowData = $getBranch->result->fetch_assoc();
			$branchName = $rowData["name"];
		}else{
			$loc = LOCAL_HOME_URL.'?page=view-branch';
			ReDirect($loc);
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
							echo "Update Staff";
						}else{echo "Add Staff";}?>
				</h1>
			</div>
		</div>
	</div>
</div>


	<!-- SELECT BRANCH -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="card">

				<?php if(empty($_GET["branch-id"])){ ?>
						<form action="#" method="GET">
							<!-- CARD HEADER -->
							<div class="card-header">
								<b>Select Branch</b>
							</div>

							<!-- CARD BODY -->
							<div class="card-body" 
							style="display:flex;
								   align-items: center;
								   justify-content: space-between;
							">
								<!-- SELECT BRANCH -->
								<select name="select_branch_id" class="select2 form-control" id="select_branch_id" style="flex:0.8" onchange="selectBranch();">
									<option value="0">Select</option>
						<?php $branchData = new RecordSet('SELECT id, name FROM `branch`');
							  if($branchData->totalRows){
							  	while($rowData = $branchData->result->fetch_assoc()){ ?>
							  		<option value="<?php echo $rowData["id"];?>"> 
							  			<?php echo $rowData["name"];?>
							  		</option>
						<?php }}?>
								</select>

								<!-- BUTTON LINK -->
								<a href="" class="btn btn-info" id="select_branch_btn" style="flex: 0.2">Select</a>
							</div>

							<!-- CARD FOOTER -->
							<div class="card-footer"></div>
						</form>

				<?php }else{ ?>
							<!-- CARD HEADER -->
							<div class="card-header" 
							style="border-bottom: 5px solid red;">
								<b>Branch: 
									<span style="color:red;"><?php echo $branchName;?></span>
								</b>
							</div>
				<?php }?>
					
					</div>
				</div>
			</div>
		</div>
	</section>


<!-- ADD STAFF FORM -->
<?php if(!empty($_GET["branch-id"])){ ?>

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
									echo "UPDATE STAFF";
								}else{echo "ADD STAFF";}?>
							</b></h3>

							<!-- View Admin Table -->
							<h3 class="card-title" style="flex:0.1">
								<a href="?page=view-staff" class="btn btn-info">View All</a>
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

									<!-- BRANCH ID -->
									<input type="hidden" name="branch_id" value="<?php echo $branch_id;?>">

									<!-- Staff Name -->
									<div class="col-md-6">
										<div class="form-group">
											<label>Staff Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name" 
											value="<?php if(isset($staff_name)){echo $staff_name;}?>">
										</div>
									</div>

									<!-- Username -->
									<div class="col-md-6">
										<div class="form-group">
											<label>Username</label>
											<input type="text" name="username" id="username" class="form-control" placeholder="staff_123" value="<?php if(isset($staff_username)){echo $staff_username;}?>"/>
										</div>
									</div>

									<!-- Email -->
									<div class="col-md-6">
										<div class="form-group">
											<label>Email</label>
											<input type="email" name="email" id="email" class="form-control" placeholder="xyz@yahoo.com" value="<?php if(isset($staff_email)){echo $staff_email;}?>"/>
										</div>
									</div>

									<!-- Phone no. -->
									<div class="col-md-3">
										<div class="form-group">
											<label>Phone no.</label>
											<input type="number" name="phone" id="phone" class="form-control" placeholder="7999945555" value="<?php if(isset($staff_phone_no)){echo $staff_phone_no;}?>"/>
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
											<select class="select2 form-control" name="status" id="status">
												<?php $stat = Status();
												foreach($stat as $key=> $val){ ?>
													<option value="<?php echo $key;?>" 
													<?php if(isset($staff_status) && $staff_status==1){echo "selected";}?>
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
									<button class="btn btn-info" name="update-staff"> UPDATE </button>
								<?php }else{?>
									<button class="btn btn-info" name="add-staff"> ADD </button>
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

<?php }?>


<script>
	//var usernameFlag = 0, emailFlag = 0, phone_noFlag = 0;

	//SELECT BRANCH
	function selectBranch(){
		let branch_id = document.getElementById("select_branch_id").value;
		let branch_btn = document.getElementById("select_branch_btn");

		//We need to make this dynamic...
		let LOCAL_HOME_URL = "http://localhost/ALU/RenalProject/";

		branch_btn.setAttribute("href", LOCAL_HOME_URL+"?page=add-staff&branch-id="+branch_id);
	}

	//VALIDATION FOR UPDATE STAFF
	function updateForm(){
		let formData = {
			branch_id: document.getElementById("name").value,
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


	//VALIDATION FOR ADD STAFF
	function submitForm(){
		let formData = {
			branch_id: document.getElementById("name").value,
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

</script>