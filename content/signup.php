<div class="container">
	<div class="row">
		<form class="form-horizontal" role="form" action="index.php" method="post">
			<div class="form-group">
				<label for="username" class="col-lg-2 control-label">Username</label>
				<div class="col-lg-4">
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter a user name">
				</div>
			</div>

			<div class="form-group">
				<label for="password" class="col-lg-2 control-label">Password</label>
				<div class="col-md-4">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password">  
				</div>
			</div>
			<div class="form-group">
				<label for="verifyPassword" class="col-lg-2 control-label">Verify Password</label>
				<div class="col-md-4">
					<input type="password" class="form-control" id="verifyPassword" name="verifyPassword" placeholder="Verify Password">
				</div>
			</div>
				
			<div class="form-group">
				<label for="firstname" class="col-lg-2 control-label">First name</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter first name">
				</div>
				<label for="surname" class="col-lg-2 control-label">Sur name</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="surname" name="surname" placeholder="Enter your sur name">
				</div>
			</div>
			
			<div class="form-group">
				<label for="homeaddress" class="col-lg-2 control-label">Home Address</label>
				<div class="col-md-10">
					<input type="text" class="form-control" id="homeaddress" name="homeaddress" placeholder="Enter your home address">
				</div>
			</div>

			<div class="form-group">
				<label for="zipcode" class="col-lg-2 control-label">Zip code</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter your zip code">
				</div>
			</div>

			<div class="form-group">
				<label for="city" class="col-lg-2 control-label">City</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="city" name="city" placeholder="Enter the city your home address resides in">
				</div>
			</div>

			<div class="form-group">
				<label for="country" class="col-lg-2 control-label">Country</label>
				<div class="col-md-4">
					<input type="text" class="form-control" id="country" name="country" placeholder="Enter the country you live in">
				</div>
			</div>

			<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn-lg btn-primary">Sign up</button>
				</div>
			</div>

		</form>
	</div>
</div>

<?php 

// Checks whether we are receiving a post request from the user-agent.
// If the UA just browses then GET requests are sent, but when the UA
// presses the sign up button we will receive a POST.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$username				= $_POST["username"];
	$password				= $_POST["password"];
	$verifyPassword		= $_POST["verifyPassword"];
	$firstname				= $_POST["firstname"];
	$surname					= $_POST["surname"];
	$homeaddress			= $_POST["homeaddress"];
	$zipcode					= $_POST["zipcode"];
	$city						= $_POST["city"];
	$country					= $_POST["country"];

	// Protects against SQLi.
	$Username				= mysql_real_escape_string($username);
	$password				= mysql_real_escape_string($password);
	$verifyPassword		= mysql_real_escape_string($verifyPassword);
	$firstname				= mysql_real_escape_string($firstname);
	$surname					= mysql_real_escape_string($surname);
	$homeaddress			= mysql_real_escape_string($homeaddress);
	$zipcode					= mysql_real_escape_string($zipcode);
	$city						= mysql_real_escape_string($city);
	$country					= mysql_real_escape_string($country);


	$sitewide_key = "eitf05 secure web shop sitewide key";
	$salt = uniqid(mt_rand(), true);
	$password = hash_hmac('sha512', $password . $salt, $sitewide_key);

	echo "<div>" . $salt . "</div><div>" . $password . "</div>";

}



?>