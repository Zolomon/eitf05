<?php
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