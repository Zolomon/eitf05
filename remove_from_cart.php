<?php

include 'config.php';
include 'session.php';

$_SESSION['site'] = 'cart';
var_dump($_POST);
var_dump($_SESSION);


$user_id = $_SESSION['user'];
if(isset($_POST['remove'])){ /* Remove all with that id */
	$item_id = $_POST['remove'];
	
	$stmt = $db->prepare("DELETE FROM cart WHERE item_id=:item_id AND user_id=:user_id;");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
	$stmt->execute();
	
} else { /* Update amount to the one in count column */
	/* TODO */
}

session_write_close();

header('Location: index.php', true, 302);
exit();

?>