<?php

$values = [ 
'username' 			=> NULL,
'password'			=> NULL,
'verifyPassword'	=> NULL,
'firstname'			=> NULL,
'surname'			=> NULL,
'homeaddress'		=> NULL,
'zipcode'			=> NULL,
'city'				=> NULL
];

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

function SanitizeInput(&$values, &$link) {

	$values['username']				= $_POST["username"];
	$values['password']				= $_POST["password"];
	$values['verifyPassword']		= $_POST["verifyPassword"];
	$values['firstname']				= $_POST["firstname"];
	$values['surname']				= $_POST["surname"];
	$values['homeaddress']			= $_POST["homeaddress"];
	$values['zipcode']				= $_POST["zipcode"];
	$values['city']					= $_POST["city"];
	$values['country']				= $_POST["country"];

	// Protects against SQLi.
	$values['username']				= mysqli_real_escape_string($link, $values['username']);
	$values['password']				= mysqli_real_escape_string($link, $values['password']);
	$values['verifyPassword']		= mysqli_real_escape_string($link, $values['verifyPassword']);
	$values['firstname']				= mysqli_real_escape_string($link, $values['firstname']);
	$values['surname']				= mysqli_real_escape_string($link, $values['surname']);
	$values['homeaddress']			= mysqli_real_escape_string($link, $values['homeaddress']);
	$values['zipcode']				= mysqli_real_escape_string($link, $values['zipcode']);
	$values['city']					= mysqli_real_escape_string($link, $values['city']);
	$values['country']				= mysqli_real_escape_string($link, $values['country']);
}

function VerifyPasswords(&$password, &$verifyPassword)
{
	return strcmp($password, $verifyPassword) === 0 && !empty($password) && strlen($password) >= 12;
}

function IsInputValid(&$values)
{
	$result = !empty($values['username']) &&
				 !empty($values['password']) &&
				 !empty($values['verifyPassword']) &&
				 !empty($values['firstname']) &&
				 !empty($values['surname']) &&
				 !empty($values['homeaddress']) &&
				 !empty($values['zipcode']) &&
				 !empty($values['city']) &&
				 !empty($values['country']);

	return $result;
}

function IsFormValid(&$values) {
	$result = IsInputValid($values) && VerifyPasswords($values['password'], $values['verifyPassword']);

	return $result;
}



	// Render validation
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		echo <<<EOT
		<div class="container">
			<div class="row">
				<form class="form-horizontal" role="form" action="index.php" method="post">
EOT;

		SanitizeInput($values, $link);
		
		$isFormValid = IsFormValid($values);

		if (!$isFormValid) {

			$passwordSuccess = VerifyPasswords($values['password'], $values['verifyPassword']);

			RenderGroup(!empty($values['username']) ? 'success' : 'error',		RenderControl($values['username'], 'username', 'text', 4, 'Username', 'Enter Username'));
			RenderGroup($passwordSuccess ? 'success' : 'error',					RenderControl('', 'password', 'password', 4, 'Password','Enter Password'));
			RenderGroup($passwordSuccess ? 'success' : 'error',					RenderControl('', 'verifyPassword', 'password', 4, 'Verify Password', 'Verify Password'));
			RenderGroup(!empty($values['firstname']) ? 'success' : 'error',	RenderControl($values['firstname'], 'firstname', 'text', 4,'First Name', 'Enter First Name'));
			RenderGroup(!empty($values['surname']) ? 'success' : 'error', 		RenderControl($values['surname'],   'surname',   'text', 4,'Sur Name', 'Enter Sur Name'));
			RenderGroup(!empty($values['homeaddress'])? 'success' : 'error',	RenderControl($values['homeaddress'], 'homeaddress', 'text', 4,'Home Address', 'Enter Home Address'));
			RenderGroup(!empty($values['zipcode']) ? 'success' : 'error',		RenderControl($values['zipcode'],   'zipcode',   'text', 4,'Zip Code', 'Enter Zip Code'));
			RenderGroup(!empty($values['city']) ? 'success' : 'error',			RenderControl($values['city'], 'city', 'text', 4,'City', 'Enter City'));
			RenderGroup(!empty($values['country']) ? 'success' : 'error',		RenderControl($values['country'],   'country',   'text', 4,'Country', 'Enter Country'));
			
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


		} else {
			// POST && Validated --> Nothing to output, carry on.
		}

	} else {
		// GET --> Output empty form.
		echo <<<EOT
		<div class="container">
			<div class="row">
				<form class="form-horizontal" role="form" action="index.php" method="post">
EOT;
		RenderGroup('', RenderControl($values['username'], 'username', 'text', 4, 'Username', 'Enter Username'));
		RenderGroup('', RenderControl('', 'password', 'password', 4, 'Password','Enter Password'));
		RenderGroup('', RenderControl('', 'verifyPassword', 'password', 4, 'Verify Password', 'Verify Password'));
		RenderGroup('', RenderControl($values['firstname'], 'firstname', 'text', 4,'First Name', 'Enter First Name'));
		RenderGroup('', RenderControl($values['surname'],   'surname',   'text', 4,'Sur Name', 'Enter Sur Name'));
		RenderGroup('', RenderControl($values['homeaddress'], 'homeaddress', 'text', 4,'Home Address', 'Enter Home Address'));
		RenderGroup('', RenderControl($values['zipcode'],   'zipcode',   'text', 4,'Zip Code', 'Enter Zip Code'));
		RenderGroup('', RenderControl($values['city'], 'city', 'text', 4,'City', 'Enter City'));
		RenderGroup('', RenderControl($values['country'],   'country',   'text', 4,'Country', 'Enter Country'));

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
	}

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
		$password = hash_hmac('sha512', $values['password'] . $salt, $sitewide_key);

		// Create a prepared mysql statement
		//Prepare the statement by giving the SQL logic
		$stmt = mysqli_prepare($link, "INSERT INTO users (username, passwordhash, salt, firstname, surname, homeaddress, zipcode, city, country) VALUES (?,?,?,?,?,?,?,?,?)");
		//Bind parameters and result, execute and fetch parameters
		mysqli_stmt_bind_param($stmt,"sssssssss", 
			$values['username'],
			$values['password'],
			$values['verifyPassword'],
			$values['firstname'],
			$values['surname'],
			$values['homeaddress'],
			$values['zipcode'],
			$values['city'],
			$values['country']);

		mysqli_stmt_execute($stmt);

		// User created successfully
		echo <<<EOT
<div class="container">
	<div class="row">
		<div>
			<h1>Account Created Successfully</h1>
			<p>Your account was created successfully, you can now login at the top!</p>
		</div>
	</div>
</div>
EOT;
	}
}

?>