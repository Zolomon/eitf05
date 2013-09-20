<?php

include 'config.php';

if (!$link) {
    die('Could not connect: ' . mysql_error());
}

include 'header.php';

include 'content.php';

include 'footer.php';

mysql_close($link);

?>