<?php
	include 'config.php';
	include 'session.php';

	// We are trying to login, we want to refer back to the site we came from,
	// so don't change the site variable.
	//$_SESSION['site'] = 'login';

	// Get salt from DB
	// Calculate hash: password+salt
	// Compare calculated hash with hash in DB
	// Store in session variable that we are logged in
	// Redirect to index.php

if (isset($_POST['email']) && isset($_POST['password'])) {
	if(isset($_SESSION['failtime']) && $_SESSION['failtime'] > time()) {
		$_SESSION['failtime'] += 5;
	} elseif(isset($_SESSION['failed']) && $_SESSION['failed'] > 2){
		$_SESSION['failed'] = 0;
		$_SESSION['failtime'] = time() + 10;
	} else {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$stmt = $db->prepare("SELECT id, salt, passwordhash FROM users WHERE username=:username");
		$stmt->bindParam(':username', $email, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetchAll();

		$user_id = $rows[0]["id"];
		$salt = $rows[0]["salt"];
		$storedHash = $rows[0]["passwordhash"];

		// Create salt
		$hash = hash_hmac('sha512', $password . $salt, $sitewide_key);

		$success = $hash === $storedHash;

		$_SESSION["loggedin"] = $success;
		if($success){
			$_SESSION["user"] = $user_id;
			$_SESSION["username"] = $email;
			$_SESSION['timeout'] = time();
		} elseif (!isset($_SESSION['failed'])) {
			$_SESSION['failed'] = 1;
		} else {
			$_SESSION['failed']++;
		}
	}

	session_write_close();
}

header('Location: index.php', true, 302);
exit();
?>