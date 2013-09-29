<?php

include 'config.php';
include 'session.php';

$_SESSION['site'] = 'shop';

var_dump($_POST);


session_write_close();

//header('Location: index.php', true, 302);
//exit();

?>