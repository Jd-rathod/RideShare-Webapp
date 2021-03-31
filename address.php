<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Address form by RideShare</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="css_1/roboto-font.css">
	<link rel="stylesheet" type="text/css" href="fonts_1/font-awesome-5/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="css_1/style.css"/>
</head>
<body class="form-v5">
	<div class="page-content">
		<div class="form-v5-content">
			<form method="POST" class="form-detail" action="addvar.php">
				<h2>Address Information</h2>
				<div class="form-row">
					<label for="User-name">User Name</label>
					<input type="text" name="name" id="name" class="input-text" placeholder="User name" value="<?php if (isset($_SESSION["name"])){echo $_SESSION["name"];}?>">
					<i class="fas fa-user"></i>
				</div>
				<div class="form-row">
					<label for="Street">Street</label>
					<input type="text" name="street" id="street" class="input-text" placeholder="enter street" autofocus required>
					<i class="fas fa-home"></i>
				</div>
				<div class="form-row">
					<label for="Pincode">Pincode</label>
					<input type="number" name="pin" id="pin" class="input-text" placeholder="Pincode" required>
					<i class="fas fa-map-pin"></i>
				</div>
				<div class="form-row">
					<label for="city">City</label>
					<input type="text" name="city" id="city" class="input-text" placeholder="City" required>
					<i class="fas fa-crosshairs"></i>
				</div>
				<div class="form-row">
					<label for="state">State</label>
					<input type="text" name="state" id="state" class="input-text" placeholder="State" required>
					<i class="fas fa-flag"></i>
				</div>
				<div class="form-row">
					<label for="country">Country</label>
					<input type="text" name="country" id="country" class="input-text" placeholder="Country" required>
					<i class="fas fa-globe" aria-hidden="true"></i>
				</div>
				<div class="form-row-last">
					<input type="submit" name="register" class="register" value="Register">
				</div>
			</form>
		</div>
	</div>
</body>
</html>
<?php
	unset($_SESSION["name"]);
?>