<?php

include 'config.php';

if (!$link) {
	die('Could not connect: ' . mysql_error());
}

include 'session.php';		// Create a new session if none already exist, must be called before <html> since it's sent with the HTTP headers

include 'header.php';

include 'content.php';

include 'footer.php';

mysql_close($link);

?>