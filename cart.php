<?php

include 'session.php';

$_SESSION['site'] = 'cart';

session_write_close();

header('Location: index.php', true, 302);
exit();

?>