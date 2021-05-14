<?php 

	//include header file
	include ('include/header.php');

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
		margin: 25px;
		-webkit-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		-moz-box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		box-shadow: 0px 2px 5px -2px rgba(89,89,89,0.95);
		padding: 20px 10px 20px 30px;
	}
</style>
<style>
 #theading{
	text-align: center;
	color: black;
	}
</style>
<?php
        $sql="select timestamp from logs where donor_id =$_SESSION[user_id]";
		$result=mysqli_query($con,$sql);
    //    print_r($result);
?>
<div class="container">
<p style="text-align: center; color: black; font-size: 60px;">Blood Donation History</p>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Timestamp</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $i=1;
 
  if(mysqli_num_rows($result) > 0 ){
    //   echo("inside if");
    while ($row = mysqli_fetch_array ($result)) {
        //  echo($row['timestamp']);    
  ?>

    <tr>
      <td>
      <?php
     echo($i);
      ?>
      </td>
      <td>
      <?php
     echo($row['timestamp']);
      ?>
</td>
    </tr>
    <?php
     $i++;
    }
    }
     ?>
  </tbody>
</table>
</div>
<?php 

	//include footer file
	include ('include/footer.php');

?>


