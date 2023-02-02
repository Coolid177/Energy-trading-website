<!doctype html>
<html lang="en" class="fullscreen">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Create account</title>
	<link href="<?= base_url('CSS/Login.css') ?>" rel="stylesheet">
</head>
<body class="maxVH"> 
	<div class="d-flex bg-gray align-content-stretch max-height">
		<img class="hidden"src="<?= base_url('/Public_images/Login image.jpg') ?>">
		<div class="mx-auto justify-content-center align-self-center">
			<div class="mx-auto justify-content-center">
				<h1 class="mb-3"> Welcome to energetic! </h1> 
			</div>
			<?php if (!empty(session()->getFlashdata('email_taken'))): ?>
				<div class="alert alert-danger">
					<?= session()->getFlashdata("email_taken") ?>
				</div>
			<?php endif ?>
			<form id = "form" class="mx-auto align-self-center" action="<?= base_url("/create_account")?>" method="post">
				<?= csrf_field() ?>
				<div class="mb-3">
					<label for ="Email" class="form-label">Email address</label>
					<input id ="email" name = "Email" placeholder="Email..." type="text"  class="form-control length-fixed-300 bg-light" aria-describedby="emailHelp">
					<span id="email-error" class="error"></span>
					<?php if (isset($Email)): ?>
						<span><?= $Email ?></span>
					<?php endif ?>
				</div>
				<div class="mb-3">
					<label for = "Fname" class="form-label">First name</label>
					<input id = "fname" name = "Fname" placeholder = "First name..." type="text" class="form-control length-fixed-300 bg-light">
					<span id="fname-error" class="error"></span>
					<?php if (isset($Fname)): ?>
					<span><?= $Fname ?></span>
					<?php endif ?>
				</div>
				<div class="mb-3">
					<label for ="Lname" class="form-label">Last name</label>
					<input id="lname" name = "Lname" placeholder = "Last name..." type="text" class="form-control length-fixed-300 bg-light">
					<span id="lname-error" class="error"></span>
					<?php if (isset($Lname)): ?>
					<span><?= $Lname ?></span>
					<?php endif ?>
				</div>
				<div class="mb-3">
					<label for = "Password" class="form-label">Password</label>
					<input id="password" name="Password" placeholder = "Password..." type="password" class="form-control length-fixed-300 bg-light">
					<span id="password-error" class="error"></span>
					<?php if (isset($Password)): ?>
					<span><?= $Password ?></span>
					<?php endif ?>
				</div>
				<div class="mb-3">
					<label for ="Cpassword" class="form-label">Retype password</label>
					<input id="cpassword" name="Cpassword" placeholder = "Confirm password..." type="password"  class="form-control length-fixed-300 bg-light">
					<span id="cpassword-error" class="error"></span>
					<?php if (isset($Cpassword)): ?>
					<span><?= $Cpassword ?></span>
					<?php endif ?>
				</div>
				<div class = "mb-3">
					<label for="isVendor" class="form-label">Would you like to be a vendor?</label>
					<div class="input-group-text">
						<input name="isVendor" id="isVendor" class="mt-0" type="checkbox" value="true" aia-label="Sign up as a vendor">
						<label for = "isVendor" class="yes-position">Yes</label>
					</div>
				</div>
				<div class="spacing">
					<button type="submit" class="btn btn-primary" aria-label="submit form">Create account</button>
				</div>
			</form>
		</div>
	</div>
</body>
<script src="authenticate.js"></script>
</html>