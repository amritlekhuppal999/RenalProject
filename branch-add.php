<?php 
	
	// Display Message
	$msg = "";

	// ADD ADMIN
	if(isset($_POST["add-branch"])){
		//echo "add admin";
		$errorFlag = 0;
		$formData = array();

		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["cost_per_patient"])){
			$formData["cost_per_patient"] = $_POST["cost_per_patient"];
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["status"])){
			$formData["status"] = 1;
		}else{ $formData["status"] = 0; }

		$formData["cby"] = $_SESSION["userid"];
		$formData["cip"] = "";
		$formData["cdate"] = date("Y:m:d h:i:s");

		if(!$errorFlag){
			$insert = new RowInsert('branch', $formData);
			if($insert->id > 0){
				$msg = 'Branch added.';
				$loc = LOCAL_HOME_URL.'?page=view-branch&msg='.$msg;
				ReDirect($loc);
			}
			else{
				$msg = 'Error adding branch.';
				//$loc = LOCAL_HOME_URL.'?page=add-branch&msg='.$msg;
			}
		}else{ $msg = 'Error adding branch.'; }
	}

	// UPDATE ADMIN
	if(isset($_POST["update-branch"])){
		$branch_id = $_GET["id"];

		$errorFlag = 0;
		$formData = array();

		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}else{
			$errorFlag = 1;
		}

		if(!empty($_POST["cost_per_patient"])){
			$formData["cost_per_patient"] = $_POST["cost_per_patient"];
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
			$update = new RowUpdate('branch', $formData, ' WHERE id='.$branch_id);
			if($update->updated == true){
				$msg = "Branch updated";
				$loc = LOCAL_HOME_URL.'?page=view-branch&msg='.$msg;
				ReDirect($loc);
			}else{
				$msg = "Error updating branch";
				//$loc = LOCAL_HOME_URL.'?page=add-branch&id='.$branch_id.'&msg='.$msg;
			}
		}else{
			$msg = "Error updating branch";
		}
	}

	//FETCH ADMIN
	if(!empty($_GET["id"])){
		$branch_id = $_GET["id"];

		$branchData = new RecordSet('SELECT id, name, cost_per_patient, status FROM `branch` WHERE id='.$branch_id);
		if($branchData->totalRows){
			$rowData = $branchData->result->fetch_assoc();
			$branch_name = $rowData["name"];
			$cost_per_patient = $rowData["cost_per_patient"];
			$branch_status = $rowData["status"];
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
							echo "Update Branch";
						}else{echo "Add Branch";}?>
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

						<h3 class="card-title" style="flex:1"><b> 
							<?php if(isset($_GET["id"])){
								echo "UPDATE BRANCH";
							}else{echo "ADD BRANCH";}?>
						</b></h3>

						<!-- View Branch table -->
						<h3 class="card-title">
							<a href="?page=view-branch" class="btn btn-info" title="view branch"> <i class="fas fa-eye"></i> </a>
						</h3>
					</div>

					<!-- ADD ADMIN FORM -->
					<form action="#" method="POST" enctype="multipart/form-data" 
						onsubmit="return submitForm()">
						<!-- CARD BODY -->
						<div class="card-body">
							
							<div class="row">

								<!-- ADMIN ID -->
								<!-- <input type="hidden" name="userType" value="<?php //echo $_GET["id"];?>"> -->

								<!-- Branch Name -->
								<div class="col-md-6">
									<div class="form-group">
										<label>Branch Name</label>
										<input type="text" name="name" id="name" class="form-control" placeholder="Name" 
										value="<?php if(isset($branch_name)){echo $branch_name;}?>">
									</div>
								</div>

								<!-- Cost per patient -->
								<div class="col-md-3">
									<div class="form-group">
										<label>Cost per patient</label>
										<input type="text" name="cost_per_patient" id="cost_per_patient" class="form-control" placeholder="100.50" value="<?php if(isset($cost_per_patient)){echo $cost_per_patient;}?>"/>
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
												<?php if(isset($branch_status) && $branch_status==1){echo "selected";}?>
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
								<button class="btn btn-info" name="update-branch"> UPDATE </button>
							<?php }else{?>
								<button class="btn btn-info" name="add-branch"> ADD </button>
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
	

	<!-- SHOW STAFF -->
	<?php if(!empty($_GET["id"])){?>
	
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

							<h3 class="card-title" style="flex:1"><b> 
								Branch Staff</b></h3>

							<!-- View Staff Table -->
							<h3 class="card-title" style="">
								<a href="<?php echo LOCAL_HOME_URL.'?page=add-staff&branch-id='.$_GET["id"]?>" class="btn btn-info" title="add staff"><i class="fas fa-user-plus"></i></a>
							</h3>
						</div>

						<!-- CARD BODY -->
						<div class="card-body" style="overflow-x: auto;">
							
							<table id="example1" class="table table-bordered table-striped text-center">
		           		<thead>
		           			<tr>
		           				<!-- <th>S.no</th> -->
		           				<th>Name</th>
		           				<th>Username</th>
		           				<th>Email</th>
		           				<th>Phone</th>
		           				<th>Status</th>
		           				<th>Action</th>
		           			</tr>
		           		</thead>

       		<tbody id="load-record">
       			<?php 
       			$getStaff = new RecordSet('SELECT id, name, username, email, phone_no, status FROM `staff` WHERE branch_id='.$_GET["id"].' ORDER BY ID DESC');
       			if($getStaff->totalRows > 0 ){
       				while($rowData = $getStaff->result->fetch_assoc()){ ?>
       					
       					<tr>
							<!-- <td><?php echo $rowData["id"]?></td> -->
							<td><?php echo $rowData["name"]?></td>
							<td><?php echo $rowData["username"]?></td>
							<td><?php echo $rowData["email"]?></td>
							<td><?php echo $rowData["phone_no"]?></td>
							
							<td> <?php if($rowData["status"]){ ?>
								<span class="badge badge-success status"><?php echo getStatus($rowData["status"]);?>
								</span>
							<?php }else{ ?>
								<span class="badge badge-danger status"><?php echo getStatus($rowData["status"]);?>
								</span>
							<?php } ?>
							</td>

							<td><a href="<?php echo LOCAL_HOME_URL.'?page=add-staff&id='.$rowData["id"].'&branch-id='.$_GET["id"];?>">
								<i class="fas fa-edit"></i>
							</a></td>
						</tr>
       			<?php }}else{ ?>
       					<tr>
							<td colspan="6"><b>No Staff Assigned.</b></td>	
						</tr>
       			<?php }?>
					
       		</tbody>
		           	</table>
		           		</div>	<!-- Card Body End -->

						<!-- CARD FOOTER -->
						<div class="card-footer"></div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php }?>

<script>
	//var usernameFlag = 0, emailFlag = 0, phone_noFlag = 0;

	//VALIDATION FOR add/update ADMIN
	function submitForm(){

		//cost per patient
		let cpp = document.getElementById("cost_per_patient").value;
		cpp = Math.round(cpp * 100) / 100;

		let formData = {
			name: document.getElementById("name").value.trim(),
			cost_per_patient: cpp,
			status: document.getElementById("status").value,
		};
		
		if(formData.name.length <=0 || formData.name.length > 50){
			alert("Enter valid branch name");
			return false;
		}
		
		if(formData.cost_per_patient.length <=0){
			alert("Enter valid Cost");
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