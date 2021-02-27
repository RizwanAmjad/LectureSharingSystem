<?php
    session_start();
    if(!sizeof($_SESSION)){
      header('location: index.php');
    }
    $title = "Edit your Data";
    include('templates/header.php');
?>
<link rel="stylesheet" href="assets/css/editprofile.css">
<!-- Page starts here-->
<?php include('templates/navigation.php');?>
<p id='status'></p>
<div id='main-div'>
	<div id=pic-div>
		<!--Profile Picture Form-->
		<form id='profile-pic-form' method="POST" class="md-form" enctype="multipart/form-data">
			<div class="file-field">
				<div class="btn btn-primary btn-sm float-left">
					<span>Select Picture</span>
					<input type="file" name="ProfilePicture" id="file">
				</div>
			</div>
			<input type="submit" value="Upload Image" class="btn btn-outline-success my-2 my-sm-0" name="submit-pic" id='submit-pic'>
		</form>
		<div class="container my-4">

			<!--Grid column-->
			<div class="col-md-6 mb-4">
				<img class="rounded-circle z-depth-2" id='img-holder' alt="100x100" src=<?php echo $pic; ?> data-holder-rendered="true">
			</div>
			<!--Grid column-->
		</div>
	</div>
	<!--Profile Picture related things ends here-->
	<div id=info-div>
		<form class="form-horizontal" id='data-form'>
			<!-- Form Name -->
			<legend>Personal Information</legend>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="textinput">Name</label>  
				<div class="col-md-4">
					<input id="name" name="name" type="text" placeholder="<?php echo $_SESSION['user_name'];?>" class="form-control input-md">
				</div>
			</div>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label" for="textinput">Email</label>  
				<div class="col-md-4">
					<input id="email" name="email" type="email" placeholder="<?php echo $_SESSION['user_email'];?>" class="form-control input-md">
				</div>
			</div>
			<!-- Button (Double) -->
			<div class="form-group">
				<div class="col-md-8">
					<button id="submit-data" name="button1id" class="btn btn-success">Update Info</button>
				</div>
			</div>
		</form>

	</div>
</div>





<!--Page ends here-->
<?php
    include('templates/footer.php');
?>
<script src='assets/js/globalFunctions.js'></script>
<script src='assets/js/editprofile/editpicture.js'></script>
<script src='assets/js/editprofile/editinfo.js'></script>