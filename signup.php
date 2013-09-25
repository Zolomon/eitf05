<?php
	// TODO: move this into a function.

	include 'session.php';

	$_SESSION['site'] = 'signup';

	session_write_close();

	header('Location: index.php', true, 302);
	exit();

?>