<?php

include 'session.php';

$_SESSION['site'] = 'checkout';

session_write_close();

header('Location: index.php', true, 302);
exit();

?>