<?php 
	//include header file
	//

	include ('include/header.php');
// if(isset($_POST['SignIn'])){
	//admin check!
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['email']) && !empty($_POST['email']) && 
		isset($_POST['password']) && !empty($_POST['password']) && 
		isset($_POST['status']) && !empty($_POST['status']) ){
			$email=$_POST['email'];
			$password=$_POST['password'];
			$status=$_POST['status'];


			if(isset($email) && isset($password) && isset($status) ){
				$password=md5($password);
				$sql="SELECT * FROM donor WHERE password='$password' AND email='$email' AND status='0'";
				$result=mysqli_query($con,$sql);
				if(mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){
						
						
						$_SESSION['user_id']=$row['id'];
						$_SESSION['name']=$row['name'];
						$_SESSION['save_life_date']=$row['save_life_date'];
						$_SESSION['blood_group']=$row['blood_group'];
						$_SESSION['status']=$row['status'];
						header('Location:user/adminindex.php');
					}
	
				}else{
					$signError='
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Invalid Credtial!!OOPSTry Again..</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div> 
					';	
				}
			}
		}
		//user
		else if(isset($_POST['email']) && !empty($_POST['email']) && 
		isset($_POST['password']) && !empty($_POST['password']) && empty($_POST['status'])){
			$email=$_POST['email'];
			$password=$_POST['password'];

		}else{
			$signinError='
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>User, Invalid Credtial!!Try Again..</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div> 
			';
		}
		//login query
		if(isset($email) && isset($password)){
			$password=md5($password);
			$sql="SELECT * FROM donor WHERE password='$password' AND email='$email'";
			$result=mysqli_query($con,$sql);
			if(mysqli_num_rows($result)>0){
				while($row=mysqli_fetch_assoc($result)){
					
					
					$_SESSION['user_id']=$row['id'];
					$_SESSION['name']=$row['name'];
					$_SESSION['save_life_date']=$row['save_life_date'];
					$_SESSION['blood_group']=$row['blood_group'];
					$_SESSION['status']=$row['status'];
					header('Location:user/index.php');
				}

			}else{
				$signError='
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<strong>Invalid Credtial!!OOPSTry Again..</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div> 
				';	
			}
		}
	}


?>

<style>
	.size{
		min-height: 0px;
		padding: 60px 0 60px 0;

	}
	h1{
		color: white;
	}
	.form-group{
		text-align: left;
	}
	h3{
		color: #e74c3c;
		text-align: center;
	}
	.red-bar{
		width: 25%;
	}
	.form-container{
		background-color: white;
		border: .5px solid #eee;
		border-radius: 5px;
		padding: 20px 10px 20px 30px;
		-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
	}
</style>
 <div class="container-fluid red-background size">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<h1 class="text-center">SignIn</h1>
			<hr class="white-bar">
		</div>
	</div>
</div>
<div class="container size ">
	<div class="row">
		<div class="col-md-6 offset-md-3 form-container">
		<h3>SignIn</h3>
		<hr class="red-bar">
		<?php if(isset($signinError)) echo $signinError; ?>
		<?php if(isset($signError)) echo $signError; ?>

		<!-- Erorr Messages -->

			<form  action="signin.php" method="POST" >
				<div class="form-group">
					<label for="email">Email/Phone no.</label>
					<input type="text" name="email" class="form-control" placeholder="Email" required>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" placeholder="Password" required class="form-control">
				</div>
				<!-- <div class="form-group">
					<input type="checkbox" name="status" value='1'>Are you an Admin?
				</div>
				status -->
				<div class="form-group">
					<button class="btn btn-danger btn-lg center-aligned" type="submit" name="SignIn">SignIn</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'include/footer.php' ?>
