<?php

//$link = mysqli_connect('curses.zolomon.com', 'eitf05', 'eitf05 secure web shop: this the new password', 'eitf05', 8796);

// if (mysqli_connect_errno()) {
// 	printf("Connect failed: %s\n", mysqli_connect_error());
// 	exit();
// }

$cfconn = get_cfg_var('mysql_conn') . ";" . get_cfg_var('mysql_port') . ";" . get_cfg_var('mysql_datb') . ";" . get_cfg_var('mysql_char');
$cfuser = get_cfg_var('mysql_user');
$cfpass = get_cfg_var('mysql_pass');
$db = new PDO($cfconn, $cfuser, $cfpass, array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$sitewide_key = get_cfg_var('sitewide_key');

?>