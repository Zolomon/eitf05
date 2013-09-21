<?php

// Initialize variables
$username				= "";
$password				= "";
$verifyPassword		= "";
$firstname				= "";
$surname					= "";
$homeaddress			= "";
$zipcode					= "";
$city						= "";
$country					= "";

$isInputValid = FALSE;

function RenderControl($val, $name, $type, $cols, $label, $helptext, $success)
{
	$val = htmlspecialchars($val);

	$passwordHelp = '';

	if ($type === 'password' && $name !== 'verifyPassword') {
		$passwordHelp = '<span class="help-block">Password must be 12 characters or longer.</span>';
	}

	return <<<EOT
	<label for="$name" class="col-md-2 control-label">$label</label>
	<div class="col-md-$cols">
		<input value="$val" type="$type" class="form-control" id="$name" name="$name" placeholder="$helptext">
		$passwordHelp
	</div>
EOT;
}

function RenderGroup($success, $control) {
	$validation = '';

	switch ($success) {
		case 'success':
			$validation = 'has-success';
			break;

		case 'error':
			$validation = 'has-error';
			break;
		
		default:
			$validation = '';
			break;
	}

	echo <<<EOT
	<div class="form-group $validation">
		$control
	</div>
EOT;
}

function SanitizeInput(&$username, &$password, &$verifyPassword, &$firstname, &$surname, &$homeaddress, &$zipcode, &$city, &$country) {

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
	$username				= mysql_real_escape_string($username);
	$password				= mysql_real_escape_string($password);
	$verifyPassword		= mysql_real_escape_string($verifyPassword);
	$firstname				= mysql_real_escape_string($firstname);
	$surname					= mysql_real_escape_string($surname);
	$homeaddress			= mysql_real_escape_string($homeaddress);
	$zipcode					= mysql_real_escape_string($zipcode);
	$city						= mysql_real_escape_string($city);
	$country					= mysql_real_escape_string($country);
}

function VerifyPasswords(&$password, &$verifyPassword)
{
	return $password === $verifyPassword && !empty($password) && strlen($password) >= 12;
}

function IsInputValid(&$username, &$password, &$verifyPassword, &$firstname, &$surname, &$homeaddress, &$zipcode, &$city, &$country)
{
	return 
		!empty($username) && 
		!empty($password) && 
		!empty($verifyPassword) && 
		!empty($firstname) &&
		!empty($surname) && 
		!empty($homeaddress) && 
		!empty($zipcode) && 
		!empty($city) && 
		!empty($country);
}

function IsFormValid(&$username, &$password, &$verifyPassword, &$firstname, &$surname, &$homeaddress, &$zipcode, &$city, &$country) {
	return IsInputValid($username, $password, $verifyPassword, $firstname, $surname, $homeaddress, $zipcode, $city, $country) && 
			 VerifyPasswords($password, $verifyPassword);
}

echo <<<EOT
<div class="container">
	<div class="row">
		<form class="form-horizontal" role="form" action="index.php" method="post">
EOT;

	// Render validation
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		
		SanitizeInput($username, $password, $verifyPassword, $firstname, $surname, $homeaddress, $zipcode, $city, $country);

		$isFormValid = IsFormValid($username, $password, $verifyPassword, $firstname, $surname, $homeaddress, $zipcode, $city, $country);

		if (!$isFormValid) {

			$passwordSuccess = VerifyPasswords($password, $verifyPassword);

			RenderGroup(!empty($username) ? 'success' : 'error',			RenderControl($username, 'username', 'text', 4, 'Username', 'Enter Username'));
			RenderGroup($passwordSuccess ? 'success' : 'error',			RenderControl('', 'password', 'password', 4, 'Password','Enter Password'));
			RenderGroup($passwordSuccess ? 'success' : 'error',			RenderControl('', 'verifyPassword', 'password', 4, 'Verify Password', 'Verify Password'));
			RenderGroup(!empty($firstname) ? 'success' : 'error',			RenderControl($firstname, 'firstname', 'text', 4,'First Name', 'Enter First Name'));
			RenderGroup(!empty($surname) ? 'success' : 'error', 			RenderControl($surname,   'surname',   'text', 4,'Sur Name', 'Enter Sur Name'));
			RenderGroup(!empty($homeaddress)? 'success' : 'error',		RenderControl($homeaddress, 'homeaddress', 'text', 4,'Home Address', 'Enter Home Address'));
			RenderGroup(!empty($zipcode) ? 'success' : 'error',			RenderControl($zipcode,   'zipcode',   'text', 4,'Zip Code', 'Enter Zip Code'));
			RenderGroup(!empty($city) ? 'success' : 'error',				RenderControl($city, 'city', 'text', 4,'City', 'Enter City'));
			RenderGroup(!empty($country) ? 'success' : 'error',			RenderControl($country,   'country',   'text', 4,'Country', 'Enter Country'));

		} else {
			// POST && Validated --> Nothing to output, carry on.
		}

	} else {
		// GET --> Output empty form.

			RenderGroup('', RenderControl($username, 'username', 'text', 4, 'Username', 'Enter Username'));
			RenderGroup('', RenderControl('', 'password', 'password', 4, 'Password','Enter Password'));
			RenderGroup('', RenderControl('', 'verifyPassword', 'password', 4, 'Verify Password', 'Verify Password'));
			RenderGroup('', RenderControl($firstname, 'firstname', 'text', 4,'First Name', 'Enter First Name'));
			RenderGroup('', RenderControl($surname,   'surname',   'text', 4,'Sur Name', 'Enter Sur Name'));
			RenderGroup('', RenderControl($homeaddress, 'homeaddress', 'text', 4,'Home Address', 'Enter Home Address'));
			RenderGroup('', RenderControl($zipcode,   'zipcode',   'text', 4,'Zip Code', 'Enter Zip Code'));
			RenderGroup('', RenderControl($city, 'city', 'text', 4,'City', 'Enter City'));
			RenderGroup('', RenderControl($country,   'country',   'text', 4,'Country', 'Enter Country'));
	}

echo <<<EOT
	
				<div class="form-group">
				<div class="col-lg-offset-2 col-lg-10">
					<button type="submit" class="btn-lg btn-primary">Sign up</button>
				</div>
			</div>

		</form>
	</div>
</div>
EOT;

// Checks whether we are receiving a post request from the user-agent.
// If the UA just browses then GET requests are sent, but when the UA
// presses the sign up button we will receive a POST.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	// Input already sanitized

	if ($isFormValid) {
		
		// Create salt
		$sitewide_key = "eitf05 secure web shop sitewide key";
		$salt = uniqid(mt_rand(), true);

		// Create password hash
		$password = hash_hmac('sha512', $password . $salt, $sitewide_key);

		echo "<div>" . $username . "</div><div>" . $salt . "</div><div>" . $password . "</div>";
	}

	

	//

}

?>