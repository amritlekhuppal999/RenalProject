<?php 
ob_start();
ini_set('display_errors', true);
include('function/function.class.php');
IndexCheckLogin();


	// PAGE SLICING
	if(isset($_GET["page"])){
		
		//ADMINS
		if($_GET["page"] == "add-admin"){
			$inc_page = "admin-add.php";
		}
		else if($_GET["page"] == "view-admin"){
			$inc_page = "admin-view.php";
		}

		//DOCTORS
		else if($_GET["page"] == "add-doctor"){
			$inc_page = "doctor-add.php";
		}
		else if($_GET["page"] == "view-doctor"){
			$inc_page = "doctor-view.php";
		}

		//BRANCH
		else if($_GET["page"] == "add-branch"){
			$inc_page = "branch-add.php";
		}
		else if($_GET["page"] == "view-branch"){
			$inc_page = "branch-view.php";
		}

		//STAFF
		else if($_GET["page"] == "add-staff"){
			$inc_page = "staff-add.php";
		}
		else if($_GET["page"] == "view-staff"){
			$inc_page = "staff-view.php";
		}

		//PATIENT
		else if($_GET["page"] == "add-patient"){
			$inc_page = "patient-add.php";
		}
		else if($_GET["page"] == "view-patient"){
			$inc_page = "patient-view.php";
		}

		//HOME & PAGE NOT FOUND
		else if($_GET["page"] == "home"){
			$inc_page = "home-page.php";
		}
		else{
			$inc_page = "page-unauth.php";
		}
	}
	else{
		$inc_page = "home-page.php";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- FAVICON -->
	<link rel="icon" href="https://www.therenalproject.com/images/favicon.png" type="image/x-icon">

	<title>Renal Project</title>
	<link rel="stylesheet" type="text/css" href="./dist/local-css/index.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

	<!-- Chart.js CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

	<!-- Ionicons -->
	<!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

	<!-- daterange picker -->
	<!-- <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css"> -->

	<!-- iCheck for checkboxes and radio inputs -->
	<!-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->

	<!-- Bootstrap Color Picker -->
	<!-- <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css"> -->

	<!-- Bootstrap4 Duallistbox -->
	<!-- <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css"> -->

	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	
	<div class="wrapper">

		<!--Navbar-->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

    		<!-- SEARCH FORM -->
	      <!-- <form class="form-inline ml-3">
	        <div class="input-group input-group-sm">
	          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
	          <div class="input-group-append">
	            <button class="btn btn-navbar" type="submit">
	              <i class="fas fa-search"></i>
	            </button>
	          </div>
	        </div>
	      </form> -->

	      <!-- USER PROFILE IMAGE -->
	      <ul class="navbar-nav ml-auto">
	      	<li class="nav-item dropdown">
	      		<a class="nav-link" data-toggle="dropdown" href="#">
	      			<!-- <i class="fas fa-th-large"></i> -->
	      			<img src="https://yt3.ggpht.com/a/AATXAJzzaUUK9kOsOxBH9_zlV5u40RTzKEerh7QH8gIk7w=s48-c-k-c0xffffffff-no-nd-rj" class="avatar" />
	      			<?php /*
	      			<?php if(file_exists($userImg)){ ?>
	      				<img src="<?php echo $userImg;?>" class="nav-img elevation-2" />
	      			<?php }else{?> 
	      				<img src="../images/in_design/DP.jpg" class="nav-img elevation-2" />
	      			<?php }?>

	      			<span class=""><?php echo $_SESSION["name"];?></span> 
	      			*/?>
	      		</a>
	      		<div class="dropdown-menu dropdown-menu-right">
	      			<a href="#" id="view-profile" class="dropdown-item">
	      				<?php echo $_SESSION["name"];?> </a>
	      			<div class="dropdown-divider"></div>
	      			<a href="logout.php" class="dropdown-item">Logout</a>
	      		</div>
	      	</li>
	      </ul>

  		</nav>

		<!-- Main Sidebar Container -->
		<div class="main-sidebar sidebar-dark-primary elevation-4">
		 	<!-- Brand Logo -->
		  	<a href="?page=home" class="brand-link" id="goHome">
		  		<!-- BRAND LOGO -->
		  		<img style="background-color: white;" src="https://www.therenalproject.com/images/favicon.png" alt="..." class="brand-image img-circle elevation-3"
		  		style="opacity: .8" />
		  		<span class="brand-text font-weight-light">The Renal Project</span>
		  	</a>

		  	<!-- Sidebar Menu -->
	  		<div class="sidebar">
	  			<nav class="mt-2">
		  			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

	            <?php if($_SESSION["userType"]==1){ ?>
	            	<!-- ADMIN -->
	            	<li class="nav-item has-treeview"> <!-- menu-open -->
	            		<a href="#" class="nav-link">
	            			<i class="nav-icon fas fa-user-shield"></i>
	            			<p> ADMIN <i class="right fas fa-angle-left"></i></p>
	            		</a>

	            		<ul class="nav nav-treeview">
	            			<!--View-->
	            			<li class="nav-item">
	            				<a href="<?php echo LOCAL_HOME_URL.'?page=view-admin'?>" class="nav-link" id="view-admin">
	            					<i class="nav-icon fa fa-eye"></i>
	            					<p>View</p>
	            				</a>
	            			</li>

	            			<!-- Add -->
	            			<li class="nav-item">
	            				<a href="<?php echo LOCAL_HOME_URL.'?page=add-admin'?>" class="nav-link" id="add-admin">
	            					<i class="nav-icon fa fa-plus"></i>
	            					<p>Add</p>
	            				</a>
	            			</li>
	            		</ul>
	            	</li>
	            
	            	<!-- DOCTOR -->
		            <li class="nav-item has-treeview">
			           	<a href="#" class="nav-link">
			           		
			           		<i class="nav-icon fas fa-user-md"></i>
			           		<p>DOCTOR<i class="right fas fa-angle-left"></i></p>
			           	</a>

			           	<ul class="nav nav-treeview">
			           		<!--View-->
			           		<li class="nav-item">
			           			<a href="?page=view-doctor" class="nav-link" id="view-doctors">
			           				<i class="nav-icon fa fa-eye"></i>
			           				<p>View</p>
			           			</a>
			           		</li>

			           		<!-- Add -->
			           		<li class="nav-item">
			           			<a href="?page=add-doctor" class="nav-link" id="add-doctors">
			           				<i class="nav-icon fa fa-plus"></i>
			           				<p>Add</p>
			           			</a>
			           		</li>
			           	</ul>
		            </li>
		        
		            <!-- BRANCH -->
		            <li class="nav-item has-treeview">
			           	<a href="#" class="nav-link">
			           		
			           		<i class="nav-icon fas fa-hospital-alt"></i>
			           		<p>BRANCH<i class="right fas fa-angle-left"></i></p>
			           	</a>

			           	<ul class="nav nav-treeview">
			           		<!--View-->
			           		<li class="nav-item">
			           			<a href="?page=view-branch" class="nav-link" id="view-branch">
			           				<i class="nav-icon fa fa-eye"></i>
			           				<p>View</p>
			           			</a>
			           		</li>

			           		<!-- Add -->
			           		<li class="nav-item">
			           			<a href="?page=add-branch" class="nav-link" id="add-branch">
			           				<i class="nav-icon fa fa-plus"></i>
			           				<p>Add</p>
			           			</a>
			           		</li>
			           	</ul>
		            </li>
		        
		            <!-- STAFF -->
		            <li class="nav-item has-treeview">
			           	<a href="#" class="nav-link">
			           		
			           		<i class="nav-icon fas fa-user"></i>
			           		<p>STAFF<i class="right fas fa-angle-left"></i></p>
			           	</a>

			           	<ul class="nav nav-treeview">
			           		<!--View-->
			           		<li class="nav-item">
			           			<a href="?page=view-staff" class="nav-link" id="view-staff">
			           				<i class="nav-icon fa fa-eye"></i>
			           				<p>View</p>
			           			</a>
			           		</li>

			           		<!-- Add -->
			           		<li class="nav-item">
			           			<a href="?page=add-staff" class="nav-link" id="add-staff">
			           				<i class="nav-icon fa fa-plus"></i>
			           				<p>Add</p>
			           			</a>
			           		</li>
			           	</ul>
		            </li>
		        <?php }?>

		        
		            <!-- PATIENT -->
		            <li class="nav-item has-treeview">
			           	<a href="#" class="nav-link">
			           		
			           		<i class="nav-icon fas fa-user-injured"></i>
			           		<p>PATIENT<i class="right fas fa-angle-left"></i></p>
			           	</a>

			           	<ul class="nav nav-treeview">
			           	
			           		<!--View-->
			           		<li class="nav-item">
			           			<a href="?page=view-patient" class="nav-link" id="view-patient">
			           				<i class="nav-icon fa fa-eye"></i>
			           				<p>View</p>
			           			</a>
			           		</li>

			           	<?php if($_SESSION["userType"]==3){?>
			           		<!-- Add -->
			           		<li class="nav-item">
			           			<a href="?page=add-patient" class="nav-link" id="add-patient">
			           				<i class="nav-icon fa fa-plus"></i>
			           				<p>Add</p>
			           			</a>
			           		</li>
			           	<?php }?>
			           	</ul>
		            </li> 
		        

					</ul>
		      </nav>
	  		</div>
	  	</div>

	

		<!-- MAIN LOADING PAGE -->
		<div style="" class="content-wrapper" id="load-page">
			<!-- <h1 class="container-fluid">Loading...</h1> -->
			
			<?php //FILTER PAGES THAT WILL BE ACCESSED BY:

				//ADMIN
				if($_SESSION["userType"]==1){
					$accsPage = AdminAccessPages();
					if(in_array($inc_page, $accsPage)){
						include($inc_page);
					}
					else{ include("page-unauth.php"); }
				}

				//DOCTOR
				else if($_SESSION["userType"]==2){
					$accsPage = DoctorAccessPages();
					if(in_array($inc_page, $accsPage)){
						include($inc_page);
					}
					else{ include("page-unauth.php"); }
				}

				//STAFF
				else if($_SESSION["userType"]==3){
					$accsPage = StaffAccessPages();
					if(in_array($inc_page, $accsPage)){
						include($inc_page);
					}
					else{ include("page-unauth.php"); }
				}
			?>

		</div>

		<!-- FOOTER -->
		<footer class="main-footer">
			<strong>Copyright &copy; 2019 <a href="#">The Renal Project</a>.</strong> All rights reserved.
		</footer>
	</div>




<!-- SCRIPTS FOR ADMINLTE -->
	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>

	<!-- Bootstrap4 Duallistbox -->
	<!-- <script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script> -->

	<!-- InputMask -->
	<script src="plugins/moment/moment.min.js"></script>
	<script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>


	<!-- date-range-picker -->
	<!--<script src="plugins/daterangepicker/daterangepicker.js"></script> -->

	<!-- bootstrap color picker -->
	<!-- <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script> -->

	<!-- Tempusdominus Bootstrap 4 -->
	<!-- <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->

	<!-- Bootstrap Switch -->
	<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>

	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- Page script -->

</body>
</html>

<script>
	$(function () {
		//Initialize Select2 Elements
	   $(".select2").select2()

	   //Initialize Select2 Elements
	   $(".select2bs4").select2({
	     theme: "bootstrap4"
	   })

	   //Datemask dd/mm/yyyy
	   $("#datemask").inputmask("dd/mm/yyyy", { "placeholder": "dd/mm/yyyy" })

	   //Datemask2 mm/dd/yyyy
	   $("#datemask2").inputmask("mm/dd/yyyy", { "placeholder": "mm/dd/yyyy" })

	   //Money Euro
	   $("[data-mask]").inputmask()

	   //Date range picker
	   //$("#reservation").daterangepicker()

	   //Date range picker with time picker
	   // $("#reservationtime").daterangepicker({
	   //   timePicker: true,
	   //   timePickerIncrement: 30,
	   //   locale: {
	   //     format: "MM/DD/YYYY hh:mm A"
	   //   }
	   // })

	   //Date range as a button
	   // $("#daterange-btn").daterangepicker(
	   //   {
	   //     ranges   : {
	   //       "Today"       : [moment(), moment()],
	   //       "Yesterday"   : [moment().subtract(1, "days"), moment().subtract(1, 'days')],
	   //       "Last 7 Days" : [moment().subtract(6, "days"), moment()],
	   //       "Last 30 Days": [moment().subtract(29, "days"), moment()],
	   //       "This Month"  : [moment().startOf("month"), moment().endOf("month")],
	   //       "Last Month"  : [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
	   //     },
	   //     startDate: moment().subtract(29, "days"),
	   //     endDate  : moment()
	   //   },
	   //   function (start, end) {
	   //     $("#reportrange span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"))
	   //   }
	   // )

	   //Timepicker
	   $("#timepicker").datetimepicker({
	     format: "LT"
	   })

	   //Bootstrap Duallistbox
	   $(".duallistbox").bootstrapDualListbox()

	   //Colorpicker
	   //$(".my-colorpicker1").colorpicker()

	   //color picker with addon
	   //$(".my-colorpicker2").colorpicker()

	   // $(".my-colorpicker2").on("colorpickerChange", function(event) {
	   //   $(".my-colorpicker2 .fa-square").css("color", event.color.toString());
	   // });

	   // $("input[data-bootstrap-switch]").each(function(){
	   //   $(this).bootstrapSwitch("state", $(this).prop("checked"));
	   // });
	});
</script>

<?php ob_end_flush();?>