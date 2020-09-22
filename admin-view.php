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
				<h1 class="m-0 text-dark">View Admin</h1>
			</div>
		</div>
	</div>
</div>

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
		                	<a href="?page=add-admin" class="btn btn-info">
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
       			$getAdmin = new RecordSet('SELECT id, name, username, email, phone_no, status FROM `admin` ORDER BY ID DESC LIMIT 7 ');
       			if($getAdmin->totalRows > 0 ){
       				while($rowData = $getAdmin->result->fetch_assoc()){ ?>
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

							<td><a href="<?php echo LOCAL_HOME_URL.'?page=add-admin&id='.$rowData["id"];?>">
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