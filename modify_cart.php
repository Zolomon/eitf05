<?php

include 'config.php';
include 'session.php';

$_SESSION['site'] = 'shop';

$user_id = $_SESSION['user'];

if(isset($_POST['add'])) {

	foreach($_POST['add'] as $item_id) {

		$count_arr = $_POST['count'];

		// Validate input: Only digits are allowed.
		if (preg_match("/^\d+$/", $count_arr[$item_id])) {

			$count = intval($count_arr[$item_id]);

			if ($count < 100) {

				for ($i = 1; $i <= $count; $i++){
					$stmt = $db->prepare("INSERT INTO cart (user_id, item_id) VALUES (:user_id, :item_id);");
					$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
					$stmt->bindParam(':item_id', $item_id, PDO::PARAM_INT);
					$stmt->execute();
				}

			}
		}
	}
}

session_write_close();

header('Location: index.php', true, 302);
exit();

?>