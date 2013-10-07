<?php

/* Force https */
// $protocol = 'http';
// if (array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS'] === 'on') {
// 	$protocol = 'https';
// }
// if ($protocol != 'https') {
// 	$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// 	header("HTTP/1.1 301 Moved Permanently");
// 	header("Location: $actual_link");
// 	exit();
// }

try {

	include 'config.php';

	include 'session.php';		// Create a new session if none already exist, must be called before <html> since it's sent with the HTTP headers

	include 'header.php';

	include 'content.php';

	include 'footer.php';

} catch (PDOException $ex) {
	echo $ex->getMessage();
}

?>