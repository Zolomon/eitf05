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

	$email = $_POST['email'];
	$password = $_POST['password'];

	$stmt = $db->prepare("SELECT salt, passwordhash FROM users WHERE username=:username");
	$stmt->bindParam(':username', $email, PDO::PARAM_STR);
	$stmt->execute();
	$rows = $stmt->fetchAll();

	$salt = $rows[0]["salt"];
	$storedHash = $rows[0]["passwordhash"];

	// Create salt
	$hash = hash_hmac('sha512', $password . $salt, $sitewide_key);

	$success = $hash === $storedHash;

	$_SESSION["loggedin"] = $success;

	session_write_close();

	header('Location: index.php', true, 302);
	exit();
?>