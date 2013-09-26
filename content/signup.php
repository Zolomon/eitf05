<?php
$values = [ 
'username' 			=> NULL,
'password'			=> NULL,
'verifyPassword'	=> NULL,
'firstname'			=> NULL,
'surname'			=> NULL,
'homeaddress'		=> NULL,
'zipcode'			=> NULL,
'city'				=> NULL,
'country'			=> NULL
];

$isInputValid = FALSE;

function render_ctrl($val, $name, $type, $cols, $label, $helptext) {
	// Only escape when outputting as HTML to protect user-agent
	$val = htmlspecialchars($val);

	$passwordHelp = '';

	if ($type === 'password' && $name !== 'verifyPassword') {
		$passwordHelp = '<span class="help-block">Password must be 12 characters or longer.</span>';
	}

	$inputGroup = "";

	if ($name === 'username') {
		$inputGroup = '<span class="input-group-addon">@</span>';
	}

	return <<<EOT
	<label for="$name" class="col-md-2 control-label">$label</label>
	<div class="input-group col-md-$cols">
		$inputGroup
		<input value="$val" type="$type" class="form-control" id="$name" name="$name" placeholder="$helptext">
		$passwordHelp
	</div>
EOT;
}

function render_grp($success, $control) {
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

function read_input(&$values, &$link) {
	$values['username']			= $_POST["username"];
	$values['password']			= $_POST["password"];
	$values['verifyPassword']	= $_POST["verifyPassword"];
	$values['firstname']			= $_POST["firstname"];
	$values['surname']			= $_POST["surname"];
	$values['homeaddress']		= $_POST["homeaddress"];
	$values['zipcode']			= $_POST["zipcode"];
	$values['city']				= $_POST["city"];
	$values['country']			= $_POST["country"];
}

function verify_password(&$password, &$verifyPassword) {
	return strcmp($password, $verifyPassword) === 0 && !empty($password) && strlen($password) >= 12;
}

function is_input_valid(&$values) {
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

function is_form_valid(&$values) {
	$result = is_input_valid($values) && verify_password($values['password'], $values['verifyPassword']);

	return $result;
}

	// Render validation
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		echo <<<EOT
		<div class="container">
			<div class="row">
				<form class="form-horizontal" role="form" action="index.php" method="post">
EOT;

		read_input($values, $link);
		
		$isFormValid = is_form_valid($values);

		if (!$isFormValid) {

			$passwordSuccess = verify_password($values['password'], $values['verifyPassword']);

			$valid_email = preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i', $values['username']);

			render_grp(!empty($values['username']) && $valid_email ? 'success' : 'error',
					render_ctrl($values['username'], 'username', 'text', 4, 'Email', 'Enter email'));
			render_grp($passwordSuccess ? 'success' : 'error',						render_ctrl('', 'password', 'password', 4, 'Password','Enter Password'));
			render_grp($passwordSuccess ? 'success' : 'error',						render_ctrl('', 'verifyPassword', 'password', 4, 'Verify Password', 'Verify Password'));
			render_grp(!empty($values['firstname']) ? 'success' : 'error',		render_ctrl($values['firstname'], 'firstname', 'text', 4,'First Name', 'Enter First Name'));
			render_grp(!empty($values['surname']) ? 'success' : 'error', 		render_ctrl($values['surname'],   'surname',   'text', 4,'Sur Name', 'Enter Sur Name'));
			render_grp(!empty($values['homeaddress'])? 'success' : 'error',	render_ctrl($values['homeaddress'], 'homeaddress', 'text', 4,'Home Address', 'Enter Home Address'));
			render_grp(!empty($values['zipcode']) ? 'success' : 'error',		render_ctrl($values['zipcode'],   'zipcode',   'text', 4,'Zip Code', 'Enter Zip Code'));
			render_grp(!empty($values['city']) ? 'success' : 'error',			render_ctrl($values['city'], 'city', 'text', 4,'City', 'Enter City'));
			render_grp(!empty($values['country']) ? 'success' : 'error',		render_ctrl($values['country'],   'country',   'text', 4,'Country', 'Enter Country'));
			
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
		render_grp('', render_ctrl($values['username'], 'username', 'text', 4, 'Email', 'Enter Email'));
		render_grp('', render_ctrl('', 'password', 'password', 4, 'Password','Enter Password'));
		render_grp('', render_ctrl('', 'verifyPassword', 'password', 4, 'Verify Password', 'Verify Password'));
		render_grp('', render_ctrl($values['firstname'], 'firstname', 'text', 4,'First Name', 'Enter First Name'));
		render_grp('', render_ctrl($values['surname'],   'surname',   'text', 4,'Sur Name', 'Enter Sur Name'));
		render_grp('', render_ctrl($values['homeaddress'], 'homeaddress', 'text', 4,'Home Address', 'Enter Home Address'));
		render_grp('', render_ctrl($values['zipcode'],   'zipcode',   'text', 4,'Zip Code', 'Enter Zip Code'));
		render_grp('', render_ctrl($values['city'], 'city', 'text', 4,'City', 'Enter City'));
		render_grp('', render_ctrl($values['country'],   'country',   'text', 4,'Country', 'Enter Country'));

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
	if ($isFormValid) {

		// Create salt
		$salt = uniqid(mt_rand(), true);

		// Create password hash, sitewide_key in config.php
		$password = hash_hmac('sha512', $values['password'] . $salt, $sitewide_key);

		// Create a prepared mysql statement
		// PROTECTION: Prepared Statements protect against SQL injections.
		$stmt = $db->prepare("INSERT INTO users (username, passwordhash, salt, firstname, surname, homeaddress, zipcode, city, country) " . 
			"VALUES (:username, :passwordHash, :salt, :firstname, :surname, :homeaddress, :zipcode, :city, :country)");
		
		$stmt->bindParam(':username', $values['username'], PDO::PARAM_STR);
		$stmt->bindParam(':passwordHash', $password, PDO::PARAM_STR);
		$stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
		$stmt->bindParam(':firstname', $values['firstname'], PDO::PARAM_STR);
		$stmt->bindParam(':surname', $values['surname'], PDO::PARAM_STR);
		$stmt->bindParam(':homeaddress', $values['homeaddress'], PDO::PARAM_STR);
		$stmt->bindParam(':zipcode', $values['zipcode'], PDO::PARAM_STR);
		$stmt->bindParam(':city', $values['city'], PDO::PARAM_STR);
		$stmt->bindParam(':country', $values['country'], PDO::PARAM_STR);

		$stmt->execute();

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