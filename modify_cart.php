<?php

include 'config.php';
include 'session.php';

$_SESSION['site'] = 'shop';

var_dump($_POST);
$user_id = $_SESSION['user'];

if(isset($_POST['count'])){
    foreach($_POST['count'] as $value){
    	$item_id = substr($value, 6);
    	$count_s = "count_\$" . $item_id;
    	$count = intval($_POST[$count_s]);
    	if ($count > 100) {
    		//echo "You cannot add more than 100 items at a time!";
    	} else {
	    	for ($i = 1; $i <= $count; $i++){
	    		$stmt = $db->prepare("INSERT into cart (user_id, item_id) VALUES (:user_id, :item_id);");
	    		$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	    		$stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
	    		$stmt->execute();
	    		//echo "Added item $item_id to user $user_id<br>";
	    	}
    	}
    }
}

session_write_close();

//header('Location: index.php', true, 302);
//exit();

?>