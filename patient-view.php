<style>
	.status{
		cursor: pointer;
	}
</style>


<!-- Page Header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-12">
				<h1 class="m-0 text-dark">View Patients</h1>
			</div>
		</div>
	</div>
</div>


<!-- PATIENT GRAPH DUMMY -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				
				<div class="card">
					<div class="card-body">
						<canvas id="line-chart"></canvas>
					</div>
				</div>

	<script>

		let patientChart = document.getElementById('line-chart').getContext('2d');	

		let chartObj = new Chart(patientChart, {

			type: '<?php echo "line";?>',
			data: {
				labels: ["11-July", "12-July", "13-July", "14-July", "15-July", "16-July", "17-July"],
				datasets: [{
					label: 'Patient\'s Graph',

					data: [

						10,
						20,
						30, 
						40, 
						50, 
						40, 
						30, 
						70, 
						80
					],

					// backgroundColor: 'green',
					borderWidth: 2,
					borderColor: 'red',
					hoverBorderWidth: 4,
					hoverBorderColor: 'green',
				}],
			},
			option: {},
		});
	</script>

			</div>
		</div>
	</div>
</section>




<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<!--Card Header-->
					<div class="card-header" 
					style="display: flex;
						   align-items: center; 
						   justify-content: space-between;">
						
						<!-- Search Icon -->
		                <span class="btn btn-light ser-icon">
							<i class="fas fa-search"></i>
						</span>

						<div class="card-tools" style="flex:1">
							<div class="input-group input-group-sm ser-bar-resize" style="width: 350px;">
								<input type="text" name="table_search" class="form-control" placeholder="Search by Admin Name" id="dy-search" onkeyup="dySearch()">
							<!-- <div class="input-group-append">
		                       	<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
		                       </div> -->
		                   </div>		
		                </div>	

		                <h3 class="card-title">
		                	<a href="?page=add-patient" class="btn btn-info">
		                		<i class="fas fa-user-plus"></i>
		                	</a>
						</h3>
		            </div>

		            <!--Card Body-->
		            <div class="card-body" style="overflow-x: auto;">
			           	<!--Table-->
			           	<table id="example1" class="table table-bordered table-striped text-center">
			           		<thead>
			           			<tr>
			           				<!-- <th>S.no</th> -->
			           				<th>Branch</th>
			           				<th>Name</th>
			           				<th>Phone</th>
			           				<th>Date of Birth</th>
			           				<th>Status</th>
			           				<th>Action</th>
			           			</tr>
			           		</thead>

		   		<tbody id="load-record">
		   			<?php 
		   			$getPatient = new RecordSet('SELECT id, branch_id, name, phone_no, dob, status FROM `patient` ORDER BY ID DESC LIMIT 7 ');
		   			if($getPatient->totalRows > 0 ){
		   				while($rowData = $getPatient->result->fetch_assoc()){ 

		   					$getBranch = new RecordSet('SELECT name FROM `branch` WHERE id='.$rowData["branch_id"]);
		   					if($getBranch->totalRows){
		   						$branchData = $getBranch->result->fetch_assoc();
		   						$branchName = $branchData["name"];
		   					}
		   					?>
		   					<tr>
								<!-- <td><?php echo $rowData["id"]?></td> -->
								<td><?php echo $branchName?></td>
								<td><?php echo $rowData["name"]?></td>
								<td><?php echo $rowData["phone_no"]?></td>
								<td><?php echo date('d-M-Y', strtotime($rowData["dob"]))?></td>
								
								<td> <?php if($rowData["status"]){ ?>
									<span class="badge badge-success status"><?php echo getStatus($rowData["status"]);?>
									</span>
								<?php }else{ ?>
									<span class="badge badge-danger status"><?php echo getStatus($rowData["status"]);?>
									</span>
								<?php } ?>
								</td>

								<td><a href="<?php echo LOCAL_HOME_URL.'?page=add-patient&id='.$rowData["id"];?>">
									<i class="fas fa-edit"></i>
								</a></td>
							</tr>
		   			<?php }
		   			}else{ ?>
		   					<tr>
								<td colspan="5"><b>No Records Found.</b></td>	
							</tr>
		   			<?php }?>
							
		   				
		   		</tbody>
			           	</table>
		            </div>

		           <!-- Card Footer -->
		           <div class="card-footer">
		           	<div class="row">
		           		<!-- PAGINATION -->
		           		<!-- <div class="col-md-10">
		           			<div id="load-pagn"></div>	
		           		</div> -->
		           	</div>
		           </div>

		       </div>
		   </div>

		</div>
	</div>

</section>

<!-- Script for Dynamic Search -->
<script>

	// // Dynamic Search
	// function dySearch(){
	// 	let serData = {
	// 		userid: document.getElementById("userid").value,
	// 		ser_key: document.getElementById("dy-search").value,
	// 		action: 'search-accounts'
	// 	};
		
	// 	let xhr = new XMLHttpRequest();
	// 	xhr.open('POST', 'search-api.php', true);

	// 	xhr.onreadystatechange = function(){
	// 		//console.log('state: '+this.readyState+' & status:'+this.status);
	// 		if(this.readyState == 4 && this.status == 200){
	// 			// console.log(this.responseText);
	// 			let result = JSON.parse(this.responseText);
	// 			//console.log(result.dat);
	// 			document.getElementById("load-record").innerHTML = result.dat;
	// 		}
	// 	}
	// 	xhr.setRequestHeader("Content-Type", "application/json");
	// 	xhr.send(JSON.stringify(serData));
	// }
</script>