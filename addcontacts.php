<?php 
  //include header file
  include ('include/header.php');

  if(isset($_POST['submit']) ){
	  echo("submitted");
	if(isset($_POST['organization']) && !empty($_POST['organization'])){
		echo("organization set");
			$organization=$_POST['organization'];
	}else{
		$nameError='
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>please fill the name field.</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		';
	}
	
		if(isset($_POST['headname']) && !empty($_POST['headname'])){
				$headname=$_POST['headname'];
		}else{
			$nameError='
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>please fill the name field.</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			';
		}
	
		if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
			if(preg_match('/^\d{10}$/',$_POST['contact_no'])){
				$contact_no=$_POST['contact_no'];
			}else{
				$contactError='
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Only 10 digits are allowed</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				  </button>
				</div>
				';
			}
		}else{
			$contactError='
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>please fill the contact field.</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			';
		}

		if(isset($_POST['link']) && !empty($_POST['link'])){
			$link=$_POST['link'];
	}else{
		$nameError='
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>please fill the name field.</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		';
	}

	if(isset($_POST['city']) && !empty($_POST['city'])){
		if(preg_match('/^[A-Za-z\s]+$/',$_POST['city'])){
			$city=$_POST['city'];
		}else{
			$cityError='
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>Only lower and upper case and space is allowed(city)</strong>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			';
		}
	}else{
		$cityError='
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>please fill the city field.</strong>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		';
	}
	
	//insert the data
	
	echo('insert data called');
	if(isset($organization) && isset($contact_no) && isset($headname)
	 && isset($city) && isset($link)){
		 echo('insert data called');

		 $sql="INSERT INTO `lifesavingcontacts`(`organization`, `head`, `phonenumber`, `link`, `city`) 
		 VALUES ('$organization','$headname','$contact_no','$link','$city')";
		echo($sql);
		 if(mysqli_query($con,$sql)){
			
			header('Location:user/adminindex.php');
		 }
		 else{
			$submitError='
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>OOPS!!Admin Data not inserted.</strong>
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
		padding: 60px 0 40px 0;
		
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
</style>
<div class="container-fluid red-background size">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<h1 class="text-center">Donate</h1>
			<hr class="white-bar">
		</div>
	</div>
</div>
<div class="container size">
	<div class="row">
		<div class="col-md-6 offset-md-3 form-container">
					<h3>Life Saving Contacts</h3>
					<hr class="red-bar">
					<?php if(isset($termError)) echo $termError; ?>
					<?php if(isset($submitsuccess)) echo $submitsuccess; ?>
					<?php if(isset($submitError)) echo $submitError; ?>	
					
					
          <!-- Error Messages -->

				<form class="form-group" action="" method="post" novalidate=""> 
					<div class="form-group">
						<label for="organization"> organization</label>
						<input type="text" name="organization" id="organization" placeholder="organization" 
						required pattern="[A-Za-z/\s]+" title="Only lower and upper case and space"
						value="<?php if(isset($organization)) echo $organization; ?>" class="form-control">
						<?php if(isset($nameError)) echo $nameError; ?>
					</div><!--full name-->

				    <div class="form-group">
						<label for="headname">Head Name</label>
						<input type="text" name="headname" id="headname" placeholder="Head Name"  value="<?php if(isset($headname)) echo $headname; ?>" class="form-control">
					</div>
					<div class="form-group">
              <label for="contact_no">Contact No</label>
              <input type="text" name="contact_no" value="<?php if(isset($contact_no)) echo $contact_no; ?>" placeholder="+91********" class="form-control" required pattern="^\d{11}$" title="11 numeric characters only" maxlength="11">
			  <?php if(isset($contactError)) echo $contactError; ?>
			</div><!--End form-group-->

			<div class="form-group">
						<label for="link">Link</label>
						<input type="text" name="link" id="link" placeholder="Link"  value="<?php if(isset($link)) echo $link; ?>" class="form-control">
					</div>
					
					<div class="form-group">
			  <label for="city">City</label>
              <select name="city" id="city" class="form-control demo-default" required>
	<option value="">-- Select --</option><?php if(isset($city)) echo '<option selected="" value="'.$city.'">
				'.$city.'</option>'; ?><optgroup title="Azad Jammu and Kashmir (Azad Kashmir)" label="&raquo; Azad Jammu and Kashmir (Azad Kashmir)"></optgroup><option value="Bagh" >Bagh</option><option value="Bhimber" >Bhimber</option><option value="Kotli" >Kotli</option><option value="Mirpur" >Mirpur</option><option value="Muzaffarabad" >Muzaffarabad</option><option value="Neelum" >Neelum</option><option value="Poonch" >Poonch</option><option value="Sudhnati" >Sudhnati</option><optgroup title="Balochistan" label="&raquo; Balochistan"></optgroup><option value="Awaran" >Awaran</option><option value="Barkhan" >Barkhan</option><option value="Bolan" >Bolan</option><option value="Chagai" >Chagai</option><option value="Dera Bugti" >Dera Bugti</option><option value="Gwadar" >Gwadar</option><option value="Jafarabad" >Jafarabad</option><option value="Jhal Magsi" >Jhal Magsi</option><option value="Kalat" >Kalat</option><option value="Kech" >Kech</option><option value="Kharan" >Kharan</option><option value="Khuzdar" >Khuzdar</option><option value="Kohlu" >Kohlu</option><option value="Lasbela" >Lasbela</option><option value="Loralai" >Loralai</option><option value="Mastung" >Mastung</option><option value="Musakhel" >Musakhel</option><option value="Naseerabad" >Naseerabad</option><option value="Nushki" >Nushki</option><option value="Panjgur" >Panjgur</option><option value="Pishin" >Pishin</option><option value="Qilla Abdullah" >Qilla Abdullah</option><option value="Qilla Saifullah" >Qilla Saifullah</option><option value="Quetta" >Quetta</option><option value="Sibi" >Sibi</option><option value="Zhob" >Zhob</option><option value="Ziarat" >Ziarat</option><optgroup title="Federally Administered Tribal Areas (FATA" label="&raquo; Federally Administered Tribal Areas (FATA"></optgroup><option value="Bajaur Agency" >Bajaur Agency</option><option value="Khyber Agency" >Khyber Agency</option><option value="Kurram Agency" >Kurram Agency</option><option value="Mohmand Agency" >Mohmand Agency</option><option value="North Waziristan Agency" >North Waziristan Agency</option><option value="Orakzai Agency" >Orakzai Agency</option><option value="South Waziristan Agency" >South Waziristan Agency</option><optgroup title="Islamabad Capital" label="&raquo; Islamabad Capital"></optgroup><option value="Islamabad" >Islamabad</option><optgroup title="North-West Frontier Province (NWFP)" label="&raquo; North-West Frontier Province (NWFP)"></optgroup><option value="Abbottabad" >Abbottabad</option><option value="Bannu" >Bannu</option><option value="Batagram" >Batagram</option><option value="Buner" >Buner</option><option value="Charsadda" >Charsadda</option><option value="Chitral" >Chitral</option><option value="Dera Ismail Khan" >Dera Ismail Khan</option><option value="Dir Lower" >Dir Lower</option><option value="Dir Upper" >Dir Upper</option><option value="Hangu" >Hangu</option><option value="Haripur" >Haripur</option><option value="Karak" >Karak</option><option value="Kohat" >Kohat</option><option value="Kohistan" >Kohistan</option><option value="Lakki Marwat" >Lakki Marwat</option><option value="Malakand" >Malakand</option><option value="Mansehra" >Mansehra</option><option value="Mardan" >Mardan</option><option value="Nowshera" >Nowshera</option><option value="Peshawar" >Peshawar</option><option value="Shangla" >Shangla</option><option value="Swabi" >Swabi</option><option value="Swat" >Swat</option><option value="Tank" >Tank</option><optgroup title="Punjab" label="&raquo; Punjab"></optgroup><option value="Alipur" >Alipur</option><option value="Attock" >Attock</option><option value="Bahawalnagar" >Bahawalnagar</option><option value="Bahawalpur" >Bahawalpur</option><option value="Bhakkar" >Bhakkar</option><option value="Chakwal" >Chakwal</option><option value="Chiniot" >Chiniot</option><option value="Dera Ghazi Khan" >Dera Ghazi Khan</option><option value="Faisalabad" >Faisalabad</option><option value="Gujranwala" >Gujranwala</option><option value="Gujrat" >Gujrat</option><option value="Hafizabad" >Hafizabad</option><option value="Jhang" >Jhang</option><option value="Jhelum" >Jhelum</option><option value="Kasur" >Kasur</option><option value="Khanewal" >Khanewal</option><option value="Khushab" >Khushab</option><option value="Lahore" >Lahore</option><option value="Layyah" >Layyah</option><option value="Lodhran" >Lodhran</option><option value="Mandi Bahauddin" >Mandi Bahauddin</option><option value="Mianwali" >Mianwali</option><option value="Multan" >Multan</option><option value="Muzaffargarh" >Muzaffargarh</option><option value="Nankana Sahib" >Nankana Sahib</option><option value="Narowal" >Narowal</option><option value="Okara" >Okara</option><option value="Pakpattan" >Pakpattan</option><option value="Rahim Yar Khan" >Rahim Yar Khan</option><option value="Rajanpur" >Rajanpur</option><option value="Rawalpindi" >Rawalpindi</option><option value="Sahiwal" >Sahiwal</option><option value="Sargodha" >Sargodha</option><option value="Sheikhupura" >Sheikhupura</option><option value="Shekhupura" >Shekhupura</option><option value="Sialkot" >Sialkot</option><option value="Toba Tek Singh" >Toba Tek Singh</option><option value="Vehari" >Vehari</option><optgroup title="Sindh" label="&raquo; Sindh"></optgroup><option value="Badin" >Badin</option><option value="Dadu" >Dadu</option><option value="Ghotki" >Ghotki</option><option value="Hyderabad" >Hyderabad</option><option value="Jacobabad" >Jacobabad</option><option value="Jamshoro" >Jamshoro</option><option value="Karachi" >Karachi</option><option value="Kashmore" >Kashmore</option><option value="Khairpur" >Khairpur</option><option value="Larkana" >Larkana</option><option value="Matiari" >Matiari</option><option value="Mirpur Khas" >Mirpur Khas</option><option value="Naushahro Feroze" >Naushahro Feroze</option><option value="Nawabshah" >Nawabshah</option><option value="Qambar Shahdadkot" >Qambar Shahdadkot</option><option value="Sanghar" >Sanghar</option><option value="Shikarpur" >Shikarpur</option><option value="Sukkur" >Sukkur</option><option value="Tando Allahyar" >Tando Allahyar</option><option value="Tando Muhammad Khan" >Tando Muhammad Khan</option><option value="Tharparkar" >Tharparkar</option><option value="Thatta" >Thatta</option><option value="Umerkot" >Umerkot</option></select>
			</div><!--city end-->
			
					<div class="form-group">
						<button id="submit" name="submit" type="submit" class="btn btn-lg btn-danger center-aligned" style="margin-top: 20px;">Submit</button>
					</div>
				</form>
		</div>
	</div>
</div>

<?php 
  //include footer file
  include ('include/footer.php');
?>