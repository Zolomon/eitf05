<?php

	// TODO: move this into a function.

	include 'session.php';

	// We are trying to login, we want to refer back to the site we came from,
	// so don't change the site variable.
	//$_SESSION['site'] = 'login';

	

	session_write_close();

	header('Location: index.php', true, 302);
	exit();

?>