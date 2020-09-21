<!--PAGE HEADER -->
<div class="content-header">
	<!-- <div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">HOME PAGE</h1>
			</div>
		</div>
	</div> -->
</div>

<!-- SECTION BODY -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">

					<!-- CARD HEADER -->
					<div class="card-header">
						<h3 class="card-title"><b> HOME PAGE</b></h3>
					</div>

					<!-- CARD BODY -->
					<div class="card-body" style="text-align: center;">
						<h1> Welcome <?php echo $_SESSION["name"]; ?> </h1>
						<!-- <img src="dist/img/flow-renal-pro.png"> -->

						<!-- <h3>ADD LIVE SEARCH</h3> -->

						<?php 
							echo '<p><b>Name: '.$_SESSION["name"].'</b></p>';
							echo '<p><b>User Type: '.$_SESSION["userType"].'</b></p>';
							echo '<p><b>Email: '.$_SESSION["email"].'</b></p>';
						?>
					</div>

					<!-- CARD FOOTER -->
					<div class="card-footer">
						<div class="row">
							<!-- PAGINATION -->
							<div class="col-md-10">
								<div id="load-pagn"></div>	
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</section>