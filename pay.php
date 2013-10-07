<?php

include 'config.php';
include 'session.php';

$_SESSION['site'] = 'receipt';
var_dump($_POST);
var_dump($_SESSION);

if(isset($_POST['pay'])){ // Remove all with that id
	$_SESSION['inputEmail'] = htmlspecialchars($_POST['inputEmail'];
	$_SESSION['inputFirst'] = htmlspecialchars($_POST['inputFirst'];
	$_SESSION['inputSur'] = htmlspecialchars($_POST['inputSur'];
	$_SESSION['inputStreet'] = htmlspecialchars($_POST['inputStreet'];
	$_SESSION['inputZip'] = htmlspecialchars($_POST['inputZip'];
	$_SESSION['inputCity'] = htmlspecialchars($_POST['inputCity'];
	$_SESSION['inputCountry'] = htmlspecialchars($_POST['inputCountry']);
	 
	$user_id = $_SESSION['user'];
	$stmt = $db->prepare("DELETE FROM cart WHERE user_id=:user_id;");
	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$stmt->execute();

}
 /*else { // Update amount to the one in count column
	$before_update = $_SESSION['before_update'];
	$update = $_POST['update'];
	foreach ($update as $item_id => $count) {
		$old_count = $before_update[$item_id];
		$new_count = intval($count);
		if ($new_count < $old_count){
			// Remove $nbr_to_delete entries of $item_id from $user_id's cart
			$nbr_to_delete = $old_count - $new_count;
			$stmt = $db->prepare("DELETE FROM cart WHERE item_id=:item_id AND user_id=:user_id ORDER BY id DESC LIMIT :nbr_to_delete;");
			$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
			$stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
			$stmt->bindParam(':nbr_to_delete', $nbr_to_delete, PDO::PARAM_INT);
			$stmt->execute();
		} elseif ($new_count > $old_count) {
			// Add $nbr_to_add entries of $item_id to $user_id's cart
			$nbr_to_add = $new_count - $old_count;
			for ($i = 0; $i < $nbr_to_add; $i++) { 
				$stmt = $db->prepare("INSERT into cart (user_id, item_id) VALUES (:user_id, :item_id);");
		    	$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		    	$stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
		    	$stmt->execute();
			}
		}
	}
}*/

session_write_close();

header('Location: index.php', true, 302);
exit();

?>