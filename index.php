<?php
//index.php

$error = '';
$name = '';
$gender = '';
$phone = '';
$email = '';
$address = '';
$nationality = '';
$birth = '';
$background = '';

function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

if(isset($_POST["submit"]))
{
	if(empty($_POST["name"]))
	{
		$error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
	}
	else
	{
		$name = clean_text($_POST["name"]);
		if(!preg_match("/^[a-zA-Z ]*$/",$name))
		{
			$error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
		}
	}
	if(empty($_POST["email"]))
	{
		$error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
	}
	else
	{
		$email = clean_text($_POST["email"]);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error .= '<p><label class="text-danger">Invalid email format</label></p>';
		}
	}
	if(empty($_POST["gender"]))
	{
		$error .= '<p><label class="text-danger">Gender is required</label></p>';
	}
	else
	{
		$subject = clean_text($_POST["gender"]);
	}
	if(empty($_POST["address"]))
	{
		$error .= '<p><label class="text-danger">Address is required</label></p>';
	}
	else
	{
		$message = clean_text($_POST["address"]);
	}
	if(empty($_POST["nationality"]))
	{
		$error .= '<p><label class="text-danger">Nationality is required</label></p>';
	}
	else
	{
		$message = clean_text($_POST["nationality"]);
	}
	if(empty($_POST["birth"]))
	{
		$error .= '<p><label class="text-danger">Date of Birth is required</label></p>';
	}
	else
	{
		$message = clean_text($_POST["birth"]);
	}
	if(empty($_POST["background"]))
	{
		$error .= '<p><label class="text-danger">Educational Background is required</label></p>';
	}
	else
	{
		$message = clean_text($_POST["background"]);
	}

	if($error == '')
	{
		$file_open = fopen("client_data.csv", "a");
		$no_rows = count(file("client_data.csv"));
		if($no_rows > 1)
		{
			$no_rows = ($no_rows - 1) + 1;
		}
		$form_data = array(
			'sr_no'		=>	$no_rows,
			'name'		=>	$name,
			'gender'	=>	$gender,
			'phone'		=>	$phone,
			'email'		=>	$email,
			'address'	=>	$address,
			'nationality'	=>	$nationality,
			'birth'		=>	$birth,
			'background'=>	$background
		);
		fputcsv($file_open, $form_data);
		$error = '<label class="text-success">Thank you</label>';
		$name = '';
		$gender = '';
		$phone = '';
		$email = '';
		$address = '';
		$nationality = '';
		$birth = '';
		$background = '';
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>FORM</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h2 align="center">FORM</h2>
			<br />
			<div class="col-md-6" style="margin:0 auto; float:none;">
				<form method="post">
					<h3 align="center">Client Form</h3>
					<br />
					<?php echo $error; ?>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
					</div>
					<div class="form-group">
						<label>Gender</label>
						<input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>" />
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" placeholder="Enter Phone number" class="form-control" value="<?php 
						echo $phone; ?>" />
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" class="form-control" placeholder="Enter Address" value="<?php echo $address; ?>" />
					</div>
					<div class="form-group">
						<label>Nationality</label> 
						<input type="text" name="nationality" class="form-control" placeholder="Enter nationality" value="<?php echo $nationality; ?>" />
					</div>
					<div class="form-group">
						<label>Date of Birth</label> 
						<input type="text" name="birth" class="form-control" placeholder="Enter Date of Birth" value="<?php echo $birth; ?>" />
					</div>

					<div class="form-group">
						<label>Educational Background</label>
						<textarea name="background" class="form-control"><?php \
						echo $background; ?></textarea>
					</div>

					<div class="form-group" align="center">
						<input type="submit" name="submit" class="btn btn-info" value="Submit" />
					</div>
				</form>
			</div>
		</div>
	</body>
</html>