<?php 
	
	// Display Message
	$msg = "";

	// ADD / REGISTER STAFF
	if(isset($_POST["add-patient"])){
		//echo "add admin";
		$errorFlag = 0;
		$formData = array();

		//BRANCH ID
		if(!empty($_POST["branch_id"])){
			$formData["branch_id"] = $_POST["branch_id"];
		}else{
			$errorFlag = 1;
		}

		// PATIENT NAME
		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}else{
			$errorFlag = 1;
		}

		//PHONE
		if(!empty($_POST["phone"])){
			$getPhone = new RecordSet('SELECT id FROM `patient` WHERE phone_no='.$_POST["phone"]);
			if($getPhone->totalRows > 0){
				$msg = "phone no. already in use";
				$errorFlag = 1;
			}
			else{ $formData["phone_no"] = $_POST["phone"]; }
		}else{
			$errorFlag = 1;
		}

		//DOB
		if(!empty($_POST["dob"])){
			$dob = $_POST["dob"];
			$dob = str_replace('/', '-', $dob);
			$formData["dob"] = date('Y-m-d', strtotime($dob));
		}else{
			$errorFlag = 1;
		}

		//STATUS
		if(!empty($_POST["status"])){
			$formData["status"] = 1;
		}else{ $formData["status"] = 0; }

		$formData["cby"] = 1;
		$formData["cip"] = "";
		$formData["cdate"] = date("Y:m:d h:i:s");

		if(!$errorFlag){
			$insert = new RowInsert('patient', $formData);
			if($insert->id > 0){
				$msg = 'Patient added.';
				$loc = LOCAL_HOME_URL.'?page=view-patient&msg='.$msg;
				//ReDirect($loc);
			}
			else{
				$msg = 'Error adding patient.'; //SQL
				//$loc = LOCAL_HOME_URL.'?page=add-patient&msg='.$msg;
			}
		}
		// else{ $msg = 'Error adding patient.'; //PHP
		// 	//$loc = LOCAL_HOME_URL.'?page=add-patient&msg='.$msg;
		// }
	}

	// UPDATE PATIENT
	if(isset($_POST["update-patient"])){
		$patient_id = $_GET["id"];

		$errorFlag = 0;
		$formData = array();

		//BRANCH TRANSFER COMING SOON
		// if(!empty($_POST["branch_id"])){
		// 	$formData["branch_id"] = $_POST["branch_id"];
		// }else{
		// 	$errorFlag = 1;
		// }

		// PATIENT NAME
		if(!empty($_POST["name"])){
			$formData["name"] = $_POST["name"];
		}else{
			$errorFlag = 1;
		}

		//PHONE
		if(!empty($_POST["phone"])){
			$getPhone = new RecordSet('SELECT id FROM `patient` WHERE phone_no='.$_POST["phone"].' AND id!='.$patient_id);
			if($getPhone->totalRows > 0){
				$msg = "phone no. already in use";
				$errorFlag = 1;
			}
			else{ $formData["phone_no"] = $_POST["phone"]; }
		}else{
			$errorFlag = 1;
		}

		//DOB
		if(!empty($_POST["dob"])){
			$dob = $_POST["dob"];
			$dob = str_replace('/', '-', $dob);
			$formData["dob"] = date('Y-m-d', strtotime($dob));
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
			$update = new RowUpdate('patient', $formData, ' WHERE id='.$patient_id);
			if($update->updated == true){
				$msg = "Patient updated";
				$loc = LOCAL_HOME_URL.'?page=view-patient&msg='.$msg;
				ReDirect($loc);
			}else{
				$msg = "Error updating patient"; //SQL
				//$loc = LOCAL_HOME_URL.'?page=add-patient&id='.$staff_id.'&msg='.$msg;
			}
		}
		// else{ $msg = "Error updating patient"; //PHP
		// 	//$loc = LOCAL_HOME_URL.'?page=add-patient&id='.$staff_id.'&msg='.$msg;
		// }
	}

	//FETCH PATIENT
	if(!empty($_GET["id"])){
		$patient_id = $_GET["id"];

		$patientData = new RecordSet('SELECT id, branch_id, name, phone_no, dob, status FROM `patient` WHERE id='.$patient_id);
		if($patientData->totalRows){
			$rowData = $patientData->result->fetch_assoc();
			$patient_branch_id = $rowData["branch_id"];
			$patient_name = $rowData["name"];
			$patient_phone_no = $rowData["phone_no"];
			$patient_dob = date('d/m/YYY', strtotime($rowData["dob"]));
			$patient_status = $rowData["status"];
			// $admin_name = $rowData["name"];
		}
	}

	//GET BRANCH ID & BRANCH NAME
	$staffData = new RecordSet('SELECT branch_id FROM `staff` WHERE id='.$_SESSION["userid"]);
	if($staffData->totalRows){
		$rowData = $staffData->result->fetch_assoc();

		$getBranch = new RecordSet('SELECT id, name FROM `branch` WHERE id='.$rowData["branch_id"]);
		if($getBranch->totalRows){
			$branchData = $getBranch->result->fetch_assoc();
			$branch_id = $branchData["id"];
			$branchName = $branchData["name"];
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
							echo "Update Patient";
						}else{echo "Add Patient";}?>
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
								echo "UPDATE REGISTERED PATIENT";
							}else{echo "REGISTER PATIENT";}?>
						</b></h3>

						<!-- View Patient Table -->
						<h3 class="card-title">
							<a href="?page=view-patient" class="btn btn-info" title="view patient"> <i class="fas fa-eye"></i> </a>
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

								<!-- Patient Name -->
								<div class="col-md-6">
									<div class="form-group">
										<label>Patient Name</label>
										<input type="text" name="name" id="name" class="form-control" placeholder="Name" 
										value="<?php if(isset($patient_name)){echo $patient_name;}?>">
									</div>
								</div>

								<!-- Phone no. -->
								<div class="col-md-3">
									<div class="form-group">
										<label>Phone no.</label>
										<input type="number" name="phone" id="phone" class="form-control" placeholder="7999945555" value="<?php if(isset($patient_phone_no)){echo $patient_phone_no;}?>"/>
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
											<input id="dob" name="dob" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?php if(isset($patient_dob)){echo $patient_dob;}?>">
										</div>
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
								<button class="btn btn-info" name="update-patient"> UPDATE </button>
							<?php }else{?>
								<button class="btn btn-info" name="add-patient"> REGISTER </button>
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
	
	//VALIDATION FOR UPDATE STAFF
	function updateForm(){
		let formData = {
			branch_id: document.getElementById("name").value,
			name: document.getElementById("name").value.trim(),
			phone_no: document.getElementById("phone").value,
			dob: document.getElementById("dob").value,
			status: document.getElementById("status").value,
		};

		if(formData.name.length <=0 || formData.name.length > 50){
			alert("Enter valid name");
			return false;
		}
		
		if(formData.phone_no.length <=0 || formData.phone_no.length > 10){
			alert("Enter valid phone number");
			return false;
		}

		if(formData.dob.length <=0 || formData.dob.length > 10){
			alert("Enter valid date");
			return false;
		}
	}


	//VALIDATION FOR ADD STAFF
	function submitForm(){
		let formData = {
			branch_id: document.getElementById("name").value,
			name: document.getElementById("name").value.trim(),
			phone_no: document.getElementById("phone").value,
			dob: document.getElementById("dob").value,
			status: document.getElementById("status").value,
		};

		if(formData.name.length <=0 || formData.name.length > 50){
			alert("Enter valid name");
			return false;
		}
		
		if(formData.phone_no.length <=0 || formData.phone_no.length > 10){
			alert("Enter valid phone number");
			return false;
		}

		if(formData.dob.length <=0 || formData.dob.length > 10){
			alert("Enter valid date");
			return false;
		}
	}

</script>