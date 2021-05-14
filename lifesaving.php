<?php	
	
	include ('include/header.php');
	include("config.php"); 

?>

<style>
	.size{
		min-height: 0px;
		padding: 60px 0 40px 0;
		
	}
	.loader{
		display:none;
		width:69px;
		height:89px;
		position:absolute;
		top:25%;
		left:50%;
		padding:2px;
		z-index: 1;
	}
	.loader .fa{
		color: #e74c3c;
		font-size: 52px !important;
	}
	.form-group{
		text-align: left;
	}
	h1{
		color: white;
	}
	h3{
		color: #e74c3c;
		text-align: center;
	}
	.red-bar{
		width: 25%;
	}
	span{
		display: block;
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
<div class="container-fluid red-background size">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<h1 class="text-center">Life Saving Contacts</h1>
			<hr class="white-bar">
		</div>
	</div>
</div>


	

<div class="container" style="padding: 60px 0;">
	<div class="row data">
		<?php
		$sql="SELECT * FROM lifesavingcontacts";
		$result=mysqli_query($con,$sql);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
					echo '
						<div class="col-md-3 col-sm-12 col-lg-3 donors_data">
						
							<span class="name">'.$row['organization'].'</span>
							<span>'.$row['head'].'</span>
							<span>'.$row['phonenumber'].'</span>
							<span>'.$row['city'].'</span>
							<span>'.$row['link'].'</span>

							
						</div>
					';
					
				}
			}
		?>
	</div>
</div>
<div class="loader" id="wait">
	<i class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>
</div>

<?php	

	include ('include/footer.php'); 

?>
