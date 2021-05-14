
<?php 

include 'include/header.php';
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){ 
	if(isset($_POST['date'])){
		$showform='
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Are you sure you want to update your record?</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		<form target="" method="post">
		<br>
		<input type="hidden" name="userid" value="'.$_SESSION['user_id'].'">
		<button type="submit" name="updatesave" class="btn btn-danger">Yes</button>
		<button type="button" class="btn btn-danger" data-dismiss="alert">
		<span aria-hidden="true">Oops! No </span>
		</button>      
		</form>
		 </div>	
		';
	}
	if(isset($_POST['userid'])){
		$userid=$_POST['userid'];
		$currentdate=date_create();
		$currentdate=date_format($currentdate,'Y-m-d');
		$sql="UPDATE donor SET save_life_date='$currentdate' where id='$userid'";
		if(mysqli_query($con,$sql)){
			$_SESSION['save_life_date']=$currentdate;
			//insert into log!
			$donor_name=$_SESSION['name'];
			$slf=$_SESSION['save_life_date'];
			$blood_group=$_SESSION['blood_group'];
			$timestamp=date("Y-m-d H:i:s");
			$donor_id = $_SESSION['user_id'];
			$sqllog="INSERT INTO `logs`(`donor_name`, `blood_donated`, `timestamp`, `donor_id`) 
			VALUES ('$donor_name','$blood_group','$timestamp', '$donor_id')";
			$inserted_into_logs=mysqli_query($con,$sqllog);	
			// // header("Location:./index.php");
		}else{
			$submiterror='
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>OOPS!!Try again later...</strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div> 
			';
		}
	}
?>


<style>
h1,h3{
	display: inline-block;
	padding: 10px;
}
.name{
	color: #e74c3c;
	font-size: 22px;
	font-weight: 700;
}
.donors_data{
	background-color: white;
	border-radius: 5px;
	margin:20px 5px 0px 5px;
	-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
	-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
	box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
	padding: 20px;
}
</style>

		<div class="container" style="padding: 60px 0;">
		<div class="row">
			<div class="col-md-12 col-md-push-1">
				<div class="panel panel-default" style="padding: 20px;">
					<div class="panel-body">
						<?php if(isset($submiterror)) echo $submiterror; ?>
						
							<div class="alert alert-danger alert-dismissable" style="font-size: 18px; display: none;">
						
								<strong>Warning!</strong> Are you sure you want a save the life if you press yes, then you will not be able to show before 3 months.
							
							<div class="buttons" style="padding: 20px 10px;">
								<input type="text" value="" hidden="true" name="today">
								<button class="btn btn-primary" id="yes" name="yes" type="submit">Yes</button>
								<button class="btn btn-info" id="no" name="no">No</button>
							</div>
						  </div>
						<div class="heading text-center">
							<h3>Welcome </h3> <h1><?php if(isset($_SESSION['name'])) echo $_SESSION['name'];?></h1>
						</div>
						<p class="text-center">Here you can manage your account update your profile</p>
						<div class="test-success text-center" id="data" style="margin-top: 20px;">
						<?php if(isset($showform)) echo $showform; ?>
						<!-- Display Message here--></div>
						<?php
						$safedate=$_SESSION['save_life_date'];
						if($safedate=='0'){
							echo '
							<form target="" method="post">
						<button style="margin-top: 20px;" name="date" type="submit" id="save_the_life" class="btn btn-lg btn-danger center-aligned ">Save The Life</button>
						</form>
							';
						}else{
							$start=date_create("$safedate");
							$end=date_create();
							$diff=date_diff($start,$end);
							
							
							// $diffyear=$diff->y;
							$diffmonth=$diff->m;
							// $diffdays=$diff->d;
							
							
							


							if($diffmonth>=3){
								echo '
							<form target="" method="post">
						<button style="margin-top: 20px;" name="date" type="submit" id="save_the_life" class="btn btn-lg btn-danger center-aligned ">Save The Life</button>
						</form>
							';
							
							}else {

								echo '
							<div class="donors_data">
							<span class="name">HURRAY!!</span>
							<span>You already saved life.You can donate 
							the blood <b>after three</b> months.<b>Stay Blessed and Healthy...Grateful</b></span>
							</div>
							';
							}
							
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
<?php
}else{
	header("Location:../index.php");
}

include 'include/footer.php'; 
?>